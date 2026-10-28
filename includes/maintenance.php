<?php
// "Under maintenance" page, shown instead of the site whenever the database cannot be used.
//
//   visitors (live server)  -> friendly maintenance message only, no technical details
//   this computer / LAN     -> the same page plus a diagnostics box: what failed, why, and how to fix it
//
// Self-contained on purpose (no CMS, no database, no Tailwind) so it works when everything else is broken.

require_once __DIR__ . '/installer.php';

/**
 * @param string          $kind  'unreachable' | 'install_failed' | 'installing' | 'unconfigured'
 * @param Throwable|null  $e     the underlying error (shown to local requests only)
 * @param array           $cfg   connection settings that were used (password never shown)
 */
function chedo_maintenance(string $kind, ?Throwable $e = null, array $cfg = []): void
{
    $local = chedo_is_local_request();
    if ($e) {
        error_log('Chedo maintenance (' . $kind . '): ' . $e->getMessage());
    }
    if (!headers_sent()) {
        http_response_code(503);
        header('Retry-After: ' . ($kind === 'installing' ? '10' : '300'));
        header('Cache-Control: no-store');
        header('X-Robots-Tag: noindex');
        header('Content-Type: text/html; charset=utf-8');
    }
    $h = fn($s) => htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8');
    $installing = $kind === 'installing';
    $cfgN = $cfg ? chedo_normalize_cfg($cfg) : [];
    $why = $e ? chedo_explain_error($e, $cfg) : null;
    ?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="noindex, nofollow">
<?php if ($installing): ?><meta http-equiv="refresh" content="6"><?php endif; ?>
<title>Under maintenance | Chedo Tech</title>
<link rel="icon" type="image/png" href="/assets/logo-32.png">
<style>
  *{box-sizing:border-box}
  body{margin:0;min-height:100vh;display:flex;align-items:center;justify-content:center;padding:24px;background:#f8fafc;color:#0f172a;font:16px/1.6 system-ui,-apple-system,"Segoe UI",Roboto,Arial,sans-serif}
  .card{width:100%;max-width:640px;background:#fff;border:1px solid #e2e8f0;border-radius:20px;padding:40px 32px;box-shadow:0 10px 30px rgba(15,23,42,.06);text-align:center}
  .logo{width:72px;height:72px;object-fit:contain;margin-bottom:8px}
  h1{margin:8px 0 8px;font-size:1.75rem;letter-spacing:-.02em}
  p{margin:0 0 12px;color:#475569}
  .spin{width:34px;height:34px;margin:18px auto 0;border:4px solid #dbeafe;border-top-color:#2563eb;border-radius:50%;animation:s 1s linear infinite}
  @keyframes s{to{transform:rotate(360deg)}}
  .btns{display:flex;flex-wrap:wrap;gap:10px;justify-content:center;margin-top:22px}
  .btn{display:inline-block;padding:10px 20px;border-radius:12px;font-weight:600;text-decoration:none;font-size:.95rem}
  .btn-p{background:#2563eb;color:#fff}.btn-s{background:#fff;color:#1e293b;border:1px solid #cbd5e1}
  .diag{margin-top:28px;text-align:left;border:1px solid #fecaca;background:#fef2f2;border-radius:14px;padding:18px 20px;font-size:.92rem}
  .diag h2{margin:0 0 4px;font-size:1rem;color:#991b1b}
  .diag .tag{display:inline-block;font-size:.7rem;font-weight:700;letter-spacing:.06em;text-transform:uppercase;background:#991b1b;color:#fff;border-radius:6px;padding:2px 8px;margin-bottom:8px}
  .diag ul{margin:8px 0 0;padding-left:20px;color:#334155}
  .diag li{margin:3px 0}
  .diag pre{margin:12px 0 0;padding:10px 12px;background:#fff;border:1px solid #fecaca;border-radius:8px;white-space:pre-wrap;word-break:break-word;font:12.5px/1.5 ui-monospace,Consolas,monospace;color:#7f1d1d}
  .diag dl{display:grid;grid-template-columns:auto 1fr;gap:2px 12px;margin:10px 0 0;font-size:.85rem;color:#475569}
  .diag dt{font-weight:600}.diag dd{margin:0;font-family:ui-monospace,Consolas,monospace}
  .foot{margin-top:22px;font-size:.85rem;color:#94a3b8}
</style>
</head>
<body>
<main class="card">
  <img class="logo" src="/assets/logo-110.webp" alt="Chedo Tech" width="72" height="72">
  <?php if ($installing): ?>
    <h1>Setting things up&hellip;</h1>
    <p>The website data is being installed for the first time. This page refreshes by itself &mdash; it takes under a minute.</p>
    <div class="spin" aria-hidden="true"></div>
  <?php else: ?>
    <h1>We&rsquo;re under maintenance</h1>
    <p>Chedo Tech&rsquo;s website is temporarily unavailable while we do some work behind the scenes. Please check back in a little while.</p>
    <p>Need us right now? Call or WhatsApp <strong>+91 87931 00815</strong>.</p>
    <div class="btns">
      <a class="btn btn-p" href="https://wa.me/918793100815" rel="noopener">WhatsApp us</a>
      <a class="btn btn-s" href="">Try again</a>
    </div>
  <?php endif; ?>

  <?php if ($local && !$installing): ?>
  <section class="diag" aria-label="Diagnostics (only visible on this computer or local network)">
    <span class="tag">Developer details &middot; local only</span>
    <h2><?= $h($kind === 'unconfigured' ? 'The database has not been set up yet' : ($why['title'] ?? 'The database could not be used')) ?></h2>
    <?php if ($kind === 'install_failed'): ?><p style="color:#334155">The database connected, but loading the site data into it failed.</p><?php endif; ?>
    <?php if ($why): ?><ul><?php foreach ($why['steps'] as $s): ?><li><?= $h($s) ?></li><?php endforeach; ?></ul><?php endif; ?>
    <?php if ($cfgN): ?>
      <dl><dt>Host</dt><dd><?= $h($cfgN['host'] . ($cfgN['port'] !== '' ? ':' . $cfgN['port'] : '')) ?></dd>
          <dt>Database</dt><dd><?= $h($cfgN['db']) ?></dd>
          <dt>User</dt><dd><?= $h($cfgN['user']) ?></dd>
          <dt>Password</dt><dd><?= ($cfgN['pass'] ?? '') === '' ? '(empty)' : '&bull;&bull;&bull;&bull;&bull;&bull;' ?></dd></dl>
    <?php endif; ?>
    <?php if ($e): ?><pre><?= $h($e->getMessage()) ?></pre><?php endif; ?>
    <div class="btns" style="justify-content:flex-start">
      <a class="btn btn-p" href="/setup.php">Open the setup wizard</a>
      <a class="btn btn-s" href="">Retry</a>
    </div>
  </section>
  <?php endif; ?>
  <p class="foot">&copy; Chedo Tech, Pune</p>
</main>
</body>
</html>
<?php
    exit;
}
