<?php
require_once __DIR__ . '/db.php';

if (!function_exists('esc')) {
    function esc($s){ return htmlspecialchars($s ?? '', ENT_QUOTES, 'UTF-8'); }
}
if (!function_exists('get_settings')) {
    function get_settings(){ global $pdo; if (!$pdo) { return []; } try { $st = $pdo->query("SELECT * FROM site_settings WHERE id=1 LIMIT 1")->fetch(); return $st ?: []; } catch(Throwable $e){ return []; } }
}
if (!function_exists('get_courses')) {
    function get_courses($limit=12){ global $pdo; return $pdo->query("SELECT c.*, cat.name as category_name, cat.slug as category_slug FROM courses c LEFT JOIN course_categories cat ON c.category_id = cat.id WHERE c.status=1 ORDER BY c.sort_order ASC, c.created_at DESC LIMIT $limit")->fetchAll(); }
}
if (!function_exists('get_course_by_slug')) {
    function get_course_by_slug($slug){ global $pdo; $st = $pdo->prepare("SELECT c.*, cat.name as category_name, cat.slug as category_slug FROM courses c LEFT JOIN course_categories cat ON c.category_id = cat.id WHERE c.slug=? AND c.status=1 LIMIT 1"); $st->execute([$slug]); return $st->fetch(); }
}
if (!function_exists('get_modules')) {
    function get_modules($course_id){ global $pdo; $st = $pdo->prepare("SELECT * FROM course_modules WHERE course_id=? ORDER BY sort_order ASC"); $st->execute([$course_id]); return $st->fetchAll(); }
}
if (!function_exists('get_topics')) {
    function get_topics($module_id){ global $pdo; $st = $pdo->prepare("SELECT * FROM course_topics WHERE module_id=? ORDER BY sort_order ASC"); $st->execute([$module_id]); return $st->fetchAll(); }
}
if (!function_exists('get_projects')) {
    function get_projects($course_id){ global $pdo; $st = $pdo->prepare("SELECT * FROM course_projects WHERE course_id=? AND status=1 ORDER BY sort_order ASC"); $st->execute([$course_id]); return $st->fetchAll(); }
}
if (!function_exists('get_testimonials')) {
    function get_testimonials($limit=6){ global $pdo; return $pdo->query("SELECT * FROM testimonials WHERE status=1 ORDER BY sort_order ASC LIMIT $limit")->fetchAll(); }
}
if (!function_exists('get_faqs')) {
    function get_faqs(){ global $pdo; return $pdo->query("SELECT * FROM faqs WHERE status=1 ORDER BY sort_order ASC")->fetchAll(); }
}
if (!function_exists('get_categories')) {
    function get_categories(){ global $pdo; return $pdo->query("SELECT * FROM course_categories ORDER BY sort_order ASC")->fetchAll(); }
}

if (!function_exists('get_level_badge_class')) {
    function get_level_badge_class($level) {
        $l = strtolower($level ?? '');
        if (str_contains($l, 'beginner')) return 'badge-beginner';
        if (str_contains($l, 'advanced')) return 'badge-advanced';
        return 'badge-intermediate';
    }
}

if (!function_exists('get_course_duration')) {
    function get_course_duration($slug) {
        $durations = [
            'c-programming' => '2 Months (60 Hours)',
            'cpp-programming' => '2 Months (60 Hours)',
            'java-programming' => '2.5 Months (75 Hours)',
            'python-programming' => '2.5 Months (75 Hours)',
            'data-structures' => '3 Months (90 Hours)',
            'data-science' => '6 Months (180 Hours)',
            'data-science-foundation' => '3 Months (90 Hours)',
            'mern-full-stack' => '6 Months (180 Hours)',
            'java-full-stack' => '6 Months (180 Hours)',
            'mobile-app' => '4 Months (120 Hours)',
            'ui-ux' => '3 Months (90 Hours)',
            'kids-programming' => '3 Months (60 Hours)',
        ];
        return $durations[$slug] ?? '3 Months (90 Hours)';
    }
}

if (!function_exists('get_course_title')) {
    // Course name as edited in the admin CMS (courses table); falls back to the built-in name.
    function get_course_title($slug, $fallback = '') {
        global $pdo;
        static $titles = null;
        if ($titles === null) {
            $titles = [];
            if ($pdo) {
                try {
                    foreach ($pdo->query("SELECT slug, title FROM courses WHERE status = 1") as $row) {
                        $titles[$row['slug']] = $row['title'];
                    }
                } catch (Throwable $e) {
                    error_log('get_course_title: ' . $e->getMessage());
                }
            }
        }
        return $titles[$slug] ?? $fallback;
    }
}
