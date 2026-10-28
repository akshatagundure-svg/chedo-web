<?php
// Handles the course-page enquiry form, and the contact-page form when JavaScript is off.
// Saves the enquiry, then sends the visitor back to the page they came from with ?msg=success|error.

// Send the visitor back to the same page on this site (never to another site), with ?msg= added.
function enquiry_redirect($status) {
    $target = '/';
    $ref = parse_url($_SERVER['HTTP_REFERER'] ?? '');
    $host = strtolower($_SERVER['HTTP_HOST'] ?? '');
    $ref_host = strtolower(($ref['host'] ?? '') . (isset($ref['port']) ? ':' . $ref['port'] : ''));
    if (!empty($ref['path']) && ($ref_host === '' || $ref_host === $host)) {
        parse_str($ref['query'] ?? '', $query);
        $query['msg'] = $status;
        $target = $ref['path'] . '?' . http_build_query($query) . '#enquireForm';
    }
    header('Location: ' . $target, true, 303);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /');
    exit;
}

$name = trim($_POST['name'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$email = trim($_POST['email'] ?? '');
$course_id = !empty($_POST['course_id']) ? intval($_POST['course_id']) : null;
$message = trim($_POST['message'] ?? '');
$source = trim($_POST['source_page'] ?? 'Course Page');

$learning_level = trim($_POST['learning_level'] ?? $_POST['experience'] ?? '');
$career_goal = trim($_POST['career_goal'] ?? $_POST['goal'] ?? '');
$learning_objective = trim($_POST['learning_objective'] ?? $_POST['interest'] ?? '');
$daily_availability = trim($_POST['daily_availability'] ?? '');
$education = trim($_POST['education'] ?? '');
$age = !empty($_POST['age']) ? intval($_POST['age']) : null;
$known_raw = $_POST['known_technologies'] ?? [];
if (empty($known_raw) && !empty($_POST['language']) && $_POST['language'] !== 'Not Sure') {
    $known_raw = [$_POST['language']];
}
$known_technologies = is_array($known_raw) ? $known_raw : array_map('trim', explode(',', (string)$known_raw));
$known_technologies = array_values(array_filter($known_technologies));

// The contact page form also asks these questions; keep the answers with the message.
$extra_fields = [
    'education' => 'Education',
    'age' => 'Age',
    'learning_level' => 'Learning Level',
    'career_goal' => 'Career Goal',
    'learning_objective' => 'Objective',
    'daily_availability' => 'Availability'
];
$extras = [];
foreach ($extra_fields as $key => $label) {
    $value = trim($_POST[$key] ?? '');
    if ($value !== '') {
        $extras[] = $label . ': ' . $value;
    }
}
if (!empty($known_technologies)) {
    $extras[] = 'Known Technologies: ' . implode(', ', $known_technologies);
}
if ($extras) {
    $message = implode("\n", $extras) . ($message !== '' ? "\n\n" . $message : '');
    if (!isset($_POST['source_page'])) {
        $source = 'Contact Page Assessment';
    }
}

if ($name === '' || ($phone === '' && $email === '')) {
    enquiry_redirect('error');
}

// Keep values within the column sizes in database/schema.sql.
$name = mb_substr($name, 0, 100);
$phone = mb_substr($phone, 0, 50);
$email = mb_substr($email, 0, 255);
$source = mb_substr($source, 0, 255);
$message = mb_substr($message, 0, 5000);
$education = mb_substr($education, 0, 100);
$learning_level = mb_substr($learning_level, 0, 100);
$career_goal = mb_substr($career_goal, 0, 100);
$learning_objective = mb_substr($learning_objective, 0, 255);
$daily_availability = mb_substr($daily_availability, 0, 100);

$db_optional = true; // db.php leaves $pdo = null instead of stopping the page
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/recommendation-engine.php';

if (!$pdo) {
    enquiry_redirect('error');
}

try {
    if ($career_goal !== '' || $learning_level !== '') {
        $rec = ChedoRecommendationEngine::analyzeAndRecommend([
            'learning_level' => $learning_level ?: 'Complete Beginner',
            'career_goal' => $career_goal ?: 'Software Developer',
            'known_technologies' => $known_technologies,
            'learning_objective' => $learning_objective ?: 'Job and interview preparation',
            'daily_availability' => $daily_availability ?: '2–4 hours'
        ], $pdo);

        $course_id = (int)$rec['recommended_courses']['primary']['id'];
        $recCourseIds = json_encode(['primary' => $course_id, 'supporting' => (int)$rec['recommended_courses']['supporting']['id']], JSON_UNESCAPED_SLASHES);
        $recScores = json_encode($rec['scores'], JSON_UNESCAPED_SLASHES);
        $skillGapJson = json_encode($rec['skill_gap_analysis'], JSON_UNESCAPED_SLASHES);
        $roadmapJson = json_encode($rec['roadmap'], JSON_UNESCAPED_SLASHES);
        $studyPlanJson = json_encode($rec['daily_study_plan'], JSON_UNESCAPED_SLASHES);
        $projectsJson = json_encode($rec['project_recommendations'], JSON_UNESCAPED_SLASHES);
        $knownTechsJson = json_encode($known_technologies, JSON_UNESCAPED_SLASHES);
        $estDuration = $rec['career_profile']['estimated_duration'];
        $recommendedCareer = $rec['career_profile']['recommended_career'];

        $sql = "INSERT INTO enquiries (
            name, phone, email, education, age, learning_level, career_goal,
            known_technologies, learning_objective, daily_availability,
            recommended_career_path, recommended_course_ids, recommendation_scores,
            skill_gap_analysis, personalized_roadmap, daily_study_plan,
            project_recommendations, estimated_duration, course_id, message, source_page, status
        ) VALUES (
            ?, ?, ?, ?, ?, ?, ?,
            ?, ?, ?,
            ?, ?, ?,
            ?, ?, ?,
            ?, ?, ?, ?, ?, 'New'
        )";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $name, $phone, $email, $education, $age, $learning_level, $career_goal,
            $knownTechsJson, $learning_objective, $daily_availability,
            $recommendedCareer, $recCourseIds, $recScores,
            $skillGapJson, $roadmapJson, $studyPlanJson,
            $projectsJson, $estDuration, $course_id, $message, $source
        ]);
    } else {
        $stmt = $pdo->prepare("INSERT INTO enquiries (name, phone, email, course_id, message, source_page) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$name, $phone, $email, $course_id, $message, $source]);
    }

    enquiry_redirect('success');
} catch (Exception $e) {
    error_log('Enquiry insert failed: ' . $e->getMessage());
    enquiry_redirect('error');
}

