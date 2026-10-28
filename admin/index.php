<?php
// Checks the database first: no config -> setup wizard, MySQL down -> maintenance page, empty DB -> auto-install.
require_once __DIR__ . '/../includes/db.php';
// /admin (no trailing slash) would make relative links resolve to /login-process.php
if (preg_match('#/admin$#', parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH) ?: '')) {
    header('Location: /admin/', true, 301);
    exit;
}
session_start();
if (isset($_SESSION['admin'])) {
    header('Location: dashboard.php');
    exit;
}
if (empty($_SESSION['csrf'])) {
    $_SESSION['csrf'] = bin2hex(random_bytes(32));
}
$error = isset($_GET['error']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login — Chedo Tech CMS</title>
  <meta name="robots" content="noindex, nofollow">
  <link rel="icon" type="image/png" href="/assets/logo-32.png">
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    body {
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
      background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
      color: #f8fafc;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 1.5rem;
    }
    .login-container {
      width: 100%;
      max-width: 420px;
    }
    .brand-header {
      text-align: center;
      margin-bottom: 2rem;
    }
    .brand-logo {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 56px;
      height: 56px;
      border-radius: 14px;
      background: linear-gradient(135deg, #2563eb, #1d4ed8);
      color: #ffffff;
      font-weight: 800;
      font-size: 24px;
      box-shadow: 0 10px 25px -5px rgba(37, 99, 235, 0.4);
      margin-bottom: 1rem;
    }
    .brand-title {
      font-size: 1.5rem;
      font-weight: 700;
      color: #ffffff;
      letter-spacing: -0.02em;
    }
    .brand-subtitle {
      font-size: 0.875rem;
      color: #94a3b8;
      margin-top: 0.25rem;
    }
    .login-card {
      background: #ffffff;
      color: #0f172a;
      border-radius: 16px;
      padding: 2.25rem;
      box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.35);
      border: 1px solid rgba(255, 255, 255, 0.1);
    }
    .form-group {
      margin-bottom: 1.25rem;
    }
    .form-label {
      display: block;
      font-size: 0.8125rem;
      font-weight: 600;
      color: #334155;
      margin-bottom: 0.5rem;
      text-transform: uppercase;
      letter-spacing: 0.04em;
    }
    .form-input {
      width: 100%;
      padding: 0.75rem 1rem;
      border: 1.5px solid #cbd5e1;
      border-radius: 8px;
      font-size: 0.95rem;
      color: #0f172a;
      transition: all 0.2s ease;
      background: #f8fafc;
    }
    .form-input:focus {
      outline: none;
      border-color: #2563eb;
      background: #ffffff;
      box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.12);
    }
    .error-banner {
      background: #fef2f2;
      border: 1px solid #fecaca;
      color: #b91c1c;
      padding: 0.75rem 1rem;
      border-radius: 8px;
      font-size: 0.875rem;
      margin-bottom: 1.25rem;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }
    .btn-submit {
      width: 100%;
      padding: 0.85rem;
      border: none;
      border-radius: 8px;
      background: #2563eb;
      color: #ffffff;
      font-size: 0.95rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.2s ease;
      box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);
    }
    .btn-submit:hover {
      background: #1d4ed8;
      box-shadow: 0 6px 16px rgba(37, 99, 235, 0.35);
    }
    .btn-submit:active {
      transform: translateY(1px);
    }
    .footer-note {
      text-align: center;
      margin-top: 1.5rem;
      font-size: 0.8125rem;
      color: #64748b;
    }
    .footer-note a {
      color: #60a5fa;
      text-decoration: none;
      transition: color 0.2s;
    }
    .footer-note a:hover {
      color: #93c5fd;
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="login-container">
    <div class="brand-header">
      <div class="brand-logo">C</div>
      <h1 class="brand-title">Chedo Tech CMS</h1>
      <p class="brand-subtitle">Content Management &amp; Database Administration</p>
    </div>

    <div class="login-card">
      <?php if ($error): ?>
        <div class="error-banner" role="alert">
          <svg style="width:18px;height:18px;shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
          <span>Invalid username or password. Please try again.</span>
        </div>
      <?php endif; ?>

      <form method="post" action="/admin/login-process.php" autocomplete="on">
        <input type="hidden" name="csrf" value="<?php echo htmlspecialchars($_SESSION['csrf']); ?>">
        
        <div class="form-group">
          <label class="form-label" for="username">Administrator Username</label>
          <input type="text" id="username" name="username" class="form-input" placeholder="e.g. admin" autocomplete="username" required autofocus>
        </div>

        <div class="form-group">
          <label class="form-label" for="password">Password</label>
          <input type="password" id="password" name="password" class="form-input" placeholder="••••••••" autocomplete="current-password" required>
        </div>

        <button type="submit" class="btn-submit">Sign In to CMS</button>
      </form>
    </div>

    <div class="footer-note">
      <p>Secure Portal &bull; <a href="/" target="_blank">&larr; Return to Chedo Website</a></p>
    </div>
  </div>
</body>
</html>
