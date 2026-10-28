<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: index.php');
    exit;
}
require_once __DIR__ . '/../includes/db.php';
$adminUser = $_SESSION['admin_user'] ?? 'Administrator';
$adminEmail = $_SESSION['admin_email'] ?? 'admin@chedo.in';
$isDefaultPassword = !empty($_SESSION['admin_default_password']);
$csrfToken = $_SESSION['csrf'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chedo Tech CMS — Admin Dashboard</title>
  <meta name="robots" content="noindex, nofollow">
  <link rel="icon" type="image/png" href="/assets/logo-32.png">
  <style>
    :root {
      --primary: #2563eb;
      --primary-hover: #1d4ed8;
      --primary-light: #eff6ff;
      --primary-border: #bfdbfe;
      --slate-900: #0f172a;
      --slate-800: #1e293b;
      --slate-700: #334155;
      --slate-600: #475569;
      --slate-500: #64748b;
      --slate-400: #94a3b8;
      --slate-300: #cbd5e1;
      --slate-200: #e2e8f0;
      --slate-100: #f1f5f9;
      --slate-50: #f8fafc;
      --sidebar-width: 260px;
      --header-height: 64px;
      --radius-sm: 6px;
      --radius-md: 10px;
      --radius-lg: 16px;
      --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
      --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.08), 0 2px 4px -2px rgba(0, 0, 0, 0.04);
      --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -4px rgba(0, 0, 0, 0.05);
      --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.12), 0 8px 10px -6px rgba(0, 0, 0, 0.04);
    }
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    body {
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
      background: var(--slate-100);
      color: var(--slate-800);
      min-height: 100vh;
      display: flex;
      font-size: 14px;
      line-height: 1.5;
    }
    a { color: inherit; text-decoration: none; }
    button { font-family: inherit; font-size: inherit; cursor: pointer; }

    /* LAYOUT */
    .cms-sidebar {
      width: var(--sidebar-width);
      background: var(--slate-900);
      color: var(--slate-300);
      display: flex;
      flex-direction: column;
      position: fixed;
      top: 0;
      bottom: 0;
      left: 0;
      z-index: 40;
      transition: transform 0.25s ease;
      overflow-y: auto;
      border-right: 1px solid var(--slate-800);
    }
    .cms-brand {
      padding: 1.25rem 1.25rem 1rem;
      display: flex;
      align-items: center;
      gap: 0.75rem;
      border-bottom: 1px solid rgba(255,255,255,0.08);
    }
    .cms-brand-logo {
      width: 38px;
      height: 38px;
      border-radius: 10px;
      background: linear-gradient(135deg, #2563eb, #1d4ed8);
      color: #fff;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 800;
      font-size: 1.15rem;
      box-shadow: 0 4px 12px rgba(37,99,235,0.4);
    }
    .cms-brand-text h2 {
      font-size: 1rem;
      font-weight: 700;
      color: #fff;
      letter-spacing: -0.01em;
    }
    .cms-brand-text span {
      font-size: 0.7rem;
      text-transform: uppercase;
      letter-spacing: 0.08em;
      color: var(--slate-400);
      display: block;
    }
    .cms-nav {
      padding: 0.75rem 0.5rem;
      flex: 1;
      display: flex;
      flex-direction: column;
      gap: 2px;
    }
    .cms-nav-item {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      padding: 0.65rem 0.85rem;
      border-radius: var(--radius-sm);
      color: var(--slate-400);
      font-weight: 500;
      font-size: 0.85rem;
      transition: all 0.15s ease;
      position: relative;
    }
    .cms-nav-item:hover {
      background: rgba(255, 255, 255, 0.05);
      color: #fff;
    }
    .cms-nav-item.active {
      background: var(--primary);
      color: #fff;
      font-weight: 600;
      box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
    }
    .cms-nav-item .nav-icon {
      font-size: 1.1rem;
      width: 20px;
      text-align: center;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .cms-nav-badge {
      margin-left: auto;
      background: #ef4444;
      color: #fff;
      font-size: 0.7rem;
      font-weight: 700;
      padding: 1px 7px;
      border-radius: 999px;
    }
    .cms-user-panel {
      padding: 1rem;
      border-top: 1px solid rgba(255,255,255,0.08);
      background: rgba(0,0,0,0.2);
    }
    .cms-user-info {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      margin-bottom: 0.75rem;
    }
    .cms-user-avatar {
      width: 34px;
      height: 34px;
      border-radius: 50%;
      background: var(--slate-700);
      color: #fff;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 700;
      font-size: 0.85rem;
    }
    .cms-user-meta {
      flex: 1;
      min-width: 0;
    }
    .cms-user-name {
      font-size: 0.85rem;
      font-weight: 600;
      color: #fff;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }
    .cms-user-sub {
      font-size: 0.725rem;
      color: var(--slate-400);
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }
    .cms-user-actions {
      display: flex;
      gap: 0.5rem;
    }
    .btn-user-action {
      flex: 1;
      padding: 0.4rem 0.5rem;
      font-size: 0.75rem;
      text-align: center;
      border-radius: var(--radius-sm);
      border: 1px solid var(--slate-700);
      background: var(--slate-800);
      color: var(--slate-300);
      transition: all 0.15s;
    }
    .btn-user-action:hover {
      background: var(--slate-700);
      color: #fff;
    }
    .btn-logout {
      border-color: rgba(239,68,68,0.3);
      color: #f87171;
    }
    .btn-logout:hover {
      background: #ef4444;
      color: #fff;
    }

    /* MAIN CONTENT */
    .cms-main {
      margin-left: var(--sidebar-width);
      flex: 1;
      min-width: 0;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }
    .cms-header {
      height: var(--header-height);
      background: #fff;
      border-bottom: 1px solid var(--slate-200);
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 1.75rem;
      position: sticky;
      top: 0;
      z-index: 30;
      box-shadow: var(--shadow-sm);
    }
    .cms-header-left {
      display: flex;
      align-items: center;
      gap: 1rem;
    }
    .cms-toggle-btn {
      display: none;
      background: none;
      border: 1px solid var(--slate-200);
      padding: 0.4rem 0.6rem;
      border-radius: var(--radius-sm);
      color: var(--slate-600);
    }
    .cms-title {
      font-size: 1.15rem;
      font-weight: 700;
      color: var(--slate-900);
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }
    .cms-title-badge {
      font-size: 0.725rem;
      font-weight: 600;
      padding: 2px 8px;
      border-radius: 999px;
      background: var(--slate-100);
      color: var(--slate-600);
    }
    .cms-header-right {
      display: flex;
      align-items: center;
      gap: 1rem;
    }
    .db-status-pill {
      display: flex;
      align-items: center;
      gap: 0.4rem;
      font-size: 0.75rem;
      font-weight: 600;
      color: #15803d;
      background: #f0fdf4;
      border: 1px solid #bbf7d0;
      padding: 0.35rem 0.75rem;
      border-radius: 999px;
    }
    .db-status-dot {
      width: 7px;
      height: 7px;
      border-radius: 50%;
      background: #22c55e;
      box-shadow: 0 0 0 2px rgba(34, 197, 94, 0.2);
    }
    .btn-primary-action {
      display: inline-flex;
      align-items: center;
      gap: 0.4rem;
      background: var(--primary);
      color: #fff;
      font-weight: 600;
      font-size: 0.85rem;
      padding: 0.5rem 1rem;
      border-radius: var(--radius-sm);
      border: none;
      box-shadow: 0 2px 4px rgba(37,99,235,0.2);
      transition: all 0.15s;
    }
    .btn-primary-action:hover {
      background: var(--primary-hover);
    }

    /* CONTENT BODY */
    .cms-body {
      padding: 1.75rem;
      flex: 1;
    }

    /* WARNING BANNER */
    .alert-banner {
      background: #fef2f2;
      border: 1px solid #fecaca;
      border-radius: var(--radius-md);
      padding: 1rem 1.25rem;
      margin-bottom: 1.5rem;
      display: flex;
      align-items: flex-start;
      gap: 0.75rem;
      color: #991b1b;
      font-size: 0.875rem;
    }
    .alert-banner strong { color: #b91c1c; }

    /* STATS GRID */
    .stats-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 1.25rem;
      margin-bottom: 1.75rem;
    }
    .stat-card {
      background: #fff;
      border-radius: var(--radius-md);
      padding: 1.25rem;
      border: 1px solid var(--slate-200);
      box-shadow: var(--shadow-sm);
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      transition: transform 0.15s, box-shadow 0.15s;
    }
    .stat-card:hover {
      transform: translateY(-2px);
      box-shadow: var(--shadow-md);
    }
    .stat-card-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 0.5rem;
    }
    .stat-card-title {
      font-size: 0.775rem;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.05em;
      color: var(--slate-500);
    }
    .stat-card-icon {
      width: 32px;
      height: 32px;
      border-radius: 8px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1rem;
      background: var(--primary-light);
      color: var(--primary);
    }
    .stat-card-value {
      font-size: 1.85rem;
      font-weight: 800;
      color: var(--slate-900);
      letter-spacing: -0.02em;
    }
    .stat-card-footer {
      font-size: 0.75rem;
      color: var(--slate-400);
      margin-top: 0.25rem;
    }

    /* CARD / TABLE CONTAINER */
    .panel-card {
      background: #fff;
      border-radius: var(--radius-md);
      border: 1px solid var(--slate-200);
      box-shadow: var(--shadow-sm);
      overflow: hidden;
      margin-bottom: 1.75rem;
    }
    .panel-card-header {
      padding: 1rem 1.25rem;
      border-bottom: 1px solid var(--slate-200);
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 0.75rem;
      background: #fff;
    }
    .panel-card-title {
      font-size: 1rem;
      font-weight: 700;
      color: var(--slate-900);
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }
    .panel-toolbar {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      flex-wrap: wrap;
    }
    .search-input-wrapper {
      position: relative;
    }
    .search-input {
      padding: 0.45rem 0.75rem 0.45rem 2rem;
      border: 1px solid var(--slate-300);
      border-radius: var(--radius-sm);
      font-size: 0.85rem;
      width: 220px;
      background: var(--slate-50);
      color: var(--slate-800);
      transition: all 0.15s;
    }
    .search-input:focus {
      outline: none;
      background: #fff;
      border-color: var(--primary);
      width: 260px;
    }
    .search-icon {
      position: absolute;
      left: 0.65rem;
      top: 50%;
      transform: translateY(-50%);
      color: var(--slate-400);
      pointer-events: none;
    }
    .select-filter {
      padding: 0.45rem 0.75rem;
      border: 1px solid var(--slate-300);
      border-radius: var(--radius-sm);
      font-size: 0.85rem;
      background: var(--slate-50);
      color: var(--slate-700);
    }

    /* TABLE */
    .table-responsive {
      width: 100%;
      overflow-x: auto;
    }
    .data-table {
      width: 100%;
      border-collapse: collapse;
      text-align: left;
    }
    .data-table th {
      background: var(--slate-50);
      padding: 0.75rem 1rem;
      font-size: 0.75rem;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.05em;
      color: var(--slate-500);
      border-bottom: 1px solid var(--slate-200);
      white-space: nowrap;
    }
    .data-table td {
      padding: 0.85rem 1rem;
      border-bottom: 1px solid var(--slate-100);
      font-size: 0.85rem;
      color: var(--slate-700);
      vertical-align: middle;
    }
    .data-table tr:last-child td {
      border-bottom: none;
    }
    .data-table tr:hover td {
      background: #fafafa;
    }

    /* BADGES */
    .badge {
      display: inline-flex;
      align-items: center;
      gap: 0.25rem;
      padding: 0.2rem 0.55rem;
      border-radius: 999px;
      font-size: 0.725rem;
      font-weight: 600;
      white-space: nowrap;
    }
    .badge-success { background: #dcfce7; color: #15803d; }
    .badge-danger { background: #fee2e2; color: #b91c1c; }
    .badge-info { background: #e0f2fe; color: #0369a1; }
    .badge-warning { background: #fef3c7; color: #b45309; }
    .badge-neutral { background: var(--slate-100); color: var(--slate-600); }
    .badge-primary { background: var(--primary-light); color: var(--primary); }

    /* ACTION BUTTONS */
    .btn-action-group {
      display: flex;
      align-items: center;
      gap: 0.35rem;
    }
    .btn-action {
      padding: 0.35rem 0.6rem;
      border-radius: var(--radius-sm);
      font-size: 0.775rem;
      font-weight: 600;
      border: 1px solid var(--slate-300);
      background: #fff;
      color: var(--slate-700);
      transition: all 0.15s;
    }
    .btn-action:hover {
      background: var(--slate-50);
      border-color: var(--slate-400);
      color: var(--slate-900);
    }
    .btn-action-edit:hover {
      border-color: var(--primary);
      color: var(--primary);
      background: var(--primary-light);
    }
    .btn-action-delete:hover {
      border-color: #ef4444;
      color: #ef4444;
      background: #fef2f2;
    }

    /* SYLLABUS MANAGEMENT TREE */
    .syllabus-header-card {
      background: #fff;
      border-radius: var(--radius-md);
      padding: 1.5rem;
      border: 1px solid var(--slate-200);
      box-shadow: var(--shadow-sm);
      margin-bottom: 1.5rem;
    }
    .syllabus-course-select {
      font-size: 1.05rem;
      font-weight: 700;
      padding: 0.65rem 1rem;
      border-radius: var(--radius-sm);
      border: 2px solid var(--primary);
      color: var(--slate-900);
      background: #fff;
      width: 100%;
      max-width: 480px;
      margin-bottom: 1rem;
    }
    .syllabus-module-card {
      background: #fff;
      border-radius: var(--radius-md);
      border: 1px solid var(--slate-200);
      box-shadow: var(--shadow-sm);
      margin-bottom: 1rem;
      overflow: hidden;
      transition: border-color 0.15s;
    }
    .syllabus-module-card:hover {
      border-color: var(--primary-border);
    }
    .syllabus-module-header {
      padding: 1rem 1.25rem;
      background: var(--slate-50);
      border-bottom: 1px solid var(--slate-200);
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 1rem;
      cursor: pointer;
      user-select: none;
    }
    .syllabus-module-title {
      font-size: 0.95rem;
      font-weight: 700;
      color: var(--slate-900);
      display: flex;
      align-items: center;
      gap: 0.6rem;
    }
    .syllabus-topics-container {
      padding: 0.75rem 1.25rem 1rem 2.5rem;
      background: #fff;
    }
    .syllabus-topic-item {
      padding: 0.6rem 0.75rem;
      border-radius: var(--radius-sm);
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 1rem;
      border-bottom: 1px dashed var(--slate-200);
    }
    .syllabus-topic-item:last-child {
      border-bottom: none;
    }
    .syllabus-topic-item:hover {
      background: var(--slate-50);
    }

    /* MODAL */
    .cms-modal-backdrop {
      display: none;
      position: fixed;
      inset: 0;
      background: rgba(15, 23, 42, 0.6);
      backdrop-filter: blur(2px);
      z-index: 100;
      align-items: center;
      justify-content: center;
      padding: 1rem;
    }
    .cms-modal-backdrop.open {
      display: flex;
    }
    .cms-modal-card {
      background: #fff;
      border-radius: var(--radius-lg);
      width: 100%;
      max-width: 640px;
      max-height: 90vh;
      display: flex;
      flex-direction: column;
      box-shadow: var(--shadow-xl);
      overflow: hidden;
      animation: modalFadeIn 0.2s ease-out;
    }
    @keyframes modalFadeIn {
      from { opacity: 0; transform: scale(0.96); }
      to { opacity: 1; transform: scale(1); }
    }
    .cms-modal-header {
      padding: 1.25rem 1.5rem;
      border-bottom: 1px solid var(--slate-200);
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
    .cms-modal-title {
      font-size: 1.15rem;
      font-weight: 700;
      color: var(--slate-900);
    }
    .cms-modal-close {
      background: none;
      border: none;
      font-size: 1.25rem;
      color: var(--slate-400);
      padding: 0.25rem;
      line-height: 1;
    }
    .cms-modal-close:hover { color: var(--slate-700); }
    .cms-modal-body {
      padding: 1.5rem;
      overflow-y: auto;
      flex: 1;
    }
    .cms-modal-footer {
      padding: 1rem 1.5rem;
      border-top: 1px solid var(--slate-200);
      background: var(--slate-50);
      display: flex;
      align-items: center;
      justify-content: flex-end;
      gap: 0.75rem;
    }

    /* FORM ELEMENTS */
    .form-row {
      margin-bottom: 1.15rem;
    }
    .form-row-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 1rem;
    }
    .field-label {
      display: block;
      font-size: 0.8rem;
      font-weight: 600;
      color: var(--slate-700);
      margin-bottom: 0.35rem;
    }
    .field-hint { font-size: 0.72rem; color: var(--slate-500, #64748b); margin-top: 0.3rem; line-height: 1.4; }
    .field-input, .field-textarea, .field-select {
      width: 100%;
      padding: 0.65rem 0.85rem;
      border: 1px solid var(--slate-300);
      border-radius: var(--radius-sm);
      font-size: 0.875rem;
      color: var(--slate-900);
      background: #fff;
      transition: border-color 0.15s, box-shadow 0.15s;
    }
    .field-input:focus, .field-textarea:focus, .field-select:focus {
      outline: none;
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(37,99,235,0.12);
    }
    .field-textarea {
      min-height: 90px;
      resize: vertical;
    }
    .field-help {
      font-size: 0.725rem;
      color: var(--slate-500);
      margin-top: 0.25rem;
    }

    /* TOAST NOTIFICATION */
    #toastContainer {
      position: fixed;
      bottom: 1.5rem;
      right: 1.5rem;
      z-index: 200;
      display: flex;
      flex-direction: column;
      gap: 0.5rem;
      pointer-events: none;
    }
    .toast {
      padding: 0.85rem 1.25rem;
      border-radius: var(--radius-md);
      color: #fff;
      font-weight: 600;
      font-size: 0.875rem;
      box-shadow: var(--shadow-lg);
      display: flex;
      align-items: center;
      gap: 0.6rem;
      pointer-events: auto;
      animation: toastIn 0.25s ease-out;
      min-width: 280px;
      max-width: 420px;
    }
    @keyframes toastIn {
      from { transform: translateY(20px); opacity: 0; }
      to { transform: translateY(0); opacity: 1; }
    }
    .toast-success { background: #15803d; }
    .toast-error { background: #b91c1c; }
    .toast-info { background: #0284c7; }

    /* EMPTY STATE */
    .empty-state {
      padding: 3rem 1.5rem;
      text-align: center;
      color: var(--slate-500);
    }
    .empty-state-icon {
      font-size: 2.5rem;
      margin-bottom: 0.5rem;
      opacity: 0.6;
    }

    /* RESPONSIVE */
    @media (max-width: 1024px) {
      .cms-sidebar {
        transform: translateX(-100%);
      }
      .cms-sidebar.open {
        transform: translateX(0);
      }
      .cms-main {
        margin-left: 0;
      }
      .cms-toggle-btn {
        display: block;
      }
    }
  
    /* WEBSITE CONTENT EDITOR (Page Content + Home Page Blocks tabs) */
    .content-toolbar { display:flex; flex-wrap:wrap; gap:0.75rem; align-items:center; padding:1rem 1.25rem; border-bottom:1px solid var(--slate-200); background:var(--slate-50); }
    .content-toolbar .field-select { width:auto; min-width:260px; max-width:100%; }
    .content-toolbar .grow { flex:1; min-width:180px; }
    .content-toolbar .spacer { flex:1; }
    .content-save-bar { position:sticky; top:var(--header-height); z-index:20; display:none; align-items:center; gap:1rem; padding:0.7rem 1.25rem; background:#fffbeb; border-bottom:1px solid #fde68a; color:#92400e; font-weight:600; }
    .content-save-bar.show { display:flex; }
    .content-save-bar .spacer { flex:1; }
    .content-section { border-bottom:1px solid var(--slate-200); }
    .content-section > summary { cursor:pointer; list-style:none; display:flex; align-items:center; gap:0.75rem; padding:0.9rem 1.25rem; font-weight:700; color:var(--slate-800); background:#fff; }
    .content-section > summary::-webkit-details-marker { display:none; }
    .content-section > summary::before { content:'\25B8'; color:var(--slate-400); transition:transform .15s; }
    .content-section[open] > summary::before { transform:rotate(90deg); }
    .content-section > summary:hover { background:var(--slate-50); }
    .content-section .count { margin-left:auto; font-weight:500; font-size:0.75rem; color:var(--slate-500); }
    .content-rows { padding:0.25rem 1.25rem 1.25rem; display:grid; gap:0.9rem; }
    .content-row { display:grid; grid-template-columns:70px 1fr 34px; gap:0.75rem; align-items:start; }
    .content-key { font-family:ui-monospace,Menlo,Consolas,monospace; font-size:0.7rem; color:var(--slate-500); padding-top:0.6rem; line-height:1.3; }
    .content-key b { display:block; color:var(--slate-700); }
    .content-input.is-dirty { border-color:#f59e0b; background:#fffbeb; }
    .content-input.is-edited { border-left:3px solid var(--primary); }
    .content-reset { border:1px solid var(--slate-200); background:#fff; border-radius:var(--radius-sm); height:34px; color:var(--slate-500); }
    .content-reset:hover { color:var(--primary); border-color:var(--primary-border); }
    .content-reset[disabled] { opacity:.35; cursor:default; }
    .block-icon { width:34px; height:34px; border-radius:8px; background:var(--slate-100); display:inline-flex; align-items:center; justify-content:center; }
    .block-icon img { width:18px; height:18px; }
    .block-move { padding:0.2rem 0.45rem; }
    .icon-picker { display:flex; gap:0.75rem; align-items:center; }
    .icon-picker .block-icon { flex:none; width:42px; height:42px; }
    .icon-picker .block-icon img { width:22px; height:22px; }
    @media (max-width: 640px) { .content-row { grid-template-columns:1fr 34px; } .content-key { grid-column:1 / -1; padding-top:0; } }
  </style>
</head>
<body>

  <!-- LEFT SIDEBAR -->
  <aside class="cms-sidebar" id="cmsSidebar">
    <div class="cms-brand">
      <div class="cms-brand-logo">C</div>
      <div class="cms-brand-text">
        <h2>Chedo Tech</h2>
        <span>Administration CMS</span>
      </div>
    </div>

    <nav class="cms-nav">
      <a href="#dashboard" class="cms-nav-item active" data-tab="dashboard">
        <span class="nav-icon">📊</span>
        <span>Dashboard</span>
      </a>
      <a href="#content" class="cms-nav-item" data-tab="content">
        <span class="nav-icon">✏️</span>
        <span>Page Content</span>
      </a>
      <a href="#blocks" class="cms-nav-item" data-tab="blocks">
        <span class="nav-icon">🧩</span>
        <span>Home Page Blocks</span>
      </a>
      <a href="#categories" class="cms-nav-item" data-tab="categories">
        <span class="nav-icon">📁</span>
        <span>Course Categories</span>
      </a>
      <a href="#courses" class="cms-nav-item" data-tab="courses">
        <span class="nav-icon">🎓</span>
        <span>Courses</span>
      </a>
      <a href="#syllabus" class="cms-nav-item" data-tab="syllabus">
        <span class="nav-icon">📚</span>
        <span>Syllabus Management</span>
      </a>
      <a href="#modules" class="cms-nav-item" data-tab="modules">
        <span class="nav-icon">📑</span>
        <span>Modules</span>
      </a>
      <a href="#topics" class="cms-nav-item" data-tab="topics">
        <span class="nav-icon">📝</span>
        <span>Topics</span>
      </a>
      <a href="#projects" class="cms-nav-item" data-tab="projects">
        <span class="nav-icon">🚀</span>
        <span>Projects</span>
      </a>
      <a href="#testimonials" class="cms-nav-item" data-tab="testimonials">
        <span class="nav-icon">💬</span>
        <span>Testimonials</span>
      </a>
      <a href="#faqs" class="cms-nav-item" data-tab="faqs">
        <span class="nav-icon">❓</span>
        <span>FAQs</span>
      </a>
      <a href="#services" class="cms-nav-item" data-tab="services">
        <span class="nav-icon">⚡</span>
        <span>Services</span>
      </a>
      <a href="#enquiries" class="cms-nav-item" data-tab="enquiries">
        <span class="nav-icon">📩</span>
        <span>Enquiries</span>
        <span class="cms-nav-badge" id="enquiryBadge" style="display:none;">0</span>
      </a>
      <a href="#seo" class="cms-nav-item" data-tab="seo">
        <span class="nav-icon">🔍</span>
        <span>SEO Settings</span>
      </a>
      <a href="#settings" class="cms-nav-item" data-tab="settings">
        <span class="nav-icon">⚙️</span>
        <span>Website Settings</span>
      </a>
    </nav>

    <div class="cms-user-panel">
      <div class="cms-user-info">
        <div class="cms-user-avatar"><?php echo strtoupper(substr($adminUser, 0, 1)); ?></div>
        <div class="cms-user-meta">
          <div class="cms-user-name"><?php echo htmlspecialchars($adminUser); ?></div>
          <div class="cms-user-sub"><?php echo htmlspecialchars($adminEmail); ?></div>
        </div>
      </div>
      <div class="cms-user-actions">
        <a href="/" target="_blank" class="btn-user-action">View Site &nearr;</a>
        <a href="logout.php" class="btn-user-action btn-logout">Logout</a>
      </div>
    </div>
  </aside>

  <!-- MAIN VIEW -->
  <main class="cms-main">
    <header class="cms-header">
      <div class="cms-header-left">
        <button class="cms-toggle-btn" id="sidebarToggle" aria-label="Toggle menu">&#9776;</button>
        <div class="cms-title">
          <span id="pageTitleText">Dashboard</span>
          <span class="cms-title-badge" id="recordCountBadge">Live</span>
        </div>
      </div>
      <div class="cms-header-right">
        <div class="db-status-pill">
          <span class="db-status-dot"></span>
          <span>MySQL: chedo_tech</span>
        </div>
        <button class="btn-primary-action" id="headerActionBtn" onclick="onHeaderAction()">
          <span>+ Add New</span>
        </button>
      </div>
    </header>

    <div class="cms-body">

      <?php if ($isDefaultPassword): ?>
      <div class="alert-banner" role="alert">
        <span style="font-size:1.25rem;">⚠️</span>
        <div>
          <strong>Security Notice: You are using the default password (admin123).</strong>
          <p style="margin-top:0.25rem;">Please update the password hash in the <code>admins</code> table before deploying this system to production.</p>
        </div>
      </div>
      <?php endif; ?>

      <!-- TAB 1: DASHBOARD -->
      <section id="tab-dashboard" class="tab-pane">
        <div class="stats-grid" id="statsGrid">
          <div class="stat-card">
            <div class="stat-card-header">
              <span class="stat-card-title">Total Courses</span>
              <div class="stat-card-icon">🎓</div>
            </div>
            <div class="stat-card-value" id="statCourses">-</div>
            <div class="stat-card-footer"><span id="statActiveCourses">-</span> active courses</div>
          </div>
          <div class="stat-card">
            <div class="stat-card-header">
              <span class="stat-card-title">Categories</span>
              <div class="stat-card-icon">📁</div>
            </div>
            <div class="stat-card-value" id="statCategories">-</div>
            <div class="stat-card-footer">Course classifications</div>
          </div>
          <div class="stat-card">
            <div class="stat-card-header">
              <span class="stat-card-title">Curriculum Modules</span>
              <div class="stat-card-icon">📑</div>
            </div>
            <div class="stat-card-value" id="statModules">-</div>
            <div class="stat-card-footer">Structured course units</div>
          </div>
          <div class="stat-card">
            <div class="stat-card-header">
              <span class="stat-card-title">Syllabus Topics</span>
              <div class="stat-card-icon">📝</div>
            </div>
            <div class="stat-card-value" id="statTopics">-</div>
            <div class="stat-card-footer">Granular lesson concepts</div>
          </div>
          <div class="stat-card">
            <div class="stat-card-header">
              <span class="stat-card-title">Hands-on Projects</span>
              <div class="stat-card-icon">🚀</div>
            </div>
            <div class="stat-card-value" id="statProjects">-</div>
            <div class="stat-card-footer">Practical student deliverables</div>
          </div>
          <div class="stat-card">
            <div class="stat-card-header">
              <span class="stat-card-title">Student Enquiries</span>
              <div class="stat-card-icon">📩</div>
            </div>
            <div class="stat-card-value" id="statEnquiries">-</div>
            <div class="stat-card-footer"><span id="statNewEnquiries" style="color:#ef4444;font-weight:700;">-</span> new leads</div>
          </div>
          <div class="stat-card">
            <div class="stat-card-header">
              <span class="stat-card-title">Testimonials</span>
              <div class="stat-card-icon">💬</div>
            </div>
            <div class="stat-card-value" id="statTestimonials">-</div>
            <div class="stat-card-footer">Student reviews</div>
          </div>
          <div class="stat-card">
            <div class="stat-card-header">
              <span class="stat-card-title">FAQs &amp; Services</span>
              <div class="stat-card-icon">⚡</div>
            </div>
            <div class="stat-card-value" id="statFaqsServices">-</div>
            <div class="stat-card-footer">Website informational content</div>
          </div>
        </div>

        <div class="panel-card">
          <div class="panel-card-header">
            <div class="panel-card-title">
              <span>Recent Enquiries</span>
            </div>
            <button class="btn-action" onclick="switchTab('enquiries')">View All Enquiries &rarr;</button>
          </div>
          <div class="table-responsive">
            <table class="data-table">
              <thead>
                <tr>
                  <th>Date</th>
                  <th>Name</th>
                  <th>Phone</th>
                  <th>Email</th>
                  <th>Course / Source</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody id="recentEnquiriesTbody">
                <tr><td colspan="7" class="empty-state">Loading enquiries from MySQL...</td></tr>
              </tbody>
            </table>
          </div>
        </div>
      </section>

      <!-- TAB 2: COURSE CATEGORIES -->
      <section id="tab-categories" class="tab-pane" style="display:none;">
        <div class="panel-card">
          <div class="panel-card-header">
            <div class="panel-card-title">Course Categories</div>
            <div class="panel-toolbar">
              <div class="search-input-wrapper">
                <span class="search-icon">🔍</span>
                <input type="text" class="search-input" placeholder="Search categories..." oninput="filterTable('categoriesTable', this.value)">
              </div>
              <button class="btn-primary-action" onclick="openCategoryModal()">+ Add Category</button>
            </div>
          </div>
          <div class="table-responsive">
            <table class="data-table" id="categoriesTable">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Slug</th>
                  <th>Description</th>
                  <th>Icon</th>
                  <th>Order</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody id="categoriesTbody"></tbody>
            </table>
          </div>
        </div>
      </section>

      <!-- TAB 3: COURSES -->
      <section id="tab-courses" class="tab-pane" style="display:none;">
        <div class="panel-card">
          <div class="panel-card-header">
            <div class="panel-card-title">Courses</div>
            <div class="panel-toolbar">
              <select class="select-filter" id="courseCategoryFilter" onchange="loadCourses()">
                <option value="">All Categories</option>
              </select>
              <select class="select-filter" id="courseStatusFilter" onchange="loadCourses()">
                <option value="">All Status</option>
                <option value="1">Active</option>
                <option value="0">Draft / Inactive</option>
              </select>
              <div class="search-input-wrapper">
                <span class="search-icon">🔍</span>
                <input type="text" class="search-input" placeholder="Search courses..." oninput="filterTable('coursesTable', this.value)">
              </div>
              <button class="btn-primary-action" onclick="openCourseModal()">+ Add Course</button>
            </div>
          </div>
          <div class="table-responsive">
            <table class="data-table" id="coursesTable">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Title &amp; Slug</th>
                  <th>Category</th>
                  <th>Level</th>
                  <th>Featured</th>
                  <th>Status</th>
                  <th>Order</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody id="coursesTbody"></tbody>
            </table>
          </div>
        </div>
      </section>

      <!-- TAB 4: SYLLABUS MANAGEMENT -->
      <section id="tab-syllabus" class="tab-pane" style="display:none;">
        <div class="syllabus-header-card">
          <label class="field-label" for="syllabusCourseSelect" style="font-size:0.95rem;margin-bottom:0.5rem;">Select Course to Inspect &amp; Manage Complete Authentic Syllabus:</label>
          <div style="display:flex;align-items:center;gap:1rem;flex-wrap:wrap;">
            <select id="syllabusCourseSelect" class="syllabus-course-select" onchange="loadSyllabusForSelectedCourse()">
              <option value="">Select a course...</option>
            </select>
            <button class="btn-primary-action" onclick="openModuleModal(currentSyllabusCourseId)">+ Add Module</button>
            <button class="btn-action" onclick="openProjectModal(currentSyllabusCourseId)">+ Add Project</button>
          </div>
          <div id="syllabusCourseMeta" style="margin-top:0.75rem;font-size:0.875rem;color:var(--slate-600);"></div>
        </div>

        <div id="syllabusModulesContainer">
          <div class="empty-state">Select a course to view and edit its modules and topics.</div>
        </div>

        <div class="panel-card" style="margin-top:2rem;">
          <div class="panel-card-header">
            <div class="panel-card-title">Associated Course Projects</div>
            <button class="btn-action" onclick="openProjectModal(currentSyllabusCourseId)">+ Add Project</button>
          </div>
          <div class="table-responsive">
            <table class="data-table" id="syllabusProjectsTable">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Title</th>
                  <th>Description</th>
                  <th>Status</th>
                  <th>Sort Order</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody id="syllabusProjectsTbody">
                <tr><td colspan="6" class="empty-state">No projects loaded.</td></tr>
              </tbody>
            </table>
          </div>
        </div>
      </section>

      <!-- TAB 5: MODULES -->
      <section id="tab-modules" class="tab-pane" style="display:none;">
        <div class="panel-card">
          <div class="panel-card-header">
            <div class="panel-card-title">All Course Modules</div>
            <div class="panel-toolbar">
              <select class="select-filter" id="modulesCourseFilter" onchange="loadModules()">
                <option value="">All Courses</option>
              </select>
              <div class="search-input-wrapper">
                <span class="search-icon">🔍</span>
                <input type="text" class="search-input" placeholder="Search modules..." oninput="filterTable('modulesTable', this.value)">
              </div>
              <button class="btn-primary-action" onclick="openModuleModal()">+ Add Module</button>
            </div>
          </div>
          <div class="table-responsive">
            <table class="data-table" id="modulesTable">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Course</th>
                  <th>Module Title</th>
                  <th>Description</th>
                  <th>Order</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody id="modulesTbody"></tbody>
            </table>
          </div>
        </div>
      </section>

      <!-- TAB 6: TOPICS -->
      <section id="tab-topics" class="tab-pane" style="display:none;">
        <div class="panel-card">
          <div class="panel-card-header">
            <div class="panel-card-title">All Course Topics</div>
            <div class="panel-toolbar">
              <select class="select-filter" id="topicsModuleFilter" onchange="loadTopics()">
                <option value="">All Modules</option>
              </select>
              <div class="search-input-wrapper">
                <span class="search-icon">🔍</span>
                <input type="text" class="search-input" placeholder="Search topics..." oninput="filterTable('topicsTable', this.value)">
              </div>
              <button class="btn-primary-action" onclick="openTopicModal()">+ Add Topic</button>
            </div>
          </div>
          <div class="table-responsive">
            <table class="data-table" id="topicsTable">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Module</th>
                  <th>Topic Title</th>
                  <th>Description</th>
                  <th>Order</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody id="topicsTbody"></tbody>
            </table>
          </div>
        </div>
      </section>

      <!-- TAB 7: PROJECTS -->
      <section id="tab-projects" class="tab-pane" style="display:none;">
        <div class="panel-card">
          <div class="panel-card-header">
            <div class="panel-card-title">All Course Projects</div>
            <div class="panel-toolbar">
              <select class="select-filter" id="projectsCourseFilter" onchange="loadProjects()">
                <option value="">All Courses</option>
              </select>
              <div class="search-input-wrapper">
                <span class="search-icon">🔍</span>
                <input type="text" class="search-input" placeholder="Search projects..." oninput="filterTable('projectsTable', this.value)">
              </div>
              <button class="btn-primary-action" onclick="openProjectModal()">+ Add Project</button>
            </div>
          </div>
          <div class="table-responsive">
            <table class="data-table" id="projectsTable">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Course</th>
                  <th>Title</th>
                  <th>Description</th>
                  <th>Status</th>
                  <th>Order</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody id="projectsTbody"></tbody>
            </table>
          </div>
        </div>
      </section>

      <!-- TAB 8: TESTIMONIALS -->
      <section id="tab-testimonials" class="tab-pane" style="display:none;">
        <div class="panel-card">
          <div class="panel-card-header">
            <div class="panel-card-title">Student Testimonials</div>
            <div class="panel-toolbar">
              <div class="search-input-wrapper">
                <span class="search-icon">🔍</span>
                <input type="text" class="search-input" placeholder="Search reviews..." oninput="filterTable('testimonialsTable', this.value)">
              </div>
              <button class="btn-primary-action" onclick="openTestimonialModal()">+ Add Testimonial</button>
            </div>
          </div>
          <div class="table-responsive">
            <table class="data-table" id="testimonialsTable">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Student Name</th>
                  <th>Course</th>
                  <th>Rating</th>
                  <th>Testimonial</th>
                  <th>Status</th>
                  <th>Order</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody id="testimonialsTbody"></tbody>
            </table>
          </div>
        </div>
      </section>

      <!-- TAB 9: FAQS -->
      <section id="tab-faqs" class="tab-pane" style="display:none;">
        <div class="panel-card">
          <div class="panel-card-header">
            <div class="panel-card-title">Frequently Asked Questions</div>
            <div class="panel-toolbar">
              <div class="search-input-wrapper">
                <span class="search-icon">🔍</span>
                <input type="text" class="search-input" placeholder="Search FAQs..." oninput="filterTable('faqsTable', this.value)">
              </div>
              <button class="btn-primary-action" onclick="openFaqModal()">+ Add FAQ</button>
            </div>
          </div>
          <div class="table-responsive">
            <table class="data-table" id="faqsTable">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Question</th>
                  <th>Answer</th>
                  <th>Status</th>
                  <th>Order</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody id="faqsTbody"></tbody>
            </table>
          </div>
        </div>
      </section>

      <!-- TAB 10: SERVICES -->
      <section id="tab-services" class="tab-pane" style="display:none;">
        <div class="panel-card">
          <div class="panel-card-header">
            <div class="panel-card-title">Services</div>
            <div class="panel-toolbar">
              <div class="search-input-wrapper">
                <span class="search-icon">🔍</span>
                <input type="text" class="search-input" placeholder="Search services..." oninput="filterTable('servicesTable', this.value)">
              </div>
              <button class="btn-primary-action" onclick="openServiceModal()">+ Add Service</button>
            </div>
          </div>
          <div class="table-responsive">
            <table class="data-table" id="servicesTable">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Title</th>
                  <th>Description</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody id="servicesTbody"></tbody>
            </table>
          </div>
        </div>
      </section>

      <!-- TAB 11: ENQUIRIES -->
      <section id="tab-enquiries" class="tab-pane" style="display:none;">
        <div class="panel-card">
          <div class="panel-card-header">
            <div class="panel-card-title">Student &amp; Website Enquiries</div>
            <div class="panel-toolbar">
              <select class="select-filter" id="enquiryStatusFilter" onchange="loadEnquiries()">
                <option value="">All Statuses</option>
                <option value="New">New</option>
                <option value="Contacted">Contacted</option>
                <option value="Enrolled">Enrolled</option>
                <option value="Closed">Closed</option>
              </select>
              <div class="search-input-wrapper">
                <span class="search-icon">🔍</span>
                <input type="text" class="search-input" placeholder="Search leads..." oninput="filterTable('enquiriesTable', this.value)">
              </div>
            </div>
          </div>
          <div class="table-responsive">
            <table class="data-table" id="enquiriesTable">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Date</th>
                  <th>Student</th>
                  <th>Contact</th>
                  <th>Career Goal</th>
                  <th>Existing Skills</th>
                  <th>Recommended Course</th>
                  <th>Supporting Courses</th>
                  <th>Roadmap</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody id="enquiriesTbody"></tbody>
            </table>
          </div>
        </div>
      </section>

      <!-- TAB 12: SEO SETTINGS -->
      <section id="tab-seo" class="tab-pane" style="display:none;">
        <div class="panel-card">
          <div class="panel-card-header">
            <div class="panel-card-title">Page SEO Settings</div>
            <div class="panel-toolbar">
              <div class="search-input-wrapper">
                <span class="search-icon">🔍</span>
                <input type="text" class="search-input" placeholder="Search SEO pages..." oninput="filterTable('seoTable', this.value)">
              </div>
              <button class="btn-primary-action" onclick="openSeoModal()">+ Add Page SEO</button>
            </div>
          </div>
          <div class="table-responsive">
            <table class="data-table" id="seoTable">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Page Key</th>
                  <th>Meta Title</th>
                  <th>Meta Description</th>
                  <th>OG Image</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody id="seoTbody"></tbody>
            </table>
          </div>
        </div>
      </section>

      <!-- TAB: PAGE CONTENT (every editable text / link of the public website) -->
      <section id="tab-content" class="tab-pane" style="display:none;">
        <div class="panel-card">
          <div class="panel-card-header">
            <div class="panel-card-title">Page Content &mdash; edit any text or link on the website</div>
          </div>
          <div class="content-toolbar">
            <select id="contentPageSelect" class="field-select" onchange="onContentPageChange()"></select>
            <input type="text" id="contentSearch" class="field-input grow" placeholder="Search text on this page..." oninput="renderContent()">
            <a id="contentViewLink" href="/" target="_blank" class="btn-action">View page &nearr;</a>
          </div>
          <div class="content-save-bar" id="contentSaveBar">
            <span id="contentSaveMsg">0 unsaved changes</span>
            <span class="spacer"></span>
            <button class="btn-action" onclick="discardContentChanges()">Discard</button>
            <button class="btn-primary-action" onclick="saveContentChanges()">Save changes</button>
          </div>
          <div id="contentSections"></div>
        </div>
      </section>

      <!-- TAB: HOME PAGE BLOCKS (add / remove / reorder the repeating blocks of the home page) -->
      <section id="tab-blocks" class="tab-pane" style="display:none;">
        <div id="blocksWrap"></div>
      </section>

      <!-- TAB 13: WEBSITE SETTINGS -->
      <section id="tab-settings" class="tab-pane" style="display:none;">
        <div class="panel-card" style="max-width:840px;">
          <div class="panel-card-header">
            <div class="panel-card-title">General Website Settings (Singleton ID: 1)</div>
          </div>
          <form id="settingsForm" onsubmit="saveSiteSettings(event)" style="padding:1.5rem;">
            <div class="form-row">
              <label class="field-label" for="settingSiteName">Site Name / Institute Name</label>
              <input type="text" id="settingSiteName" class="field-input" required>
            </div>
            <div class="form-row-grid">
              <div class="form-row">
                <label class="field-label" for="settingPhone">Official Phone Number</label>
                <input type="text" id="settingPhone" class="field-input">
              </div>
              <div class="form-row">
                <label class="field-label" for="settingWhatsapp">WhatsApp Number (e.g. 918793100815)</label>
                <input type="text" id="settingWhatsapp" class="field-input">
              </div>
            </div>
            <div class="form-row-grid">
              <div class="form-row">
                <label class="field-label" for="settingEmail">Contact Email</label>
                <input type="email" id="settingEmail" class="field-input">
              </div>
              <div class="form-row">
                <label class="field-label" for="settingOpeningHours">Opening Hours</label>
                <input type="text" id="settingOpeningHours" class="field-input">
              </div>
            </div>
            <div class="form-row">
              <label class="field-label" for="settingAddress">Physical Address</label>
              <textarea id="settingAddress" class="field-textarea" rows="2"></textarea>
            </div>
            <div class="form-row">
              <label class="field-label" for="settingHeroText">Homepage Hero Tagline</label>
              <textarea id="settingHeroText" class="field-textarea" rows="2"></textarea>
            </div>
            <div class="form-row-grid">
              <div class="form-row">
                <label class="field-label" for="settingFacebook">Facebook Link</label>
                <input type="text" id="settingFacebook" class="field-input">
              </div>
              <div class="form-row">
                <label class="field-label" for="settingInstagram">Instagram Link</label>
                <input type="text" id="settingInstagram" class="field-input">
              </div>
            </div>
            <div class="form-row-grid">
              <div class="form-row">
                <label class="field-label" for="settingYoutube">YouTube Link</label>
                <input type="text" id="settingYoutube" class="field-input">
              </div>
              <div class="form-row">
                <label class="field-label" for="settingLinkedin">LinkedIn Link</label>
                <input type="text" id="settingLinkedin" class="field-input">
              </div>
            </div>
            <div style="margin-top:1.5rem;text-align:right;">
              <button type="submit" class="btn-primary-action">Save Settings to MySQL</button>
            </div>
          </form>
        </div>
      </section>

    </div>
  </main>

  <!-- GENERIC MODAL -->
  <div class="cms-modal-backdrop" id="cmsModalBackdrop">
    <div class="cms-modal-card">
      <div class="cms-modal-header">
        <h3 class="cms-modal-title" id="modalTitle">Modal Form</h3>
        <button class="cms-modal-close" onclick="closeModal()">&times;</button>
      </div>
      <form id="modalForm" onsubmit="handleModalSubmit(event)">
        <div class="cms-modal-body" id="modalBody"></div>
        <div class="cms-modal-footer">
          <button type="button" class="btn-action" onclick="closeModal()">Cancel</button>
          <button type="submit" class="btn-primary-action" id="modalSubmitBtn">Save to MySQL</button>
        </div>
      </form>
    </div>
  </div>

  <!-- DELETE CONFIRMATION MODAL -->
  <div class="cms-modal-backdrop" id="deleteModalBackdrop">
    <div class="cms-modal-card" style="max-width:440px;">
      <div class="cms-modal-header" style="border-bottom-color:#fee2e2;background:#fef2f2;">
        <h3 class="cms-modal-title" style="color:#b91c1c;">Confirm Deletion</h3>
        <button class="cms-modal-close" onclick="closeDeleteModal()">&times;</button>
      </div>
      <div class="cms-modal-body">
        <p id="deleteModalMessage" style="font-size:0.95rem;color:var(--slate-800);line-height:1.6;"></p>
        <p id="deleteCascadeNotice" style="margin-top:0.75rem;padding:0.75rem;background:#fef2f2;border-radius:var(--radius-sm);color:#991b1b;font-size:0.8rem;display:none;"></p>
      </div>
      <div class="cms-modal-footer">
        <button type="button" class="btn-action" onclick="closeDeleteModal()">Cancel</button>
        <button type="button" class="btn-primary-action" style="background:#ef4444;" id="confirmDeleteBtn" onclick="executeDelete()">Permanently Delete</button>
      </div>
    </div>
  </div>

  <!-- TOAST NOTIFICATION CONTAINER -->
  <div id="toastContainer"></div>

  <script>
    // Global State & Configuration
    const API_BASE = '/api/index.php';
    const CSRF_TOKEN = '<?php echo $csrfToken; ?>';
    let currentTab = 'dashboard';
    let currentSyllabusCourseId = null;
    let cachedCourses = [];
    let cachedCategories = [];
    let deleteActionConfig = null;

    // Toast Notifications
    function showToast(message, type = 'success') {
      const container = document.getElementById('toastContainer');
      const toast = document.createElement('div');
      toast.className = `toast toast-${type}`;
      toast.innerHTML = `<span>${type === 'success' ? '✓' : type === 'error' ? '✕' : 'ℹ'}</span> <span>${escapeHtml(message)}</span>`;
      container.appendChild(toast);
      setTimeout(() => {
        toast.style.opacity = '0';
        toast.style.transform = 'translateY(10px)';
        toast.style.transition = 'all 0.3s ease';
        setTimeout(() => toast.remove(), 300);
      }, 4000);
    }

    // Helper: Escaping
    function escapeHtml(str) {
      if (!str) return '';
      return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;').replace(/'/g, '&#039;');
    }

    // API Helper with Credentials & CSRF
    async function apiRequest(endpoint, method = 'GET', data = null) {
      const options = {
        method,
        headers: {
          'Accept': 'application/json',
          'X-CSRF-Token': CSRF_TOKEN
        },
        credentials: 'same-origin'
      };

      if (data && ['POST', 'PUT', 'PATCH'].includes(method.toUpperCase())) {
        options.headers['Content-Type'] = 'application/json';
        options.body = JSON.stringify(data);
      }

      try {
        const res = await fetch(`${API_BASE}${endpoint}`, options);
        const result = await res.json();
        if (!res.ok || !result.success) {
          if (res.status === 404 && /\/(modules|topics|projects)\/\d+/.test(endpoint)) {
            // The record changed or was removed since this page loaded (e.g. the syllabus was re-imported): refresh the list
            setTimeout(() => { closeModal(); currentTab === 'syllabus' ? loadSyllabusForSelectedCourse() : loadTabData(currentTab); }, 400);
            throw new Error((result.message || 'Record not found') + ' - it was changed or removed, refreshing the list. Please try again.');
          }
          throw new Error(result.message || 'API request failed');
        }
        return result;
      } catch (err) {
        showToast(err.message, 'error');
        throw err;
      }
    }

    // Tab Switching
    function switchTab(tabId) {
      currentTab = tabId;
      document.querySelectorAll('.tab-pane').forEach(el => el.style.display = 'none');
      const activePane = document.getElementById(`tab-${tabId}`);
      if (activePane) activePane.style.display = 'block';

      document.querySelectorAll('.cms-nav-item').forEach(el => {
        el.classList.toggle('active', el.dataset.tab === tabId);
      });

      // Update Header Title
      const titles = {
        dashboard: 'Dashboard Overview',
        content: 'Page Content (all website text)',
        blocks: 'Home Page Blocks',
        categories: 'Course Categories',
        courses: 'Courses Directory',
        syllabus: 'Complete Syllabus Management',
        modules: 'Curriculum Modules',
        topics: 'Syllabus Topics',
        projects: 'Course Projects',
        testimonials: 'Student Reviews',
        faqs: 'Frequently Asked Questions',
        services: 'Services Offered',
        enquiries: 'Student Enquiries',
        seo: 'SEO Settings',
        settings: 'Website Configuration'
      };
      document.getElementById('pageTitleText').textContent = titles[tabId] || tabId;

      // Update Context Action Button
      const headerAction = document.getElementById('headerActionBtn');
      headerAction.style.display = ['settings', 'dashboard', 'content', 'blocks'].includes(tabId) ? 'none' : 'inline-flex';
      const actionLabels = {
        categories: '+ Add Category',
        courses: '+ Add Course',
        syllabus: '+ Add Module',
        modules: '+ Add Module',
        topics: '+ Add Topic',
        projects: '+ Add Project',
        testimonials: '+ Add Testimonial',
        faqs: '+ Add FAQ',
        services: '+ Add Service',
        enquiries: 'Export Enquiries',
        seo: '+ Add Page SEO'
      };
      headerAction.textContent = actionLabels[tabId] || '+ Add New';

      // Load data for the tab
      loadTabData(tabId);

      // Close mobile sidebar if open
      document.getElementById('cmsSidebar').classList.remove('open');
    }

    function onHeaderAction() {
      switch (currentTab) {
        case 'categories': openCategoryModal(); break;
        case 'courses': openCourseModal(); break;
        case 'syllabus': openModuleModal(currentSyllabusCourseId); break;
        case 'modules': openModuleModal(); break;
        case 'topics': openTopicModal(); break;
        case 'projects': openProjectModal(); break;
        case 'testimonials': openTestimonialModal(); break;
        case 'faqs': openFaqModal(); break;
        case 'services': openServiceModal(); break;
        case 'seo': openSeoModal(); break;
        case 'enquiries': showToast('Showing all enquiries from MySQL database', 'info'); break;
      }
    }

    function loadTabData(tabId) {
      switch (tabId) {
        case 'dashboard': loadDashboardStats(); loadRecentEnquiries(); break;
        case 'content': loadContentTab(); break;
        case 'blocks': loadBlocks(); break;
        case 'categories': loadCategories(); break;
        case 'courses': loadCourses(); break;
        case 'syllabus': initSyllabusView(); break;
        case 'modules': loadModules(); break;
        case 'topics': loadTopics(); break;
        case 'projects': loadProjects(); break;
        case 'testimonials': loadTestimonials(); break;
        case 'faqs': loadFaqs(); break;
        case 'services': loadServices(); break;
        case 'enquiries': loadEnquiries(); break;
        case 'seo': loadSeo(); break;
        case 'settings': loadSiteSettings(); break;
      }
    }

    // 1. DASHBOARD STATS
    async function loadDashboardStats() {
      try {
        const res = await apiRequest('/dashboard/stats');
        const s = res.data;
        document.getElementById('statCourses').textContent = s.total_courses;
        document.getElementById('statActiveCourses').textContent = s.active_courses;
        document.getElementById('statCategories').textContent = s.total_categories;
        document.getElementById('statModules').textContent = s.total_modules;
        document.getElementById('statTopics').textContent = s.total_topics;
        document.getElementById('statProjects').textContent = s.total_projects;
        document.getElementById('statEnquiries').textContent = s.total_enquiries;
        document.getElementById('statNewEnquiries').textContent = s.new_enquiries;
        document.getElementById('statTestimonials').textContent = s.total_testimonials;
        document.getElementById('statFaqsServices').textContent = `${s.total_faqs} FAQs / ${s.total_services} Services`;

        const badge = document.getElementById('enquiryBadge');
        if (s.new_enquiries > 0) {
          badge.textContent = s.new_enquiries;
          badge.style.display = 'inline-block';
        } else {
          badge.style.display = 'none';
        }
      } catch (err) {}
    }

    async function loadRecentEnquiries() {
      try {
        const res = await apiRequest('/enquiries?limit=5');
        const list = res.data.enquiries || [];
        const tbody = document.getElementById('recentEnquiriesTbody');
        if (list.length === 0) {
          tbody.innerHTML = '<tr><td colspan="7" class="empty-state">No enquiries submitted yet.</td></tr>';
          return;
        }
        tbody.innerHTML = list.map(e => `
          <tr>
            <td><span style="font-family:monospace;font-size:0.775rem;">${escapeHtml(e.created_at ? e.created_at.substring(0, 16) : '')}</span></td>
            <td><strong>${escapeHtml(e.name)}</strong></td>
            <td>${escapeHtml(e.phone || '-')}</td>
            <td>${escapeHtml(e.email || '-')}</td>
            <td>${escapeHtml(e.course_title || e.source_page || 'General')}</td>
            <td><span class="badge ${e.status === 'New' ? 'badge-danger' : 'badge-success'}">${escapeHtml(e.status)}</span></td>
            <td>
              <button class="btn-action btn-action-edit" onclick="editEnquiry(${e.id})">Edit</button>
            </td>
          </tr>
        `).join('');
      } catch (err) {}
    }

    // 2. CATEGORIES
    async function loadCategories() {
      const res = await apiRequest('/categories');
      cachedCategories = res.data || [];
      const tbody = document.getElementById('categoriesTbody');
      if (cachedCategories.length === 0) {
        tbody.innerHTML = '<tr><td colspan="7" class="empty-state">No course categories found in MySQL.</td></tr>';
        return;
      }
      tbody.innerHTML = cachedCategories.map(c => `
        <tr>
          <td><span style="font-family:monospace;">${c.id}</span></td>
          <td><strong>${escapeHtml(c.name)}</strong></td>
          <td><span style="font-family:monospace;color:var(--primary);">${escapeHtml(c.slug)}</span></td>
          <td>${escapeHtml(c.description || '-')}</td>
          <td>${escapeHtml(c.icon || '-')}</td>
          <td>${c.sort_order}</td>
          <td>
            <div class="btn-action-group">
              <button class="btn-action btn-action-edit" onclick="openCategoryModal(${c.id})">Edit</button>
              <button class="btn-action btn-action-delete" onclick="promptDelete('Category', ${c.id}, '${escapeHtml(c.name)}', '/categories/${c.id}', loadCategories)">Delete</button>
            </div>
          </td>
        </tr>
      `).join('');
      updateCategoryFilters();
    }

    function updateCategoryFilters() {
      const filter = document.getElementById('courseCategoryFilter');
      if (filter) {
        const cur = filter.value;
        filter.innerHTML = '<option value="">All Categories</option>' + cachedCategories.map(c => `<option value="${c.id}" ${cur == c.id ? 'selected' : ''}>${escapeHtml(c.name)}</option>`).join('');
      }
    }

    function openCategoryModal(catId = null) {
      const isEdit = catId !== null;
      const cat = isEdit ? cachedCategories.find(c => c.id == catId) : { name: '', slug: '', description: '', icon: '', sort_order: 0 };
      document.getElementById('modalTitle').textContent = isEdit ? `Edit Category #${catId}` : 'Add Course Category';
      document.getElementById('modalBody').innerHTML = `
        <input type="hidden" name="_entity" value="category">
        <input type="hidden" name="id" value="${catId || ''}">
        <div class="form-row">
          <label class="field-label">Category Name *</label>
          <input type="text" name="name" class="field-input" value="${escapeHtml(cat.name)}" required>
        </div>
        <div class="form-row">
          <label class="field-label">URL Slug (leave blank to auto-generate)</label>
          <input type="text" name="slug" class="field-input" value="${escapeHtml(cat.slug)}">
        </div>
        <div class="form-row">
          <label class="field-label">Description</label>
          <textarea name="description" class="field-textarea">${escapeHtml(cat.description)}</textarea>
        </div>
        <div class="form-row-grid">
          <div class="form-row">
            <label class="field-label">Icon Identifier</label>
            <input type="text" name="icon" class="field-input" value="${escapeHtml(cat.icon)}" placeholder="e.g. code, brain">
          </div>
          <div class="form-row">
            <label class="field-label">Sort Order</label>
            <input type="number" name="sort_order" class="field-input" value="${cat.sort_order || 0}">
          </div>
        </div>
      `;
      openModal();
    }

    // 3. COURSES
    async function loadCourses() {
      const catId = document.getElementById('courseCategoryFilter')?.value || '';
      const status = document.getElementById('courseStatusFilter')?.value || '';
      let url = '/courses?limit=100';
      if (catId) url += `&category_id=${catId}`;
      if (status !== '') url += `&status=${status}`;

      const res = await apiRequest(url);
      cachedCourses = res.data.courses || [];
      const tbody = document.getElementById('coursesTbody');
      if (cachedCourses.length === 0) {
        tbody.innerHTML = '<tr><td colspan="8" class="empty-state">No courses found matching filters.</td></tr>';
        return;
      }
      tbody.innerHTML = cachedCourses.map(c => `
        <tr>
          <td><span style="font-family:monospace;">${c.id}</span></td>
          <td>
            <strong>${escapeHtml(c.title)}</strong>
            <div style="font-family:monospace;font-size:0.75rem;color:var(--slate-500);">${escapeHtml(c.slug)}</div>
          </td>
          <td><span class="badge badge-neutral">${escapeHtml(c.category_name || 'Unassigned')}</span></td>
          <td><span class="badge badge-primary">${escapeHtml(c.level || 'Beginner')}</span></td>
          <td>${c.featured ? '<span class="badge badge-warning">Featured</span>' : '-'}</td>
          <td><span class="badge ${c.status ? 'badge-success' : 'badge-danger'}">${c.status ? 'Active' : 'Inactive'}</span></td>
          <td>${c.sort_order}</td>
          <td>
            <div class="btn-action-group">
              <button class="btn-action" title="View Syllabus" onclick="openSyllabusForCourse(${c.id})">Syllabus</button>
              <button class="btn-action btn-action-edit" onclick="openCourseModal(${c.id})">Edit</button>
              <button class="btn-action btn-action-delete" onclick="promptDelete('Course', ${c.id}, '${escapeHtml(c.title)}', '/courses/${c.id}', loadCourses, 'Warning: Deleting this course will automatically cascade and delete all associated modules, topics, and projects.')">Delete</button>
            </div>
          </td>
        </tr>
      `).join('');
      updateCourseDropdowns();
    }

    function updateCourseDropdowns() {
      const selects = ['syllabusCourseSelect', 'modulesCourseFilter', 'projectsCourseFilter'];
      selects.forEach(id => {
        const el = document.getElementById(id);
        if (el) {
          const cur = el.value;
          const defaultText = id === 'syllabusCourseSelect' ? 'Select a course...' : 'All Courses';
          el.innerHTML = `<option value="">${defaultText}</option>` + cachedCourses.map(c => `<option value="${c.id}" ${cur == c.id ? 'selected' : ''}>${escapeHtml(c.title)}</option>`).join('');
        }
      });
    }

    function openCourseModal(courseId = null) {
      const isEdit = courseId !== null;
      const c = isEdit ? cachedCourses.find(item => item.id == courseId) : {
        title: '', slug: '', short_description: '', full_description: '',
        category_id: '', level: 'Beginner', featured: 0, status: 1, sort_order: 0,
        hero_text: '', meta_title: '', meta_description: ''
      };

      document.getElementById('modalTitle').textContent = isEdit ? `Edit Course #${courseId}` : 'Add New Course';
      document.getElementById('modalBody').innerHTML = `
        <input type="hidden" name="_entity" value="course">
        <input type="hidden" name="id" value="${courseId || ''}">
        <div class="form-row">
          <label class="field-label">Course Title *</label>
          <input type="text" name="title" class="field-input" value="${escapeHtml(c.title)}" required>
        </div>
        <div class="form-row-grid">
          <div class="form-row">
            <label class="field-label">URL Slug</label>
            <input type="text" name="slug" class="field-input" value="${escapeHtml(c.slug)}" placeholder="e.g. python-programming">
          </div>
          <div class="form-row">
            <label class="field-label">Category</label>
            <select name="category_id" class="field-select">
              <option value="">None / Unassigned</option>
              ${cachedCategories.map(cat => `<option value="${cat.id}" ${cat.id == c.category_id ? 'selected' : ''}>${escapeHtml(cat.name)}</option>`).join('')}
            </select>
          </div>
        </div>
        <div class="form-row-grid">
          <div class="form-row">
            <label class="field-label">Level</label>
            <select name="level" class="field-select">
              <option value="Beginner" ${c.level === 'Beginner' ? 'selected' : ''}>Beginner</option>
              <option value="Intermediate" ${c.level === 'Intermediate' ? 'selected' : ''}>Intermediate</option>
              <option value="Advanced" ${c.level === 'Advanced' ? 'selected' : ''}>Advanced</option>
            </select>
          </div>
          <div class="form-row">
            <label class="field-label">Status &amp; Featured</label>
            <div style="display:flex;gap:1.5rem;padding-top:0.4rem;">
              <label style="display:flex;align-items:center;gap:0.4rem;cursor:pointer;">
                <input type="checkbox" name="status" value="1" ${c.status ? 'checked' : ''}> Active
              </label>
              <label style="display:flex;align-items:center;gap:0.4rem;cursor:pointer;">
                <input type="checkbox" name="featured" value="1" ${c.featured ? 'checked' : ''}> Featured
              </label>
            </div>
          </div>
        </div>
        <div class="form-row">
          <label class="field-label">Short Description</label>
          <textarea name="short_description" class="field-textarea" rows="2">${escapeHtml(c.short_description)}</textarea>
        </div>
        <div class="form-row">
          <label class="field-label">Full Description / Overview</label>
          <textarea name="full_description" class="field-textarea" rows="3">${escapeHtml(c.full_description)}</textarea>
        </div>
        <div class="form-row-grid">
          <div class="form-row">
            <label class="field-label">Hero Text</label>
            <input type="text" name="hero_text" class="field-input" value="${escapeHtml(c.hero_text)}">
          </div>
          <div class="form-row">
            <label class="field-label">Sort Order</label>
            <input type="number" name="sort_order" class="field-input" value="${c.sort_order || 0}">
          </div>
        </div>
        <div class="form-row">
          <label class="field-label">SEO Meta Title</label>
          <input type="text" name="meta_title" class="field-input" value="${escapeHtml(c.meta_title)}">
        </div>
        <div class="form-row">
          <label class="field-label">SEO Meta Description</label>
          <textarea name="meta_description" class="field-textarea" rows="2">${escapeHtml(c.meta_description)}</textarea>
        </div>
      `;
      openModal();
    }

    // 4. SYLLABUS MANAGEMENT
    function initSyllabusView() {
      if (cachedCourses.length === 0) {
        loadCourses().then(() => {
          if (cachedCourses.length > 0 && !currentSyllabusCourseId) {
            currentSyllabusCourseId = cachedCourses[0].id;
            document.getElementById('syllabusCourseSelect').value = currentSyllabusCourseId;
            loadSyllabusForSelectedCourse();
          }
        });
      } else {
        updateCourseDropdowns();
        if (!currentSyllabusCourseId && cachedCourses.length > 0) {
          currentSyllabusCourseId = cachedCourses[0].id;
        }
        if (currentSyllabusCourseId) {
          document.getElementById('syllabusCourseSelect').value = currentSyllabusCourseId;
          loadSyllabusForSelectedCourse();
        }
      }
    }

    function openSyllabusForCourse(courseId) {
      currentSyllabusCourseId = courseId;
      switchTab('syllabus');
    }

    async function loadSyllabusForSelectedCourse() {
      const select = document.getElementById('syllabusCourseSelect');
      const courseId = select.value;
      currentSyllabusCourseId = courseId;
      if (!courseId) {
        document.getElementById('syllabusModulesContainer').innerHTML = '<div class="empty-state">Please select a course to inspect and manage its syllabus.</div>';
        document.getElementById('syllabusCourseMeta').innerHTML = '';
        document.getElementById('syllabusProjectsTbody').innerHTML = '<tr><td colspan="6" class="empty-state">Select a course to view projects.</td></tr>';
        return;
      }

      try {
        const res = await apiRequest(`/courses/${courseId}/syllabus`);
        const { course, modules, projects } = res.data;

        // Meta info
        document.getElementById('syllabusCourseMeta').innerHTML = `
          <strong>${escapeHtml(course.title)}</strong> &bull; Level: <span class="badge badge-primary">${escapeHtml(course.level)}</span> &bull; 
          Total Modules: <strong>${modules.length}</strong> &bull; 
          Total Topics: <strong>${modules.reduce((acc, m) => acc + (m.topics ? m.topics.length : 0), 0)}</strong> &bull; 
          Associated Projects: <strong>${projects.length}</strong>
        `;

        // Render Modules & Topics
        const container = document.getElementById('syllabusModulesContainer');
        if (modules.length === 0) {
          container.innerHTML = '<div class="empty-state">No curriculum modules created for this course yet.<br><button class="btn-primary-action" style="margin-top:1rem;" onclick="openModuleModal(currentSyllabusCourseId)">+ Add First Module</button></div>';
        } else {
          container.innerHTML = modules.map((m, idx) => `
            <div class="syllabus-module-card" id="moduleCard_${m.id}">
              <div class="syllabus-module-header" onclick="toggleModuleAccordion(${m.id})">
                <div class="syllabus-module-title">
                  <span class="badge badge-neutral">#${m.sort_order}</span>
                  <span>${escapeHtml(m.title)}</span>
                  <span class="badge badge-info">${m.topics ? m.topics.length : 0} Topics</span>
                </div>
                <div class="btn-action-group" onclick="event.stopPropagation()">
                  <button class="btn-action" title="Add Topic" onclick="openTopicModal(${m.id})">+ Topic</button>
                  <button class="btn-action btn-action-edit" title="Edit Module" onclick="openModuleModal(null, ${m.id})">Edit</button>
                  <button class="btn-action btn-action-delete" title="Delete Module" onclick="promptDelete('Module', ${m.id}, '${escapeHtml(m.title)}', '/modules/${m.id}', loadSyllabusForSelectedCourse, 'Warning: Deleting this module will delete all topics inside it.')">Delete</button>
                  <span style="font-size:0.9rem;color:var(--slate-400);margin-left:0.5rem;" id="chevron_${m.id}">&#9660;</span>
                </div>
              </div>
              <div class="syllabus-topics-container" id="topicsContainer_${m.id}">
                ${m.description ? `<p style="font-size:0.8rem;color:var(--slate-600);margin-bottom:0.75rem;font-style:italic;">${escapeHtml(m.description)}</p>` : ''}
                ${m.topics && m.topics.length > 0 ? m.topics.map(t => `
                  <div class="syllabus-topic-item">
                    <div style="display:flex;align-items:center;gap:0.6rem;flex:1;">
                      <span class="badge badge-neutral" style="font-size:0.7rem;">${t.sort_order}</span>
                      <div>
                        <strong style="color:var(--slate-800);">${escapeHtml(t.title)}</strong>
                        ${t.description ? `<div style="font-size:0.75rem;color:var(--slate-500);">${escapeHtml(t.description)}</div>` : ''}
                      </div>
                    </div>
                    <div class="btn-action-group">
                      <button class="btn-action btn-action-edit" onclick="openTopicModal(${m.id}, ${t.id})">Edit</button>
                      <button class="btn-action btn-action-delete" onclick="promptDelete('Topic', ${t.id}, '${escapeHtml(t.title)}', '/topics/${t.id}', loadSyllabusForSelectedCourse)">Delete</button>
                    </div>
                  </div>
                `).join('') : '<div style="font-size:0.8rem;color:var(--slate-400);padding:0.5rem 0;">No topics in this module. Click "+ Topic" to add one.</div>'}
              </div>
            </div>
          `).join('');
        }

        // Render Projects
        const pTbody = document.getElementById('syllabusProjectsTbody');
        if (projects.length === 0) {
          pTbody.innerHTML = '<tr><td colspan="6" class="empty-state">No capstone projects registered for this course.</td></tr>';
        } else {
          pTbody.innerHTML = projects.map(p => `
            <tr>
              <td><span style="font-family:monospace;">${p.id}</span></td>
              <td><strong>${escapeHtml(p.title)}</strong></td>
              <td>${escapeHtml(p.description || '-')}</td>
              <td><span class="badge ${p.status ? 'badge-success' : 'badge-danger'}">${p.status ? 'Active' : 'Inactive'}</span></td>
              <td>${p.sort_order}</td>
              <td>
                <div class="btn-action-group">
                  <button class="btn-action btn-action-edit" onclick="openProjectModal(${courseId}, ${p.id})">Edit</button>
                  <button class="btn-action btn-action-delete" onclick="promptDelete('Project', ${p.id}, '${escapeHtml(p.title)}', '/projects/${p.id}', loadSyllabusForSelectedCourse)">Delete</button>
                </div>
              </td>
            </tr>
          `).join('');
        }

      } catch (err) {}
    }

    function toggleModuleAccordion(moduleId) {
      const el = document.getElementById(`topicsContainer_${moduleId}`);
      const ch = document.getElementById(`chevron_${moduleId}`);
      if (el) {
        const isHidden = el.style.display === 'none';
        el.style.display = isHidden ? 'block' : 'none';
        if (ch) ch.innerHTML = isHidden ? '&#9660;' : '&#9654;';
      }
    }

    // 5. MODULE MODAL
    async function openModuleModal(courseId = null, moduleId = null) {
      const isEdit = moduleId !== null;
      let mod = { course_id: courseId || currentSyllabusCourseId || (cachedCourses[0] ? cachedCourses[0].id : ''), title: '', description: '', group_title: '', tools: '', summary: '', sort_order: 0 };
      if (isEdit) {
        const res = await apiRequest(`/modules/${moduleId}`);
        mod = res.data;
      }

      document.getElementById('modalTitle').textContent = isEdit ? `Edit Module #${moduleId}` : 'Add Module to Course';
      document.getElementById('modalBody').innerHTML = `
        <input type="hidden" name="_entity" value="module">
        <input type="hidden" name="id" value="${moduleId || ''}">
        <div class="form-row">
          <label class="field-label">Target Course *</label>
          <select name="course_id" class="field-select" required>
            ${cachedCourses.map(c => `<option value="${c.id}" ${c.id == mod.course_id ? 'selected' : ''}>${escapeHtml(c.title)}</option>`).join('')}
          </select>
        </div>
        <div class="form-row">
          <label class="field-label">Module Title *</label>
          <input type="text" name="title" class="field-input" value="${escapeHtml(mod.title)}" placeholder="e.g. Module 1: Logic Building" required>
        </div>
        <div class="form-row">
          <label class="field-label">Module Description / Overview</label>
          <textarea name="description" class="field-textarea" rows="2">${escapeHtml(mod.description)}</textarea>
        </div>
        <div class="form-row">
          <label class="field-label">Phase heading (optional)</label>
          <input type="text" name="group_title" class="field-input" value="${escapeHtml(mod.group_title || '')}" placeholder="e.g. PHASE 2 — Modern Frontend Engineering">
          <div class="field-hint">Modules with the same phase heading are listed together under it on the course page (roadmap-style courses).</div>
        </div>
        <div class="form-row">
          <label class="field-label">Tools / technologies (optional, one per line)</label>
          <textarea name="tools" class="field-textarea" rows="3">${escapeHtml(mod.tools || '')}</textarea>
          <div class="field-hint">Shown as small chips under the module on the AI &amp; Data Science course pages.</div>
        </div>
        <div class="form-row">
          <label class="field-label">Summary line (optional)</label>
          <textarea name="summary" class="field-textarea" rows="2">${escapeHtml(mod.summary || '')}</textarea>
          <div class="field-hint">Highlighted sentence at the end of the module (C/C++/Java/Python + DSA courses).</div>
        </div>
        <div class="form-row">
          <label class="field-label">Sort Order</label>
          <input type="number" name="sort_order" class="field-input" value="${mod.sort_order || 0}">
        </div>
      `;
      openModal();
    }

    // 6. TOPIC MODAL
    async function openTopicModal(moduleId = null, topicId = null) {
      const isEdit = topicId !== null;
      let top = { module_id: moduleId || '', title: '', description: '', group_title: '', sort_order: 0 };
      if (isEdit) {
        const res = await apiRequest(`/topics/${topicId}`);
        top = res.data;
      }

      // Load all modules for dropdown
      const modRes = await apiRequest(currentSyllabusCourseId ? `/courses/${currentSyllabusCourseId}/modules` : '/modules');
      const allMods = modRes.data || [];

      document.getElementById('modalTitle').textContent = isEdit ? `Edit Topic #${topicId}` : 'Add Topic to Module';
      document.getElementById('modalBody').innerHTML = `
        <input type="hidden" name="_entity" value="topic">
        <input type="hidden" name="id" value="${topicId || ''}">
        <div class="form-row">
          <label class="field-label">Target Module *</label>
          <select name="module_id" class="field-select" required>
            ${allMods.map(m => `<option value="${m.id}" ${m.id == top.module_id ? 'selected' : ''}>${escapeHtml(m.title)}</option>`).join('')}
          </select>
        </div>
        <div class="form-row">
          <label class="field-label">Topic Title *</label>
          <input type="text" name="title" class="field-input" value="${escapeHtml(top.title)}" placeholder="e.g. Variables, Types & Memory Model" required>
        </div>
        <div class="form-row">
          <label class="field-label">Topic Description (optional)</label>
          <textarea name="description" class="field-textarea" rows="2">${escapeHtml(top.description)}</textarea>
        </div>
        <div class="form-row">
          <label class="field-label">Column heading (optional)</label>
          <input type="text" name="group_title" class="field-input" value="${escapeHtml(top.group_title || '')}" placeholder="e.g. Arrays, Memory &amp; Structs">
          <div class="field-hint">Topics of one module with the same column heading are shown together in a column (DSA courses).</div>
        </div>
        <div class="form-row">
          <label class="field-label">Sort Order</label>
          <input type="number" name="sort_order" class="field-input" value="${top.sort_order || 0}">
        </div>
      `;
      openModal();
    }

    // 7. PROJECT MODAL
    async function openProjectModal(courseId = null, projId = null) {
      const isEdit = projId !== null;
      let p = { course_id: courseId || currentSyllabusCourseId || (cachedCourses[0] ? cachedCourses[0].id : ''), title: '', description: '', tag: '', subtag: '', footnote: '', sort_order: 0, status: 1 };
      if (isEdit) {
        const res = await apiRequest(`/projects/${projId}`);
        p = res.data;
      }

      document.getElementById('modalTitle').textContent = isEdit ? `Edit Project #${projId}` : 'Add Capstone Project';
      document.getElementById('modalBody').innerHTML = `
        <input type="hidden" name="_entity" value="project">
        <input type="hidden" name="id" value="${projId || ''}">
        <div class="form-row">
          <label class="field-label">Course *</label>
          <select name="course_id" class="field-select" required>
            ${cachedCourses.map(c => `<option value="${c.id}" ${c.id == p.course_id ? 'selected' : ''}>${escapeHtml(c.title)}</option>`).join('')}
          </select>
        </div>
        <div class="form-row">
          <label class="field-label">Project Title *</label>
          <input type="text" name="title" class="field-input" value="${escapeHtml(p.title)}" required>
        </div>
        <div class="form-row">
          <label class="field-label">Project Description</label>
          <textarea name="description" class="field-textarea" rows="3">${escapeHtml(p.description)}</textarea>
        </div>
        <div class="form-row-grid">
          <div class="form-row">
            <label class="field-label">Label / category (optional)</label>
            <input type="text" name="tag" class="field-input" value="${escapeHtml(p.tag || '')}" placeholder="e.g. Machine Learning">
          </div>
          <div class="form-row">
            <label class="field-label">Second label (optional)</label>
            <input type="text" name="subtag" class="field-input" value="${escapeHtml(p.subtag || '')}" placeholder="e.g. System App">
          </div>
        </div>
        <div class="form-row">
          <label class="field-label">Footer line (optional)</label>
          <input type="text" name="footnote" class="field-input" value="${escapeHtml(p.footnote || '')}">
          <div class="field-hint">The label heads the project card (or the project group on the Java / MERN full stack pages, where projects with the same label are grouped); the footer line is shown at the bottom of the card on the DSA courses.</div>
        </div>
        <div class="form-row-grid">
          <div class="form-row">
            <label class="field-label">Sort Order</label>
            <input type="number" name="sort_order" class="field-input" value="${p.sort_order || 0}">
          </div>
          <div class="form-row">
            <label class="field-label">Status</label>
            <select name="status" class="field-select">
              <option value="1" ${p.status ? 'selected' : ''}>Active</option>
              <option value="0" ${!p.status ? 'selected' : ''}>Inactive</option>
            </select>
          </div>
        </div>
      `;
      openModal();
    }

    // MODULES LIST VIEW
    async function loadModules() {
      const cId = document.getElementById('modulesCourseFilter')?.value || '';
      const url = cId ? `/modules?course_id=${cId}` : '/modules';
      const res = await apiRequest(url);
      const list = res.data || [];
      const tbody = document.getElementById('modulesTbody');
      if (list.length === 0) {
        tbody.innerHTML = '<tr><td colspan="6" class="empty-state">No modules found.</td></tr>';
        return;
      }
      tbody.innerHTML = list.map(m => `
        <tr>
          <td><span style="font-family:monospace;">${m.id}</span></td>
          <td><span class="badge badge-neutral">${escapeHtml(m.course_title || 'Course #' + m.course_id)}</span></td>
          <td><strong>${escapeHtml(m.title)}</strong></td>
          <td>${escapeHtml(m.description || '-')}</td>
          <td>${m.sort_order}</td>
          <td>
            <div class="btn-action-group">
              <button class="btn-action btn-action-edit" onclick="openModuleModal(${m.course_id}, ${m.id})">Edit</button>
              <button class="btn-action btn-action-delete" onclick="promptDelete('Module', ${m.id}, '${escapeHtml(m.title)}', '/modules/${m.id}', loadModules)">Delete</button>
            </div>
          </td>
        </tr>
      `).join('');
    }

    // TOPICS LIST VIEW
    async function loadTopics() {
      const mId = document.getElementById('topicsModuleFilter')?.value || '';
      const url = mId ? `/topics?module_id=${mId}` : '/topics';
      const res = await apiRequest(url);
      const list = res.data || [];
      const tbody = document.getElementById('topicsTbody');
      if (list.length === 0) {
        tbody.innerHTML = '<tr><td colspan="6" class="empty-state">No topics found.</td></tr>';
        return;
      }
      tbody.innerHTML = list.map(t => `
        <tr>
          <td><span style="font-family:monospace;">${t.id}</span></td>
          <td><span class="badge badge-neutral">${escapeHtml(t.module_title || 'Module #' + t.module_id)}</span></td>
          <td><strong>${escapeHtml(t.title)}</strong></td>
          <td>${escapeHtml(t.description || '-')}</td>
          <td>${t.sort_order}</td>
          <td>
            <div class="btn-action-group">
              <button class="btn-action btn-action-edit" onclick="openTopicModal(${t.module_id}, ${t.id})">Edit</button>
              <button class="btn-action btn-action-delete" onclick="promptDelete('Topic', ${t.id}, '${escapeHtml(t.title)}', '/topics/${t.id}', loadTopics)">Delete</button>
            </div>
          </td>
        </tr>
      `).join('');
    }

    // PROJECTS LIST VIEW
    async function loadProjects() {
      const cId = document.getElementById('projectsCourseFilter')?.value || '';
      const url = cId ? `/projects?course_id=${cId}` : '/projects';
      const res = await apiRequest(url);
      const list = res.data || [];
      const tbody = document.getElementById('projectsTbody');
      if (list.length === 0) {
        tbody.innerHTML = '<tr><td colspan="7" class="empty-state">No projects found.</td></tr>';
        return;
      }
      tbody.innerHTML = list.map(p => `
        <tr>
          <td><span style="font-family:monospace;">${p.id}</span></td>
          <td><span class="badge badge-neutral">${escapeHtml(p.course_title || 'Course #' + p.course_id)}</span></td>
          <td><strong>${escapeHtml(p.title)}</strong></td>
          <td>${escapeHtml(p.description || '-')}</td>
          <td><span class="badge ${p.status ? 'badge-success' : 'badge-danger'}">${p.status ? 'Active' : 'Inactive'}</span></td>
          <td>${p.sort_order}</td>
          <td>
            <div class="btn-action-group">
              <button class="btn-action btn-action-edit" onclick="openProjectModal(${p.course_id}, ${p.id})">Edit</button>
              <button class="btn-action btn-action-delete" onclick="promptDelete('Project', ${p.id}, '${escapeHtml(p.title)}', '/projects/${p.id}', loadProjects)">Delete</button>
            </div>
          </td>
        </tr>
      `).join('');
    }

    // 8. TESTIMONIALS
    async function loadTestimonials() {
      const res = await apiRequest('/testimonials');
      const list = res.data || [];
      const tbody = document.getElementById('testimonialsTbody');
      if (list.length === 0) {
        tbody.innerHTML = '<tr><td colspan="8" class="empty-state">No testimonials stored in MySQL.</td></tr>';
        return;
      }
      tbody.innerHTML = list.map(t => `
        <tr>
          <td><span style="font-family:monospace;">${t.id}</span></td>
          <td><strong>${escapeHtml(t.student_name)}</strong></td>
          <td>${escapeHtml(t.course || '-')}</td>
          <td><span style="color:#f59e0b;font-weight:700;">★ ${t.rating}/5</span></td>
          <td><div style="max-width:320px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">${escapeHtml(t.testimonial)}</div></td>
          <td><span class="badge ${t.status ? 'badge-success' : 'badge-danger'}">${t.status ? 'Published' : 'Hidden'}</span></td>
          <td>${t.sort_order}</td>
          <td>
            <div class="btn-action-group">
              <button class="btn-action btn-action-edit" onclick="openTestimonialModal(${t.id})">Edit</button>
              <button class="btn-action btn-action-delete" onclick="promptDelete('Testimonial', ${t.id}, '${escapeHtml(t.student_name)}', '/testimonials/${t.id}', loadTestimonials)">Delete</button>
            </div>
          </td>
        </tr>
      `).join('');
    }

    async function openTestimonialModal(id = null) {
      const isEdit = id !== null;
      let t = { student_name: '', course: '', testimonial: '', rating: 5, status: 1, sort_order: 0, review_date: '', source_url: '' };
      if (isEdit) {
        const res = await apiRequest(`/testimonials/${id}`);
        t = res.data;
      }

      document.getElementById('modalTitle').textContent = isEdit ? `Edit Testimonial #${id}` : 'Add Student Testimonial';
      document.getElementById('modalBody').innerHTML = `
        <input type="hidden" name="_entity" value="testimonial">
        <input type="hidden" name="id" value="${id || ''}">
        <div class="form-row-grid">
          <div class="form-row">
            <label class="field-label">Student Name *</label>
            <input type="text" name="student_name" class="field-input" value="${escapeHtml(t.student_name)}" required>
          </div>
          <div class="form-row">
            <label class="field-label">Course Taken</label>
            <input type="text" name="course" class="field-input" value="${escapeHtml(t.course)}" placeholder="e.g. Python Full Stack">
          </div>
        </div>
        <div class="form-row-grid">
          <div class="form-row">
            <label class="field-label">Review Date (as shown, e.g. 2 weeks ago)</label>
            <input type="text" name="review_date" class="field-input" value="${escapeHtml(t.review_date)}">
          </div>
          <div class="form-row">
            <label class="field-label">Review Link (Google Maps / source URL)</label>
            <input type="text" name="source_url" class="field-input" value="${escapeHtml(t.source_url)}">
          </div>
        </div>
        <div class="form-row">
          <label class="field-label">Student Review / Testimonial *</label>
          <textarea name="testimonial" class="field-textarea" rows="3" required>${escapeHtml(t.testimonial)}</textarea>
        </div>
        <div class="form-row-grid">
          <div class="form-row">
            <label class="field-label">Star Rating (1 - 5)</label>
            <select name="rating" class="field-select">
              <option value="5" ${t.rating == 5 ? 'selected' : ''}>★★★★★ (5 Stars)</option>
              <option value="4" ${t.rating == 4 ? 'selected' : ''}>★★★★☆ (4 Stars)</option>
              <option value="3" ${t.rating == 3 ? 'selected' : ''}>★★★☆☆ (3 Stars)</option>
            </select>
          </div>
          <div class="form-row">
            <label class="field-label">Status &amp; Order</label>
            <div style="display:flex;gap:0.75rem;">
              <select name="status" class="field-select" style="flex:1;">
                <option value="1" ${t.status ? 'selected' : ''}>Published</option>
                <option value="0" ${!t.status ? 'selected' : ''}>Hidden</option>
              </select>
              <input type="number" name="sort_order" class="field-input" value="${t.sort_order || 0}" style="width:80px;" placeholder="Order">
            </div>
          </div>
        </div>
      `;
      openModal();
    }

    // 9. FAQS
    async function loadFaqs() {
      const res = await apiRequest('/faqs');
      const list = res.data || [];
      const tbody = document.getElementById('faqsTbody');
      if (list.length === 0) {
        tbody.innerHTML = '<tr><td colspan="6" class="empty-state">No FAQs found.</td></tr>';
        return;
      }
      tbody.innerHTML = list.map(f => `
        <tr>
          <td><span style="font-family:monospace;">${f.id}</span></td>
          <td><strong>${escapeHtml(f.question)}</strong></td>
          <td><div style="max-width:320px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">${escapeHtml(f.answer)}</div></td>
          <td><span class="badge ${f.status ? 'badge-success' : 'badge-danger'}">${f.status ? 'Active' : 'Inactive'}</span></td>
          <td>${f.sort_order}</td>
          <td>
            <div class="btn-action-group">
              <button class="btn-action btn-action-edit" onclick="openFaqModal(${f.id})">Edit</button>
              <button class="btn-action btn-action-delete" onclick="promptDelete('FAQ', ${f.id}, '${escapeHtml(f.question)}', '/faqs/${f.id}', loadFaqs)">Delete</button>
            </div>
          </td>
        </tr>
      `).join('');
    }

    async function openFaqModal(id = null) {
      const isEdit = id !== null;
      let f = { question: '', answer: '', status: 1, sort_order: 0 };
      if (isEdit) {
        const res = await apiRequest(`/faqs/${id}`);
        f = res.data;
      }

      document.getElementById('modalTitle').textContent = isEdit ? `Edit FAQ #${id}` : 'Add FAQ';
      document.getElementById('modalBody').innerHTML = `
        <input type="hidden" name="_entity" value="faq">
        <input type="hidden" name="id" value="${id || ''}">
        <div class="form-row">
          <label class="field-label">Question *</label>
          <input type="text" name="question" class="field-input" value="${escapeHtml(f.question)}" required>
        </div>
        <div class="form-row">
          <label class="field-label">Answer *</label>
          <textarea name="answer" class="field-textarea" rows="3" required>${escapeHtml(f.answer)}</textarea>
        </div>
        <div class="form-row-grid">
          <div class="form-row">
            <label class="field-label">Status</label>
            <select name="status" class="field-select">
              <option value="1" ${f.status ? 'selected' : ''}>Active</option>
              <option value="0" ${!f.status ? 'selected' : ''}>Inactive</option>
            </select>
          </div>
          <div class="form-row">
            <label class="field-label">Sort Order</label>
            <input type="number" name="sort_order" class="field-input" value="${f.sort_order || 0}">
          </div>
        </div>
      `;
      openModal();
    }

    // 10. SERVICES
    async function loadServices() {
      const res = await apiRequest('/services');
      const list = res.data || [];
      const tbody = document.getElementById('servicesTbody');
      if (list.length === 0) {
        tbody.innerHTML = '<tr><td colspan="5" class="empty-state">No services found.</td></tr>';
        return;
      }
      tbody.innerHTML = list.map(s => `
        <tr>
          <td><span style="font-family:monospace;">${s.id}</span></td>
          <td><strong>${escapeHtml(s.title)}</strong></td>
          <td>${escapeHtml(s.description || '-')}</td>
          <td><span class="badge ${s.status ? 'badge-success' : 'badge-danger'}">${s.status ? 'Active' : 'Inactive'}</span></td>
          <td>
            <div class="btn-action-group">
              <button class="btn-action btn-action-edit" onclick="openServiceModal(${s.id})">Edit</button>
              <button class="btn-action btn-action-delete" onclick="promptDelete('Service', ${s.id}, '${escapeHtml(s.title)}', '/services/${s.id}', loadServices)">Delete</button>
            </div>
          </td>
        </tr>
      `).join('');
    }

    async function openServiceModal(id = null) {
      const isEdit = id !== null;
      let s = { title: '', description: '', status: 1 };
      if (isEdit) {
        const res = await apiRequest(`/services/${id}`);
        s = res.data;
      }

      document.getElementById('modalTitle').textContent = isEdit ? `Edit Service #${id}` : 'Add Service';
      document.getElementById('modalBody').innerHTML = `
        <input type="hidden" name="_entity" value="service">
        <input type="hidden" name="id" value="${id || ''}">
        <div class="form-row">
          <label class="field-label">Service Title *</label>
          <input type="text" name="title" class="field-input" value="${escapeHtml(s.title)}" required>
        </div>
        <div class="form-row">
          <label class="field-label">Description</label>
          <textarea name="description" class="field-textarea" rows="3">${escapeHtml(s.description)}</textarea>
        </div>
        <div class="form-row">
          <label class="field-label">Status</label>
          <select name="status" class="field-select">
            <option value="1" ${s.status ? 'selected' : ''}>Active</option>
            <option value="0" ${!s.status ? 'selected' : ''}>Inactive</option>
          </select>
        </div>
      `;
      openModal();
    }

    // 11. ENQUIRIES
    async function loadEnquiries() {
      const status = document.getElementById('enquiryStatusFilter')?.value || '';
      let url = '/enquiries?limit=100';
      if (status) url += `&status=${encodeURIComponent(status)}`;
      const res = await apiRequest(url);
      const list = res.data.enquiries || [];
      const tbody = document.getElementById('enquiriesTbody');
      if (list.length === 0) {
        tbody.innerHTML = '<tr><td colspan="11" class="empty-state">No enquiries found in database.</td></tr>';
        return;
      }

      tbody.innerHTML = list.map(e => {
        // Parse skills
        let skillsHtml = '-';
        if (Array.isArray(e.known_technologies) && e.known_technologies.length > 0) {
          skillsHtml = e.known_technologies.map(t => `<span class="badge badge-info" style="font-size:0.7rem;margin:1px;">${escapeHtml(t)}</span>`).join(' ');
        }

        // Supporting course title resolution
        let supportingCourseTitle = '-';
        if (e.recommended_course_ids && e.recommended_course_ids.supporting) {
          const supId = e.recommended_course_ids.supporting;
          const sup = cachedCourses.find(c => c.id == supId);
          supportingCourseTitle = sup ? sup.title : `Course #${supId}`;
        }

        const hasRoadmap = !!(e.personalized_roadmap || e.recommended_career_path);

        return `
          <tr>
            <td><span style="font-family:monospace;font-weight:700;">#${e.id}</span></td>
            <td><span style="font-family:monospace;font-size:0.775rem;">${escapeHtml(e.created_at ? e.created_at.substring(0, 16) : '')}</span></td>
            <td>
              <strong>${escapeHtml(e.name)}</strong>
              ${e.education ? `<div style="font-size:0.75rem;color:var(--slate-500);">${escapeHtml(e.education)}${e.age ? ` (${e.age}y)` : ''}</div>` : ''}
            </td>
            <td>
              <div>${escapeHtml(e.phone || '-')}</div>
              ${e.email ? `<div style="font-size:0.75rem;color:var(--slate-500);">${escapeHtml(e.email)}</div>` : ''}
            </td>
            <td>
              <span class="badge badge-primary" style="font-weight:600;">${escapeHtml(e.career_goal || e.recommended_career_path || e.source_page || 'General')}</span>
              ${e.learning_level ? `<div style="font-size:0.72rem;color:var(--slate-500);margin-top:2px;">${escapeHtml(e.learning_level)}</div>` : ''}
            </td>
            <td style="max-width:180px;">${skillsHtml}</td>
            <td>
              <strong>${escapeHtml(e.course_title || (e.recommended_course_ids && e.recommended_course_ids.primary ? `Course #${e.recommended_course_ids.primary}` : '-'))}</strong>
              ${e.recommendation_scores && e.recommendation_scores.primary_score ? `<span style="font-size:0.7rem;color:#059669;font-weight:700;"> (${e.recommendation_scores.primary_score}% Match)</span>` : ''}
            </td>
            <td>
              <span style="font-size:0.8rem;color:var(--slate-700);">${escapeHtml(supportingCourseTitle)}</span>
              ${e.recommendation_scores && e.recommendation_scores.supporting_score ? `<span style="font-size:0.7rem;color:#2563eb;font-weight:700;"> (${e.recommendation_scores.supporting_score}% Match)</span>` : ''}
            </td>
            <td>
              ${hasRoadmap ? `<button class="btn-action" style="background:#eff6ff;color:#1d4ed8;border-color:#bfdbfe;font-size:0.75rem;padding:3px 8px;font-weight:600;" onclick="viewEnquiryRoadmap(${e.id})">🗺️ View Roadmap</button>` : '<span style="color:#94a3b8;font-size:0.75rem;">None</span>'}
            </td>
            <td>
              <span class="badge ${e.status === 'New' ? 'badge-danger' : e.status === 'Contacted' ? 'badge-warning' : 'badge-success'}">${escapeHtml(e.status)}</span>
            </td>
            <td>
              <div class="btn-action-group">
                <button class="btn-action btn-action-edit" onclick="editEnquiry(${e.id})">Edit</button>
                <button class="btn-action btn-action-delete" onclick="promptDelete('Enquiry', ${e.id}, '${escapeHtml(e.name)}', '/enquiries/${e.id}', loadEnquiries)">Delete</button>
              </div>
            </td>
          </tr>
        `;
      }).join('');
    }

    // Modal to view full roadmap & skill-gap for an enquiry
    async function viewEnquiryRoadmap(id) {
      const res = await apiRequest(`/enquiries/${id}`);
      const e = res.data;

      document.getElementById('modalTitle').textContent = `Roadmap Blueprint — ${escapeHtml(e.name)} (#${id})`;
      document.getElementById('modalSubmitBtn').style.display = 'none';

      let gap = e.skill_gap_analysis || {};
      let roadmap = e.personalized_roadmap || [];
      let studyPlan = e.daily_study_plan || {};
      let projects = e.project_recommendations || [];

      let akHtml = (gap.already_known || []).map(s => `<span class="badge badge-success" style="margin:2px;">${escapeHtml(s)}</span>`).join(' ') || 'None';
      let nrHtml = (gap.needs_revision || []).map(s => `<span class="badge badge-warning" style="margin:2px;">${escapeHtml(s)}</span>`).join(' ') || 'None';
      let nlHtml = (gap.needs_to_learn || []).map(s => `<span class="badge badge-primary" style="margin:2px;">${escapeHtml(s)}</span>`).join(' ') || 'None';

      let roadmapHtml = roadmap.map(st => `
        <div style="border-left:3px solid #2563eb;padding-left:12px;margin-bottom:14px;">
          <div style="display:flex;justify-content:space-between;align-items:center;">
            <strong style="font-size:0.875rem;color:#1e293b;">Stage ${st.stage_number}: ${escapeHtml(st.stage_name)}</strong>
            <span class="badge badge-info" style="font-size:0.75rem;">${escapeHtml(st.duration)}</span>
          </div>
          <div style="font-size:0.8rem;color:#64748b;margin:4px 0;">${escapeHtml(st.description || '')}</div>
          <div style="margin:4px 0;">${(st.skills || []).map(sk => `<span class="badge" style="background:#f1f5f9;color:#334155;font-size:0.7rem;margin:1px;">${escapeHtml(sk)}</span>`).join(' ')}</div>
          <div style="font-size:0.75rem;color:#475569;margin-top:4px;">
            <strong>Milestone:</strong> ${escapeHtml(st.milestone || '')}
            ${st.chedo_course ? ` &bull; <strong style="color:#2563eb;">Course:</strong> <a href="${st.chedo_course.url}" target="_blank" style="color:#2563eb;text-decoration:underline;">${escapeHtml(st.chedo_course.title)}</a>` : ''}
          </div>
        </div>
      `).join('');

      let scheduleHtml = (studyPlan.schedule || []).map(s => `
        <div style="display:flex;gap:10px;padding:6px 0;border-bottom:1px solid #f1f5f9;font-size:0.8rem;">
          <span style="font-weight:700;color:#2563eb;width:80px;shrink:0;">${escapeHtml(s.time)}</span>
          <div>
            <strong>${escapeHtml(s.activity)}</strong>
            <div style="font-size:0.75rem;color:#64748b;">${escapeHtml(s.focus)}</div>
          </div>
        </div>
      `).join('');

      let projectsHtml = projects.map(p => `
        <div style="border:1px solid #e2e8f0;border-radius:6px;padding:8px 12px;margin-bottom:8px;font-size:0.8rem;">
          <span class="badge badge-primary" style="font-size:0.65rem;text-transform:uppercase;">${escapeHtml(p.level)}</span>
          <strong style="display:block;margin:4px 0 2px;">${escapeHtml(p.title)}</strong>
          <div style="color:#64748b;font-size:0.75rem;margin-bottom:4px;">${escapeHtml(p.description)}</div>
          <div style="font-family:monospace;font-size:0.7rem;color:#475569;">Tech: ${escapeHtml(p.tech)}</div>
        </div>
      `).join('');

      document.getElementById('modalBody').innerHTML = `
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:16px;background:#f8fafc;padding:12px;border-radius:8px;">
          <div>
            <div style="font-size:0.75rem;color:#64748b;">Target Career Goal</div>
            <strong style="font-size:0.95rem;color:#1e293b;">${escapeHtml(e.recommended_career_path || e.career_goal || 'Software Developer')}</strong>
          </div>
          <div>
            <div style="font-size:0.75rem;color:#64748b;">Estimated Roadmap Duration</div>
            <strong style="font-size:0.95rem;color:#059669;">${escapeHtml(e.estimated_duration || '5–6 Months')}</strong>
          </div>
          <div>
            <div style="font-size:0.75rem;color:#64748b;">Current Level</div>
            <div>${escapeHtml(e.learning_level || '-')}</div>
          </div>
          <div>
            <div style="font-size:0.75rem;color:#64748b;">Daily Availability</div>
            <div>${escapeHtml(e.daily_availability || '-')}</div>
          </div>
          <div>
            <div style="font-size:0.75rem;color:#64748b;">Primary Recommended Course</div>
            <strong style="color:#2563eb;">${escapeHtml(e.course_title || '-')}</strong>
          </div>
          <div>
            <div style="font-size:0.75rem;color:#64748b;">Supporting Course</div>
            <strong style="color:#475569;">${escapeHtml(e.supporting_course ? e.supporting_course.title : '-')}</strong>
          </div>
        </div>

        <h4 style="font-size:0.875rem;font-weight:700;margin:12px 0 6px;">Skill-Gap Classification</h4>
        <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:8px;margin-bottom:16px;">
          <div style="border:1px solid #d1fae5;background:#f0fdf4;padding:8px;border-radius:6px;">
            <div style="font-size:0.7rem;font-weight:700;color:#065f46;margin-bottom:4px;">ALREADY KNOWN</div>
            <div>${akHtml}</div>
          </div>
          <div style="border:1px solid #fef3c7;background:#fffbeb;padding:8px;border-radius:6px;">
            <div style="font-size:0.7rem;font-weight:700;color:#92400e;margin-bottom:4px;">NEEDS REVISION</div>
            <div>${nrHtml}</div>
          </div>
          <div style="border:1px solid #dbeafe;background:#eff6ff;padding:8px;border-radius:6px;">
            <div style="font-size:0.7rem;font-weight:700;color:#1e40af;margin-bottom:4px;">NEEDS TO LEARN</div>
            <div>${nlHtml}</div>
          </div>
        </div>

        <h4 style="font-size:0.875rem;font-weight:700;margin:12px 0 8px;">Personalized Learning Roadmap</h4>
        <div style="margin-bottom:16px;">${roadmapHtml || '<p style="color:#94a3b8;font-size:0.8rem;">No roadmap recorded.</p>'}</div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:12px;">
          <div>
            <h4 style="font-size:0.875rem;font-weight:700;margin:0 0 8px;">Daily Study Plan (${escapeHtml(studyPlan.total_hours || 'Schedule')})</h4>
            <div style="background:#f8fafc;padding:10px;border-radius:6px;">${scheduleHtml || '-'}</div>
          </div>
          <div>
            <h4 style="font-size:0.875rem;font-weight:700;margin:0 0 8px;">Progressive Projects</h4>
            <div>${projectsHtml || '-'}</div>
          </div>
        </div>

        <div style="font-size:0.75rem;color:#64748b;margin-top:10px;">
          Submission Timestamp: <strong>${escapeHtml(e.created_at)}</strong> &bull; Contact: <strong>${escapeHtml(e.phone)}</strong>
        </div>
      `;
      openModal();
    }

    async function editEnquiry(id) {
      const res = await apiRequest(`/enquiries/${id}`);
      const e = res.data;

      document.getElementById('modalSubmitBtn').style.display = 'inline-flex';
      document.getElementById('modalTitle').textContent = `Manage Enquiry #${id} — ${escapeHtml(e.name)}`;
      document.getElementById('modalBody').innerHTML = `
        <input type="hidden" name="_entity" value="enquiry">
        <input type="hidden" name="id" value="${id}">
        <div class="form-row-grid">
          <div class="form-row">
            <label class="field-label">Student Name</label>
            <input type="text" name="name" class="field-input" value="${escapeHtml(e.name)}" required>
          </div>
          <div class="form-row">
            <label class="field-label">Lead Status *</label>
            <select name="status" class="field-select">
              <option value="New" ${e.status === 'New' ? 'selected' : ''}>New (Uncontacted)</option>
              <option value="Contacted" ${e.status === 'Contacted' ? 'selected' : ''}>Contacted</option>
              <option value="Enrolled" ${e.status === 'Enrolled' ? 'selected' : ''}>Enrolled / Converted</option>
              <option value="Closed" ${e.status === 'Closed' ? 'selected' : ''}>Closed / Not Interested</option>
            </select>
          </div>
        </div>
        <div class="form-row-grid">
          <div class="form-row">
            <label class="field-label">Phone</label>
            <input type="text" name="phone" class="field-input" value="${escapeHtml(e.phone)}">
          </div>
          <div class="form-row">
            <label class="field-label">Email</label>
            <input type="email" name="email" class="field-input" value="${escapeHtml(e.email)}">
          </div>
        </div>
        <div class="form-row">
          <label class="field-label">Interested / Recommended Course</label>
          <select name="course_id" class="field-select">
            <option value="">General / None</option>
            ${cachedCourses.map(c => `<option value="${c.id}" ${c.id == e.course_id ? 'selected' : ''}>${escapeHtml(c.title)}</option>`).join('')}
          </select>
        </div>
        <div class="form-row">
          <label class="field-label">Message / Student Notes</label>
          <textarea name="message" class="field-textarea" rows="4">${escapeHtml(e.message)}</textarea>
        </div>
        <div style="font-size:0.75rem;color:var(--slate-500);background:var(--slate-50);padding:0.5rem;border-radius:var(--radius-sm);">
          Career Goal: <strong>${escapeHtml(e.career_goal || e.recommended_career_path || 'General')}</strong> &bull; Source Page: <strong>${escapeHtml(e.source_page || 'Website')}</strong> &bull; Received At: <strong>${escapeHtml(e.created_at)}</strong>
        </div>
      `;
      openModal();
    }


    // 12. SEO
    async function loadSeo() {
      const res = await apiRequest('/seo');
      const list = res.data || [];
      const tbody = document.getElementById('seoTbody');
      if (list.length === 0) {
        tbody.innerHTML = '<tr><td colspan="6" class="empty-state">No SEO records configured.</td></tr>';
        return;
      }
      tbody.innerHTML = list.map(s => `
        <tr>
          <td><span style="font-family:monospace;">${s.id}</span></td>
          <td><span class="badge badge-primary" style="font-family:monospace;">${escapeHtml(s.page)}</span></td>
          <td><strong>${escapeHtml(s.meta_title || '-')}</strong></td>
          <td><div style="max-width:280px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">${escapeHtml(s.meta_description || '-')}</div></td>
          <td><span style="font-family:monospace;font-size:0.75rem;">${escapeHtml(s.og_image || '-')}</span></td>
          <td>
            <div class="btn-action-group">
              <button class="btn-action btn-action-edit" onclick="openSeoModal(${s.id})">Edit</button>
              <button class="btn-action btn-action-delete" onclick="promptDelete('SEO Page', ${s.id}, '${escapeHtml(s.page)}', '/seo/${s.id}', loadSeo)">Delete</button>
            </div>
          </td>
        </tr>
      `).join('');
    }

    async function openSeoModal(id = null) {
      const isEdit = id !== null;
      let s = { page: '', meta_title: '', meta_description: '', og_image: '' };
      if (isEdit) {
        const res = await apiRequest(`/seo/${id}`);
        s = res.data;
      }

      document.getElementById('modalTitle').textContent = isEdit ? `Edit Page SEO #${id}` : 'Add Page SEO Record';
      document.getElementById('modalBody').innerHTML = `
        <input type="hidden" name="_entity" value="seo">
        <input type="hidden" name="id" value="${id || ''}">
        <div class="form-row">
          <label class="field-label">Page Identifier * (e.g. home, courses, about, contact)</label>
          <input type="text" name="page" class="field-input" value="${escapeHtml(s.page)}" required>
        </div>
        <div class="form-row">
          <label class="field-label">Page Meta Title</label>
          <input type="text" name="meta_title" class="field-input" value="${escapeHtml(s.meta_title)}">
        </div>
        <div class="form-row">
          <label class="field-label">Meta Description</label>
          <textarea name="meta_description" class="field-textarea" rows="2">${escapeHtml(s.meta_description)}</textarea>
        </div>
        <div class="form-row">
          <label class="field-label">OpenGraph Social Share Image URL</label>
          <input type="text" name="og_image" class="field-input" value="${escapeHtml(s.og_image)}" placeholder="/assets/og-image.png">
        </div>
      `;
      openModal();
    }

    // 13. SITE SETTINGS
    async function loadSiteSettings() {
      const res = await apiRequest('/settings');
      const s = res.data;
      document.getElementById('settingSiteName').value = s.site_name || '';
      document.getElementById('settingPhone').value = s.phone || '';
      document.getElementById('settingWhatsapp').value = s.whatsapp || '';
      document.getElementById('settingEmail').value = s.email || '';
      document.getElementById('settingAddress').value = s.address || '';
      document.getElementById('settingOpeningHours').value = s.opening_hours || '';
      document.getElementById('settingHeroText').value = s.hero_text || '';
      document.getElementById('settingFacebook').value = s.facebook || '';
      document.getElementById('settingInstagram').value = s.instagram || '';
      document.getElementById('settingYoutube').value = s.youtube || '';
      document.getElementById('settingLinkedin').value = s.linkedin || '';
    }

    async function saveSiteSettings(e) {
      e.preventDefault();
      const payload = {
        site_name: document.getElementById('settingSiteName').value,
        phone: document.getElementById('settingPhone').value,
        whatsapp: document.getElementById('settingWhatsapp').value,
        email: document.getElementById('settingEmail').value,
        address: document.getElementById('settingAddress').value,
        opening_hours: document.getElementById('settingOpeningHours').value,
        hero_text: document.getElementById('settingHeroText').value,
        facebook: document.getElementById('settingFacebook').value,
        instagram: document.getElementById('settingInstagram').value,
        youtube: document.getElementById('settingYoutube').value,
        linkedin: document.getElementById('settingLinkedin').value
      };

      try {
        const res = await apiRequest('/settings', 'PUT', payload);
        showToast('Site settings updated in MySQL successfully!', 'success');
      } catch (err) {}
    }

    // FORM MODAL HANDLER
    async function handleModalSubmit(e) {
      e.preventDefault();
      const form = e.target;
      const formData = new FormData(form);
      const entity = formData.get('_entity');
      const id = formData.get('id');
      const isEdit = Boolean(id);

      const data = {};
      formData.forEach((val, key) => {
        if (!key.startsWith('_') && key !== 'id') {
          data[key] = val;
        }
      });

      let endpoint = '';
      switch (entity) {
        case 'category': endpoint = isEdit ? `/categories/${id}` : '/categories'; break;
        case 'course': endpoint = isEdit ? `/courses/${id}` : '/courses'; break;
        case 'module': endpoint = isEdit ? `/modules/${id}` : '/modules'; break;
        case 'topic': endpoint = isEdit ? `/topics/${id}` : '/topics'; break;
        case 'project': endpoint = isEdit ? `/projects/${id}` : '/projects'; break;
        case 'testimonial': endpoint = isEdit ? `/testimonials/${id}` : '/testimonials'; break;
        case 'faq': endpoint = isEdit ? `/faqs/${id}` : '/faqs'; break;
        case 'service': endpoint = isEdit ? `/services/${id}` : '/services'; break;
        case 'enquiry': endpoint = `/enquiries/${id}`; break;
        case 'seo': endpoint = isEdit ? `/seo/${id}` : '/seo'; break;
        case 'pageitem': endpoint = isEdit ? `/page-items/${id}` : '/page-items'; break;
      }

      const method = isEdit ? 'PUT' : 'POST';

      try {
        const res = await apiRequest(endpoint, method, data);
        showToast(res.message || 'Record saved successfully!', 'success');
        closeModal();

        // Refresh currently active tab
        if (currentTab === 'syllabus') {
          loadSyllabusForSelectedCourse();
        } else {
          loadTabData(currentTab);
        }
      } catch (err) {}
    }

    // DELETE MODAL
    function promptDelete(typeName, id, label, endpoint, callback, cascadeNotice = '') {
      deleteActionConfig = { endpoint, callback };
      document.getElementById('deleteModalMessage').innerHTML = `Are you sure you want to permanently delete <strong>${escapeHtml(typeName)} #${id} (${escapeHtml(label)})</strong> directly from MySQL?`;
      const notice = document.getElementById('deleteCascadeNotice');
      if (cascadeNotice) {
        notice.textContent = cascadeNotice;
        notice.style.display = 'block';
      } else {
        notice.style.display = 'none';
      }
      document.getElementById('deleteModalBackdrop').classList.add('open');
    }

    async function executeDelete() {
      if (!deleteActionConfig) return;
      try {
        const res = await apiRequest(deleteActionConfig.endpoint, 'DELETE');
        showToast(res.message || 'Record deleted from MySQL successfully', 'success');
        closeDeleteModal();
        if (deleteActionConfig.callback) deleteActionConfig.callback();
      } catch (err) {}
    }

    function closeDeleteModal() {
      document.getElementById('deleteModalBackdrop').classList.remove('open');
      deleteActionConfig = null;
    }

    function openModal() {
      document.getElementById('cmsModalBackdrop').classList.add('open');
    }

    function closeModal() {
      document.getElementById('cmsModalBackdrop').classList.remove('open');
    }

    // SEARCH / FILTER TABLE CLIENT-SIDE
    function filterTable(tableId, query) {
      const q = query.toLowerCase();
      const rows = document.querySelectorAll(`#${tableId} tbody tr`);
      rows.forEach(r => {
        const text = r.textContent.toLowerCase();
        r.style.display = text.includes(q) ? '' : 'none';
      });
    }

    // ============================================================
    // PAGE CONTENT - edit any text / link of the public pages
    // ============================================================
    let contentPages = [];
    let contentRows = [];
    const contentDirty = new Map(); // id -> unsaved value

    function contentPageUrl(page) {
      if (page.startsWith('course-')) return '/courses/' + page.slice(7) + '.php';
      const map = { about: '/about.php', contact: '/contact.php', courses: '/courses.php', services: '/services.php', privacy: '/privacy-policy.php', notfound: '/404.php' };
      return map[page] || '/';
    }

    async function loadContentTab() {
      if (!contentPages.length) {
        const res = await apiRequest('/content/pages');
        contentPages = res.data || [];
        document.getElementById('contentPageSelect').innerHTML = contentPages
          .map(p => `<option value="${escapeHtml(p.page)}">${escapeHtml(p.label)} (${p.count})</option>`).join('');
      }
      await loadContentPage(document.getElementById('contentPageSelect').value);
    }

    async function onContentPageChange() {
      const sel = document.getElementById('contentPageSelect');
      if (contentDirty.size && !confirm('You have unsaved changes on this page. Discard them?')) {
        sel.value = sel.dataset.current;
        return;
      }
      await loadContentPage(sel.value);
    }

    async function loadContentPage(page) {
      const sel = document.getElementById('contentPageSelect');
      sel.dataset.current = page;
      document.getElementById('contentViewLink').href = contentPageUrl(page);
      document.getElementById('contentSearch').value = '';
      contentDirty.clear();
      updateContentSaveBar();
      const res = await apiRequest('/content?page=' + encodeURIComponent(page));
      contentRows = res.data || [];
      renderContent();
    }

    function contentCurrent(r) {
      return contentDirty.has(r.id) ? contentDirty.get(r.id) : (r.value ?? '');
    }

    function renderContent() {
      const q = document.getElementById('contentSearch').value.trim().toLowerCase();
      const groups = [];
      const index = {};
      contentRows.forEach(r => {
        if (!(r.section in index)) {
          index[r.section] = groups.length;
          groups.push({ section: r.section, label: r.section_label || r.section, rows: [] });
        }
        groups[index[r.section]].rows.push(r);
      });
      let html = '';
      let shown = 0;
      groups.forEach((g, gi) => {
        const rows = g.rows.filter(r => !q || (contentCurrent(r) + ' ' + r.content_key + ' ' + (r.default_value || '')).toLowerCase().includes(q));
        if (!rows.length) return;
        shown += rows.length;
        const open = q || groups.length === 1 || gi === 0 ? 'open' : '';
        html += `<details class="content-section" ${open}>
          <summary>${escapeHtml(g.label)}<span class="count">${rows.length} text${rows.length === 1 ? '' : 's'}</span></summary>
          <div class="content-rows">${rows.map(contentRowHtml).join('')}</div>
        </details>`;
      });
      document.getElementById('contentSections').innerHTML = html || '<div class="empty-state">Nothing matches your search.</div>';
    }

    function contentRowHtml(r) {
      const val = contentCurrent(r);
      const long = r.field_type === 'textarea' || r.field_type === 'html' || val.length > 90;
      const num = r.content_key.split('.').pop();
      const edited = (r.value ?? '') !== (r.default_value ?? '');
      const cls = 'field-input content-input' + (contentDirty.has(r.id) ? ' is-dirty' : '') + (edited ? ' is-edited' : '');
      const field = long
        ? `<textarea class="field-textarea ${cls}" data-id="${r.id}" rows="${Math.min(6, Math.max(2, Math.ceil(val.length / 90)))}">${escapeHtml(val)}</textarea>`
        : `<input type="text" class="${cls}" data-id="${r.id}" value="${escapeHtml(val)}">`;
      const typeLabel = r.field_type === 'url' ? 'link' : 'text';
      return `<div class="content-row" id="crow-${r.id}">
        <div class="content-key"><b>#${escapeHtml(num)}</b>${typeLabel}</div>
        ${field}
        <button type="button" class="content-reset" data-reset="${r.id}" title="Restore original: ${escapeHtml((r.default_value || '').slice(0, 120))}" ${edited || contentDirty.has(r.id) ? '' : 'disabled'}>&#8634;</button>
      </div>`;
    }

    function updateContentSaveBar() {
      const bar = document.getElementById('contentSaveBar');
      bar.classList.toggle('show', contentDirty.size > 0);
      document.getElementById('contentSaveMsg').textContent = `${contentDirty.size} unsaved change${contentDirty.size === 1 ? '' : 's'}`;
    }

    function discardContentChanges() {
      contentDirty.clear();
      updateContentSaveBar();
      renderContent();
    }

    async function saveContentChanges() {
      if (!contentDirty.size) return;
      const items = [...contentDirty.entries()].map(([id, value]) => ({ id, value }));
      try {
        const res = await apiRequest('/content', 'PUT', { items });
        contentRows.forEach(r => { if (contentDirty.has(r.id)) r.value = contentDirty.get(r.id); });
        contentDirty.clear();
        updateContentSaveBar();
        renderContent();
        showToast(`${res.data.saved} change${res.data.saved === 1 ? '' : 's'} saved - live on the website now`, 'success');
      } catch (err) {}
    }

    document.addEventListener('input', e => {
      const el = e.target.closest ? e.target.closest('.content-input') : null;
      if (!el) return;
      const id = Number(el.dataset.id);
      const row = contentRows.find(r => r.id === id);
      if (!row) return;
      if (el.value === (row.value ?? '')) contentDirty.delete(id); else contentDirty.set(id, el.value);
      el.classList.toggle('is-dirty', contentDirty.has(id));
      const reset = document.querySelector(`[data-reset="${id}"]`);
      if (reset) reset.disabled = !(contentDirty.has(id) || (row.value ?? '') !== (row.default_value ?? ''));
      updateContentSaveBar();
    });

    document.addEventListener('click', async e => {
      const btn = e.target.closest ? e.target.closest('[data-reset]') : null;
      if (!btn || btn.disabled) return;
      const id = Number(btn.dataset.reset);
      const row = contentRows.find(r => r.id === id);
      if (!row) return;
      try {
        await apiRequest(`/content/${id}/reset`, 'POST');
        row.value = row.default_value;
        contentDirty.delete(id);
        updateContentSaveBar();
        renderContent();
        showToast('Original text restored', 'success');
      } catch (err) {}
    });

    window.addEventListener('beforeunload', e => {
      if (contentDirty.size) { e.preventDefault(); e.returnValue = ''; }
    });

    // ============================================================
    // HOME PAGE BLOCKS - add / remove / reorder repeating blocks
    // ============================================================
    const BLOCK_TYPES = {
      skills: {
        title: 'Course cards',
        help: 'The "Skills That Build Careers" grid: icon, course name, short line and the course page it links to.',
        fields: ['title', 'subtitle', 'icon', 'link_url'],
        labels: { title: 'Course name *', subtitle: 'Short line (e.g. Python · SQL · Power BI)', icon: 'Icon', link_url: 'Links to (page URL)' }
      },
      journey: {
        title: 'Learning journey steps',
        help: '"From your first line of code to real applications": the numbered steps (numbers are automatic).',
        fields: ['tag', 'title', 'description'],
        labels: { tag: 'Small heading (e.g. FOUNDATION)', title: 'Title *', description: 'Description' }
      },
      projects: {
        title: 'Project tiles',
        help: '"Your learning should produce something": project name, icon and the course it is built in.',
        fields: ['title', 'icon', 'link_label', 'link_url'],
        labels: { title: 'Project name *', icon: 'Icon', link_label: 'Course name shown under it', link_url: 'Course page URL' }
      }
    };
    let blockItems = [];
    let iconNames = [];

    async function loadBlocks() {
      if (!iconNames.length) {
        try { iconNames = (await apiRequest('/icons')).data || []; } catch (e) {}
      }
      const res = await apiRequest('/page-items?page=home');
      blockItems = res.data || [];
      renderBlocks();
    }

    function blockIcon(name) {
      return name ? `<span class="block-icon"><img src="/assets/icons/${escapeHtml(name)}.svg" alt=""></span>` : '<span class="block-icon">&ndash;</span>';
    }

    function renderBlocks() {
      document.getElementById('blocksWrap').innerHTML = Object.entries(BLOCK_TYPES).map(([section, cfg]) => {
        const items = blockItems.filter(i => i.section === section);
        const rows = items.map((it, idx) => `
          <tr>
            <td>${idx + 1}</td>
            ${cfg.fields.includes('icon') ? `<td>${blockIcon(it.icon)}</td>` : ''}
            <td><strong>${escapeHtml(it.tag ? it.tag + ' - ' : '')}${escapeHtml(it.title)}</strong>
              ${it.subtitle ? `<div style="color:var(--slate-500);font-size:0.8rem;">${escapeHtml(it.subtitle)}</div>` : ''}
              ${it.description ? `<div style="color:var(--slate-500);font-size:0.8rem;max-width:420px;">${escapeHtml(it.description)}</div>` : ''}</td>
            <td style="font-size:0.8rem;color:var(--slate-500);">${escapeHtml(it.link_label || '')} ${it.link_url ? `<span style="font-family:monospace;">${escapeHtml(it.link_url)}</span>` : ''}</td>
            <td><span class="badge ${Number(it.status) ? 'badge-success' : 'badge-danger'}">${Number(it.status) ? 'Visible' : 'Hidden'}</span></td>
            <td>
              <div class="btn-action-group">
                <button class="btn-action block-move" onclick="moveBlock('${section}', ${it.id}, -1)" ${idx === 0 ? 'disabled' : ''} title="Move up">&uarr;</button>
                <button class="btn-action block-move" onclick="moveBlock('${section}', ${it.id}, 1)" ${idx === items.length - 1 ? 'disabled' : ''} title="Move down">&darr;</button>
                <button class="btn-action btn-action-edit" onclick="openBlockModal('${section}', ${it.id})">Edit</button>
                <button class="btn-action btn-action-delete" onclick="promptDelete('Item', ${it.id}, '${escapeHtml(it.title).replace(/'/g, '&#039;')}', '/page-items/${it.id}', loadBlocks)">Delete</button>
              </div>
            </td>
          </tr>`).join('');
        return `<div class="panel-card" style="margin-bottom:1.5rem;">
          <div class="panel-card-header">
            <div>
              <div class="panel-card-title">${cfg.title} <span class="badge badge-neutral">${items.length}</span></div>
              <div style="font-size:0.8rem;color:var(--slate-500);margin-top:0.2rem;">${cfg.help}</div>
            </div>
            <div class="panel-toolbar"><button class="btn-primary-action" onclick="openBlockModal('${section}')">+ Add</button></div>
          </div>
          <div class="table-responsive"><table class="data-table"><thead><tr>
            <th>#</th>${cfg.fields.includes('icon') ? '<th>Icon</th>' : ''}<th>Content</th><th>Link</th><th>Status</th><th>Actions</th>
          </tr></thead><tbody>${rows || '<tr><td colspan="6" class="empty-state">Nothing here yet - click + Add.</td></tr>'}</tbody></table></div>
        </div>`;
      }).join('');
    }

    async function moveBlock(section, id, dir) {
      const items = blockItems.filter(i => i.section === section);
      const i = items.findIndex(x => x.id === id);
      const j = i + dir;
      if (i < 0 || j < 0 || j >= items.length) return;
      [items[i], items[j]] = [items[j], items[i]];
      try {
        await apiRequest('/page-items/reorder', 'POST', { ids: items.map(x => x.id) });
        await loadBlocks();
      } catch (e) {}
    }

    function openBlockModal(section, id = null) {
      const cfg = BLOCK_TYPES[section];
      const it = (id !== null ? blockItems.find(x => x.id === id) : null) || { title: '', subtitle: '', description: '', tag: '', icon: '', link_label: '', link_url: '', status: 1 };
      document.getElementById('modalTitle').textContent = (id !== null ? 'Edit ' : 'Add ') + cfg.title.toLowerCase().replace(/s$/, '');
      const fieldHtml = f => {
        if (f === 'icon') {
          return `<div class="form-row"><label class="field-label">${cfg.labels.icon}</label>
            <div class="icon-picker"><span class="block-icon" id="iconPreview">${it.icon ? `<img src="/assets/icons/${escapeHtml(it.icon)}.svg" alt="">` : ''}</span>
            <select name="icon" class="field-select" onchange="previewIcon(this.value)">
              ${iconNames.map(n => `<option value="${escapeHtml(n)}" ${n === it.icon ? 'selected' : ''}>${escapeHtml(n)}</option>`).join('')}
            </select></div></div>`;
        }
        const big = f === 'description';
        return `<div class="form-row"><label class="field-label">${cfg.labels[f]}</label>
          ${big ? `<textarea name="${f}" class="field-textarea" rows="3">${escapeHtml(it[f])}</textarea>` : `<input type="text" name="${f}" class="field-input" value="${escapeHtml(it[f])}" ${f === 'title' ? 'required' : ''}>`}</div>`;
      };
      document.getElementById('modalBody').innerHTML = `
        <input type="hidden" name="_entity" value="pageitem">
        <input type="hidden" name="id" value="${id ?? ''}">
        <input type="hidden" name="page" value="home">
        <input type="hidden" name="section" value="${section}">
        ${cfg.fields.map(fieldHtml).join('')}
        <div class="form-row"><label class="field-label">Show on website</label>
          <select name="status" class="field-select"><option value="1" ${Number(it.status) ? 'selected' : ''}>Visible</option><option value="0" ${Number(it.status) ? '' : 'selected'}>Hidden</option></select></div>`;
      openModal();
    }

    function previewIcon(name) {
      document.getElementById('iconPreview').innerHTML = name ? `<img src="/assets/icons/${escapeHtml(name)}.svg" alt="">` : '';
    }

    // INITIALIZATION
    document.addEventListener('DOMContentLoaded', () => {
      // Nav click handler
      document.querySelectorAll('.cms-nav-item').forEach(link => {
        link.addEventListener('click', e => {
          e.preventDefault();
          const tab = link.dataset.tab;
          window.location.hash = tab;
          switchTab(tab);
        });
      });

      // Sidebar mobile toggle
      document.getElementById('sidebarToggle').addEventListener('click', () => {
        document.getElementById('cmsSidebar').classList.toggle('open');
      });

      // Hash route on load
      const initialTab = window.location.hash.replace('#', '') || 'dashboard';
      // Preload categories & courses first
      Promise.all([loadCategories(), loadCourses()]).then(() => {
        switchTab(initialTab);
      });
    });
  </script>
</body>
</html>
