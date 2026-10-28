<?php
$file = 'includes/contact-main.php';
$content = file_get_contents($file);

// 1. Update enquiry-form-card class
$content = str_replace(
    'class="enquiry-form-card p-6 sm:p-10 shadow-sm border border-slate-200 rounded-2xl bg-white"',
    'class="enquiry-form-card p-6 sm:p-10 lg:p-12 shadow-sm border border-slate-200 rounded-3xl bg-white"',
    $content
);

// 2. Update Group 1 grid to 4 columns on large screens
$content = str_replace(
    '<div class="grid gap-x-5 gap-y-4 sm:grid-cols-2">',
    '<div class="grid gap-x-5 gap-y-4 sm:grid-cols-2 lg:grid-cols-4">',
    $content
);

// 3. Update recommendation-cards grid to 2 columns on tablet/desktop
$content = str_replace(
    '<div id="recommendation-cards" class="grid gap-4 sm:grid-cols-1">',
    '<div id="recommendation-cards" class="grid gap-5 md:grid-cols-2">',
    $content
);

file_put_contents($file, $content);
echo "Successfully patched includes/contact-main.php\n";
