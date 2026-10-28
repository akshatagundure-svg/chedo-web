<?php
// CMS helpers used by every public page.
//
// Text and links in the templates are written as  cms('<page>.<section>.NN', 'Default text')  -  the value saved
// in the admin CMS (table site_content) wins, the default in the template is the fallback. So the site
// keeps working with its built-in text if MySQL is down or the tables are not installed yet.
//
//   cms($key, $default)       plain text, HTML-escaped
//   cms_html($key, $default)  text that may contain <br>, <strong>, <em>, <span> (everything else stripped)
//   cmsu($key, $default)      a link / URL for an href="" attribute
//   cms_items($page, $sect)   repeating blocks (page_items table): course cards, journey steps, projects...
//   cms_icon($name, $class)   inline SVG from assets/icons/<name>.svg
//   cms_testimonials($limit)  student reviews (testimonials table)
//
// New keys are picked up by:  php database/sync_content.php   (or php database/install.php)

// If the database is unavailable db.php shows the "under maintenance" page (or the setup wizard on a first run).
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/functions.php';

if (!function_exists('cms_page_rows')) {
    /** All saved content values for one page (cached for the request): [content_key => value]. */
    function cms_page_rows(string $page): array
    {
        global $pdo;
        static $cache = [];
        if (!isset($cache[$page])) {
            $cache[$page] = [];
            if ($pdo) {
                try {
                    $st = $pdo->prepare('SELECT content_key, value FROM site_content WHERE page = ?');
                    $st->execute([$page]);
                    foreach ($st as $row) {
                        $cache[$page][$row['content_key']] = $row['value'];
                    }
                } catch (Throwable $e) {
                    error_log('cms_page_rows: ' . $e->getMessage());
                }
            }
        }
        return $cache[$page];
    }

    function cms_raw(string $key, string $default): string
    {
        $dot = strpos($key, '.');
        $rows = cms_page_rows($dot === false ? $key : substr($key, 0, $dot));
        return isset($rows[$key]) ? (string)$rows[$key] : $default;
    }

    function cms(string $key, string $default = ''): string
    {
        return htmlspecialchars(cms_raw($key, $default), ENT_QUOTES, 'UTF-8');
    }

    function cms_html(string $key, string $default = ''): string
    {
        return strip_tags(cms_raw($key, $default), '<br><strong><em><b><i><span>');
    }

    function cmsu(string $key, string $default = ''): string
    {
        return htmlspecialchars(cms_clean_url(cms_raw($key, $default)), ENT_QUOTES, 'UTF-8');
    }

    /** Blocks javascript:/data: links that someone may paste into a URL field. */
    function cms_clean_url(string $url): string
    {
        $url = trim($url);
        if (preg_match('#^\s*(javascript|data|vbscript):#i', $url)) {
            return '#';
        }
        return $url;
    }

    /** data-* attributes for an animated counter, derived from its visible text ("1,324+" -> target 1324, comma, suffix +). */
    function cms_counter_attrs(string $key, string $default): string
    {
        $text = cms_raw($key, $default);
        $target = (int)preg_replace('/\D+/', '', $text);
        $attrs = 'data-target="' . $target . '"';
        if (strpos($text, ',') !== false) {
            $attrs .= ' data-format="comma"';
        }
        if (preg_match('/\D+$/', $text, $m)) {
            $attrs .= ' data-suffix="' . htmlspecialchars(trim($m[0]), ENT_QUOTES, 'UTF-8') . '"';
        }
        return $attrs;
    }

    /** Repeating blocks for a page section, ordered, only the visible ones. */
    function cms_items(string $page, string $section): array
    {
        global $pdo;
        static $cache = [];
        if (!array_key_exists($page, $cache)) {
            $cache[$page] = null;
            if ($pdo) {
                try {
                    $st = $pdo->prepare('SELECT * FROM page_items WHERE page = ? AND status = 1 ORDER BY sort_order ASC, id ASC');
                    $st->execute([$page]);
                    $rows = [];
                    foreach ($st as $row) {
                        $rows[$row['section']][] = $row;
                    }
                    $cache[$page] = $rows ?: null; // nothing saved for the whole page -> use the built-in seed
                } catch (Throwable $e) {
                    error_log('cms_items: ' . $e->getMessage());
                }
            }
        }
        if ($cache[$page] !== null) {
            return $cache[$page][$section] ?? [];
        }
        return cms_seed_data()['page_items'][$page][$section] ?? [];
    }

    /** database/site_seed.json - the original site content, used when the database is unavailable. */
    function cms_seed_data(): array
    {
        static $seed = null;
        if ($seed === null) {
            $file = __DIR__ . '/../database/site_seed.json';
            $seed = is_file($file) ? (json_decode((string)file_get_contents($file), true) ?: []) : [];
            // page_items are stored flat in the seed file; group them like the database rows
            $grouped = [];
            foreach (($seed['page_items'] ?? []) as $row) {
                $grouped[$row['page']][$row['section']][] = $row + ['status' => 1];
            }
            $seed['page_items'] = $grouped;
        }
        return $seed;
    }

    function cms_testimonials(int $limit = 12): array
    {
        global $pdo;
        if ($pdo) {
            try {
                $st = $pdo->prepare('SELECT * FROM testimonials WHERE status = 1 ORDER BY sort_order ASC, id ASC LIMIT ' . (int)$limit);
                $st->execute();
                $rows = $st->fetchAll();
                if ($rows) {
                    return $rows;
                }
            } catch (Throwable $e) {
                error_log('cms_testimonials: ' . $e->getMessage());
            }
        }
        return array_slice(cms_seed_data()['testimonials'] ?? [], 0, $limit);
    }

    /** Inline <svg> from assets/icons/<name>.svg with the given CSS classes. */
    function cms_icon(?string $name, string $class = 'h-5 w-5', ?string $strokeWidth = null): string
    {
        static $cache = [];
        $name = preg_replace('/[^a-z0-9-]/', '', strtolower((string)$name));
        if ($name === '') {
            return '';
        }
        if (!isset($cache[$name])) {
            $file = __DIR__ . '/../assets/icons/' . $name . '.svg';
            $svg = is_file($file) ? (string)file_get_contents($file) : '';
            $svg = preg_replace('/<!--.*?-->\s*/s', '', $svg);
            $cache[$name] = trim($svg);
        }
        if ($cache[$name] === '') {
            return '';
        }
        $svg = preg_replace('/<svg\b[^>]*?\sclass="[^"]*"/s', '<svg aria-hidden="true" focusable="false" class="' . htmlspecialchars($class, ENT_QUOTES) . '"', $cache[$name], 1);
        if ($strokeWidth !== null) {
            $svg = preg_replace('/stroke-width="[^"]*"/', 'stroke-width="' . htmlspecialchars($strokeWidth, ENT_QUOTES) . '"', $svg, 1);
        }
        return $svg;
    }

    /** Contact details saved in Website Settings, in the shape assets/js/config.js expects (only filled-in fields). */
    function cms_site_overrides(): array
    {
        $s = get_settings();
        $out = [];
        if (!empty($s['phone'])) {
            $out['phoneDisplay'] = $s['phone'];
            $out['phoneTel'] = '+' . preg_replace('/\D+/', '', $s['phone']);
        }
        if (!empty($s['whatsapp'])) {
            $out['whatsapp'] = preg_replace('/\D+/', '', $s['whatsapp']);
        }
        foreach (['email' => 'email', 'address' => 'address', 'opening_hours' => 'hours'] as $col => $js) {
            if (!empty($s[$col])) {
                $out[$js] = $s[$col];
            }
        }
        return $out;
    }

    /** Identifier used in the admin "SEO" tab for the page being shown: home, courses, about, c-programming... */
    function cms_page_key(): string
    {
        $file = basename(parse_url($_SERVER['SCRIPT_NAME'] ?? '/index.php', PHP_URL_PATH) ?: 'index.php', '.php');
        return ($file === 'index' || $file === '') ? 'home' : $file;
    }

    function cms_seo(string $pageKey): array
    {
        global $pdo;
        if (!$pdo) {
            return [];
        }
        try {
            $st = $pdo->prepare('SELECT meta_title, meta_description, og_image FROM seo_settings WHERE page = ? LIMIT 1');
            $st->execute([$pageKey]);
            return $st->fetch() ?: [];
        } catch (Throwable $e) {
            error_log('cms_seo: ' . $e->getMessage());
            return [];
        }
    }
}

require_once __DIR__ . '/course-content.php';
