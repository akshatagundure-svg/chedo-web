<?php
// Builds chatbot/knowledge.json — the text the chat assistant answers from.
//
// Run it from the project folder whenever page content changes:
//     php chatbot/build-knowledge.php
//
// It renders every public page, keeps the visible text of the page body (no menus,
// footer, scripts or forms), splits it into page-tagged sections ("chunks"), and adds
// chatbot/extra-knowledge.md (facts that are not on the website, written by the team).
// The chunk format follows chedo_in_rag/: id, url, title, page_type, text.

if (PHP_SAPI !== 'cli') {
    http_response_code(404);
    exit;
}

$root = dirname(__DIR__);
$out_file = __DIR__ . '/knowledge.json';
$extra_file = __DIR__ . '/extra-knowledge.md';

$pages = ['/' => 'index.php', '/about.php' => 'about.php', '/courses.php' => 'courses.php',
          '/contact.php' => 'contact.php', '/services.php' => 'services.php',
          '/privacy-policy.php' => 'privacy-policy.php'];
foreach (glob($root . '/courses/*.php') as $f) {
    $pages['/courses/' . basename($f)] = 'courses/' . basename($f);
}

// Render one page in its own PHP process (pages use include_once and shared variables).
function render_page($root, $url, $file) {
    $cmd = [PHP_BINARY, '-d', 'display_errors=0', '-r',
            '$_SERVER["REQUEST_URI"] = getenv("REQUEST_URI"); include $argv[1];', basename($file)];
    $env = getenv();
    $env['REQUEST_URI'] = $url;
    $proc = proc_open($cmd, [1 => ['pipe', 'w'], 2 => ['pipe', 'w']], $pipes, $root . '/' . dirname($file), $env);
    if (!is_resource($proc)) {
        return '';
    }
    $html = stream_get_contents($pipes[1]);
    fclose($pipes[1]);
    fclose($pipes[2]);
    proc_close($proc);
    return $html;
}

// Turn a rendered page into lines of Markdown-like text (headings, bullets, paragraphs).
function page_to_text($html, $is_course, &$title, &$description) {
    libxml_use_internal_errors(true);
    $doc = new DOMDocument();
    $doc->loadHTML('<?xml encoding="UTF-8">' . $html);
    libxml_clear_errors();
    $xp = new DOMXPath($doc);

    $description = '';
    foreach ($xp->query('//meta[@name="description"]') as $m) {
        $description = trim($m->getAttribute('content'));
    }
    // Course pages are named by their <h1>; other pages by their <title> (before the "|").
    $h1 = $xp->query('//h1')->item(0);
    $t = $xp->query('//title')->item(0);
    $title = '';
    if ($h1 && $is_course) {
        $h1_html = preg_replace('#<br\s*/?>#i', ' ', $doc->saveHTML($h1));
        $title = trim(preg_replace('/\s+/u', ' ', html_entity_decode(strip_tags($h1_html), ENT_QUOTES, 'UTF-8')));
    }
    if ($title === '' && $t) {
        $title = trim(preg_replace('/\s*\|.*$/', '', $t->textContent));
        $title = $title === 'Chedo Tech' ? 'Chedo Tech home page' : $title;
    }

    $remove = '//script | //style | //noscript | //svg | //iframe | //img | //form | //select'
            . ' | //header[contains(@class,"site-header")] | //footer | //*[@id="wa-fab"]'
            . ' | //*[contains(@class,"skip-link")] | //nav | //*[@aria-hidden="true"]';
    foreach (iterator_to_array($xp->query($remove)) as $n) {
        $n->parentNode->removeChild($n);
    }

    $body = $xp->query('//main')->item(0) ?: $xp->query('//body')->item(0);
    if (!$body) {
        return [];
    }

    $prefix = ['h1' => '# ', 'h2' => '## ', 'h3' => '### ', 'h4' => '#### ', 'h5' => '#### ', 'h6' => '#### ', 'li' => '- '];
    $blocks = ['div', 'p', 'section', 'article', 'ul', 'ol', 'li', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6',
               'details', 'summary', 'table', 'tr', 'td', 'th', 'dl', 'dt', 'dd', 'blockquote', 'pre',
               'figure', 'figcaption', 'aside', 'button', 'label', 'br', 'main'];
    foreach (iterator_to_array($xp->query('.//*', $body)) as $el) {
        $tag = strtolower($el->nodeName);
        if (!in_array($tag, $blocks, true)) {
            continue;
        }
        $el->insertBefore($doc->createTextNode("\n" . ($prefix[$tag] ?? '')), $el->firstChild);
        $el->appendChild($doc->createTextNode("\n"));
    }

    $lines = [];
    foreach (preg_split('/\n/u', $body->textContent) as $line) {
        $line = trim(preg_replace('/[ \t\x{00A0}]+/u', ' ', $line));
        if ($line === '' || $line === '-' || preg_match('/^#+$/', $line)) {
            continue;
        }
        if ($lines && end($lines) === $line) {
            continue; // repeated line
        }
        $lines[] = $line;
    }
    return $lines;
}

// Group lines into sections under their nearest heading, then into ~1,000 character chunks.
function make_chunks($lines, $page_title, $max = 1400, $target = 900) {
    $sections = [];
    $current = ['heading' => $page_title, 'lines' => []];
    foreach ($lines as $line) {
        if (preg_match('/^#{1,4} (.+)$/u', $line, $m)) {
            if ($current['lines']) {
                $sections[] = $current;
            }
            $current = ['heading' => $m[1], 'lines' => []];
            continue;
        }
        $current['lines'][] = $line;
    }
    if ($current['lines']) {
        $sections[] = $current;
    }

    // Small neighbouring sections share a chunk; a section longer than $max is split
    // on line boundaries, repeating its heading in each part.
    $chunks = [];
    $buf = '';
    foreach ($sections as $s) {
        $parts = [];
        $part = '';
        foreach ($s['lines'] as $line) {
            if ($part !== '' && mb_strlen($part) + mb_strlen($line) > $target) {
                $parts[] = trim($part);
                $part = '';
            }
            $part .= $line . "\n";
        }
        $parts[] = trim($part);
        if (count($parts) > 1 && mb_strlen(implode("\n", $parts)) <= $max) {
            $parts = [implode("\n", $parts)];
        }
        foreach ($parts as $p) {
            $block = '## ' . $s['heading'] . "\n" . $p;
            if ($buf !== '' && mb_strlen($buf) + mb_strlen($block) > $target) {
                $chunks[] = ['text' => $buf];
                $buf = '';
            }
            $buf .= ($buf === '' ? '' : "\n\n") . $block;
        }
    }
    if (trim($buf) !== '') {
        $chunks[] = ['text' => $buf];
    }
    return $chunks;
}

// Search terms for one piece of text (used for BM25 ranking in chat-api.php).
require __DIR__ . '/search.php';

$chunks = [];
$catalog = [];
foreach ($pages as $url => $file) {
    $html = render_page($root, $url, $file);
    if ($html === '') {
        fwrite(STDERR, "Could not render $file\n");
        continue;
    }
    $is_course = strpos($url, '/courses/') === 0;
    $lines = page_to_text($html, $is_course, $title, $description);
    if ($is_course) {
        $catalog[] = ['name' => $title, 'url' => $url, 'summary' => $description];
    }
    $slug = $url === '/' ? 'home' : preg_replace('/[^a-z0-9]+/', '-', trim(str_replace('.php', '', $url), '/'));
    foreach (make_chunks($lines, $title) as $i => $c) {
        $chunks[] = [
            'id' => sprintf('%s-%03d', $slug, $i),
            'url' => $url,
            'title' => $title,
            'page_type' => $is_course ? 'course' : 'institute',
            'text' => $c['text'],
        ];
    }
    echo str_pad($url, 48), count($lines), " lines\n";
}

// Team-written facts: each "## Heading" section becomes one chunk.
if (is_file($extra_file)) {
    $md = preg_replace('/<!--.*?-->/s', '', file_get_contents($extra_file));
    $i = 0;
    foreach (preg_split('/^(?=## )/m', $md) as $section) {
        $section = trim($section);
        if (strpos($section, '## ') !== 0 || substr_count($section, "\n") < 1) {
            continue;
        }
        $chunks[] = ['id' => sprintf('extra-%03d', $i++), 'url' => '/contact.php', 'title' => 'Chedo Tech FAQ',
                     'page_type' => 'institute', 'text' => $section];
    }
    echo str_pad('chatbot/extra-knowledge.md', 48), "$i sections\n";
}

// BM25 statistics, computed once here so each chat request only scores.
$df = [];
$total_len = 0;
foreach ($chunks as &$c) {
    $terms = chat_terms($c['title'] . ' ' . $c['title'] . ' ' . $c['text']);
    $c['tf'] = array_count_values($terms);
    $c['len'] = count($terms);
    $total_len += $c['len'];
    foreach ($c['tf'] as $t => $_) {
        $df[$t] = ($df[$t] ?? 0) + 1;
    }
}
unset($c);

usort($catalog, function ($a, $b) { return strcmp($a['url'], $b['url']); });
$knowledge = [
    'built' => date('c'),
    'catalog' => $catalog,
    'stats' => ['n' => count($chunks), 'avgdl' => $chunks ? $total_len / count($chunks) : 0, 'df' => $df],
    'chunks' => $chunks,
];
file_put_contents($out_file, json_encode($knowledge, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
printf("\nWrote %s: %d chunks from %d pages, %d courses, %.0f KB\n",
       'chatbot/knowledge.json', count($chunks), count($pages), count($catalog), filesize($out_file) / 1024);
