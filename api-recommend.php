<?php
// api-recommend.php — Public Course & Career Roadmap Recommendation Bridge Endpoint
// Provides direct access for recommendations and stores enquiries into MySQL table 'enquiries'.

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    echo json_encode(['success' => true]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed. Use POST.']);
    exit;
}

require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/recommendation-engine.php';

global $pdo;
if (!$pdo) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Database connection unavailable']);
    exit;
}

// Parse request data (JSON or Form POST)
$rawInput = file_get_contents('php://input');
$input = [];
if (!empty($rawInput)) {
    $decoded = json_decode($rawInput, true);
    if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
        $input = $decoded;
    }
}
if (empty($input) && !empty($_POST)) {
    $input = $_POST;
}

$name = trim($input['name'] ?? '');
$phone = trim($input['phone'] ?? '');
$email = trim($input['email'] ?? '');
$education = trim($input['education'] ?? '');
$age = !empty($input['age']) ? (int)$input['age'] : null;
$learningLevel = trim($input['learning_level'] ?? $input['experience'] ?? 'Complete Beginner');
$careerGoal = trim($input['career_goal'] ?? $input['goal'] ?? 'Software Developer');
$learningObjective = trim($input['learning_objective'] ?? $input['interest'] ?? 'Job and interview preparation');
$dailyAvailability = trim($input['daily_availability'] ?? '2–4 hours');
$message = trim($input['message'] ?? '');
$sourcePage = trim($input['source_page'] ?? 'Recommendation Assessment');

if ($name === '') {
    http_response_code(422);
    echo json_encode(['success' => false, 'message' => 'Name is required']);
    exit;
}
if ($phone === '' && $email === '') {
    http_response_code(422);
    echo json_encode(['success' => false, 'message' => 'Phone or Email is required']);
    exit;
}

// Normalize known technologies
$knownRaw = $input['known_technologies'] ?? [];
if (empty($knownRaw) && !empty($input['language']) && $input['language'] !== 'Not Sure') {
    $knownRaw = [$input['language']];
}
if (is_string($knownRaw)) {
    $decoded = json_decode($knownRaw, true);
    $knownTechs = is_array($decoded) ? $decoded : array_map('trim', explode(',', $knownRaw));
} else {
    $knownTechs = (array)$knownRaw;
}
$knownTechs = array_values(array_filter(array_map('trim', $knownTechs), function($t) {
    return $t !== '' && strtolower($t) !== 'none';
}));

// Idempotency check: prevent duplicate submissions within the hour
$idempotencyKey = trim($input['idempotency_key'] ?? '');
if ($idempotencyKey === '') {
    $idempotencyKey = hash('sha256', strtolower($name) . '|' . preg_replace('/\D+/', '', $phone) . '|' . $careerGoal . '|' . date('YmdH'));
}

$dupStmt = $pdo->prepare("SELECT id, recommended_career_path, recommended_course_ids, recommendation_scores, skill_gap_analysis, personalized_roadmap, daily_study_plan, project_recommendations, estimated_duration FROM enquiries WHERE idempotency_key = ? LIMIT 1");
$dupStmt->execute([$idempotencyKey]);
$existingDup = $dupStmt->fetch(PDO::FETCH_ASSOC);

if ($existingDup) {
    $dupScores = json_decode($existingDup['recommendation_scores'] ?? '[]', true);
    $dupCourseIds = json_decode($existingDup['recommended_course_ids'] ?? '[]', true);
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

    echo json_encode([
        'success' => true,
        'message' => 'Existing recommendation retrieved (idempotent)',
        'enquiry_id' => (int)$existingDup['id'],
        'career_profile' => [
            'recommended_career' => $existingDup['recommended_career_path'],
            'learning_level' => $learningLevel,
            'known_technologies' => $knownTechs,
            'learning_objective' => $learningObjective,
            'daily_availability' => $dailyAvailability,
            'estimated_duration' => $existingDup['estimated_duration']
        ],
        'skill_gap_analysis' => json_decode($existingDup['skill_gap_analysis'] ?? '[]', true),
        'recommendations' => $formattedCards,
        'roadmap' => json_decode($existingDup['personalized_roadmap'] ?? '[]', true),
        'daily_study_plan' => json_decode($existingDup['daily_study_plan'] ?? '[]', true),
        'project_recommendations' => json_decode($existingDup['project_recommendations'] ?? '[]', true)
    ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    exit;
}

// Generate new recommendation
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
        ?, ?, ?, 'New'
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
        mb_substr($sourcePage, 0, 255)
    ]);

    $newId = (int)$pdo->lastInsertId();
    $pdo->commit();

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

    echo json_encode([
        'success' => true,
        'message' => 'Recommendation generated and enquiry stored successfully',
        'enquiry_id' => $newId,
        'career_profile' => $recResult['career_profile'],
        'skill_gap_analysis' => $recResult['skill_gap_analysis'],
        'recommended_courses' => $recResult['recommended_courses'],
        'recommendations' => $recommendationCards,
        'roadmap' => $recResult['roadmap'],
        'daily_study_plan' => $recResult['daily_study_plan'],
        'project_recommendations' => $recResult['project_recommendations'],
        'job_readiness' => $recResult['job_readiness']
    ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
} catch (Throwable $e) {
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }
    http_response_code(500);
    error_log("api-recommend.php error: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Failed to save enquiry']);
}
