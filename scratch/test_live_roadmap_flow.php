<?php
// 1. Verify contact.php HTML contains the new roadmap structure
$html = file_get_contents('http://localhost:8000/contact.php');
assert(strpos($html, 'roadmap-wrapper-card') !== false, 'roadmap-wrapper-card missing');
assert(strpos($html, 'roadmap-flow-container') !== false, 'roadmap-flow-container missing');
assert(strpos($html, 'highway-svg') !== false, 'highway-svg missing');
assert(strpos($html, 'road-path-surface') !== false, 'road-path-surface missing');
assert(strpos($html, 'road-path-dash') !== false, 'road-path-dash missing');
assert(strpos($html, 'roadmap-timeline') !== false, 'roadmap-timeline missing');
assert(strpos($html, 'roadmap-goal-wrap') !== false, 'roadmap-goal-wrap missing');
echo "HTML DOM verification: PASSED!\n";

// 2. Test Recommendation API submission for different career paths
$careers = [
    [
        'name' => 'Aditi Sharma',
        'email' => 'aditi.test@example.com',
        'phone' => '9876543210',
        'career_goal' => 'Java Full Stack Developer',
        'learning_level' => 'Beginner',
        'known_technologies' => ['Java', 'SQL'],
        'daily_availability' => '2–3 hours/day',
        'learning_objective' => 'Job / Career Transition'
    ],
    [
        'name' => 'Rahul Verma',
        'email' => 'rahul.test@example.com',
        'phone' => '9876543211',
        'career_goal' => 'Data Scientist',
        'learning_level' => 'Intermediate',
        'known_technologies' => ['Python', 'SQL'],
        'daily_availability' => '4+ hours/day',
        'learning_objective' => 'Job / Career Transition'
    ],
    [
        'name' => 'Sneha Patil',
        'email' => 'sneha.test@example.com',
        'phone' => '9876543212',
        'career_goal' => 'MERN Stack Developer',
        'learning_level' => 'Beginner',
        'known_technologies' => ['HTML/CSS', 'JavaScript'],
        'daily_availability' => '1–2 hours/day',
        'learning_objective' => 'College Student / Final Year Project'
    ]
];

foreach ($careers as $idx => $payload) {
    $ch = curl_init('http://localhost:8000/api/enquiries');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    $json = json_decode($response, true);
    assert($httpCode === 200 || $httpCode === 201, "HTTP status $httpCode");
    assert(!empty($json['success']), 'API returned error: ' . $response);

    $data = $json['data'] ?? [];
    $roadmap = $data['roadmap'] ?? [];
    echo "Career [{$payload['career_goal']}]: " . count($roadmap) . " stages generated\n";
    foreach ($roadmap as $st) {
        assert(!empty($st['stage_name']), 'stage_name missing');
        assert(!empty($st['duration']), 'duration missing');
        assert(!empty($st['description']), 'description missing');
        assert(isset($st['skills']) && is_array($st['skills']), 'skills array missing');
        assert(!empty($st['milestone']), 'milestone missing');
    }
}

echo "All Career Roadmaps dynamically verified with 100% integrity!\n";
