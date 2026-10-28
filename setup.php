<?php
// First-run setup wizard.
//
// Asks for the MySQL host / database name / user / password, creates the database and tables, loads ALL the
// site data from database/chedo_data.json and saves config/database.php. It appears only while the site has no
// working database connection - once config/database.php works, the site never asks again.
//
// On a live server, an existing-but-broken config can only be changed after creating an empty file
// config/allow-setup.txt (proves file access); the wizard deletes it when it is done.

require_once __DIR__ . '/includes/installer.php';

session_start();
header('Cache-Control: no-store');
header('X-Robots-Tag: noindex');
if (empty($_SESSION['setup_csrf'])) {
    $_SESSION['setup_csrf'] = bin2hex(random_bytes(16));
}

$h = fn($s) => htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8');
$existing = chedo_load_config();
$local = chedo_is_local_request();
$allowed = $existing === null || $local || chedo_setup_unlocked();

// Is the saved configuration already working?
$working = false;
$workingNote = '';
if ($existing !== null) {
    try {
        $working = chedo_is_ready(chedo_pdo($existing));
    } catch (Throwable $e) {
        $workingNote = chedo_explain_error($e, $existing)['title'];
    }
}

$vals = chedo_normalize_cfg($existing ?? ['host' => 'localhost', 'port' => '3306', 'db' => 'chedo_tech', 'user' => 'root', 'pass' => '']);
$vals['pass'] = '';
$error = null;
$result = null;

if ($allowed && $_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!hash_equals($_SESSION['setup_csrf'], (string)($_POST['csrf'] ?? ''))) {
        $error = ['title' => 'The page expired', 'steps' => ['Reload the page and try again.'], 'raw' => ''];
    } else {
        $post = [
            'host' => trim((string)($_POST['host'] ?? '')),
            'port' => trim((string)($_POST['port'] ?? '')),
            'db' => trim((string)($_POST['db'] ?? '')),
            'user' => trim((string)($_POST['user'] ?? '')),
            'pass' => (string)($_POST['pass'] ?? ''),
            'charset' => 'utf8mb4',
        ];
        // Leaving the password empty on a re-run keeps the saved one when nothing else changed.
        if ($post['pass'] === '' && $existing !== null && !empty($_POST['keep_pass'])) {
            $post['pass'] = (string)($existing['pass'] ?? '');
        }
        $vals = $post;
        $vals['pass'] = '';
        $vals = chedo_normalize_cfg($vals);
        $log = [];
        try {
            if ($post['db'] === '' || $post['user'] === '') {
                throw new InvalidArgumentException('Please fill in the database name and the user name.');
            }
            if ($post['port'] !== '' && !ctype_digit($post['port'])) {
                throw new InvalidArgumentException('The port must be a number (usually 3306).');
            }
            chedo_pdo($post, false); // 1) can we reach MySQL with these details at all?
            $res = chedo_install($post, ['create_db' => !empty($_POST['create_db'])], function (string $l) use (&$log) { $log[] = $l; });
            $saved = chedo_save_config($post);
            if ($saved && is_file(chedo_root() . '/config/allow-setup.txt')) {
                @unlink(chedo_root() . '/config/allow-setup.txt');
            }
            $result = ['log' => $log, 'saved' => $saved, 'config_text' => $saved ? '' : chedo_config_text($post), 'source' => $res['source']];
        } catch (InvalidArgumentException $e) {
            $error = ['title' => $e->getMessage(), 'steps' => [], 'raw' => ''];
        } catch (Throwable $e) {
            $error = chedo_explain_error($e, $post) + ['raw' => $e->getMessage()];
        }
    }
}

// Environment checks shown on the page.
$checks = [
    ['PHP 8.0 or newer', PHP_VERSION_ID >= 80000, 'Found ' . PHP_VERSION],
    ['PDO MySQL extension (pdo_mysql)', extension_loaded('pdo_mysql'), 'Enable extension=pdo_mysql in php.ini'],
    ['mbstring extension', extension_loaded('mbstring'), 'Enable extension=mbstring in php.ini'],
    ['cURL extension (chat assistant)', extension_loaded('curl'), 'Optional - only the chat assistant needs it'],
    ['Site data file (database/chedo_data.json)', is_file(chedo_data_file()), 'Missing - the older built-in seed files will be used'],
    ['config/ folder writable', is_writable(chedo_root() . '/config'), 'The settings can still be copied by hand at the end'],
];
$blocking = !extension_loaded('pdo_mysql') || PHP_VERSION_ID < 80000;
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="noindex, nofollow">
<title>Setup | Chedo Tech</title>
<link rel="icon" type="image/png" href="/assets/logo-32.png">
<style>
  *{box-sizing:border-box}
  body{margin:0;background:#f1f5f9;color:#0f172a;font:15px/1.6 system-ui,-apple-system,"Segoe UI",Roboto,Arial,sans-serif;padding:24px}
  .wrap{max-width:680px;margin:0 auto}
  .head{display:flex;align-items:center;gap:14px;margin:8px 0 18px}
  .head img{width:52px;height:52px;object-fit:contain}
  h1{margin:0;font-size:1.5rem;letter-spacing:-.02em}.sub{margin:0;color:#64748b;font-size:.9rem}
  .card{background:#fff;border:1px solid #e2e8f0;border-radius:16px;padding:24px;margin-bottom:16px;box-shadow:0 4px 14px rgba(15,23,42,.04)}
  h2{margin:0 0 12px;font-size:1.05rem}
  label{display:block;font-weight:600;font-size:.88rem;margin:14px 0 4px}
  input[type=text],input[type=password],input[type=number]{width:100%;padding:10px 12px;border:1px solid #cbd5e1;border-radius:10px;font:inherit;background:#fff}
  input:focus{outline:2px solid #93c5fd;border-color:#2563eb}
  .row{display:grid;grid-template-columns:1fr 120px;gap:12px}
  .hint{font-size:.8rem;color:#64748b;margin:4px 0 0;font-weight:400}
  .chk{display:flex;gap:8px;align-items:flex-start;font-weight:500;margin-top:16px}.chk input{margin-top:5px}
  .btn{display:inline-block;border:0;cursor:pointer;background:#2563eb;color:#fff;font:600 1rem system-ui,sans-serif;padding:12px 22px;border-radius:12px;text-decoration:none;margin-top:20px}
  .btn:hover{background:#1d4ed8}.btn.s{background:#fff;color:#1e293b;border:1px solid #cbd5e1}
  ul.c{list-style:none;margin:0;padding:0}ul.c li{display:flex;gap:10px;padding:5px 0;font-size:.9rem;border-bottom:1px solid #f1f5f9}
  .ok{color:#15803d;font-weight:700}.no{color:#b91c1c;font-weight:700}.warn{color:#b45309;font-weight:700}
  .alert{border-radius:12px;padding:14px 16px;margin-bottom:16px;font-size:.92rem}
  .alert.e{background:#fef2f2;border:1px solid #fecaca;color:#7f1d1d}.alert.g{background:#f0fdf4;border:1px solid #bbf7d0;color:#14532d}.alert.i{background:#eff6ff;border:1px solid #bfdbfe;color:#1e3a8a}
  .alert ul{margin:6px 0 0;padding-left:20px}
  pre{background:#0f172a;color:#e2e8f0;border-radius:10px;padding:12px 14px;font:12.5px/1.55 ui-monospace,Consolas,monospace;overflow:auto;white-space:pre-wrap;word-break:break-word;margin:10px 0 0;max-height:320px}
  code{background:#f1f5f9;border-radius:5px;padding:1px 6px;font-size:.88em}
</style>
</head>
<body>
<div class="wrap">
  <div class="head"><img src="/assets/logo-110.webp" alt=""><div><h1>Chedo Tech &mdash; first-time setup</h1><p class="sub">Connect the website to your MySQL database. This runs only once.</p></div></div>

<?php if ($result): ?>
  <div class="alert g"><strong>All done.</strong> The database is ready and the website data has been installed (from the <?= $h($result['source']) ?>).</div>
  <?php if (!$result['saved']): ?>
    <div class="alert e"><strong>Could not write config/database.php</strong> (folder not writable). Create that file by hand with this content, then reload the site:
      <pre><?= $h($result['config_text']) ?></pre></div>
  <?php endif; ?>
  <div class="card"><h2>What was done</h2><pre><?= $h(implode("\n", $result['log'])) ?></pre>
    <p class="hint" style="margin-top:12px">Admin panel: <code>/admin/</code> &mdash; user <code>admin</code>, password <code>admin123</code> (unless you changed it in the original site). Change the password after your first login.</p>
    <a class="btn" href="/">Open the website</a> <a class="btn s" href="/admin/">Open the admin panel</a></div>

<?php elseif (!$allowed): ?>
  <div class="alert e"><strong>Setup is locked on this server.</strong> The site already has a database configuration<?= $workingNote ? ' (currently failing: ' . $h($workingNote) . ')' : '' ?>, and changing it from the internet is not allowed.
    <ul><li>To re-run the setup, create an empty file named <code>allow-setup.txt</code> inside the <code>config</code> folder (FTP / file manager), then reload this page.</li>
        <li>Or delete <code>config/database.php</code>.</li></ul></div>
  <a class="btn s" href="/">Back to the website</a>

<?php else: ?>
  <?php if ($working): ?>
    <div class="alert g"><strong>The website is already connected to its database.</strong> You do not need to do anything &mdash; the setup is never asked again. You can only use this form to switch to a different database.
      <br><a href="/" style="color:inherit;font-weight:600">&larr; Open the website</a></div>
  <?php elseif ($existing !== null): ?>
    <div class="alert e"><strong>The saved database settings do not work</strong><?= $workingNote ? ': ' . $h($workingNote) : '' ?>. Enter the correct details below (this happens when the project is moved to another computer or server).</div>
  <?php else: ?>
    <div class="alert i"><strong>Welcome!</strong> Enter your MySQL details. If the database does not exist it is created, and all courses, syllabus, page texts, reviews and settings are loaded into it automatically. If you already have the data in that database, nothing is overwritten.</div>
  <?php endif; ?>

  <?php if ($error): ?>
    <div class="alert e"><strong><?= $h($error['title']) ?></strong>
      <?php if ($error['steps']): ?><ul><?php foreach ($error['steps'] as $s): ?><li><?= $h($s) ?></li><?php endforeach; ?></ul><?php endif; ?>
      <?php if (!empty($error['raw'])): ?><pre><?= $h($error['raw']) ?></pre><?php endif; ?></div>
  <?php endif; ?>

  <div class="card"><h2>Requirements on this computer</h2><ul class="c">
    <?php foreach ($checks as [$name, $ok, $note]): ?>
      <li><span class="<?= $ok ? 'ok' : ($name[0] === 'c' || str_starts_with($name, 'Site') || str_starts_with($name, 'config') ? 'warn' : 'no') ?>"><?= $ok ? '✔' : '✖' ?></span><span><?= $h($name) ?><?php if (!$ok): ?> <span class="hint">&mdash; <?= $h($note) ?></span><?php endif; ?></span></li>
    <?php endforeach; ?></ul>
    <?php if ($blocking): ?><p class="alert e" style="margin:12px 0 0">Fix the red items above first, then reload this page.</p><?php endif; ?></div>

  <form class="card" method="post" autocomplete="off">
    <h2>MySQL connection</h2>
    <input type="hidden" name="csrf" value="<?= $h($_SESSION['setup_csrf']) ?>">
    <?php if ($existing !== null): ?><input type="hidden" name="keep_pass" value="1"><?php endif; ?>
    <div class="row"><div><label for="host">Host</label><input type="text" id="host" name="host" value="<?= $h($vals['host']) ?>" required></div>
      <div><label for="port">Port</label><input type="number" id="port" name="port" value="<?= $h($vals['port']) ?>" placeholder="3306"></div></div>
    <p class="hint">Your own computer (XAMPP / WAMP / MySQL): <code>localhost</code>, port <code>3306</code>. On hosting: copy the host from the hosting panel.</p>
    <label for="db">Database name</label><input type="text" id="db" name="db" value="<?= $h($vals['db']) ?>" required>
    <label for="user">User name</label><input type="text" id="user" name="user" value="<?= $h($vals['user']) ?>" required>
    <label for="pass">Password</label><input type="password" id="pass" name="pass" value="" autocomplete="new-password">
    <p class="hint">XAMPP default: user <code>root</code> with an empty password.<?= $existing !== null ? ' Leave empty to keep the saved password.' : '' ?></p>
    <label class="chk"><input type="checkbox" name="create_db" value="1" checked> <span>Create the database if it does not exist yet<br><span class="hint">Untick if your hosting gives you a ready-made empty database and the user cannot create databases.</span></span></label>
    <button class="btn" type="submit"<?= $blocking ? ' disabled' : '' ?>>Connect &amp; install data</button>
  </form>
<?php endif; ?>
</div>
</body>
</html>
