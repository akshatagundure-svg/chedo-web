<?php
$html = file_get_contents('http://localhost:8000/contact.php');
echo "HTML length: " . strlen($html) . "\n";
echo "Header logo match:\n";
if (preg_match('/<a[^>]+class="site-brand[^"]*"[^>]*>(.*?)<\/a>/s', $html, $m)) {
    echo trim($m[0]) . "\n\n";
} else {
    echo "No header site-brand found\n";
}

echo "Footer logo match:\n";
if (preg_match_all('/<a[^>]+class="site-brand[^"]*"[^>]*>(.*?)<\/a>/s', $html, $matches)) {
    if (isset($matches[0][1])) {
        echo trim($matches[0][1]) . "\n";
    }
}
