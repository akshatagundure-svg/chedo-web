<?php
/**
 * Saves the WHOLE live database (courses, syllabus, page texts, home blocks, reviews, SEO, settings, admin
 * account...) into database/chedo_data.json. That file travels with the project: on a new computer or server
 * the setup wizard (setup.php) loads it into the new empty MySQL database.
 *
 *   php database/export_data.php
 *
 * Run it again whenever you changed content in the admin CMS and want the next zip to contain it.
 * Enquiries (visitors' names / phone numbers) are NOT exported.
 */
if (PHP_SAPI !== 'cli') {
    http_response_code(404);
    exit;
}
require_once __DIR__ . '/../includes/installer.php';

$cfg = chedo_load_config();
if ($cfg === null) {
    fwrite(STDERR, "config/database.php is missing - nothing to export from.\n");
    exit(1);
}
try {
    $data = chedo_export_data(chedo_pdo($cfg));
} catch (Throwable $e) {
    fwrite(STDERR, 'Export failed: ' . $e->getMessage() . "\n");
    exit(1);
}
if (empty($data['tables']['site_settings']) && empty($data['tables']['courses'])) {
    fwrite(STDERR, "The database is empty - refusing to overwrite database/chedo_data.json.\n");
    exit(1);
}
$json = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PARTIAL_OUTPUT_ON_ERROR);
file_put_contents(chedo_data_file(), $json, LOCK_EX);
foreach ($data['meta']['counts'] as $t => $n) {
    printf("  %-18s %d rows\n", $t, $n);
}
printf("\nSaved %s (%.1f KB)\n", 'database/chedo_data.json', strlen($json) / 1024);
echo "Before zipping the project for someone else: delete config/database.php and .env (they hold passwords / API keys).\n";
