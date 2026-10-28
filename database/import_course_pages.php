<?php
/**
 * Loads the syllabus and projects of the static course pages (database/course_pages_seed.json) into
 * course_modules / course_topics / course_projects, so the pages can render them from the database
 * and the admin CMS ("Courses" / "Syllabus Management") can edit them.
 *
 *   php database/import_course_pages.php                 only courses that have no modules / no projects yet
 *   php database/import_course_pages.php --replace       reset the syllabus + projects of every course in the file to the file's content
 *   php database/import_course_pages.php --replace c-programming java-dsa     ... only these pages
 *   add --dry-run to see what would change; nothing is written
 *
 * Without --replace nothing that already exists in the database is touched (edits made in the CMS are safe).
 * --replace updates existing rows in place (matched by position: course + sort order, module + sort order), so row ids
 * stay the same and an open admin CMS keeps working; only rows beyond the file's length are deleted, missing ones are added.
 */

/** Columns the course pages need on top of the base schema (also created by install.php on old databases). */
function course_content_columns(): array
{
    return [
        ['course_modules', 'group_title', 'VARCHAR(255) NULL AFTER description'],
        ['course_modules', 'tools', 'TEXT NULL AFTER group_title'],
        ['course_modules', 'summary', 'TEXT NULL AFTER tools'],
        ['course_topics', 'group_title', 'VARCHAR(255) NULL AFTER description'],
        ['course_projects', 'tag', 'VARCHAR(100) NULL AFTER description'],
        ['course_projects', 'subtag', 'VARCHAR(100) NULL AFTER tag'],
        ['course_projects', 'footnote', 'VARCHAR(255) NULL AFTER subtag'],
    ];
}

/**
 * Brings the rows of one parent (a course or a module) in line with $rows: row N of the file updates the Nth existing row
 * (ordered by sort_order, id), extra file rows are inserted, extra database rows are deleted. Only really changed rows are written.
 * @return int[] ids of the rows in file order
 */
function course_sync_rows(PDO $pdo, string $table, string $fk, int $parentId, array $rows, array $cols, array &$count, string $kind): array
{
    $sel = $pdo->prepare("SELECT * FROM `$table` WHERE `$fk` = ? ORDER BY sort_order ASC, id ASC");
    $sel->execute([$parentId]);
    $existing = $sel->fetchAll();
    $ids = [];
    foreach ($rows as $i => $row) {
        $row['sort_order'] = $i + 1;
        $want = [];
        foreach (array_merge($cols, ['sort_order']) as $c) {
            $want[$c] = $row[$c] ?? null;
        }
        if (isset($existing[$i])) {
            $ids[] = (int)$existing[$i]['id'];
            $set = [];
            $vals = [];
            foreach ($want as $c => $v) {
                if ((string)($existing[$i][$c] ?? '') !== (string)($v ?? '')) {
                    $set[] = "`$c` = ?";
                    $vals[] = $v;
                }
            }
            if ($set) {
                $vals[] = $existing[$i]['id'];
                $pdo->prepare("UPDATE `$table` SET " . implode(', ', $set) . ' WHERE id = ?')->execute($vals);
                $count[$kind]++;
            }
        } else {
            $names = array_keys($want);
            $pdo->prepare("INSERT INTO `$table` (`$fk`, `" . implode('`, `', $names) . '`) VALUES (?' . str_repeat(', ?', count($names)) . ')')
                ->execute(array_merge([$parentId], array_values($want)));
            $ids[] = (int)$pdo->lastInsertId();
            $count[$kind]++;
        }
    }
    for ($i = count($rows); $i < count($existing); $i++) {
        $pdo->prepare("DELETE FROM `$table` WHERE id = ?")->execute([$existing[$i]['id']]); // topics of a module cascade
        $count['deleted']++;
    }
    return $ids;
}

/**
 * @return array{modules:int,topics:int,projects:int,deleted:int} rows inserted or changed (and deleted)
 */
function import_course_pages(PDO $pdo, string $seedFile, bool $replace = false, array $only = [], bool $dryRun = false): array
{
    $stats = ['modules' => 0, 'topics' => 0, 'projects' => 0, 'deleted' => 0];
    foreach (course_content_columns() as [$table, $col, $def]) {
        $st = $pdo->prepare('SELECT COUNT(*) FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = ? AND COLUMN_NAME = ?');
        $st->execute([$table, $col]);
        if (!(int)$st->fetchColumn()) {
            $pdo->exec("ALTER TABLE `$table` ADD COLUMN `$col` $def"); // DDL commits, so it runs before any transaction
        }
    }
    $seed = json_decode((string)file_get_contents($seedFile), true) ?: [];
    $dbSlug = ['data-structures-algorithms' => 'data-structures', 'mobile-app-development' => 'mobile-app', 'ui-ux-design' => 'ui-ux'];

    $findCourse = $pdo->prepare('SELECT id FROM courses WHERE slug = ?');
    $hasModules = $pdo->prepare('SELECT COUNT(*) FROM course_modules WHERE course_id = ?');
    $hasProjects = $pdo->prepare('SELECT COUNT(*) FROM course_projects WHERE course_id = ?');

    foreach ($seed as $page => $data) {
        if ($only && !in_array($page, $only, true)) {
            continue;
        }
        $findCourse->execute([$dbSlug[$page] ?? $page]);
        $courseId = (int)$findCourse->fetchColumn();
        if (!$courseId) {
            echo "  ! no course row for $page - skipped\n";
            continue;
        }
        $pdo->beginTransaction();
        try {
            if (!empty($data['modules'])) {
                $hasModules->execute([$courseId]);
                if ($replace || !(int)$hasModules->fetchColumn()) {
                    $mods = [];
                    foreach ($data['modules'] as $m) {
                        $m['tools'] = !empty($m['tools']) ? implode("\n", $m['tools']) : null;
                        $mods[] = $m;
                    }
                    $ids = course_sync_rows($pdo, 'course_modules', 'course_id', $courseId, $mods,
                        ['title', 'description', 'group_title', 'tools', 'summary'], $stats, 'modules');
                    foreach ($data['modules'] as $i => $m) {
                        course_sync_rows($pdo, 'course_topics', 'module_id', $ids[$i], $m['topics'] ?? [],
                            ['title', 'description', 'group_title'], $stats, 'topics');
                    }
                }
            }
            if (!empty($data['projects'])) {
                $hasProjects->execute([$courseId]);
                if ($replace || !(int)$hasProjects->fetchColumn()) {
                    course_sync_rows($pdo, 'course_projects', 'course_id', $courseId, $data['projects'],
                        ['title', 'description', 'tag', 'subtag', 'footnote'], $stats, 'projects');
                }
            }
            $dryRun ? $pdo->rollBack() : $pdo->commit();
        } catch (Throwable $e) {
            $pdo->rollBack();
            echo "  ! $page failed: " . $e->getMessage() . "\n";
        }
    }
    return $stats;
}

if (PHP_SAPI === 'cli' && realpath($argv[0] ?? '') === realpath(__FILE__)) {
    $cfg = require __DIR__ . '/../config/database.php';
    $pdo = new PDO("mysql:host={$cfg['host']};dbname={$cfg['db']};charset={$cfg['charset']}", $cfg['user'], $cfg['pass'], [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
    $args = array_slice($argv, 1);
    $replace = in_array('--replace', $args, true);
    $dry = in_array('--dry-run', $args, true);
    $only = array_values(array_filter($args, fn($a) => strpos($a, '--') !== 0));
    $s = import_course_pages($pdo, __DIR__ . '/course_pages_seed.json', $replace, $only, $dry);
    echo ($dry ? '[dry run, nothing written] ' : '') . "Inserted or changed {$s['modules']} modules, {$s['topics']} topics, {$s['projects']} projects; {$s['deleted']} rows deleted\n";
}
