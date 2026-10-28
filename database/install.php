<?php
/**
 * Chedo Tech database installer (command line).
 *
 *   php database/install.php           create the database + tables, fill every table that is still empty
 *   php database/install.php --fresh   DROP the database first and rebuild it (asks nothing - be careful)
 *
 * Normally you do not need this: open the site in a browser and the setup wizard (setup.php) does the same
 * thing. Safe to run again - tables that already have data are never overwritten.
 */
if (PHP_SAPI !== 'cli') {
    http_response_code(404);
    exit;
}
require_once __DIR__ . '/../includes/installer.php';

$cfg = chedo_load_config();
if ($cfg === null) {
    fwrite(STDERR, "config/database.php is missing - open the site in a browser to run the setup wizard, or copy config/database.example.php and fill it in.\n");
    exit(1);
}
try {
    $res = chedo_install($cfg, ['fresh' => in_array('--fresh', $argv, true)], function (string $l): void { echo $l, "\n"; });
} catch (Throwable $e) {
    $why = chedo_explain_error($e, $cfg);
    fwrite(STDERR, $why['title'] . "\n  " . $e->getMessage() . "\n");
    exit(1);
}
echo "\nDone (data from the {$res['source']}). Admin login: /admin/  (username: admin, password: admin123 unless you changed it)\n";
