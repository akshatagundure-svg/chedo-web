<?php
/**
 * Registers every editable text / link used in the templates into the site_content table.
 *
 *   php database/sync_content.php
 *
 * The templates contain calls like  cms('home.hero.01', 'Default text')  /  cmsu(...)  /  cms_html(...).
 * This scans all public .php files for them and inserts the ones the database does not know yet
 * (value = the default text). Texts you already edited in the admin CMS are never touched - only the
 * "default" copy (used by the Reset button) and the display order are refreshed.
 *
 *   php database/sync_content.php --prune    also deletes rows no template uses any more, but only the ones nobody
 *                                            edited (value = default); an edited row is kept so no saved text is lost.
 */

/** @return array{added:int,total:int,orphans:int,pruned:int} */
function sync_content(PDO $pdo, string $root, bool $prune = false): array
{
    $skipDirs = ['admin', 'api', 'database', 'chatbot', 'chedo_in_rag', 'config', 'assets', 'uploads', '.git', '.kilo', 'node_modules', 'vendor'];
    // Files of one page, in the order they appear on screen (decides the order in the CMS editor)
    $preferred = [
        'includes/header.php', 'includes/hero.php', 'includes/home-courses.php', 'includes/home-features.php',
        'includes/home-testimonials.php', 'includes/footer.php',
    ];

    $files = [];
    $it = new RecursiveIteratorIterator(new RecursiveCallbackFilterIterator(
        new RecursiveDirectoryIterator($root, FilesystemIterator::SKIP_DOTS),
        function ($f) use ($skipDirs, $root) {
            if ($f->isDir()) {
                return !in_array($f->getFilename(), $skipDirs, true);
            }
            return substr($f->getFilename(), -4) === '.php' && $f->getFilename() !== 'cms.php';
        }
    ));
    foreach ($it as $f) {
        $rel = str_replace('\\', '/', substr($f->getPathname(), strlen($root) + 1));
        $files[] = $rel;
    }
    usort($files, function ($a, $b) use ($preferred) {
        $ra = array_search($a, $preferred, true);
        $rb = array_search($b, $preferred, true);
        $ra = $ra === false ? 100 : $ra;
        $rb = $rb === false ? 100 : $rb;
        return $ra <=> $rb ?: strcmp($a, $b);
    });

    $sections = [];
    $sectionFile = $root . '/database/content_sections.json';
    if (is_file($sectionFile)) {
        $sections = json_decode((string)file_get_contents($sectionFile), true) ?: [];
    }

    $found = []; // key => [type, default, order]
    $order = 0;
    $re = "/\\b(cms|cms_html|cmsu)\\(\\s*'((?:[^'\\\\]|\\\\.)*)'\\s*,\\s*'((?:[^'\\\\]|\\\\.)*)'\\s*\\)/s";
    foreach ($files as $rel) {
        $src = (string)file_get_contents($root . '/' . $rel);
        if (!preg_match_all($re, $src, $m, PREG_SET_ORDER)) {
            continue;
        }
        foreach ($m as $hit) {
            $key = stripcslashes($hit[2]);
            $default = preg_replace_callback("/\\\\(['\\\\])/", fn($x) => $x[1], $hit[3]);
            $type = $hit[1] === 'cmsu' ? 'url' : ($hit[1] === 'cms_html' ? 'html' : 'text');
            if ($type === 'text' && (strlen($default) > 90 || strpos($default, "\n") !== false)) {
                $type = 'textarea';
            }
            if (!isset($found[$key])) {
                $found[$key] = ['type' => $type, 'default' => $default, 'order' => ++$order];
            }
        }
    }

    $existing = [];
    foreach ($pdo->query('SELECT content_key FROM site_content') as $row) {
        $existing[$row['content_key']] = true;
    }

    $ins = $pdo->prepare(
        'INSERT INTO site_content (content_key, page, section, section_label, field_type, default_value, value, sort_order)
         VALUES (:k, :p, :s, :l, :t, :d, :d, :o)
         ON DUPLICATE KEY UPDATE page = VALUES(page), section = VALUES(section), section_label = VALUES(section_label),
                                 field_type = VALUES(field_type), default_value = VALUES(default_value), sort_order = VALUES(sort_order)'
    );
    $added = 0;
    $pdo->beginTransaction();
    foreach ($found as $key => $info) {
        $parts = explode('.', $key);
        $page = $parts[0];
        $section = count($parts) >= 3 ? implode('.', array_slice($parts, 1, -1)) : ($parts[1] ?? 'general');
        $label = $sections[$page . '.' . $section] ?? ucfirst(str_replace('-', ' ', $section));
        $ins->execute([
            ':k' => $key, ':p' => $page, ':s' => $section, ':l' => mb_substr($label, 0, 255),
            ':t' => $info['type'], ':d' => $info['default'], ':o' => $info['order'],
        ]);
        if (!isset($existing[$key])) {
            $added++;
        }
    }
    $pdo->commit();

    $orphans = array_keys(array_diff_key($existing, $found));
    $pruned = 0;
    if ($prune && $orphans) {
        foreach (array_chunk($orphans, 500) as $chunk) {
            $marks = implode(',', array_fill(0, count($chunk), '?'));
            $del = $pdo->prepare("DELETE FROM site_content WHERE content_key IN ($marks) AND (value <=> default_value OR value IS NULL)");
            $del->execute($chunk);
            $pruned += $del->rowCount();
        }
    }

    return [
        'added' => $added,
        'total' => count($found),
        'orphans' => count($orphans) - $pruned,
        'pruned' => $pruned,
    ];
}

// Run directly from the command line:  php database/sync_content.php
if (PHP_SAPI === 'cli' && isset($argv[0]) && realpath($argv[0]) === __FILE__) {
    $cfg = require __DIR__ . '/../config/database.php';
    $pdo = new PDO("mysql:host={$cfg['host']};dbname={$cfg['db']};charset={$cfg['charset']}", $cfg['user'], $cfg['pass'], [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
    $s = sync_content($pdo, dirname(__DIR__), in_array('--prune', $argv, true));
    echo "{$s['added']} new text blocks registered, {$s['total']} in use, {$s['orphans']} no longer in any template"
        . ($s['pruned'] ? ", {$s['pruned']} unused unedited rows deleted" : '') . "\n";
}
