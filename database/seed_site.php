<?php
/**
 * Seeds the website content that lives outside the SQL seed files: the home page lists, the Google
 * reviews, the courses that only had a page (no database row yet) and the SEO title / description of
 * every page. Each part only runs while its table is empty / the row is missing, so nothing edited in
 * the admin CMS is ever overwritten.
 */
function seed_site(PDO $pdo): void
{
    $root = dirname(__DIR__);
    $seed = json_decode((string)file_get_contents(__DIR__ . '/site_seed.json'), true);
    if (!$seed) {
        echo "site_seed.json is missing or invalid - skipped\n";
        return;
    }

    // ---- home page lists (course cards, journey steps, projects)
    if ((int)$pdo->query('SELECT COUNT(*) FROM page_items')->fetchColumn() === 0) {
        $st = $pdo->prepare('INSERT INTO page_items (page, section, title, subtitle, description, tag, icon, link_label, link_url, sort_order, status)
                             VALUES (:page, :section, :title, :subtitle, :description, :tag, :icon, :link_label, :link_url, :sort_order, 1)');
        foreach ($seed['page_items'] as $it) {
            $st->execute([
                ':page' => $it['page'], ':section' => $it['section'], ':title' => $it['title'] ?? null,
                ':subtitle' => $it['subtitle'] ?? null, ':description' => $it['description'] ?? null,
                ':tag' => $it['tag'] ?? null, ':icon' => $it['icon'] ?? null, ':link_label' => $it['link_label'] ?? null,
                ':link_url' => $it['link_url'] ?? null, ':sort_order' => $it['sort_order'] ?? 0,
            ]);
        }
        echo 'Seeded ' . count($seed['page_items']) . " home page items\n";
    }

    // ---- student reviews
    if ((int)$pdo->query('SELECT COUNT(*) FROM testimonials')->fetchColumn() === 0) {
        $st = $pdo->prepare('INSERT INTO testimonials (student_name, course, testimonial, rating, review_date, source, source_url, status, sort_order)
                             VALUES (:n, :c, :t, :r, :d, :s, :u, 1, :o)');
        foreach ($seed['testimonials'] as $t) {
            $st->execute([
                ':n' => $t['student_name'], ':c' => $t['course'] ?? '', ':t' => $t['testimonial'], ':r' => $t['rating'] ?? 5,
                ':d' => $t['review_date'] ?? '', ':s' => $t['source'] ?? 'google', ':u' => $t['source_url'] ?? '', ':o' => $t['sort_order'] ?? 0,
            ]);
        }
        echo 'Seeded ' . count($seed['testimonials']) . " student reviews\n";
    }

    // ---- courses that only existed as static pages
    $cats = [];
    foreach ($pdo->query('SELECT id, slug FROM course_categories') as $row) {
        $cats[$row['slug']] = (int)$row['id'];
    }
    $order = (int)$pdo->query('SELECT COALESCE(MAX(sort_order), 0) FROM courses')->fetchColumn();
    $st = $pdo->prepare('INSERT IGNORE INTO courses (title, slug, short_description, full_description, category_id, level, featured, status, meta_title, meta_description, sort_order)
                         VALUES (:t, :s, :sd, :fd, :c, :l, 0, 1, :mt, :md, :o)');
    $addedCourses = 0;
    foreach ($seed['courses_extra'] ?? [] as $c) {
        $st->execute([
            ':t' => $c['title'], ':s' => $c['slug'], ':sd' => $c['short_description'], ':fd' => $c['full_description'],
            ':c' => $cats[$c['category']] ?? null, ':l' => $c['level'], ':mt' => $c['meta_title'], ':md' => $c['meta_description'], ':o' => ++$order,
        ]);
        $addedCourses += $st->rowCount();
    }
    if ($addedCourses) {
        echo "Added $addedCourses courses that only had a static page\n";
    }

    // ---- SEO title / description of every page (admin "SEO" tab)
    $pages = array_merge(glob($root . '/*.php'), glob($root . '/courses/*.php'));
    $headerSrc = (string)file_get_contents($root . '/includes/header.php');
    $defaults = [];
    foreach (['page_title', 'page_description'] as $var) {
        if (preg_match('/\$' . $var . ' = \$' . $var . ' \?\? "((?:[^"\\\\]|\\\\.)*)";/', $headerSrc, $m)) {
            $defaults[$var] = stripcslashes($m[1]);
        }
    }
    $st = $pdo->prepare('INSERT IGNORE INTO seo_settings (page, meta_title, meta_description) VALUES (?, ?, ?)');
    $seoAdded = 0;
    foreach ($pages as $file) {
        $base = basename($file, '.php');
        if (in_array($base, ['router', 'chat-api', 'send-otp', 'verify-otp', 'enquire-submit', 'course', '404'], true)) {
            continue;
        }
        $src = (string)file_get_contents($file);
        $title = $desc = null;
        if (preg_match('/\$page_title\s*=\s*"((?:[^"\\\\]|\\\\.)*)";/', $src, $m)) {
            $title = stripcslashes($m[1]);
        }
        if (preg_match('/\$page_description\s*=\s*"((?:[^"\\\\]|\\\\.)*)";/', $src, $m)) {
            $desc = stripcslashes($m[1]);
        }
        if ($base === 'index') {
            $title = $title ?? ($defaults['page_title'] ?? null);
            $desc = $desc ?? ($defaults['page_description'] ?? null);
            $base = 'home';
        }
        if ($title === null && $desc === null) {
            continue;
        }
        $st->execute([$base, $title, $desc]);
        $seoAdded += $st->rowCount();
    }
    if ($seoAdded) {
        echo "Seeded SEO settings for $seoAdded pages\n";
    }
}
