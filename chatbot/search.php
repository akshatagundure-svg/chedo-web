<?php
// Keyword search over chatbot/knowledge.json (BM25 ranking), shared by
// build-knowledge.php (to index) and chat-api.php (to find context for a question).

const CHAT_STOPWORDS = ['the', 'and', 'for', 'are', 'you', 'your', 'our', 'with', 'this', 'that', 'what',
    'which', 'how', 'can', 'will', 'from', 'have', 'has', 'was', 'were', 'about', 'into', 'all', 'any',
    'there', 'their', 'they', 'them', 'who', 'why', 'when', 'where', 'does', 'did', 'not', 'but', 'its',
    'also', 'more', 'than', 'then', 'too', 'very', 'just', 'get', 'got', 'want', 'need', 'please', 'tell',
    'is', 'in', 'of', 'to', 'a', 'an', 'on', 'at', 'by', 'or', 'as', 'be', 'it', 'me', 'my', 'we', 'us',
    'do', 'i', 'if', 'so', 'no', 'up', 'hi', 'hello', 'chedo', 'tech', 'course', 'courses'];

// Words that mean the same thing on this site, mapped to the word the pages use.
const CHAT_SYNONYMS = ['kid' => 'kids', 'child' => 'kids', 'children' => 'kids', 'son' => 'kids',
    'daughter' => 'kids', 'cpp' => 'cpp', 'ml' => 'machine', 'ai' => 'ai', 'genai' => 'generative',
    'llm' => 'llms', 'flutter' => 'flutter', 'android' => 'mobile', 'ios' => 'mobile', 'app' => 'mobile',
    'apps' => 'mobile', 'ui' => 'ui', 'ux' => 'ux', 'figma' => 'figma', 'address' => 'location',
    'located' => 'location', 'timing' => 'hours', 'timings' => 'hours', 'enroll' => 'enroll',
    'enrol' => 'enroll', 'admission' => 'enroll', 'join' => 'enroll', 'syllabus' => 'curriculum',
    'module' => 'modules', 'fee' => 'fees', 'price' => 'fees', 'cost' => 'fees'];

function chat_terms($text) {
    $text = mb_strtolower($text, 'UTF-8');
    $text = str_replace(['c++', 'c#', 'node.js', 'next.js', 'react.js'], [' cpp ', ' csharp ', ' node ', ' nextjs ', ' react '], $text);
    $terms = [];
    foreach (preg_split('/[^a-z0-9]+/', $text, -1, PREG_SPLIT_NO_EMPTY) as $w) {
        if ($w === 'c') {
            $terms[] = 'clang'; // keep the C language searchable
            continue;
        }
        if (strlen($w) < 2 || in_array($w, CHAT_STOPWORDS, true)) {
            continue;
        }
        if (strlen($w) > 4 && substr($w, -1) === 's' && substr($w, -2) !== 'ss') {
            $w = substr($w, 0, -1); // courses -> course, projects -> project
        }
        $terms[] = CHAT_SYNONYMS[$w] ?? $w;
    }
    return $terms;
}

// Returns the $limit best chunks for $query, best first.
function chat_search($knowledge, $query, $limit = 6, $k1 = 1.4, $b = 0.75) {
    $terms = array_unique(chat_terms($query));
    if (!$terms) {
        return [];
    }
    $n = $knowledge['stats']['n'];
    $avgdl = $knowledge['stats']['avgdl'] ?: 1;
    $df = $knowledge['stats']['df'];
    $scores = [];
    foreach ($knowledge['chunks'] as $i => $c) {
        $score = 0.0;
        foreach ($terms as $t) {
            if (empty($c['tf'][$t])) {
                continue;
            }
            $idf = log(1 + ($n - $df[$t] + 0.5) / ($df[$t] + 0.5));
            $tf = $c['tf'][$t];
            $score += $idf * ($tf * ($k1 + 1)) / ($tf + $k1 * (1 - $b + $b * $c['len'] / $avgdl));
        }
        if ($score > 0) {
            $scores[$i] = $score;
        }
    }
    arsort($scores);
    $result = [];
    foreach (array_slice($scores, 0, $limit, true) as $i => $score) {
        $result[] = $knowledge['chunks'][$i] + ['score' => $score];
    }
    return $result;
}
