<?php
$css = file_get_contents('assets/css/main.css');

// Minify safely with node or simple regex
// Let's write node script if available or clean php
// Remove comments
$css = preg_replace('#/\*.*?\*/#s', '', $css);
// Remove unnecessary whitespace
$css = preg_replace('/\s+/', ' ', $css);
$css = preg_replace('/\s*([\{\};:,>~])\s*/', '$1', $css);
$css = str_replace(';}', '}', $css);
$css = trim($css);

file_put_contents('assets/css/main.min.css', $css);
echo "Minified CSS successfully written: " . strlen($css) . " bytes\n";
