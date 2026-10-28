<?php
$c = file_get_contents('assets/css/main.css');
$classes = ['gap-1', 'gap-1.5', 'gap-2', 'gap-3', 'gap-3.5', 'gap-4', 'inline-flex', 'tracking-normal', 'text-slate-900', 'text-blue-600'];
foreach ($classes as $cls) {
    $escaped = preg_quote($cls, '/');
    if (preg_match('/(\.' . $escaped . '|\b' . str_replace('.', '\\.', $escaped) . '\b)/', $c)) {
        echo "Found $cls\n";
    } else {
        echo "MISSING $cls\n";
    }
}
