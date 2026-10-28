<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] !== 'POST'
    || empty($_SESSION['csrf']) || !hash_equals($_SESSION['csrf'], $_POST['csrf'] ?? '')) {
    header('Location: index.php?error=1');
    exit;
}
require '../includes/db.php';
$user = $_POST['username'] ?? '';
$pass = $_POST['password'] ?? '';
$st = $pdo->prepare("SELECT * FROM admins WHERE username=?");
$st->execute([$user]);
$admin = $st->fetch();
if ($admin && password_verify($pass, $admin['password_hash'])) {
    session_regenerate_id(true);
    $_SESSION['admin'] = true;
    $_SESSION['admin_id'] = (int)$admin['id'];
    $_SESSION['admin_user'] = $admin['username'];
    $_SESSION['admin_email'] = $admin['email'];
    $_SESSION['admin_default_password'] = ($pass === 'admin123');
    $_SESSION['csrf'] = bin2hex(random_bytes(32));
    header('Location: dashboard.php');
    exit;
}
sleep(2); // slow down password guessing
header('Location: index.php?error=1');
exit;
