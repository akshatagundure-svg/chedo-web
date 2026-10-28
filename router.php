<?php
// router.php — Development router for PHP built-in web server
// Run with: php -S localhost:8000 router.php

$rawPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$path = urldecode($rawPath);
$filePath = __DIR__ . $path;

// Serve existing files directly
if ($path !== '/' && file_exists($filePath) && !is_dir($filePath)) {
    return false;
}

// Serve existing directory index files
if (is_dir($filePath)) {
    if (file_exists($filePath . '/index.php')) {
        require $filePath . '/index.php';
        exit;
    }
    if (file_exists($filePath . '/index.html')) {
        require $filePath . '/index.html';
        exit;
    }
}

// Route /api/* to api/index.php
if (preg_match('#^/api(/|$)#', $path)) {
    require __DIR__ . '/api/index.php';
    exit;
}

// Default page resolution for extensionless PHP files
if (file_exists($filePath . '.php')) {
    require $filePath . '.php';
    exit;
}

// Root page
if ($path === '/' || $path === '') {
    require __DIR__ . '/index.php';
    exit;
}

// Not found
http_response_code(404);
if (file_exists(__DIR__ . '/404.php')) {
    require __DIR__ . '/404.php';
} else {
    echo "404 Not Found";
}
exit;
