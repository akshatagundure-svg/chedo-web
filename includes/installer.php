<?php
// Database bootstrap / installer library.
//
// Used by setup.php (first-run wizard), includes/db.php (auto-seeds an empty database) and
// database/install.php + database/export_data.php (command line). It does not depend on db.php.
//
// Data source: database/chedo_data.json (written by  php database/export_data.php)  holds every table of the
// live site. When that file is missing the older seed files (seed.sql, seed_courses.sql, site_seed.json,
// course_pages_seed.json) are used instead. Seeding only fills tables that are still EMPTY, so nothing that was
// edited in the CMS is ever overwritten.

if (defined('CHEDO_INSTALLER_LOADED')) {
    return;
}
define('CHEDO_INSTALLER_LOADED', true);

/** Tables copied by the export / import, in dependency order. (enquiries holds visitors' personal data and is never exported.) */
const CHEDO_DATA_TABLES = [
    'admins', 'site_settings', 'course_categories', 'courses', 'course_modules', 'course_topics',
    'course_projects', 'testimonials', 'faqs', 'services', 'seo_settings', 'site_content', 'page_items',
];

function chedo_root(): string
{
    return dirname(__DIR__);
}

function chedo_config_path(): string
{
    return chedo_root() . '/config/database.php';
}

function chedo_data_file(): string
{
    return chedo_root() . '/database/chedo_data.json';
}

/** Saved connection settings, or null when config/database.php does not exist / is not valid. */
function chedo_load_config(): ?array
{
    $file = chedo_config_path();
    if (!is_file($file)) {
        return null;
    }
    try {
        $cfg = require $file;
    } catch (Throwable $e) {
        return null;
    }
    return is_array($cfg) && !empty($cfg['db']) ? $cfg : null;
}

/** Fills in defaults and splits an old-style "host:port" value. */
function chedo_normalize_cfg(array $c): array
{
    $c += ['host' => 'localhost', 'port' => '', 'db' => '', 'user' => '', 'pass' => '', 'charset' => 'utf8mb4'];
    $host = trim((string)$c['host']);
    $port = trim((string)$c['port']);
    if ($port === '' && preg_match('/^([^:\[\]]+):(\d+)$/', $host, $m)) {
        $host = $m[1];
        $port = $m[2];
    }
    $c['host'] = $host === '' ? 'localhost' : $host;
    $c['port'] = $port;
    return $c;
}

/** Opens a connection (to the database, or only to the server when $withDb is false). Times out after 5 s. */
function chedo_pdo(array $cfg, bool $withDb = true): PDO
{
    if (!extension_loaded('pdo_mysql')) {
        throw new RuntimeException('could not find driver (the PHP pdo_mysql extension is not enabled)');
    }
    $cfg = chedo_normalize_cfg($cfg);
    $dsn = 'mysql:host=' . $cfg['host'] . ($cfg['port'] !== '' ? ';port=' . (int)$cfg['port'] : '')
        . ($withDb ? ';dbname=' . $cfg['db'] : '') . ';charset=' . $cfg['charset'];
    return new PDO($dsn, (string)$cfg['user'], (string)$cfg['pass'], [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_TIMEOUT => 5,
    ]);
}

/** MySQL error number inside an exception message ("SQLSTATE[HY000] [1045] ..."), 0 when unknown. */
function chedo_errno(Throwable $e): int
{
    if (preg_match('/\[(\d{4})\]/', $e->getMessage(), $m)) {
        return (int)$m[1];
    }
    return $e instanceof PDOException && isset($e->errorInfo[1]) ? (int)$e->errorInfo[1] : 0;
}

/** Plain-language explanation of a connection / install failure: ['title' => ..., 'steps' => [...]]. */
function chedo_explain_error(Throwable $e, array $cfg = []): array
{
    $cfg = chedo_normalize_cfg($cfg);
    $msg = $e->getMessage();
    $no = chedo_errno($e);
    $where = $cfg['host'] . ($cfg['port'] !== '' ? ':' . $cfg['port'] : '');
    if (stripos($msg, 'could not find driver') !== false) {
        return ['title' => 'PHP cannot talk to MySQL (pdo_mysql extension missing)', 'steps' => [
            'Open php.ini and enable the line  extension=pdo_mysql  (remove the leading semicolon).',
            'With XAMPP/WAMP this is already on - make sure you are using the PHP that comes with it.',
            'Restart the web server / php -S after changing php.ini.',
        ]];
    }
    switch ($no) {
        case 2002:
        case 2003:
        case 2006:
            return ['title' => "MySQL is not reachable at $where", 'steps' => [
                'MySQL / MariaDB may not be installed on this computer. Install XAMPP, WAMP or MySQL Community Server.',
                'If it is installed, start it (XAMPP Control Panel -> MySQL -> Start, or start the "MySQL" Windows service).',
                'Check the host and port - the default is localhost and 3306 (XAMPP sometimes uses 3307).',
                'On a hosting server the database host is often not "localhost" - copy it from the hosting panel.',
            ]];
        case 1045:
            return ['title' => 'MySQL refused the user name / password', 'steps' => [
                'Check the user name and password (XAMPP default: user root, empty password).',
                'On hosting, use the database user created in the hosting panel and make sure it is attached to the database.',
            ]];
        case 1049:
            return ['title' => "Database \"{$cfg['db']}\" does not exist", 'steps' => [
                'Tick "Create the database if it does not exist" in the setup wizard, or create it in phpMyAdmin.',
            ]];
        case 1044:
        case 1142:
        case 1227:
            return ['title' => 'This MySQL user is not allowed to create the database or tables', 'steps' => [
                'Create an empty database yourself (phpMyAdmin / hosting panel), give the user full rights on it, then run the setup again.',
            ]];
        case 2054:
            return ['title' => 'MySQL uses an authentication method this PHP cannot use', 'steps' => [
                'Use a newer PHP, or switch the MySQL user to mysql_native_password.',
            ]];
    }
    if (stripos($msg, 'getaddrinfo') !== false || stripos($msg, 'Unknown MySQL server host') !== false || $no === 2005) {
        return ['title' => "The database host \"{$cfg['host']}\" could not be found", 'steps' => [
            'Check the host name for typos (use localhost or 127.0.0.1 on your own computer).',
        ]];
    }
    return ['title' => 'The database could not be used', 'steps' => ['See the technical message below.']];
}

/** True when the database already holds the site (the single site_settings row exists). */
function chedo_is_ready(PDO $pdo): bool
{
    try {
        return (int)$pdo->query('SELECT COUNT(*) FROM site_settings')->fetchColumn() > 0;
    } catch (Throwable $e) {
        return false;
    }
}

/** Split an .sql text into statements (handles quotes and -- comments). */
function chedo_sql_statements(string $sql): array
{
    $out = [];
    $buf = '';
    $quote = null;
    $len = strlen($sql);
    for ($i = 0; $i < $len; $i++) {
        $c = $sql[$i];
        if ($quote) {
            $buf .= $c;
            if ($c === '\\' && $i + 1 < $len) {
                $buf .= $sql[++$i];
            } elseif ($c === $quote) {
                if ($i + 1 < $len && $sql[$i + 1] === $quote) {
                    $buf .= $sql[++$i];
                } else {
                    $quote = null;
                }
            }
            continue;
        }
        if ($c === "'" || $c === '"' || $c === '`') {
            $quote = $c;
            $buf .= $c;
        } elseif ($c === '-' && ($sql[$i + 1] ?? '') === '-' && in_array($sql[$i + 2] ?? ' ', [' ', "\t", "\r", "\n"], true)) {
            while ($i < $len && $sql[$i] !== "\n") {
                $i++;
            }
        } elseif ($c === ';') {
            if (trim($buf) !== '') {
                $out[] = trim($buf);
            }
            $buf = '';
        } else {
            $buf .= $c;
        }
    }
    if (trim($buf) !== '') {
        $out[] = trim($buf);
    }
    return $out;
}

/** Runs an .sql file; CREATE DATABASE / USE lines are skipped because the wizard picks the database itself. */
function chedo_run_sql_file(PDO $pdo, string $file): int
{
    $n = 0;
    foreach (chedo_sql_statements((string)file_get_contents($file)) as $stmt) {
        if (preg_match('/^\s*(CREATE\s+DATABASE|USE)\b/i', $stmt)) {
            continue;
        }
        $pdo->exec($stmt);
        $n++;
    }
    return $n;
}

function chedo_table_exists(PDO $pdo, string $table): bool
{
    $st = $pdo->prepare('SELECT COUNT(*) FROM information_schema.TABLES WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = ?');
    $st->execute([$table]);
    return (bool)$st->fetchColumn();
}

function chedo_table_count(PDO $pdo, string $table): int
{
    return (int)$pdo->query("SELECT COUNT(*) FROM `$table`")->fetchColumn();
}

function chedo_table_columns(PDO $pdo, string $table): array
{
    $st = $pdo->prepare('SELECT COLUMN_NAME FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = ?');
    $st->execute([$table]);
    return $st->fetchAll(PDO::FETCH_COLUMN);
}

function chedo_ensure_column(PDO $pdo, string $table, string $column, string $definition, callable $log): void
{
    if (!in_array($column, chedo_table_columns($pdo, $table), true)) {
        $pdo->exec("ALTER TABLE `$table` ADD COLUMN `$column` $definition");
        $log("  + added column $table.$column");
    }
}

/** Reads every exported table of the live database into an array (see database/export_data.php). */
function chedo_export_data(PDO $pdo): array
{
    $tables = [];
    foreach (CHEDO_DATA_TABLES as $t) {
        if (!chedo_table_exists($pdo, $t)) {
            continue;
        }
        $cols = chedo_table_columns($pdo, $t);
        $order = in_array('id', $cols, true) ? ' ORDER BY `id`' : '';
        $tables[$t] = $pdo->query("SELECT * FROM `$t`$order")->fetchAll();
    }
    return ['meta' => ['exported_at' => date('c'), 'counts' => array_map('count', $tables)], 'tables' => $tables];
}

/** Fills every EMPTY table from database/chedo_data.json. Returns [table => rows inserted]. */
function chedo_import_data(PDO $pdo, string $file, callable $log): array
{
    $data = json_decode((string)file_get_contents($file), true);
    if (!is_array($data) || !is_array($data['tables'] ?? null)) {
        throw new RuntimeException('database/chedo_data.json is not valid - run  php database/export_data.php  to rebuild it');
    }
    $inserted = [];
    $pdo->exec('SET FOREIGN_KEY_CHECKS=0');
    try {
        foreach (CHEDO_DATA_TABLES as $t) {
            $rows = $data['tables'][$t] ?? [];
            if (!$rows) {
                continue;
            }
            if (!chedo_table_exists($pdo, $t)) {
                continue;
            }
            if (chedo_table_count($pdo, $t) > 0) {
                $log("  = $t already has data - kept as it is");
                continue;
            }
            $cols = array_values(array_intersect(array_keys($rows[0]), chedo_table_columns($pdo, $t)));
            $sql = 'INSERT INTO `' . $t . '` (`' . implode('`,`', $cols) . '`) VALUES (' . implode(',', array_fill(0, count($cols), '?')) . ')';
            $st = $pdo->prepare($sql);
            $pdo->beginTransaction();
            foreach ($rows as $row) {
                $st->execute(array_map(fn($c) => $row[$c] ?? null, $cols));
            }
            $pdo->commit();
            $inserted[$t] = count($rows);
            $log("  + $t: " . count($rows) . ' rows');
        }
    } finally {
        $pdo->exec('SET FOREIGN_KEY_CHECKS=1');
    }
    return $inserted;
}

/**
 * Creates the database (if allowed), the tables and all site data. Safe to run again: only empty tables are filled.
 * $opts: 'fresh' => drop the database first, 'create_db' => create it when missing (default true).
 * Returns ['source' => 'data file'|'built-in seeds', 'db_created' => bool]. Throws on failure.
 */
function chedo_install(array $cfg, array $opts = [], ?callable $log = null): array
{
    $log = $log ?? function (string $l): void {};
    $opts += ['fresh' => false, 'create_db' => true];
    $cfg = chedo_normalize_cfg($cfg);
    $name = (string)$cfg['db'];
    if (!preg_match('/^[A-Za-z0-9_$-]{1,64}$/', $name)) {
        throw new RuntimeException('The database name may only contain letters, numbers, _ , $ and -.');
    }
    @set_time_limit(0);
    @ignore_user_abort(true);
    $root = chedo_root();
    $created = false;

    if ($opts['fresh']) {
        chedo_pdo($cfg, false)->exec("DROP DATABASE IF EXISTS `$name`");
        $log("Dropped database $name");
    }
    try {
        $pdo = chedo_pdo($cfg);
    } catch (PDOException $e) {
        if (chedo_errno($e) !== 1049 || !$opts['create_db']) {
            throw $e;
        }
        chedo_pdo($cfg, false)->exec("CREATE DATABASE `$name` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
        $created = true;
        $log("Created database $name");
        $pdo = chedo_pdo($cfg);
    }

    $n = chedo_run_sql_file($pdo, $root . '/database/schema.sql');
    $log("Tables ready ($n statements) in database $name");

    // Columns added after the first release (CREATE TABLE IF NOT EXISTS leaves old tables alone).
    chedo_ensure_column($pdo, 'testimonials', 'review_date', 'VARCHAR(50) NULL', $log);
    chedo_ensure_column($pdo, 'testimonials', 'source', "VARCHAR(30) DEFAULT 'google'", $log);
    chedo_ensure_column($pdo, 'testimonials', 'source_url', 'VARCHAR(255) NULL', $log);
    require_once $root . '/database/import_course_pages.php';
    foreach (course_content_columns() as [$table, $column, $definition]) {
        chedo_ensure_column($pdo, $table, $column, $definition, $log);
    }

    $capture = function (callable $fn) use ($log): void {
        ob_start();
        try {
            $fn();
        } finally {
            foreach (preg_split('/\R/', trim((string)ob_get_clean())) as $line) {
                if ($line !== '') {
                    $log('  ' . $line);
                }
            }
        }
    };

    if (is_file(chedo_data_file())) {
        $source = 'data file';
        $log('Loading site data from database/chedo_data.json');
        chedo_import_data($pdo, chedo_data_file(), $log);
    } else {
        $source = 'built-in seeds';
        $log('database/chedo_data.json not found - using the built-in seed files');
        foreach ([['admins', 'seed.sql'], ['courses', 'seed_courses.sql']] as [$table, $file]) {
            if (chedo_table_count($pdo, $table) === 0) {
                $log("  + $file (" . chedo_run_sql_file($pdo, "$root/database/$file") . ' statements)');
            }
        }
        require_once $root . '/database/seed_site.php';
        $capture(fn() => seed_site($pdo));
        if (chedo_table_count($pdo, 'course_modules') === 0) {
            $capture(function () use ($pdo, $root) {
                $c = import_course_pages($pdo, $root . '/database/course_pages_seed.json');
                echo "Seeded course syllabus ({$c['modules']} modules, {$c['topics']} topics, {$c['projects']} projects)\n";
            });
        }
    }

    // Registers every cms('key', 'default') found in the templates (adds only keys that are missing).
    require_once $root . '/database/sync_content.php';
    $capture(function () use ($pdo, $root) {
        $s = sync_content($pdo, $root);
        echo "Page content: {$s['added']} new text blocks registered, {$s['total']} total\n";
    });

    return ['source' => $source, 'db_created' => $created];
}

/** Saves config/database.php. Returns false when the folder is not writable (the caller then shows the text to copy). */
function chedo_config_text(array $cfg): string
{
    $cfg = chedo_normalize_cfg($cfg);
    $out = ['host' => $cfg['host'], 'port' => $cfg['port'], 'db' => $cfg['db'], 'user' => $cfg['user'], 'pass' => $cfg['pass'], 'charset' => $cfg['charset']];
    return "<?php\n// Written by setup.php - database connection. Never commit or share this file.\nreturn " . var_export($out, true) . ";\n";
}

function chedo_save_config(array $cfg): bool
{
    $file = chedo_config_path();
    if (!is_dir(dirname($file))) {
        @mkdir(dirname($file), 0755, true);
    }
    return @file_put_contents($file, chedo_config_text($cfg), LOCK_EX) !== false;
}

/** Request comes from this computer / the local network and is not behind a public proxy: safe to show technical details. */
function chedo_is_local_request(): bool
{
    if (PHP_SAPI === 'cli') {
        return true;
    }
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']) || !empty($_SERVER['HTTP_X_REAL_IP']) || !empty($_SERVER['HTTP_CF_CONNECTING_IP'])) {
        return false;
    }
    $ip = $_SERVER['REMOTE_ADDR'] ?? '';
    if ($ip === '::1' || strpos($ip, '127.') === 0) {
        return true;
    }
    return (bool)preg_match('/^(10\.|192\.168\.|172\.(1[6-9]|2\d|3[01])\.|169\.254\.|f[cd][0-9a-f]{2}:)/i', $ip);
}

/** An empty config/allow-setup.txt (created by whoever has file access to the server) re-opens setup.php on a live server. */
function chedo_setup_unlocked(): bool
{
    return is_file(chedo_root() . '/config/allow-setup.txt');
}
