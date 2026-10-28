<?php

/**
 * Chedo Tech REST API Front Controller
 * Handles all REST endpoints: Auth, Categories, Courses, Modules, Topics,
 * Projects, Syllabus, Testimonials, FAQs, Services, Enquiries, SEO, Settings, Stats.
 */

// Enable error logging, never leak sensitive traces to visitors
error_reporting(E_ALL);
ini_set('display_errors', '0');

// Start session if not started
if (session_status() === PHP_SESSION_NONE) {
    if (PHP_VERSION_ID >= 70300) {
        session_set_cookie_params([
            'lifetime' => 86400 * 7,
            'path' => '/',
            'httponly' => true,
            'samesite' => 'Lax'
        ]);
    } else {
        session_set_cookie_params(86400 * 7, '/; samesite=Lax', '', false, true);
    }
    session_start();
}

// Generate CSRF token if missing
if (empty($_SESSION['csrf'])) {
    $_SESSION['csrf'] = bin2hex(random_bytes(32));
}

// CORS & JSON Headers
$origin = $_SERVER['HTTP_ORIGIN'] ?? '';
if (!empty($origin)) {
    header("Access-Control-Allow-Origin: {$origin}");
    header('Access-Control-Allow-Credentials: true');
} else {
    header('Access-Control-Allow-Origin: *');
}
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With, X-CSRF-Token, X-HTTP-Method-Override');
header('Content-Type: application/json; charset=utf-8');

// Handle preflight OPTIONS
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    echo json_encode(['success' => true, 'message' => 'Preflight OK']);
    exit;
}

// Database Connection
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/recommendation-engine.php';
if (!$pdo) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Database connection unavailable',
        'error' => 'DATABASE_UNAVAILABLE'
    ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    exit;
}

// Helper: Standard API JSON Response
/**
 * Optional course-page columns (see database/import_course_pages.php) - saved only when the column exists, so the
 * API keeps working on a database that has not been upgraded yet.
 */
function apply_course_extras(PDO $pdo, string $table, int $id, array $input): void
{
    static $fields = [
        'course_modules'  => ['group_title', 'tools', 'summary'],
        'course_topics'   => ['group_title'],
        'course_projects' => ['tag', 'subtag', 'footnote'],
    ];
    static $cols = [];
    if (!isset($cols[$table])) {
        $st = $pdo->prepare('SELECT COLUMN_NAME FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = ?');
        $st->execute([$table]);
        $cols[$table] = $st->fetchAll(PDO::FETCH_COLUMN);
    }
    $set = [];
    $vals = [];
    foreach ($fields[$table] ?? [] as $f) {
        if (array_key_exists($f, $input) && in_array($f, $cols[$table], true)) {
            $v = trim((string)$input[$f]);
            if ($f === 'tools') {
                $v = implode("\n", array_filter(array_map('trim', preg_split('/\R/', $v)), 'strlen'));
            }
            $set[] = "`$f` = ?";
            $vals[] = $v === '' ? null : $v;
        }
    }
    if ($set) {
        $vals[] = $id;
        $pdo->prepare("UPDATE `$table` SET " . implode(', ', $set) . ' WHERE id = ?')->execute($vals);
    }
}

function api_response(int $status, bool $success, string $message, $data = null, ?string $error = null): void
{
    http_response_code($status);
    $payload = [
        'success' => $success,
        'message' => $message
    ];
    if ($error !== null) {
        $payload['error'] = $error;
    }
    if ($data !== null) {
        $payload['data'] = $data;
    }
    echo json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    exit;
}

// Helper: Parse Request Body (JSON or Form Data)
function get_request_data(): array
{
    $method = $_SERVER['REQUEST_METHOD'];
    $contentType = $_SERVER['CONTENT_TYPE'] ?? $_SERVER['HTTP_CONTENT_TYPE'] ?? '';

    $rawInput = file_get_contents('php://input');
    $jsonData = [];
    if (!empty($rawInput) && (strpos($contentType, 'application/json') !== false || substr(trim($rawInput), 0, 1) === '{' || substr(trim($rawInput), 0, 1) === '[')) {
        $decoded = json_decode($rawInput, true);
        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
            $jsonData = $decoded;
        }
    }

    if (empty($jsonData) && !empty($_POST)) {
        $jsonData = $_POST;
    }

    if (empty($jsonData) && in_array($method, ['PUT', 'PATCH', 'DELETE'])) {
        parse_str($rawInput, $parsed);
        if (is_array($parsed)) {
            $jsonData = $parsed;
        }
    }

    return $jsonData;
}

// Helper: Verify Admin Session
function is_admin_authenticated(): bool
{
    return !empty($_SESSION['admin']);
}

function require_admin(): void
{
    if (!is_admin_authenticated()) {
        api_response(401, false, 'Unauthorized. Administrator authentication required.', null, 'UNAUTHORIZED');
    }
}

// Determine Method (supports method override)
$requestMethod = $_SERVER['REQUEST_METHOD'];
if ($requestMethod === 'POST') {
    if (!empty($_SERVER['HTTP_X_HTTP_METHOD_OVERRIDE'])) {
        $requestMethod = strtoupper($_SERVER['HTTP_X_HTTP_METHOD_OVERRIDE']);
    } elseif (!empty($_POST['_method'])) {
        $requestMethod = strtoupper($_POST['_method']);
    }
}

// Parse Route Segments
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
// Normalize by removing leading /api or /api/index.php
$route = preg_replace('#^/api(/index\.php)?#', '', $requestUri);
$route = trim($route, '/');
$segments = $route === '' ? [] : explode('/', $route);

$resource = $segments[0] ?? '';
$id = isset($segments[1]) && is_numeric($segments[1]) ? (int)$segments[1] : null;
$subResource = $segments[2] ?? null;

// Handle special case where 2nd segment is not numeric ID (e.g. /api/auth/login, /api/dashboard/stats)
$action = $segments[1] ?? '';

// ============================================================================
// ROUTING
// ============================================================================

try {

    // ------------------------------------------------------------------------
    // A. AUTHENTICATION (/api/auth/...)
    // ------------------------------------------------------------------------
    if ($resource === 'auth') {
        if ($action === 'login' && $requestMethod === 'POST') {
            $input = get_request_data();
            $username = trim($input['username'] ?? '');
            $password = $input['password'] ?? '';

            if ($username === '' || $password === '') {
                api_response(422, false, 'Username and password are required', null, 'VALIDATION_ERROR');
            }

            $stmt = $pdo->prepare("SELECT id, username, password_hash, email, created_at FROM admins WHERE username = ? LIMIT 1");
            $stmt->execute([$username]);
            $admin = $stmt->fetch();

            if ($admin && password_verify($password, $admin['password_hash'])) {
                session_regenerate_id(true);
                $_SESSION['admin'] = true;
                $_SESSION['admin_id'] = $admin['id'];
                $_SESSION['admin_user'] = $admin['username'];
                $_SESSION['admin_email'] = $admin['email'];
                $_SESSION['admin_default_password'] = ($password === 'admin123');

                $userData = [
                    'id' => (int)$admin['id'],
                    'username' => $admin['username'],
                    'email' => $admin['email'],
                    'csrf_token' => $_SESSION['csrf'],
                    'is_default_password' => $_SESSION['admin_default_password']
                ];

                api_response(200, true, 'Login successful', $userData);
            } else {
                api_response(401, false, 'Invalid username or password', null, 'INVALID_CREDENTIALS');
            }
        }

        if ($action === 'logout' && in_array($requestMethod, ['POST', 'GET'])) {
            $_SESSION = [];
            if (ini_get("session.use_cookies")) {
                $params = session_get_cookie_params();
                setcookie(
                    session_name(),
                    '',
                    time() - 42000,
                    $params["path"],
                    $params["domain"],
                    $params["secure"],
                    $params["httponly"]
                );
            }
            session_destroy();
            api_response(200, true, 'Logged out successfully');
        }

        if ($action === 'me' && $requestMethod === 'GET') {
            if (!is_admin_authenticated()) {
                api_response(401, false, 'Unauthenticated', null, 'UNAUTHENTICATED');
            }
            $stmt = $pdo->prepare("SELECT id, username, email, created_at FROM admins WHERE id = ? LIMIT 1");
            $stmt->execute([$_SESSION['admin_id'] ?? 0]);
            $admin = $stmt->fetch();
            if (!$admin) {
                api_response(404, false, 'Admin user not found', null, 'NOT_FOUND');
            }
            $admin['id'] = (int)$admin['id'];
            $admin['csrf_token'] = $_SESSION['csrf'] ?? '';
            $admin['is_default_password'] = !empty($_SESSION['admin_default_password']);
            api_response(200, true, 'Authenticated admin profile', $admin);
        }

        api_response(404, false, 'Auth route not found', null, 'ROUTE_NOT_FOUND');
    }

    // ------------------------------------------------------------------------
    // DASHBOARD STATS (/api/dashboard/stats)
    // ------------------------------------------------------------------------
    if ($resource === 'dashboard' && $action === 'stats') {
        require_admin();
        if ($requestMethod !== 'GET') {
            api_response(405, false, 'Method not allowed', null, 'METHOD_NOT_ALLOWED');
        }

        $stats = [
            'total_courses' => (int)$pdo->query("SELECT COUNT(*) FROM courses")->fetchColumn(),
            'active_courses' => (int)$pdo->query("SELECT COUNT(*) FROM courses WHERE status = 1")->fetchColumn(),
            'total_categories' => (int)$pdo->query("SELECT COUNT(*) FROM course_categories")->fetchColumn(),
            'total_modules' => (int)$pdo->query("SELECT COUNT(*) FROM course_modules")->fetchColumn(),
            'total_topics' => (int)$pdo->query("SELECT COUNT(*) FROM course_topics")->fetchColumn(),
            'total_projects' => (int)$pdo->query("SELECT COUNT(*) FROM course_projects")->fetchColumn(),
            'total_enquiries' => (int)$pdo->query("SELECT COUNT(*) FROM enquiries")->fetchColumn(),
            'new_enquiries' => (int)$pdo->query("SELECT COUNT(*) FROM enquiries WHERE status = 'New'")->fetchColumn(),
            'total_testimonials' => (int)$pdo->query("SELECT COUNT(*) FROM testimonials")->fetchColumn(),
            'total_faqs' => (int)$pdo->query("SELECT COUNT(*) FROM faqs")->fetchColumn(),
            'total_services' => (int)$pdo->query("SELECT COUNT(*) FROM services")->fetchColumn()
        ];

        api_response(200, true, 'Dashboard statistics retrieved', $stats);
    }

    // ------------------------------------------------------------------------
    // B. COURSE CATEGORIES (/api/categories)
    // ------------------------------------------------------------------------
    if ($resource === 'categories') {
        if ($requestMethod === 'GET') {
            if ($id !== null) {
                $stmt = $pdo->prepare("SELECT * FROM course_categories WHERE id = ?");
                $stmt->execute([$id]);
                $cat = $stmt->fetch();
                if (!$cat) {
                    api_response(404, false, "Category with ID {$id} not found", null, 'NOT_FOUND');
                }
                api_response(200, true, 'Category retrieved', $cat);
            } else {
                $q = trim($_GET['q'] ?? '');
                if ($q !== '') {
                    $stmt = $pdo->prepare("SELECT * FROM course_categories WHERE name LIKE ? OR description LIKE ? ORDER BY sort_order ASC, id ASC");
                    $stmt->execute(["%$q%", "%$q%"]);
                } else {
                    $stmt = $pdo->query("SELECT * FROM course_categories ORDER BY sort_order ASC, id ASC");
                }
                $categories = $stmt->fetchAll();
                api_response(200, true, 'Categories retrieved', $categories);
            }
        }

        if ($requestMethod === 'POST') {
            require_admin();
            $input = get_request_data();
            $name = trim($input['name'] ?? '');
            $slug = trim($input['slug'] ?? '');
            $description = trim($input['description'] ?? '');
            $icon = trim($input['icon'] ?? '');
            $sortOrder = (int)($input['sort_order'] ?? 0);

            if ($name === '') {
                api_response(422, false, 'Category name is required', null, 'VALIDATION_ERROR');
            }
            if ($slug === '') {
                $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name), '-'));
            }

            // Uniqueness check
            $chk = $pdo->prepare("SELECT id FROM course_categories WHERE slug = ?");
            $chk->execute([$slug]);
            if ($chk->fetch()) {
                api_response(409, false, "Category slug '{$slug}' already exists", null, 'SLUG_CONFLICT');
            }

            $stmt = $pdo->prepare("INSERT INTO course_categories (name, slug, description, icon, sort_order) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$name, $slug, $description, $icon, $sortOrder]);
            $newId = (int)$pdo->lastInsertId();

            $newCat = $pdo->query("SELECT * FROM course_categories WHERE id = {$newId}")->fetch();
            api_response(201, true, 'Category created successfully', $newCat);
        }

        if ($requestMethod === 'PUT') {
            require_admin();
            if ($id === null) {
                api_response(400, false, 'Category ID is required for update', null, 'MISSING_ID');
            }

            $stmt = $pdo->prepare("SELECT * FROM course_categories WHERE id = ?");
            $stmt->execute([$id]);
            $existing = $stmt->fetch();
            if (!$existing) {
                api_response(404, false, "Category with ID {$id} not found", null, 'NOT_FOUND');
            }

            $input = get_request_data();
            $name = isset($input['name']) ? trim($input['name']) : $existing['name'];
            $slug = isset($input['slug']) ? trim($input['slug']) : $existing['slug'];
            $description = isset($input['description']) ? trim($input['description']) : $existing['description'];
            $icon = isset($input['icon']) ? trim($input['icon']) : $existing['icon'];
            $sortOrder = isset($input['sort_order']) ? (int)$input['sort_order'] : (int)$existing['sort_order'];

            if ($name === '') {
                api_response(422, false, 'Category name cannot be empty', null, 'VALIDATION_ERROR');
            }

            // Check slug collision
            $chk = $pdo->prepare("SELECT id FROM course_categories WHERE slug = ? AND id != ?");
            $chk->execute([$slug, $id]);
            if ($chk->fetch()) {
                api_response(409, false, "Category slug '{$slug}' is used by another category", null, 'SLUG_CONFLICT');
            }

            $upd = $pdo->prepare("UPDATE course_categories SET name = ?, slug = ?, description = ?, icon = ?, sort_order = ? WHERE id = ?");
            $upd->execute([$name, $slug, $description, $icon, $sortOrder, $id]);

            $updated = $pdo->query("SELECT * FROM course_categories WHERE id = {$id}")->fetch();
            api_response(200, true, 'Category updated successfully', $updated);
        }

        if ($requestMethod === 'DELETE') {
            require_admin();
            if ($id === null) {
                api_response(400, false, 'Category ID is required for deletion', null, 'MISSING_ID');
            }
            $stmt = $pdo->prepare("SELECT id FROM course_categories WHERE id = ?");
            $stmt->execute([$id]);
            if (!$stmt->fetch()) {
                api_response(404, false, "Category with ID {$id} not found", null, 'NOT_FOUND');
            }

            $del = $pdo->prepare("DELETE FROM course_categories WHERE id = ?");
            $del->execute([$id]);
            api_response(200, true, "Category ID {$id} deleted successfully", ['id' => $id]);
        }

        api_response(405, false, 'Method not allowed for categories', null, 'METHOD_NOT_ALLOWED');
    }

    // ------------------------------------------------------------------------
    // C. COURSES & SYLLABUS (/api/courses, /api/courses/{id}/syllabus, etc.)
    // ------------------------------------------------------------------------
    if ($resource === 'courses') {
        // Special sub-routes: /api/courses/{id}/syllabus
        if ($id !== null && $subResource === 'syllabus') {
            if ($requestMethod !== 'GET') {
                api_response(405, false, 'Method not allowed', null, 'METHOD_NOT_ALLOWED');
            }

            // 1. Fetch course details
            $cStmt = $pdo->prepare("SELECT c.*, cat.name as category_name, cat.slug as category_slug FROM courses c LEFT JOIN course_categories cat ON c.category_id = cat.id WHERE c.id = ?");
            $cStmt->execute([$id]);
            $course = $cStmt->fetch();
            if (!$course) {
                api_response(404, false, "Course with ID {$id} not found", null, 'COURSE_NOT_FOUND');
            }

            // 2. Fetch modules
            $mStmt = $pdo->prepare("SELECT * FROM course_modules WHERE course_id = ? ORDER BY sort_order ASC, id ASC");
            $mStmt->execute([$id]);
            $modules = $mStmt->fetchAll();

            // 3. Fetch topics for each module
            $modIds = array_column($modules, 'id');
            $topicsByModule = [];
            if (!empty($modIds)) {
                $inQuery = implode(',', array_map('intval', $modIds));
                $tStmt = $pdo->query("SELECT * FROM course_topics WHERE module_id IN ({$inQuery}) ORDER BY sort_order ASC, id ASC");
                $allTopics = $tStmt->fetchAll();
                foreach ($allTopics as $top) {
                    $topicsByModule[$top['module_id']][] = $top;
                }
            }

            // Attach topics to modules
            foreach ($modules as &$mod) {
                $mod['topics'] = $topicsByModule[$mod['id']] ?? [];
            }
            unset($mod);

            // 4. Fetch projects
            $pStmt = $pdo->prepare("SELECT * FROM course_projects WHERE course_id = ? ORDER BY sort_order ASC, id ASC");
            $pStmt->execute([$id]);
            $projects = $pStmt->fetchAll();

            $syllabusData = [
                'course' => $course,
                'modules' => $modules,
                'projects' => $projects
            ];

            api_response(200, true, "Complete syllabus for '{$course['title']}' retrieved", $syllabusData);
        }

        // Sub-route: /api/courses/{id}/modules
        if ($id !== null && $subResource === 'modules') {
            if ($requestMethod !== 'GET') {
                api_response(405, false, 'Method not allowed', null, 'METHOD_NOT_ALLOWED');
            }
            $stmt = $pdo->prepare("SELECT * FROM course_modules WHERE course_id = ? ORDER BY sort_order ASC, id ASC");
            $stmt->execute([$id]);
            api_response(200, true, 'Modules retrieved', $stmt->fetchAll());
        }

        // Sub-route: /api/courses/{id}/projects
        if ($id !== null && $subResource === 'projects') {
            if ($requestMethod !== 'GET') {
                api_response(405, false, 'Method not allowed', null, 'METHOD_NOT_ALLOWED');
            }
            $stmt = $pdo->prepare("SELECT * FROM course_projects WHERE course_id = ? ORDER BY sort_order ASC, id ASC");
            $stmt->execute([$id]);
            api_response(200, true, 'Projects retrieved', $stmt->fetchAll());
        }

        // Standard Course CRUD
        if ($requestMethod === 'GET') {
            if ($id !== null) {
                $stmt = $pdo->prepare("SELECT c.*, cat.name as category_name, cat.slug as category_slug FROM courses c LEFT JOIN course_categories cat ON c.category_id = cat.id WHERE c.id = ?");
                $stmt->execute([$id]);
                $course = $stmt->fetch();
                if (!$course) {
                    api_response(404, false, "Course with ID {$id} not found", null, 'NOT_FOUND');
                }
                api_response(200, true, 'Course retrieved', $course);
            } else {
                // Filters: category_id, status, featured, search query q, pagination
                $where = [];
                $params = [];

                if (isset($_GET['category_id']) && $_GET['category_id'] !== '') {
                    $where[] = "c.category_id = ?";
                    $params[] = (int)$_GET['category_id'];
                }
                if (isset($_GET['status']) && $_GET['status'] !== '') {
                    $where[] = "c.status = ?";
                    $params[] = (int)$_GET['status'];
                }
                if (isset($_GET['featured']) && $_GET['featured'] !== '') {
                    $where[] = "c.featured = ?";
                    $params[] = (int)$_GET['featured'];
                }
                if (!empty($_GET['q'])) {
                    $q = trim($_GET['q']);
                    $where[] = "(c.title LIKE ? OR c.short_description LIKE ? OR c.slug LIKE ?)";
                    $params[] = "%$q%";
                    $params[] = "%$q%";
                    $params[] = "%$q%";
                }

                $whereSql = !empty($where) ? "WHERE " . implode(' AND ', $where) : "";

                // Pagination
                $page = max(1, (int)($_GET['page'] ?? 1));
                $limit = isset($_GET['limit']) ? min(100, max(1, (int)$_GET['limit'])) : 50;
                $offset = ($page - 1) * $limit;

                // Count total
                $countStmt = $pdo->prepare("SELECT COUNT(*) FROM courses c {$whereSql}");
                $countStmt->execute($params);
                $totalCount = (int)$countStmt->fetchColumn();

                $sql = "SELECT c.*, cat.name as category_name, cat.slug as category_slug FROM courses c LEFT JOIN course_categories cat ON c.category_id = cat.id {$whereSql} ORDER BY c.sort_order ASC, c.id ASC LIMIT {$limit} OFFSET {$offset}";
                $stmt = $pdo->prepare($sql);
                $stmt->execute($params);
                $courses = $stmt->fetchAll();

                $result = [
                    'courses' => $courses,
                    'pagination' => [
                        'total' => $totalCount,
                        'page' => $page,
                        'limit' => $limit,
                        'total_pages' => ceil($totalCount / $limit)
                    ]
                ];

                api_response(200, true, 'Courses retrieved', $result);
            }
        }

        if ($requestMethod === 'POST') {
            require_admin();
            $input = get_request_data();
            $title = trim($input['title'] ?? '');
            $slug = trim($input['slug'] ?? '');
            $shortDesc = trim($input['short_description'] ?? '');
            $fullDesc = trim($input['full_description'] ?? '');
            $categoryId = !empty($input['category_id']) ? (int)$input['category_id'] : null;
            $level = trim($input['level'] ?? 'Beginner');
            $featured = !empty($input['featured']) ? 1 : 0;
            $status = isset($input['status']) ? (int)$input['status'] : 1;
            $heroText = trim($input['hero_text'] ?? '');
            $metaTitle = trim($input['meta_title'] ?? '');
            $metaDesc = trim($input['meta_description'] ?? '');
            $sortOrder = (int)($input['sort_order'] ?? 0);

            if ($title === '') {
                api_response(422, false, 'Course title is required', null, 'VALIDATION_ERROR');
            }
            if ($slug === '') {
                $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title), '-'));
            }

            // Check slug uniqueness
            $chk = $pdo->prepare("SELECT id FROM courses WHERE slug = ?");
            $chk->execute([$slug]);
            if ($chk->fetch()) {
                api_response(409, false, "Course slug '{$slug}' already exists", null, 'SLUG_CONFLICT');
            }

            // Check category if supplied
            if ($categoryId !== null) {
                $catChk = $pdo->prepare("SELECT id FROM course_categories WHERE id = ?");
                $catChk->execute([$categoryId]);
                if (!$catChk->fetch()) {
                    api_response(422, false, "Category ID {$categoryId} does not exist", null, 'INVALID_CATEGORY');
                }
            }

            $stmt = $pdo->prepare("INSERT INTO courses (title, slug, short_description, full_description, category_id, level, featured, status, hero_text, meta_title, meta_description, sort_order) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$title, $slug, $shortDesc, $fullDesc, $categoryId, $level, $featured, $status, $heroText, $metaTitle, $metaDesc, $sortOrder]);
            $newId = (int)$pdo->lastInsertId();

            $newCourse = $pdo->query("SELECT c.*, cat.name as category_name FROM courses c LEFT JOIN course_categories cat ON c.category_id = cat.id WHERE c.id = {$newId}")->fetch();
            api_response(201, true, 'Course created successfully', $newCourse);
        }

        if ($requestMethod === 'PUT') {
            require_admin();
            if ($id === null) {
                api_response(400, false, 'Course ID is required for update', null, 'MISSING_ID');
            }

            $stmt = $pdo->prepare("SELECT * FROM courses WHERE id = ?");
            $stmt->execute([$id]);
            $existing = $stmt->fetch();
            if (!$existing) {
                api_response(404, false, "Course with ID {$id} not found", null, 'NOT_FOUND');
            }

            $input = get_request_data();
            $title = isset($input['title']) ? trim($input['title']) : $existing['title'];
            $slug = isset($input['slug']) ? trim($input['slug']) : $existing['slug'];
            $shortDesc = isset($input['short_description']) ? trim($input['short_description']) : $existing['short_description'];
            $fullDesc = isset($input['full_description']) ? trim($input['full_description']) : $existing['full_description'];
            $categoryId = array_key_exists('category_id', $input) ? (!empty($input['category_id']) ? (int)$input['category_id'] : null) : $existing['category_id'];
            $level = isset($input['level']) ? trim($input['level']) : $existing['level'];
            $featured = isset($input['featured']) ? (!empty($input['featured']) ? 1 : 0) : (int)$existing['featured'];
            $status = isset($input['status']) ? (int)$input['status'] : (int)$existing['status'];
            $heroText = isset($input['hero_text']) ? trim($input['hero_text']) : $existing['hero_text'];
            $metaTitle = isset($input['meta_title']) ? trim($input['meta_title']) : $existing['meta_title'];
            $metaDesc = isset($input['meta_description']) ? trim($input['meta_description']) : $existing['meta_description'];
            $sortOrder = isset($input['sort_order']) ? (int)$input['sort_order'] : (int)$existing['sort_order'];

            if ($title === '') {
                api_response(422, false, 'Course title cannot be empty', null, 'VALIDATION_ERROR');
            }

            // Slug collision
            $chk = $pdo->prepare("SELECT id FROM courses WHERE slug = ? AND id != ?");
            $chk->execute([$slug, $id]);
            if ($chk->fetch()) {
                api_response(409, false, "Course slug '{$slug}' is used by another course", null, 'SLUG_CONFLICT');
            }

            $upd = $pdo->prepare("UPDATE courses SET title = ?, slug = ?, short_description = ?, full_description = ?, category_id = ?, level = ?, featured = ?, status = ?, hero_text = ?, meta_title = ?, meta_description = ?, sort_order = ? WHERE id = ?");
            $upd->execute([$title, $slug, $shortDesc, $fullDesc, $categoryId, $level, $featured, $status, $heroText, $metaTitle, $metaDesc, $sortOrder, $id]);

            $updated = $pdo->query("SELECT c.*, cat.name as category_name FROM courses c LEFT JOIN course_categories cat ON c.category_id = cat.id WHERE c.id = {$id}")->fetch();
            api_response(200, true, 'Course updated successfully', $updated);
        }

        if ($requestMethod === 'DELETE') {
            require_admin();
            if ($id === null) {
                api_response(400, false, 'Course ID is required for deletion', null, 'MISSING_ID');
            }
            $stmt = $pdo->prepare("SELECT id, title FROM courses WHERE id = ?");
            $stmt->execute([$id]);
            $course = $stmt->fetch();
            if (!$course) {
                api_response(404, false, "Course with ID {$id} not found", null, 'NOT_FOUND');
            }

            // Note: DB schema has ON DELETE CASCADE for modules, projects, topics
            $del = $pdo->prepare("DELETE FROM courses WHERE id = ?");
            $del->execute([$id]);
            api_response(200, true, "Course '{$course['title']}' (ID: {$id}) and its modules/topics/projects deleted successfully", ['id' => $id]);
        }

        api_response(405, false, 'Method not allowed for courses', null, 'METHOD_NOT_ALLOWED');
    }

    // ------------------------------------------------------------------------
    // D. COURSE MODULES (/api/modules)
    // ------------------------------------------------------------------------
    if ($resource === 'modules') {
        // Sub-route: /api/modules/{id}/topics
        if ($id !== null && $subResource === 'topics') {
            if ($requestMethod !== 'GET') {
                api_response(405, false, 'Method not allowed', null, 'METHOD_NOT_ALLOWED');
            }
            $stmt = $pdo->prepare("SELECT * FROM course_topics WHERE module_id = ? ORDER BY sort_order ASC, id ASC");
            $stmt->execute([$id]);
            api_response(200, true, 'Topics for module retrieved', $stmt->fetchAll());
        }

        if ($requestMethod === 'GET') {
            if ($id !== null) {
                $stmt = $pdo->prepare("SELECT m.*, c.title as course_title FROM course_modules m LEFT JOIN courses c ON m.course_id = c.id WHERE m.id = ?");
                $stmt->execute([$id]);
                $mod = $stmt->fetch();
                if (!$mod) {
                    api_response(404, false, "Module with ID {$id} not found", null, 'NOT_FOUND');
                }
                api_response(200, true, 'Module retrieved', $mod);
            } else {
                $courseId = isset($_GET['course_id']) && $_GET['course_id'] !== '' ? (int)$_GET['course_id'] : null;
                if ($courseId !== null) {
                    $stmt = $pdo->prepare("SELECT m.*, c.title as course_title FROM course_modules m LEFT JOIN courses c ON m.course_id = c.id WHERE m.course_id = ? ORDER BY m.sort_order ASC, m.id ASC");
                    $stmt->execute([$courseId]);
                } else {
                    $stmt = $pdo->query("SELECT m.*, c.title as course_title FROM course_modules m LEFT JOIN courses c ON m.course_id = c.id ORDER BY m.course_id ASC, m.sort_order ASC, m.id ASC");
                }
                api_response(200, true, 'Modules retrieved', $stmt->fetchAll());
            }
        }

        if ($requestMethod === 'POST') {
            require_admin();
            $input = get_request_data();
            $courseId = (int)($input['course_id'] ?? 0);
            $title = trim($input['title'] ?? '');
            $description = trim($input['description'] ?? '');
            $sortOrder = (int)($input['sort_order'] ?? 0);

            if ($courseId <= 0 || $title === '') {
                api_response(422, false, 'Course ID and module title are required', null, 'VALIDATION_ERROR');
            }

            // Verify course exists
            $chk = $pdo->prepare("SELECT id FROM courses WHERE id = ?");
            $chk->execute([$courseId]);
            if (!$chk->fetch()) {
                api_response(404, false, "Course ID {$courseId} not found", null, 'COURSE_NOT_FOUND');
            }

            $stmt = $pdo->prepare("INSERT INTO course_modules (course_id, title, description, sort_order) VALUES (?, ?, ?, ?)");
            $stmt->execute([$courseId, $title, $description, $sortOrder]);
            $newId = (int)$pdo->lastInsertId();
            apply_course_extras($pdo, 'course_modules', $newId, $input);

            $newMod = $pdo->query("SELECT * FROM course_modules WHERE id = {$newId}")->fetch();
            api_response(201, true, 'Module created successfully', $newMod);
        }

        if ($requestMethod === 'PUT') {
            require_admin();
            if ($id === null) {
                api_response(400, false, 'Module ID is required for update', null, 'MISSING_ID');
            }

            $stmt = $pdo->prepare("SELECT * FROM course_modules WHERE id = ?");
            $stmt->execute([$id]);
            $existing = $stmt->fetch();
            if (!$existing) {
                api_response(404, false, "Module with ID {$id} not found", null, 'NOT_FOUND');
            }

            $input = get_request_data();
            $title = isset($input['title']) ? trim($input['title']) : $existing['title'];
            $description = isset($input['description']) ? trim($input['description']) : $existing['description'];
            $sortOrder = isset($input['sort_order']) ? (int)$input['sort_order'] : (int)$existing['sort_order'];
            $courseId = isset($input['course_id']) ? (int)$input['course_id'] : (int)$existing['course_id'];

            if ($title === '') {
                api_response(422, false, 'Module title cannot be empty', null, 'VALIDATION_ERROR');
            }

            $upd = $pdo->prepare("UPDATE course_modules SET course_id = ?, title = ?, description = ?, sort_order = ? WHERE id = ?");
            $upd->execute([$courseId, $title, $description, $sortOrder, $id]);
            apply_course_extras($pdo, 'course_modules', (int)$id, $input);

            $updated = $pdo->query("SELECT * FROM course_modules WHERE id = {$id}")->fetch();
            api_response(200, true, 'Module updated successfully', $updated);
        }

        if ($requestMethod === 'DELETE') {
            require_admin();
            if ($id === null) {
                api_response(400, false, 'Module ID is required for deletion', null, 'MISSING_ID');
            }
            $stmt = $pdo->prepare("SELECT id, title FROM course_modules WHERE id = ?");
            $stmt->execute([$id]);
            $mod = $stmt->fetch();
            if (!$mod) {
                api_response(404, false, "Module with ID {$id} not found", null, 'NOT_FOUND');
            }

            $del = $pdo->prepare("DELETE FROM course_modules WHERE id = ?");
            $del->execute([$id]);
            api_response(200, true, "Module '{$mod['title']}' and its topics deleted successfully", ['id' => $id]);
        }

        api_response(405, false, 'Method not allowed for modules', null, 'METHOD_NOT_ALLOWED');
    }

    // ------------------------------------------------------------------------
    // E. COURSE TOPICS (/api/topics)
    // ------------------------------------------------------------------------
    if ($resource === 'topics') {
        if ($requestMethod === 'GET') {
            if ($id !== null) {
                $stmt = $pdo->prepare("SELECT t.*, m.title as module_title, m.course_id FROM course_topics t LEFT JOIN course_modules m ON t.module_id = m.id WHERE t.id = ?");
                $stmt->execute([$id]);
                $top = $stmt->fetch();
                if (!$top) {
                    api_response(404, false, "Topic with ID {$id} not found", null, 'NOT_FOUND');
                }
                api_response(200, true, 'Topic retrieved', $top);
            } else {
                $moduleId = isset($_GET['module_id']) && $_GET['module_id'] !== '' ? (int)$_GET['module_id'] : null;
                if ($moduleId !== null) {
                    $stmt = $pdo->prepare("SELECT t.*, m.title as module_title FROM course_topics t LEFT JOIN course_modules m ON t.module_id = m.id WHERE t.module_id = ? ORDER BY t.sort_order ASC, t.id ASC");
                    $stmt->execute([$moduleId]);
                } else {
                    $stmt = $pdo->query("SELECT t.*, m.title as module_title FROM course_topics t LEFT JOIN course_modules m ON t.module_id = m.id ORDER BY t.module_id ASC, t.sort_order ASC, t.id ASC");
                }
                api_response(200, true, 'Topics retrieved', $stmt->fetchAll());
            }
        }

        if ($requestMethod === 'POST') {
            require_admin();
            $input = get_request_data();
            $moduleId = (int)($input['module_id'] ?? 0);
            $title = trim($input['title'] ?? '');
            $description = trim($input['description'] ?? '');
            $sortOrder = (int)($input['sort_order'] ?? 0);

            if ($moduleId <= 0 || $title === '') {
                api_response(422, false, 'Module ID and topic title are required', null, 'VALIDATION_ERROR');
            }

            // Verify module exists
            $chk = $pdo->prepare("SELECT id FROM course_modules WHERE id = ?");
            $chk->execute([$moduleId]);
            if (!$chk->fetch()) {
                api_response(404, false, "Module ID {$moduleId} not found", null, 'MODULE_NOT_FOUND');
            }

            $stmt = $pdo->prepare("INSERT INTO course_topics (module_id, title, description, sort_order) VALUES (?, ?, ?, ?)");
            $stmt->execute([$moduleId, $title, $description, $sortOrder]);
            $newId = (int)$pdo->lastInsertId();
            apply_course_extras($pdo, 'course_topics', $newId, $input);

            $newTop = $pdo->query("SELECT * FROM course_topics WHERE id = {$newId}")->fetch();
            api_response(201, true, 'Topic created successfully', $newTop);
        }

        if ($requestMethod === 'PUT') {
            require_admin();
            if ($id === null) {
                api_response(400, false, 'Topic ID is required for update', null, 'MISSING_ID');
            }

            $stmt = $pdo->prepare("SELECT * FROM course_topics WHERE id = ?");
            $stmt->execute([$id]);
            $existing = $stmt->fetch();
            if (!$existing) {
                api_response(404, false, "Topic with ID {$id} not found", null, 'NOT_FOUND');
            }

            $input = get_request_data();
            $title = isset($input['title']) ? trim($input['title']) : $existing['title'];
            $description = isset($input['description']) ? trim($input['description']) : $existing['description'];
            $sortOrder = isset($input['sort_order']) ? (int)$input['sort_order'] : (int)$existing['sort_order'];
            $moduleId = isset($input['module_id']) ? (int)$input['module_id'] : (int)$existing['module_id'];

            if ($title === '') {
                api_response(422, false, 'Topic title cannot be empty', null, 'VALIDATION_ERROR');
            }

            $upd = $pdo->prepare("UPDATE course_topics SET module_id = ?, title = ?, description = ?, sort_order = ? WHERE id = ?");
            $upd->execute([$moduleId, $title, $description, $sortOrder, $id]);
            apply_course_extras($pdo, 'course_topics', (int)$id, $input);

            $updated = $pdo->query("SELECT * FROM course_topics WHERE id = {$id}")->fetch();
            api_response(200, true, 'Topic updated successfully', $updated);
        }

        if ($requestMethod === 'DELETE') {
            require_admin();
            if ($id === null) {
                api_response(400, false, 'Topic ID is required for deletion', null, 'MISSING_ID');
            }
            $stmt = $pdo->prepare("SELECT id, title FROM course_topics WHERE id = ?");
            $stmt->execute([$id]);
            $top = $stmt->fetch();
            if (!$top) {
                api_response(404, false, "Topic with ID {$id} not found", null, 'NOT_FOUND');
            }

            $del = $pdo->prepare("DELETE FROM course_topics WHERE id = ?");
            $del->execute([$id]);
            api_response(200, true, "Topic '{$top['title']}' deleted successfully", ['id' => $id]);
        }

        api_response(405, false, 'Method not allowed for topics', null, 'METHOD_NOT_ALLOWED');
    }

    // ------------------------------------------------------------------------
    // F. COURSE PROJECTS (/api/projects)
    // ------------------------------------------------------------------------
    if ($resource === 'projects') {
        if ($requestMethod === 'GET') {
            if ($id !== null) {
                $stmt = $pdo->prepare("SELECT p.*, c.title as course_title FROM course_projects p LEFT JOIN courses c ON p.course_id = c.id WHERE p.id = ?");
                $stmt->execute([$id]);
                $proj = $stmt->fetch();
                if (!$proj) {
                    api_response(404, false, "Project with ID {$id} not found", null, 'NOT_FOUND');
                }
                api_response(200, true, 'Project retrieved', $proj);
            } else {
                $courseId = isset($_GET['course_id']) && $_GET['course_id'] !== '' ? (int)$_GET['course_id'] : null;
                if ($courseId !== null) {
                    $stmt = $pdo->prepare("SELECT p.*, c.title as course_title FROM course_projects p LEFT JOIN courses c ON p.course_id = c.id WHERE p.course_id = ? ORDER BY p.sort_order ASC, p.id ASC");
                    $stmt->execute([$courseId]);
                } else {
                    $stmt = $pdo->query("SELECT p.*, c.title as course_title FROM course_projects p LEFT JOIN courses c ON p.course_id = c.id ORDER BY p.course_id ASC, p.sort_order ASC, p.id ASC");
                }
                api_response(200, true, 'Projects retrieved', $stmt->fetchAll());
            }
        }

        if ($requestMethod === 'POST') {
            require_admin();
            $input = get_request_data();
            $courseId = (int)($input['course_id'] ?? 0);
            $title = trim($input['title'] ?? '');
            $description = trim($input['description'] ?? '');
            $sortOrder = (int)($input['sort_order'] ?? 0);
            $status = isset($input['status']) ? (int)$input['status'] : 1;

            if ($courseId <= 0 || $title === '') {
                api_response(422, false, 'Course ID and project title are required', null, 'VALIDATION_ERROR');
            }

            $chk = $pdo->prepare("SELECT id FROM courses WHERE id = ?");
            $chk->execute([$courseId]);
            if (!$chk->fetch()) {
                api_response(404, false, "Course ID {$courseId} not found", null, 'COURSE_NOT_FOUND');
            }

            $stmt = $pdo->prepare("INSERT INTO course_projects (course_id, title, description, sort_order, status) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$courseId, $title, $description, $sortOrder, $status]);
            $newId = (int)$pdo->lastInsertId();
            apply_course_extras($pdo, 'course_projects', $newId, $input);

            $newProj = $pdo->query("SELECT * FROM course_projects WHERE id = {$newId}")->fetch();
            api_response(201, true, 'Project created successfully', $newProj);
        }

        if ($requestMethod === 'PUT') {
            require_admin();
            if ($id === null) {
                api_response(400, false, 'Project ID is required for update', null, 'MISSING_ID');
            }

            $stmt = $pdo->prepare("SELECT * FROM course_projects WHERE id = ?");
            $stmt->execute([$id]);
            $existing = $stmt->fetch();
            if (!$existing) {
                api_response(404, false, "Project with ID {$id} not found", null, 'NOT_FOUND');
            }

            $input = get_request_data();
            $title = isset($input['title']) ? trim($input['title']) : $existing['title'];
            $description = isset($input['description']) ? trim($input['description']) : $existing['description'];
            $sortOrder = isset($input['sort_order']) ? (int)$input['sort_order'] : (int)$existing['sort_order'];
            $courseId = isset($input['course_id']) ? (int)$input['course_id'] : (int)$existing['course_id'];
            $status = isset($input['status']) ? (int)$input['status'] : (int)$existing['status'];

            if ($title === '') {
                api_response(422, false, 'Project title cannot be empty', null, 'VALIDATION_ERROR');
            }

            $upd = $pdo->prepare("UPDATE course_projects SET course_id = ?, title = ?, description = ?, sort_order = ?, status = ? WHERE id = ?");
            $upd->execute([$courseId, $title, $description, $sortOrder, $status, $id]);
            apply_course_extras($pdo, 'course_projects', (int)$id, $input);

            $updated = $pdo->query("SELECT * FROM course_projects WHERE id = {$id}")->fetch();
            api_response(200, true, 'Project updated successfully', $updated);
        }

        if ($requestMethod === 'DELETE') {
            require_admin();
            if ($id === null) {
                api_response(400, false, 'Project ID is required for deletion', null, 'MISSING_ID');
            }
            $stmt = $pdo->prepare("SELECT id, title FROM course_projects WHERE id = ?");
            $stmt->execute([$id]);
            $proj = $stmt->fetch();
            if (!$proj) {
                api_response(404, false, "Project with ID {$id} not found", null, 'NOT_FOUND');
            }

            $del = $pdo->prepare("DELETE FROM course_projects WHERE id = ?");
            $del->execute([$id]);
            api_response(200, true, "Project '{$proj['title']}' deleted successfully", ['id' => $id]);
        }

        api_response(405, false, 'Method not allowed for projects', null, 'METHOD_NOT_ALLOWED');
    }

    // ------------------------------------------------------------------------
    // H. TESTIMONIALS (/api/testimonials)
    // ------------------------------------------------------------------------
    if ($resource === 'testimonials') {
        if ($requestMethod === 'GET') {
            if ($id !== null) {
                $stmt = $pdo->prepare("SELECT * FROM testimonials WHERE id = ?");
                $stmt->execute([$id]);
                $test = $stmt->fetch();
                if (!$test) {
                    api_response(404, false, "Testimonial with ID {$id} not found", null, 'NOT_FOUND');
                }
                api_response(200, true, 'Testimonial retrieved', $test);
            } else {
                $status = isset($_GET['status']) && $_GET['status'] !== '' ? (int)$_GET['status'] : null;
                if ($status !== null) {
                    $stmt = $pdo->prepare("SELECT * FROM testimonials WHERE status = ? ORDER BY sort_order ASC, id DESC");
                    $stmt->execute([$status]);
                } else {
                    $stmt = $pdo->query("SELECT * FROM testimonials ORDER BY sort_order ASC, id DESC");
                }
                api_response(200, true, 'Testimonials retrieved', $stmt->fetchAll());
            }
        }

        if ($requestMethod === 'POST') {
            require_admin();
            $input = get_request_data();
            $name = trim($input['student_name'] ?? '');
            $course = trim($input['course'] ?? '');
            $testimonial = trim($input['testimonial'] ?? '');
            $rating = isset($input['rating']) ? min(5, max(1, (int)$input['rating'])) : 5;
            $status = isset($input['status']) ? (int)$input['status'] : 1;
            $sortOrder = (int)($input['sort_order'] ?? 0);
            $reviewDate = trim($input['review_date'] ?? '');
            $source = trim($input['source'] ?? 'google');
            $sourceUrl = trim($input['source_url'] ?? '');

            if ($name === '' || $testimonial === '') {
                api_response(422, false, 'Student name and testimonial text are required', null, 'VALIDATION_ERROR');
            }

            $stmt = $pdo->prepare("INSERT INTO testimonials (student_name, course, testimonial, rating, review_date, source, source_url, status, sort_order) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$name, $course, $testimonial, $rating, $reviewDate, $source, $sourceUrl, $status, $sortOrder]);
            $newId = (int)$pdo->lastInsertId();

            $newTest = $pdo->query("SELECT * FROM testimonials WHERE id = {$newId}")->fetch();
            api_response(201, true, 'Testimonial created successfully', $newTest);
        }

        if ($requestMethod === 'PUT') {
            require_admin();
            if ($id === null) {
                api_response(400, false, 'Testimonial ID is required for update', null, 'MISSING_ID');
            }

            $stmt = $pdo->prepare("SELECT * FROM testimonials WHERE id = ?");
            $stmt->execute([$id]);
            $existing = $stmt->fetch();
            if (!$existing) {
                api_response(404, false, "Testimonial with ID {$id} not found", null, 'NOT_FOUND');
            }

            $input = get_request_data();
            $name = isset($input['student_name']) ? trim($input['student_name']) : $existing['student_name'];
            $course = isset($input['course']) ? trim($input['course']) : $existing['course'];
            $testimonial = isset($input['testimonial']) ? trim($input['testimonial']) : $existing['testimonial'];
            $rating = isset($input['rating']) ? min(5, max(1, (int)$input['rating'])) : (int)$existing['rating'];
            $status = isset($input['status']) ? (int)$input['status'] : (int)$existing['status'];
            $sortOrder = isset($input['sort_order']) ? (int)$input['sort_order'] : (int)$existing['sort_order'];
            $reviewDate = isset($input['review_date']) ? trim($input['review_date']) : ($existing['review_date'] ?? '');
            $source = isset($input['source']) ? trim($input['source']) : ($existing['source'] ?? 'google');
            $sourceUrl = isset($input['source_url']) ? trim($input['source_url']) : ($existing['source_url'] ?? '');

            if ($name === '' || $testimonial === '') {
                api_response(422, false, 'Student name and testimonial text cannot be empty', null, 'VALIDATION_ERROR');
            }

            $upd = $pdo->prepare("UPDATE testimonials SET student_name = ?, course = ?, testimonial = ?, rating = ?, review_date = ?, source = ?, source_url = ?, status = ?, sort_order = ? WHERE id = ?");
            $upd->execute([$name, $course, $testimonial, $rating, $reviewDate, $source, $sourceUrl, $status, $sortOrder, $id]);

            $updated = $pdo->query("SELECT * FROM testimonials WHERE id = {$id}")->fetch();
            api_response(200, true, 'Testimonial updated successfully', $updated);
        }

        if ($requestMethod === 'DELETE') {
            require_admin();
            if ($id === null) {
                api_response(400, false, 'Testimonial ID is required for deletion', null, 'MISSING_ID');
            }
            $stmt = $pdo->prepare("SELECT id FROM testimonials WHERE id = ?");
            $stmt->execute([$id]);
            if (!$stmt->fetch()) {
                api_response(404, false, "Testimonial with ID {$id} not found", null, 'NOT_FOUND');
            }

            $del = $pdo->prepare("DELETE FROM testimonials WHERE id = ?");
            $del->execute([$id]);
            api_response(200, true, "Testimonial ID {$id} deleted successfully", ['id' => $id]);
        }

        api_response(405, false, 'Method not allowed for testimonials', null, 'METHOD_NOT_ALLOWED');
    }

    // ------------------------------------------------------------------------
    // I. FAQS (/api/faqs)
    // ------------------------------------------------------------------------
    if ($resource === 'faqs') {
        if ($requestMethod === 'GET') {
            if ($id !== null) {
                $stmt = $pdo->prepare("SELECT * FROM faqs WHERE id = ?");
                $stmt->execute([$id]);
                $faq = $stmt->fetch();
                if (!$faq) {
                    api_response(404, false, "FAQ with ID {$id} not found", null, 'NOT_FOUND');
                }
                api_response(200, true, 'FAQ retrieved', $faq);
            } else {
                $status = isset($_GET['status']) && $_GET['status'] !== '' ? (int)$_GET['status'] : null;
                if ($status !== null) {
                    $stmt = $pdo->prepare("SELECT * FROM faqs WHERE status = ? ORDER BY sort_order ASC, id ASC");
                    $stmt->execute([$status]);
                } else {
                    $stmt = $pdo->query("SELECT * FROM faqs ORDER BY sort_order ASC, id ASC");
                }
                api_response(200, true, 'FAQs retrieved', $stmt->fetchAll());
            }
        }

        if ($requestMethod === 'POST') {
            require_admin();
            $input = get_request_data();
            $question = trim($input['question'] ?? '');
            $answer = trim($input['answer'] ?? '');
            $status = isset($input['status']) ? (int)$input['status'] : 1;
            $sortOrder = (int)($input['sort_order'] ?? 0);

            if ($question === '' || $answer === '') {
                api_response(422, false, 'Question and answer are required', null, 'VALIDATION_ERROR');
            }

            $stmt = $pdo->prepare("INSERT INTO faqs (question, answer, status, sort_order) VALUES (?, ?, ?, ?)");
            $stmt->execute([$question, $answer, $status, $sortOrder]);
            $newId = (int)$pdo->lastInsertId();

            $newFaq = $pdo->query("SELECT * FROM faqs WHERE id = {$newId}")->fetch();
            api_response(201, true, 'FAQ created successfully', $newFaq);
        }

        if ($requestMethod === 'PUT') {
            require_admin();
            if ($id === null) {
                api_response(400, false, 'FAQ ID is required for update', null, 'MISSING_ID');
            }

            $stmt = $pdo->prepare("SELECT * FROM faqs WHERE id = ?");
            $stmt->execute([$id]);
            $existing = $stmt->fetch();
            if (!$existing) {
                api_response(404, false, "FAQ with ID {$id} not found", null, 'NOT_FOUND');
            }

            $input = get_request_data();
            $question = isset($input['question']) ? trim($input['question']) : $existing['question'];
            $answer = isset($input['answer']) ? trim($input['answer']) : $existing['answer'];
            $status = isset($input['status']) ? (int)$input['status'] : (int)$existing['status'];
            $sortOrder = isset($input['sort_order']) ? (int)$input['sort_order'] : (int)$existing['sort_order'];

            if ($question === '' || $answer === '') {
                api_response(422, false, 'Question and answer cannot be empty', null, 'VALIDATION_ERROR');
            }

            $upd = $pdo->prepare("UPDATE faqs SET question = ?, answer = ?, status = ?, sort_order = ? WHERE id = ?");
            $upd->execute([$question, $answer, $status, $sortOrder, $id]);

            $updated = $pdo->query("SELECT * FROM faqs WHERE id = {$id}")->fetch();
            api_response(200, true, 'FAQ updated successfully', $updated);
        }

        if ($requestMethod === 'DELETE') {
            require_admin();
            if ($id === null) {
                api_response(400, false, 'FAQ ID is required for deletion', null, 'MISSING_ID');
            }
            $stmt = $pdo->prepare("SELECT id FROM faqs WHERE id = ?");
            $stmt->execute([$id]);
            if (!$stmt->fetch()) {
                api_response(404, false, "FAQ with ID {$id} not found", null, 'NOT_FOUND');
            }

            $del = $pdo->prepare("DELETE FROM faqs WHERE id = ?");
            $del->execute([$id]);
            api_response(200, true, "FAQ ID {$id} deleted successfully", ['id' => $id]);
        }

        api_response(405, false, 'Method not allowed for faqs', null, 'METHOD_NOT_ALLOWED');
    }

    // ------------------------------------------------------------------------
    // J. SERVICES (/api/services)
    // ------------------------------------------------------------------------
    if ($resource === 'services') {
        if ($requestMethod === 'GET') {
            if ($id !== null) {
                $stmt = $pdo->prepare("SELECT * FROM services WHERE id = ?");
                $stmt->execute([$id]);
                $serv = $stmt->fetch();
                if (!$serv) {
                    api_response(404, false, "Service with ID {$id} not found", null, 'NOT_FOUND');
                }
                api_response(200, true, 'Service retrieved', $serv);
            } else {
                $status = isset($_GET['status']) && $_GET['status'] !== '' ? (int)$_GET['status'] : null;
                if ($status !== null) {
                    $stmt = $pdo->prepare("SELECT * FROM services WHERE status = ? ORDER BY id ASC");
                    $stmt->execute([$status]);
                } else {
                    $stmt = $pdo->query("SELECT * FROM services ORDER BY id ASC");
                }
                api_response(200, true, 'Services retrieved', $stmt->fetchAll());
            }
        }

        if ($requestMethod === 'POST') {
            require_admin();
            $input = get_request_data();
            $title = trim($input['title'] ?? '');
            $description = trim($input['description'] ?? '');
            $status = isset($input['status']) ? (int)$input['status'] : 1;

            if ($title === '') {
                api_response(422, false, 'Service title is required', null, 'VALIDATION_ERROR');
            }

            $stmt = $pdo->prepare("INSERT INTO services (title, description, status) VALUES (?, ?, ?)");
            $stmt->execute([$title, $description, $status]);
            $newId = (int)$pdo->lastInsertId();

            $newServ = $pdo->query("SELECT * FROM services WHERE id = {$newId}")->fetch();
            api_response(201, true, 'Service created successfully', $newServ);
        }

        if ($requestMethod === 'PUT') {
            require_admin();
            if ($id === null) {
                api_response(400, false, 'Service ID is required for update', null, 'MISSING_ID');
            }

            $stmt = $pdo->prepare("SELECT * FROM services WHERE id = ?");
            $stmt->execute([$id]);
            $existing = $stmt->fetch();
            if (!$existing) {
                api_response(404, false, "Service with ID {$id} not found", null, 'NOT_FOUND');
            }

            $input = get_request_data();
            $title = isset($input['title']) ? trim($input['title']) : $existing['title'];
            $description = isset($input['description']) ? trim($input['description']) : $existing['description'];
            $status = isset($input['status']) ? (int)$input['status'] : (int)$existing['status'];

            if ($title === '') {
                api_response(422, false, 'Service title cannot be empty', null, 'VALIDATION_ERROR');
            }

            $upd = $pdo->prepare("UPDATE services SET title = ?, description = ?, status = ? WHERE id = ?");
            $upd->execute([$title, $description, $status, $id]);

            $updated = $pdo->query("SELECT * FROM services WHERE id = {$id}")->fetch();
            api_response(200, true, 'Service updated successfully', $updated);
        }

        if ($requestMethod === 'DELETE') {
            require_admin();
            if ($id === null) {
                api_response(400, false, 'Service ID is required for deletion', null, 'MISSING_ID');
            }
            $stmt = $pdo->prepare("SELECT id FROM services WHERE id = ?");
            $stmt->execute([$id]);
            if (!$stmt->fetch()) {
                api_response(404, false, "Service with ID {$id} not found", null, 'NOT_FOUND');
            }

            $del = $pdo->prepare("DELETE FROM services WHERE id = ?");
            $del->execute([$id]);
            api_response(200, true, "Service ID {$id} deleted successfully", ['id' => $id]);
        }

        api_response(405, false, 'Method not allowed for services', null, 'METHOD_NOT_ALLOWED');
    }

    // ------------------------------------------------------------------------
    // K. ENQUIRIES (/api/enquiries)
    // ------------------------------------------------------------------------
    if ($resource === 'enquiries') {
        // GET enquiries (Admin Only)
        if ($requestMethod === 'GET') {
            require_admin();
            if ($id !== null) {
                $stmt = $pdo->prepare("SELECT e.*, c.title as course_title, c.slug as course_slug FROM enquiries e LEFT JOIN courses c ON e.course_id = c.id WHERE e.id = ?");
                $stmt->execute([$id]);
                $enq = $stmt->fetch(PDO::FETCH_ASSOC);
                if (!$enq) {
                    api_response(404, false, "Enquiry with ID {$id} not found", null, 'NOT_FOUND');
                }

                // Decode structured JSON columns
                $jsonCols = ['known_technologies', 'recommended_course_ids', 'recommendation_scores', 'skill_gap_analysis', 'personalized_roadmap', 'daily_study_plan', 'project_recommendations'];
                foreach ($jsonCols as $col) {
                    if (!empty($enq[$col]) && is_string($enq[$col])) {
                        $decoded = json_decode($enq[$col], true);
                        if (json_last_error() === JSON_ERROR_NONE) {
                            $enq[$col] = $decoded;
                        }
                    }
                }

                // Fetch supporting course info if available
                $supportingCourseId = $enq['recommended_course_ids']['supporting'] ?? null;
                if ($supportingCourseId) {
                    $sStmt = $pdo->prepare("SELECT id, title, slug FROM courses WHERE id = ?");
                    $sStmt->execute([(int)$supportingCourseId]);
                    $enq['supporting_course'] = $sStmt->fetch(PDO::FETCH_ASSOC) ?: null;
                } else {
                    $enq['supporting_course'] = null;
                }

                api_response(200, true, 'Enquiry retrieved', $enq);
            } else {
                $where = [];
                $params = [];

                if (!empty($_GET['status'])) {
                    $where[] = "e.status = ?";
                    $params[] = trim($_GET['status']);
                }
                if (!empty($_GET['course_id'])) {
                    $where[] = "e.course_id = ?";
                    $params[] = (int)$_GET['course_id'];
                }
                if (!empty($_GET['career_goal'])) {
                    $where[] = "e.career_goal = ?";
                    $params[] = trim($_GET['career_goal']);
                }
                if (!empty($_GET['from_date'])) {
                    $where[] = "e.created_at >= ?";
                    $params[] = trim($_GET['from_date']) . ' 00:00:00';
                }
                if (!empty($_GET['to_date'])) {
                    $where[] = "e.created_at <= ?";
                    $params[] = trim($_GET['to_date']) . ' 23:59:59';
                }
                if (!empty($_GET['q'])) {
                    $q = trim($_GET['q']);
                    $where[] = "(e.name LIKE ? OR e.phone LIKE ? OR e.email LIKE ? OR e.career_goal LIKE ? OR e.recommended_career_path LIKE ? OR e.message LIKE ?)";
                    $params[] = "%$q%";
                    $params[] = "%$q%";
                    $params[] = "%$q%";
                    $params[] = "%$q%";
                    $params[] = "%$q%";
                    $params[] = "%$q%";
                }

                $whereSql = !empty($where) ? "WHERE " . implode(' AND ', $where) : "";

                $page = max(1, (int)($_GET['page'] ?? 1));
                $limit = isset($_GET['limit']) ? min(100, max(1, (int)$_GET['limit'])) : 50;
                $offset = ($page - 1) * $limit;

                $countStmt = $pdo->prepare("SELECT COUNT(*) FROM enquiries e {$whereSql}");
                $countStmt->execute($params);
                $totalCount = (int)$countStmt->fetchColumn();

                $stmt = $pdo->prepare("SELECT e.*, c.title as course_title, c.slug as course_slug FROM enquiries e LEFT JOIN courses c ON e.course_id = c.id {$whereSql} ORDER BY e.created_at DESC, e.id DESC LIMIT {$limit} OFFSET {$offset}");
                $stmt->execute($params);
                $enquiries = $stmt->fetchAll(PDO::FETCH_ASSOC);

                // Decode JSON columns for list view
                foreach ($enquiries as &$row) {
                    if (!empty($row['known_technologies']) && is_string($row['known_technologies'])) {
                        $row['known_technologies'] = json_decode($row['known_technologies'], true) ?: [];
                    }
                    if (!empty($row['recommended_course_ids']) && is_string($row['recommended_course_ids'])) {
                        $row['recommended_course_ids'] = json_decode($row['recommended_course_ids'], true) ?: [];
                    }
                    if (!empty($row['recommendation_scores']) && is_string($row['recommendation_scores'])) {
                        $row['recommendation_scores'] = json_decode($row['recommendation_scores'], true) ?: [];
                    }
                }
                unset($row);

                $result = [
                    'enquiries' => $enquiries,
                    'pagination' => [
                        'total' => $totalCount,
                        'page' => $page,
                        'limit' => $limit,
                        'total_pages' => ceil($totalCount / $limit)
                    ]
                ];

                api_response(200, true, 'Enquiries retrieved', $result);
            }
        }

        // POST enquiry (Public submission with Recommendation generation)
        if ($requestMethod === 'POST') {
            $input = get_request_data();
            $name = trim($input['name'] ?? '');
            $phone = trim($input['phone'] ?? '');
            $email = trim($input['email'] ?? '');
            $sourcePage = trim($input['source_page'] ?? 'Recommendation Assessment');
            $status = trim($input['status'] ?? 'New');

            if ($name === '') {
                api_response(422, false, 'Name is required', null, 'VALIDATION_ERROR');
            }
            if ($phone === '' && $email === '') {
                api_response(422, false, 'Please provide either a phone number or email address', null, 'VALIDATION_ERROR');
            }

            // Check if this is a Recommendation Assessment submission
            $isRecommendation = isset($input['career_goal']) || isset($input['learning_level']) || isset($input['known_technologies']);

            if ($isRecommendation) {
                $education = trim($input['education'] ?? '');
                $age = !empty($input['age']) ? (int)$input['age'] : null;
                $learningLevel = trim($input['learning_level'] ?? 'Complete Beginner');
                $careerGoal = trim($input['career_goal'] ?? 'Software Developer');
                $learningObjective = trim($input['learning_objective'] ?? 'Job and interview preparation');
                $dailyAvailability = trim($input['daily_availability'] ?? '2–4 hours');
                $message = trim($input['message'] ?? '');

                // Normalize known technologies
                $knownRaw = $input['known_technologies'] ?? [];
                if (is_string($knownRaw)) {
                    $decoded = json_decode($knownRaw, true);
                    $knownTechs = is_array($decoded) ? $decoded : array_map('trim', explode(',', $knownRaw));
                } else {
                    $knownTechs = (array)$knownRaw;
                }
                $knownTechs = array_values(array_filter(array_map('trim', $knownTechs), function($t) {
                    return $t !== '' && strtolower($t) !== 'none';
                }));

                // Safe idempotency mechanism: prevent duplicate submissions within short interval
                $idempotencyKey = trim($input['idempotency_key'] ?? '');
                if ($idempotencyKey === '') {
                    $idempotencyKey = hash('sha256', strtolower($name) . '|' . preg_replace('/\D+/', '', $phone) . '|' . $careerGoal . '|' . date('YmdH'));
                }

                // Check for existing duplicate submission with this idempotency key
                $dupStmt = $pdo->prepare("SELECT id, recommended_career_path, recommended_course_ids, recommendation_scores, skill_gap_analysis, personalized_roadmap, daily_study_plan, project_recommendations, estimated_duration FROM enquiries WHERE idempotency_key = ? LIMIT 1");
                $dupStmt->execute([$idempotencyKey]);
                $existingDup = $dupStmt->fetch(PDO::FETCH_ASSOC);

                if ($existingDup) {
                    // Return existing recommendation without duplicate insert
                    $dupRec = [
                        'career_profile' => [
                            'recommended_career' => $existingDup['recommended_career_path'],
                            'learning_level' => $learningLevel,
                            'known_technologies' => $knownTechs,
                            'learning_objective' => $learningObjective,
                            'daily_availability' => $dailyAvailability,
                            'estimated_duration' => $existingDup['estimated_duration']
                        ],
                        'skill_gap_analysis' => json_decode($existingDup['skill_gap_analysis'] ?? '[]', true),
                        'roadmap' => json_decode($existingDup['personalized_roadmap'] ?? '[]', true),
                        'daily_study_plan' => json_decode($existingDup['daily_study_plan'] ?? '[]', true),
                        'project_recommendations' => json_decode($existingDup['project_recommendations'] ?? '[]', true)
                    ];

                    $dupScores = json_decode($existingDup['recommendation_scores'] ?? '[]', true);
                    $dupCourseIds = json_decode($existingDup['recommended_course_ids'] ?? '[]', true);
                    
                    // Format recommendations array for frontend card rendering
                    $formattedCards = [];
                    if (!empty($dupCourseIds['primary'])) {
                        $pSt = $pdo->prepare("SELECT id, title, slug, level, short_description FROM courses WHERE id = ?");
                        $pSt->execute([(int)$dupCourseIds['primary']]);
                        $pc = $pSt->fetch(PDO::FETCH_ASSOC);
                        if ($pc) {
                            $formattedCards[] = [
                                'id' => (int)$pc['id'],
                                'name' => $pc['title'],
                                'slug' => $pc['slug'],
                                'percentage' => $dupScores['primary_score'] ?? 95,
                                'reason' => "Directly matches your target career goal as a {$existingDup['recommended_career_path']}.",
                                'url' => '/course.php?slug=' . rawurlencode($pc['slug'])
                            ];
                        }
                    }
                    if (!empty($dupCourseIds['supporting'])) {
                        $sSt = $pdo->prepare("SELECT id, title, slug, level, short_description FROM courses WHERE id = ?");
                        $sSt->execute([(int)$dupCourseIds['supporting']]);
                        $sc = $sSt->fetch(PDO::FETCH_ASSOC);
                        if ($sc) {
                            $formattedCards[] = [
                                'id' => (int)$sc['id'],
                                'name' => $sc['title'],
                                'slug' => $sc['slug'],
                                'percentage' => $dupScores['supporting_score'] ?? 90,
                                'reason' => "Reinforces your algorithmic problem-solving and programming fundamentals.",
                                'url' => '/course.php?slug=' . rawurlencode($sc['slug'])
                            ];
                        }
                    }

                    $responsePayload = array_merge($dupRec, [
                        'enquiry_id' => (int)$existingDup['id'],
                        'is_idempotent_replay' => true,
                        'recommendations' => $formattedCards
                    ]);

                    api_response(200, true, 'Existing recommendation retrieved (idempotent)', $responsePayload);
                }

                // Generate new personalized recommendation
                $recResult = ChedoRecommendationEngine::analyzeAndRecommend([
                    'learning_level' => $learningLevel,
                    'career_goal' => $careerGoal,
                    'known_technologies' => $knownTechs,
                    'learning_objective' => $learningObjective,
                    'daily_availability' => $dailyAvailability
                ], $pdo);

                $primaryCourseId = (int)$recResult['recommended_courses']['primary']['id'];
                $supportingCourseId = (int)$recResult['recommended_courses']['supporting']['id'];
                $recCourseIds = json_encode(['primary' => $primaryCourseId, 'supporting' => $supportingCourseId], JSON_UNESCAPED_SLASHES);
                $recScores = json_encode($recResult['scores'], JSON_UNESCAPED_SLASHES);
                $skillGapJson = json_encode($recResult['skill_gap_analysis'], JSON_UNESCAPED_SLASHES);
                $roadmapJson = json_encode($recResult['roadmap'], JSON_UNESCAPED_SLASHES);
                $studyPlanJson = json_encode($recResult['daily_study_plan'], JSON_UNESCAPED_SLASHES);
                $projectsJson = json_encode($recResult['project_recommendations'], JSON_UNESCAPED_SLASHES);
                $knownTechsJson = json_encode($knownTechs, JSON_UNESCAPED_SLASHES);
                $estDuration = $recResult['career_profile']['estimated_duration'];
                $recommendedCareer = $recResult['career_profile']['recommended_career'];

                // Database Transaction: save enquiry + recommendations in single record
                $pdo->beginTransaction();
                try {
                    $insertSql = "INSERT INTO enquiries (
                        name, phone, email, education, age, learning_level, career_goal,
                        known_technologies, learning_objective, daily_availability,
                        recommended_career_path, recommended_course_ids, recommendation_scores,
                        skill_gap_analysis, personalized_roadmap, daily_study_plan,
                        project_recommendations, estimated_duration, idempotency_key,
                        course_id, message, source_page, status
                    ) VALUES (
                        ?, ?, ?, ?, ?, ?, ?,
                        ?, ?, ?,
                        ?, ?, ?,
                        ?, ?, ?,
                        ?, ?, ?,
                        ?, ?, ?, ?
                    )";

                    $stmt = $pdo->prepare($insertSql);
                    $stmt->execute([
                        mb_substr($name, 0, 100),
                        mb_substr($phone, 0, 50),
                        mb_substr($email, 0, 255),
                        mb_substr($education, 0, 100),
                        $age,
                        mb_substr($learningLevel, 0, 100),
                        mb_substr($careerGoal, 0, 100),
                        $knownTechsJson,
                        mb_substr($learningObjective, 0, 255),
                        mb_substr($dailyAvailability, 0, 100),
                        mb_substr($recommendedCareer, 0, 100),
                        $recCourseIds,
                        $recScores,
                        $skillGapJson,
                        $roadmapJson,
                        $studyPlanJson,
                        $projectsJson,
                        mb_substr($estDuration, 0, 100),
                        $idempotencyKey,
                        $primaryCourseId,
                        mb_substr($message, 0, 5000),
                        mb_substr($sourcePage, 0, 255),
                        $status
                    ]);

                    $newId = (int)$pdo->lastInsertId();
                    $pdo->commit();

                    // Format cards list for frontend display
                    $recommendationCards = [
                        [
                            'id' => $primaryCourseId,
                            'name' => $recResult['recommended_courses']['primary']['name'],
                            'slug' => $recResult['recommended_courses']['primary']['slug'],
                            'percentage' => $recResult['recommended_courses']['primary']['percentage'],
                            'reason' => $recResult['recommended_courses']['primary']['reason'],
                            'url' => $recResult['recommended_courses']['primary']['url']
                        ],
                        [
                            'id' => $supportingCourseId,
                            'name' => $recResult['recommended_courses']['supporting']['name'],
                            'slug' => $recResult['recommended_courses']['supporting']['slug'],
                            'percentage' => $recResult['recommended_courses']['supporting']['percentage'],
                            'reason' => $recResult['recommended_courses']['supporting']['reason'],
                            'url' => $recResult['recommended_courses']['supporting']['url']
                        ]
                    ];

                    $responsePayload = [
                        'enquiry_id' => $newId,
                        'career_profile' => $recResult['career_profile'],
                        'skill_gap_analysis' => $recResult['skill_gap_analysis'],
                        'recommended_courses' => $recResult['recommended_courses'],
                        'recommendations' => $recommendationCards,
                        'roadmap' => $recResult['roadmap'],
                        'daily_study_plan' => $recResult['daily_study_plan'],
                        'project_recommendations' => $recResult['project_recommendations'],
                        'job_readiness' => $recResult['job_readiness']
                    ];

                    api_response(201, true, 'Recommendation generated and enquiry stored successfully', $responsePayload);
                } catch (Throwable $e) {
                    if ($pdo->inTransaction()) {
                        $pdo->rollBack();
                    }
                    error_log("Enquiry submission failed: " . $e->getMessage());
                    api_response(500, false, 'Failed to process recommendation enquiry', null, 'DATABASE_ERROR');
                }
            } else {
                // Regular Course / General Enquiry
                $courseId = !empty($input['course_id']) ? (int)$input['course_id'] : null;
                $message = trim($input['message'] ?? '');

                $name = mb_substr($name, 0, 100);
                $phone = mb_substr($phone, 0, 50);
                $email = mb_substr($email, 0, 255);
                $message = mb_substr($message, 0, 5000);
                $sourcePage = mb_substr($sourcePage, 0, 255);

                $stmt = $pdo->prepare("INSERT INTO enquiries (name, phone, email, course_id, message, source_page, status) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute([$name, $phone, $email, $courseId, $message, $sourcePage, $status]);
                $newId = (int)$pdo->lastInsertId();

                $newEnq = $pdo->query("SELECT e.*, c.title as course_title FROM enquiries e LEFT JOIN courses c ON e.course_id = c.id WHERE e.id = {$newId}")->fetch(PDO::FETCH_ASSOC);
                api_response(201, true, 'Enquiry submitted successfully', $newEnq);
            }
        }

        // PUT enquiry (Admin Only)
        if ($requestMethod === 'PUT') {
            require_admin();
            if ($id === null) {
                api_response(400, false, 'Enquiry ID is required for update', null, 'MISSING_ID');
            }

            $stmt = $pdo->prepare("SELECT * FROM enquiries WHERE id = ?");
            $stmt->execute([$id]);
            $existing = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$existing) {
                api_response(404, false, "Enquiry with ID {$id} not found", null, 'NOT_FOUND');
            }

            $input = get_request_data();
            $status = isset($input['status']) ? trim($input['status']) : $existing['status'];
            $name = isset($input['name']) ? trim($input['name']) : $existing['name'];
            $phone = isset($input['phone']) ? trim($input['phone']) : $existing['phone'];
            $email = isset($input['email']) ? trim($input['email']) : $existing['email'];
            $message = isset($input['message']) ? trim($input['message']) : $existing['message'];
            $courseId = array_key_exists('course_id', $input) ? (!empty($input['course_id']) ? (int)$input['course_id'] : null) : $existing['course_id'];

            $upd = $pdo->prepare("UPDATE enquiries SET name = ?, phone = ?, email = ?, course_id = ?, message = ?, status = ? WHERE id = ?");
            $upd->execute([$name, $phone, $email, $courseId, $message, $status, $id]);

            $updated = $pdo->query("SELECT e.*, c.title as course_title FROM enquiries e LEFT JOIN courses c ON e.course_id = c.id WHERE e.id = {$id}")->fetch(PDO::FETCH_ASSOC);
            api_response(200, true, 'Enquiry updated successfully', $updated);
        }

        // DELETE enquiry (Admin Only)
        if ($requestMethod === 'DELETE') {
            require_admin();
            if ($id === null) {
                api_response(400, false, 'Enquiry ID is required for deletion', null, 'MISSING_ID');
            }
            $stmt = $pdo->prepare("SELECT id FROM enquiries WHERE id = ?");
            $stmt->execute([$id]);
            if (!$stmt->fetch()) {
                api_response(404, false, "Enquiry with ID {$id} not found", null, 'NOT_FOUND');
            }

            $del = $pdo->prepare("DELETE FROM enquiries WHERE id = ?");
            $del->execute([$id]);
            api_response(200, true, "Enquiry ID {$id} deleted successfully", ['id' => $id]);
        }

        api_response(405, false, 'Method not allowed for enquiries', null, 'METHOD_NOT_ALLOWED');
    }


    // ------------------------------------------------------------------------
    // L. SEO SETTINGS (/api/seo)
    // ------------------------------------------------------------------------
    if ($resource === 'seo') {
        if ($requestMethod === 'GET') {
            if ($id !== null) {
                $stmt = $pdo->prepare("SELECT * FROM seo_settings WHERE id = ?");
                $stmt->execute([$id]);
                $seo = $stmt->fetch();
                if (!$seo) {
                    api_response(404, false, "SEO setting with ID {$id} not found", null, 'NOT_FOUND');
                }
                api_response(200, true, 'SEO setting retrieved', $seo);
            } else {
                $pageKey = trim($_GET['page'] ?? '');
                if ($pageKey !== '') {
                    $stmt = $pdo->prepare("SELECT * FROM seo_settings WHERE page = ? LIMIT 1");
                    $stmt->execute([$pageKey]);
                    $seo = $stmt->fetch();
                    if (!$seo) {
                        api_response(404, false, "SEO setting for page '{$pageKey}' not found", null, 'NOT_FOUND');
                    }
                    api_response(200, true, 'SEO setting retrieved', $seo);
                } else {
                    $stmt = $pdo->query("SELECT * FROM seo_settings ORDER BY page ASC");
                    api_response(200, true, 'SEO settings retrieved', $stmt->fetchAll());
                }
            }
        }

        if ($requestMethod === 'POST') {
            require_admin();
            $input = get_request_data();
            $page = trim($input['page'] ?? '');
            $metaTitle = trim($input['meta_title'] ?? '');
            $metaDesc = trim($input['meta_description'] ?? '');
            $ogImage = trim($input['og_image'] ?? '');

            if ($page === '') {
                api_response(422, false, 'Page identifier is required', null, 'VALIDATION_ERROR');
            }

            $chk = $pdo->prepare("SELECT id FROM seo_settings WHERE page = ?");
            $chk->execute([$page]);
            if ($chk->fetch()) {
                api_response(409, false, "SEO setting for page '{$page}' already exists", null, 'PAGE_CONFLICT');
            }

            $stmt = $pdo->prepare("INSERT INTO seo_settings (page, meta_title, meta_description, og_image) VALUES (?, ?, ?, ?)");
            $stmt->execute([$page, $metaTitle, $metaDesc, $ogImage]);
            $newId = (int)$pdo->lastInsertId();

            $newSeo = $pdo->query("SELECT * FROM seo_settings WHERE id = {$newId}")->fetch();
            api_response(201, true, 'SEO setting created successfully', $newSeo);
        }

        if ($requestMethod === 'PUT') {
            require_admin();
            if ($id === null) {
                api_response(400, false, 'SEO setting ID is required for update', null, 'MISSING_ID');
            }

            $stmt = $pdo->prepare("SELECT * FROM seo_settings WHERE id = ?");
            $stmt->execute([$id]);
            $existing = $stmt->fetch();
            if (!$existing) {
                api_response(404, false, "SEO setting with ID {$id} not found", null, 'NOT_FOUND');
            }

            $input = get_request_data();
            $page = isset($input['page']) ? trim($input['page']) : $existing['page'];
            $metaTitle = isset($input['meta_title']) ? trim($input['meta_title']) : $existing['meta_title'];
            $metaDesc = isset($input['meta_description']) ? trim($input['meta_description']) : $existing['meta_description'];
            $ogImage = isset($input['og_image']) ? trim($input['og_image']) : $existing['og_image'];

            if ($page === '') {
                api_response(422, false, 'Page identifier cannot be empty', null, 'VALIDATION_ERROR');
            }

            $chk = $pdo->prepare("SELECT id FROM seo_settings WHERE page = ? AND id != ?");
            $chk->execute([$page, $id]);
            if ($chk->fetch()) {
                api_response(409, false, "SEO setting for page '{$page}' is used by another record", null, 'PAGE_CONFLICT');
            }

            $upd = $pdo->prepare("UPDATE seo_settings SET page = ?, meta_title = ?, meta_description = ?, og_image = ? WHERE id = ?");
            $upd->execute([$page, $metaTitle, $metaDesc, $ogImage, $id]);

            $updated = $pdo->query("SELECT * FROM seo_settings WHERE id = {$id}")->fetch();
            api_response(200, true, 'SEO setting updated successfully', $updated);
        }

        if ($requestMethod === 'DELETE') {
            require_admin();
            if ($id === null) {
                api_response(400, false, 'SEO setting ID is required for deletion', null, 'MISSING_ID');
            }
            $stmt = $pdo->prepare("SELECT id FROM seo_settings WHERE id = ?");
            $stmt->execute([$id]);
            if (!$stmt->fetch()) {
                api_response(404, false, "SEO setting with ID {$id} not found", null, 'NOT_FOUND');
            }

            $del = $pdo->prepare("DELETE FROM seo_settings WHERE id = ?");
            $del->execute([$id]);
            api_response(200, true, "SEO setting ID {$id} deleted successfully", ['id' => $id]);
        }

        api_response(405, false, 'Method not allowed for SEO settings', null, 'METHOD_NOT_ALLOWED');
    }

    // ------------------------------------------------------------------------
    // M. WEBSITE SETTINGS (/api/settings - Singleton ID = 1)
    // ------------------------------------------------------------------------
    if ($resource === 'settings') {
        if ($requestMethod === 'GET') {
            $stmt = $pdo->query("SELECT * FROM site_settings WHERE id = 1 LIMIT 1");
            $settings = $stmt->fetch();
            if (!$settings) {
                // Return default fallback if row missing
                $settings = [
                    'id' => 1,
                    'site_name' => 'Chedo Tech',
                    'phone' => '+91 87931 00815',
                    'whatsapp' => '918793100815',
                    'email' => 'chetan2469@gmail.com'
                ];
            }
            api_response(200, true, 'Site settings retrieved', $settings);
        }

        if ($requestMethod === 'PUT') {
            require_admin();
            $stmt = $pdo->query("SELECT * FROM site_settings WHERE id = 1 LIMIT 1");
            $existing = $stmt->fetch();

            $input = get_request_data();
            $siteName = isset($input['site_name']) ? trim($input['site_name']) : ($existing['site_name'] ?? '');
            $logo = isset($input['logo']) ? trim($input['logo']) : ($existing['logo'] ?? '');
            $phone = isset($input['phone']) ? trim($input['phone']) : ($existing['phone'] ?? '');
            $whatsapp = isset($input['whatsapp']) ? trim($input['whatsapp']) : ($existing['whatsapp'] ?? '');
            $email = isset($input['email']) ? trim($input['email']) : ($existing['email'] ?? '');
            $address = isset($input['address']) ? trim($input['address']) : ($existing['address'] ?? '');
            $openingHours = isset($input['opening_hours']) ? trim($input['opening_hours']) : ($existing['opening_hours'] ?? '');
            $facebook = isset($input['facebook']) ? trim($input['facebook']) : ($existing['facebook'] ?? '');
            $instagram = isset($input['instagram']) ? trim($input['instagram']) : ($existing['instagram'] ?? '');
            $youtube = isset($input['youtube']) ? trim($input['youtube']) : ($existing['youtube'] ?? '');
            $linkedin = isset($input['linkedin']) ? trim($input['linkedin']) : ($existing['linkedin'] ?? '');
            $heroText = isset($input['hero_text']) ? trim($input['hero_text']) : ($existing['hero_text'] ?? '');

            if ($existing) {
                $upd = $pdo->prepare("UPDATE site_settings SET site_name = ?, logo = ?, phone = ?, whatsapp = ?, email = ?, address = ?, opening_hours = ?, facebook = ?, instagram = ?, youtube = ?, linkedin = ?, hero_text = ? WHERE id = 1");
                $upd->execute([$siteName, $logo, $phone, $whatsapp, $email, $address, $openingHours, $facebook, $instagram, $youtube, $linkedin, $heroText]);
            } else {
                $ins = $pdo->prepare("INSERT INTO site_settings (id, site_name, logo, phone, whatsapp, email, address, opening_hours, facebook, instagram, youtube, linkedin, hero_text) VALUES (1, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $ins->execute([$siteName, $logo, $phone, $whatsapp, $email, $address, $openingHours, $facebook, $instagram, $youtube, $linkedin, $heroText]);
            }

            $updated = $pdo->query("SELECT * FROM site_settings WHERE id = 1")->fetch();
            api_response(200, true, 'Site settings updated successfully', $updated);
        }

        if (in_array($requestMethod, ['POST', 'DELETE'])) {
            api_response(405, false, 'site_settings is a singleton resource (ID=1). Use GET to read and PUT to update.', null, 'METHOD_NOT_ALLOWED');
        }

        api_response(405, false, 'Method not allowed for settings', null, 'METHOD_NOT_ALLOWED');
    }

    // ------------------------------------------------------------------------
    // N. PAGE CONTENT (/api/content) - every editable text / link on the public pages
    //    GET  /api/content/pages            list of pages + sections (with counts)
    //    GET  /api/content?page=home        all blocks of a page (optional &section= and &q=)
    //    PUT  /api/content                  bulk save  {"items":[{"content_key":"home.x.01","value":"..."}]}
    //    PUT  /api/content/{id}             save one block {"value":"..."}
    //    POST /api/content/{id}/reset       put back the original text
    // ------------------------------------------------------------------------
    if ($resource === 'content') {
        require_admin();

        if ($requestMethod === 'GET' && $action === 'pages') {
            $courseTitles = [];
            foreach ($pdo->query("SELECT slug, title FROM courses") as $row) {
                $courseTitles[$row['slug']] = $row['title'];
            }
            $fixed = [
                'global' => 'Header & Footer (shown on every page)',
                'home' => 'Home page',
                'about' => 'About page',
                'contact' => 'Contact page',
                'courses' => 'Courses page',
                'services' => 'Services page',
                'privacy' => 'Privacy Policy',
                'notfound' => '404 page',
            ];
            $pages = [];
            $sql = "SELECT page, section, MAX(section_label) AS section_label, COUNT(*) AS cnt, MIN(sort_order) AS first_order
                    FROM site_content GROUP BY page, section ORDER BY page, first_order";
            foreach ($pdo->query($sql) as $row) {
                $p = $row['page'];
                if (!isset($pages[$p])) {
                    if (isset($fixed[$p])) {
                        $label = $fixed[$p];
                    } elseif (strpos($p, 'course-') === 0) {
                        $slug = substr($p, 7);
                        $label = 'Course page: ' . ($courseTitles[$slug] ?? ucwords(str_replace('-', ' ', $slug)));
                    } else {
                        $label = ucwords(str_replace('-', ' ', $p));
                    }
                    $pages[$p] = ['page' => $p, 'label' => $label, 'count' => 0, 'sections' => []];
                }
                $pages[$p]['count'] += (int)$row['cnt'];
                $pages[$p]['sections'][] = [
                    'section' => $row['section'],
                    'label' => $row['section_label'],
                    'count' => (int)$row['cnt'],
                ];
            }
            // Fixed pages first (in the order above), then the course pages A-Z
            $ordered = [];
            foreach (array_keys($fixed) as $p) {
                if (isset($pages[$p])) {
                    $ordered[] = $pages[$p];
                    unset($pages[$p]);
                }
            }
            usort($pages, fn($a, $b) => strcmp($a['label'], $b['label']));
            api_response(200, true, 'Content pages retrieved', array_merge($ordered, $pages));
        }

        if ($requestMethod === 'GET') {
            $page = trim($_GET['page'] ?? '');
            if ($page === '') {
                api_response(422, false, 'The page parameter is required (e.g. ?page=home)', null, 'VALIDATION_ERROR');
            }
            $sql = "SELECT id, content_key, page, section, section_label, field_type, default_value, value, sort_order, updated_at
                    FROM site_content WHERE page = ?";
            $params = [$page];
            if (!empty($_GET['section'])) {
                $sql .= " AND section = ?";
                $params[] = $_GET['section'];
            }
            if (!empty($_GET['q'])) {
                $sql .= " AND (value LIKE ? OR content_key LIKE ?)";
                $params[] = '%' . $_GET['q'] . '%';
                $params[] = '%' . $_GET['q'] . '%';
            }
            $sql .= " ORDER BY sort_order ASC, id ASC";
            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);
            api_response(200, true, 'Content retrieved', $stmt->fetchAll());
        }

        if ($requestMethod === 'POST' && $id !== null && $subResource === 'reset') {
            $stmt = $pdo->prepare("UPDATE site_content SET value = default_value WHERE id = ?");
            $stmt->execute([$id]);
            $row = $pdo->prepare("SELECT id, content_key, default_value, value FROM site_content WHERE id = ?");
            $row->execute([$id]);
            $data = $row->fetch();
            if (!$data) {
                api_response(404, false, "Content block {$id} not found", null, 'NOT_FOUND');
            }
            api_response(200, true, 'Text restored to the original', $data);
        }

        if ($requestMethod === 'PUT') {
            $input = get_request_data();
            $items = [];
            if ($id !== null) {
                if (!array_key_exists('value', $input)) {
                    api_response(422, false, 'value is required', null, 'VALIDATION_ERROR');
                }
                $items[] = ['id' => $id, 'value' => (string)$input['value']];
            } else {
                foreach (($input['items'] ?? []) as $it) {
                    if (isset($it['content_key']) || isset($it['id'])) {
                        $items[] = $it;
                    }
                }
                if (!$items) {
                    api_response(422, false, 'items is required', null, 'VALIDATION_ERROR');
                }
            }
            $byId = $pdo->prepare("UPDATE site_content SET value = ? WHERE id = ?");
            $byKey = $pdo->prepare("UPDATE site_content SET value = ? WHERE content_key = ?");
            $saved = 0;
            $pdo->beginTransaction();
            foreach ($items as $it) {
                $value = (string)($it['value'] ?? '');
                if (isset($it['id'])) {
                    $byId->execute([$value, (int)$it['id']]);
                    $saved += $byId->rowCount();
                } else {
                    $byKey->execute([$value, (string)$it['content_key']]);
                    $saved += $byKey->rowCount();
                }
            }
            $pdo->commit();
            api_response(200, true, 'Content saved - the website now shows the new text', ['saved' => $saved]);
        }

        api_response(405, false, 'Method not allowed for content', null, 'METHOD_NOT_ALLOWED');
    }

    // ------------------------------------------------------------------------
    // O. PAGE ITEMS (/api/page-items) - repeating blocks on the public pages
    //    (home page course cards, learning journey steps, project tiles)
    //    GET /api/page-items?page=home&section=skills | POST | PUT /{id} | DELETE /{id}
    //    POST /api/page-items/reorder  {"ids":[3,1,2]}
    // ------------------------------------------------------------------------
    if ($resource === 'page-items') {
        require_admin();
        $fields = ['title', 'subtitle', 'description', 'tag', 'icon', 'link_label', 'link_url'];

        if ($requestMethod === 'GET') {
            if ($id !== null) {
                $stmt = $pdo->prepare("SELECT * FROM page_items WHERE id = ?");
                $stmt->execute([$id]);
                $row = $stmt->fetch();
                if (!$row) {
                    api_response(404, false, "Page item {$id} not found", null, 'NOT_FOUND');
                }
                api_response(200, true, 'Page item retrieved', $row);
            }
            $sql = "SELECT * FROM page_items WHERE 1=1";
            $params = [];
            foreach (['page', 'section'] as $f) {
                if (!empty($_GET[$f])) {
                    $sql .= " AND {$f} = ?";
                    $params[] = $_GET[$f];
                }
            }
            $sql .= " ORDER BY page, section, sort_order ASC, id ASC";
            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);
            api_response(200, true, 'Page items retrieved', $stmt->fetchAll());
        }

        if ($requestMethod === 'POST' && $action === 'reorder') {
            $input = get_request_data();
            $ids = array_values(array_filter(array_map('intval', $input['ids'] ?? [])));
            if (!$ids) {
                api_response(422, false, 'ids is required', null, 'VALIDATION_ERROR');
            }
            $upd = $pdo->prepare("UPDATE page_items SET sort_order = ? WHERE id = ?");
            $pdo->beginTransaction();
            foreach ($ids as $pos => $itemId) {
                $upd->execute([$pos + 1, $itemId]);
            }
            $pdo->commit();
            api_response(200, true, 'Order saved', ['ids' => $ids]);
        }

        if ($requestMethod === 'POST') {
            $input = get_request_data();
            $page = trim($input['page'] ?? '');
            $section = trim($input['section'] ?? '');
            if ($page === '' || $section === '') {
                api_response(422, false, 'page and section are required', null, 'VALIDATION_ERROR');
            }
            if (trim($input['title'] ?? '') === '') {
                api_response(422, false, 'Title is required', null, 'VALIDATION_ERROR');
            }
            $max = $pdo->prepare("SELECT COALESCE(MAX(sort_order), 0) FROM page_items WHERE page = ? AND section = ?");
            $max->execute([$page, $section]);
            $sortOrder = isset($input['sort_order']) && $input['sort_order'] !== '' ? (int)$input['sort_order'] : ((int)$max->fetchColumn() + 1);
            $status = isset($input['status']) ? (int)$input['status'] : 1;
            $vals = [];
            foreach ($fields as $f) {
                $vals[] = trim((string)($input[$f] ?? ''));
            }
            $stmt = $pdo->prepare("INSERT INTO page_items (page, section, " . implode(', ', $fields) . ", sort_order, status) VALUES (?, ?, " . implode(', ', array_fill(0, count($fields), '?')) . ", ?, ?)");
            $stmt->execute(array_merge([$page, $section], $vals, [$sortOrder, $status]));
            $newId = (int)$pdo->lastInsertId();
            $row = $pdo->query("SELECT * FROM page_items WHERE id = {$newId}")->fetch();
            api_response(201, true, 'Item added - it is now live on the website', $row);
        }

        if ($requestMethod === 'PUT') {
            if ($id === null) {
                api_response(400, false, 'Item ID is required for update', null, 'MISSING_ID');
            }
            $stmt = $pdo->prepare("SELECT * FROM page_items WHERE id = ?");
            $stmt->execute([$id]);
            $existing = $stmt->fetch();
            if (!$existing) {
                api_response(404, false, "Page item {$id} not found", null, 'NOT_FOUND');
            }
            $input = get_request_data();
            $vals = [];
            foreach ($fields as $f) {
                $vals[$f] = isset($input[$f]) ? trim((string)$input[$f]) : $existing[$f];
            }
            if (trim((string)$vals['title']) === '') {
                api_response(422, false, 'Title cannot be empty', null, 'VALIDATION_ERROR');
            }
            $sortOrder = isset($input['sort_order']) && $input['sort_order'] !== '' ? (int)$input['sort_order'] : (int)$existing['sort_order'];
            $status = isset($input['status']) ? (int)$input['status'] : (int)$existing['status'];
            $set = implode(', ', array_map(fn($f) => "{$f} = ?", $fields));
            $upd = $pdo->prepare("UPDATE page_items SET {$set}, sort_order = ?, status = ? WHERE id = ?");
            $upd->execute(array_merge(array_values($vals), [$sortOrder, $status, $id]));
            $row = $pdo->query("SELECT * FROM page_items WHERE id = {$id}")->fetch();
            api_response(200, true, 'Item updated - the website shows the change', $row);
        }

        if ($requestMethod === 'DELETE') {
            if ($id === null) {
                api_response(400, false, 'Item ID is required for deletion', null, 'MISSING_ID');
            }
            $del = $pdo->prepare("DELETE FROM page_items WHERE id = ?");
            $del->execute([$id]);
            if (!$del->rowCount()) {
                api_response(404, false, "Page item {$id} not found", null, 'NOT_FOUND');
            }
            api_response(200, true, "Item {$id} removed from the website", ['id' => $id]);
        }

        api_response(405, false, 'Method not allowed for page items', null, 'METHOD_NOT_ALLOWED');
    }

    // ------------------------------------------------------------------------
    // P. ICON LIBRARY (/api/icons) - names usable in page item icon fields
    // ------------------------------------------------------------------------
    if ($resource === 'icons' && $requestMethod === 'GET') {
        require_admin();
        $names = [];
        foreach (glob(__DIR__ . '/../assets/icons/*.svg') as $f) {
            $names[] = basename($f, '.svg');
        }
        sort($names);
        api_response(200, true, 'Icons retrieved', $names);
    }

    // ------------------------------------------------------------------------
    // UNKNOWN ROUTE
    // ------------------------------------------------------------------------
    api_response(404, false, "Unknown endpoint '/api/{$route}'", null, 'ENDPOINT_NOT_FOUND');
} catch (PDOException $e) {
    error_log("API PDO Error: " . $e->getMessage());
    api_response(500, false, 'Database operation error occurred', null, 'DATABASE_ERROR');
} catch (Throwable $e) {
    error_log("API Exception: " . $e->getMessage());
    api_response(500, false, 'Internal server error occurred', null, 'INTERNAL_ERROR');
}
