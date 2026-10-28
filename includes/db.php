<?php
// Opens the MySQL connection as $pdo.
//
//   * config/database.php missing           -> redirects to the first-run setup wizard (/setup.php)
//   * MySQL unreachable / wrong credentials -> "under maintenance" page (with the exact reason on localhost)
//   * connected but the database is empty   -> installs the tables + all site data automatically, once
//
// Set $db_optional = true before including to get $pdo = null instead (used by scripts that handle a
// missing database themselves). Credentials live in config/database.php, created by the wizard; it is not in git.

require_once __DIR__ . '/installer.php';

/** [PDO|null, problem|null]. Never throws. */
function chedo_connect(): array
{
    $cfg = chedo_load_config();
    if ($cfg === null) {
        return [null, ['kind' => 'unconfigured', 'e' => null, 'cfg' => []]];
    }
    try {
        $pdo = chedo_pdo($cfg);
    } catch (Throwable $e) {
        $no = chedo_errno($e);
        if (chedo_is_local_request() && in_array($no, [1049, 1045, 1044], true)) {
            // On this computer: database deleted / wrong user or password -> ask for the details again
            return [null, ['kind' => 'needs_setup', 'e' => $e, 'cfg' => $cfg]];
        }
        if ($no === 1049) { // live server, database missing: try to create it and load the data
            return chedo_connect_install($cfg, null);
        }
        return [null, ['kind' => 'unreachable', 'e' => $e, 'cfg' => $cfg]];
    }
    return chedo_is_ready($pdo) ? [$pdo, null] : chedo_connect_install($cfg, $pdo);
}

/** Empty / missing database: load everything once (guarded by a MySQL lock so parallel visitors do not collide). */
function chedo_connect_install(array $cfg, ?PDO $pdo): array
{
    try {
        $pdo = $pdo ?? chedo_pdo($cfg, false);
        $lock = 'chedo_install_' . md5((string)$cfg['db']);
        $got = (int)$pdo->query('SELECT GET_LOCK(' . $pdo->quote($lock) . ', 20)')->fetchColumn();
        if (!$got) {
            return [null, ['kind' => 'installing', 'e' => null, 'cfg' => $cfg]]; // another visitor is installing right now
        }
        try {
            $ready = false;
            try {
                $db = chedo_pdo($cfg);
                $ready = chedo_is_ready($db);
            } catch (Throwable $ignored) {
            }
            if (!$ready) {
                chedo_install($cfg, ['create_db' => true]);
                $db = chedo_pdo($cfg);
            }
        } finally {
            $pdo->query('SELECT RELEASE_LOCK(' . $pdo->quote($lock) . ')');
        }
        return [$db, null];
    } catch (Throwable $e) {
        return [null, ['kind' => 'install_failed', 'e' => $e, 'cfg' => $cfg]];
    }
}

[$pdo, $db_problem] = chedo_connect();

if ($db_problem !== null) {
    if ($db_problem['e']) {
        error_log('Database: ' . $db_problem['kind'] . ' - ' . $db_problem['e']->getMessage());
    }
    if (empty($db_optional)) {
        $isApi = (bool)preg_match('#^/api(/|$)#', parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH) ?: '');
        if ($isApi) {
            http_response_code(503);
            header('Content-Type: application/json; charset=utf-8');
            $out = ['success' => false, 'message' => 'Database connection unavailable', 'error' => 'DATABASE_UNAVAILABLE'];
            if (in_array($db_problem['kind'], ['unconfigured', 'needs_setup'], true)) {
                $out['setup_required'] = true;
            }
            if (chedo_is_local_request() && $db_problem['e']) {
                $out['detail'] = $db_problem['e']->getMessage();
            }
            echo json_encode($out);
            exit;
        }
        if (in_array($db_problem['kind'], ['unconfigured', 'needs_setup'], true)) {
            header('Location: /setup.php', true, 302);
            exit;
        }
        require_once __DIR__ . '/maintenance.php';
        chedo_maintenance($db_problem['kind'], $db_problem['e'], $db_problem['cfg']);
           }
}
