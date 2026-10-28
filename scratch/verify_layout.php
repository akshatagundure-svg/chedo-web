<?php
$html = file_get_contents('http://localhost:8000/contact.php');

$checks = [
    'max-w-[1360px]' => 'Wide container 1360px',
    'rounded-3xl' => 'Premium rounded card',
    'lg:grid-cols-4' => '4-column desktop student details',
    'form-select-custom' => 'Custom select dropdowns',
    'tech-pill-btn' => 'Question 3 tech pills',
    'roadmap-wrapper-card' => 'Roadmap wrapper card',
    'roadmap-highway-svg' => 'Highway SVG',
    'stage-row-grid' => 'Stage row grid class exists in CSS/JS',
    'stage-pin-channel' => 'Stage pin channel class exists in CSS/JS',
    'road-connector-line' => 'Road connector line class exists in CSS/JS'
];

$allPassed = true;
foreach ($checks as $pattern => $label) {
    if (strpos($html, $pattern) !== false || file_exists_in_assets($pattern)) {
        echo "✓ $label: Found\n";
    } else {
        echo "✗ $label: MISSING\n";
        $allPassed = false;
    }
}

function file_exists_in_assets($pattern) {
    $css = file_get_contents('assets/css/main.min.css');
    return strpos($css, $pattern) !== false;
}

if ($allPassed) {
    echo "\nAll layout and styling checks PASSED!\n";
} else {
    echo "\nSome checks FAILED!\n";
    exit(1);
}
