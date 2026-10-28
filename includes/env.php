<?php
// Reads secret settings (like API keys) from a .env file of KEY=VALUE lines.
// Looks for .env in the project folder, then in the folder above it (outside the web root).
// A real environment variable set on the server takes priority over both.
function env_value($name, $default = '') {
    static $vars = null;
    if ($vars === null) {
        $vars = [];
        foreach ([dirname(__DIR__) . '/.env', dirname(__DIR__, 2) . '/.env'] as $file) {
            if (!is_readable($file)) {
                continue;
            }
            foreach (file($file, FILE_IGNORE_NEW_LINES) as $line) {
                $line = trim(preg_replace('/^\xEF\xBB\xBF/', '', $line)); // Notepad may add a BOM
                if ($line === '' || $line[0] === '#' || strpos($line, '=') === false) {
                    continue;
                }
                [$key, $value] = array_map('trim', explode('=', $line, 2));
                $key = preg_replace('/^export\s+/', '', $key);
                if (preg_match('/^(["\'])(.*)\1$/', $value, $m)) {
                    $value = $m[2];
                } else {
                    $value = trim(preg_replace('/\s+#.*$/', '', $value)); // trailing comment
                }
                $vars[$key] = $vars[$key] ?? $value; // the project folder's .env wins
            }
        }
    }
    $real = getenv($name);
    if ($real !== false && $real !== '') {
        return $real;
    }
    return ($vars[$name] ?? '') !== '' ? $vars[$name] : $default;
}
