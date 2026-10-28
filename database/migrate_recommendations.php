<?php
// database/migrate_recommendations.php
// Safe, idempotent database migration for Chedo Tech Recommendation System

require_once __DIR__ . '/../includes/db.php';
global $pdo;

if (!$pdo) {
    die("Database connection failed.\n");
}

echo "Starting recommendation system migration on database: " . $pdo->query("SELECT DATABASE()")->fetchColumn() . "...\n";

// Function to check if a column exists in enquiries table
function column_exists(PDO $pdo, string $table, string $column): bool {
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = ? AND COLUMN_NAME = ?");
    $stmt->execute([$table, $column]);
    return (int)$stmt->fetchColumn() > 0;
}

// Function to check if an index exists in enquiries table
function index_exists(PDO $pdo, string $table, string $index): bool {
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM information_schema.STATISTICS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = ? AND INDEX_NAME = ?");
    $stmt->execute([$table, $index]);
    return (int)$stmt->fetchColumn() > 0;
}

$columnsToAdd = [
    'education'               => "VARCHAR(100) NULL AFTER email",
    'age'                     => "INT NULL AFTER education",
    'learning_level'          => "VARCHAR(100) NULL AFTER age",
    'career_goal'             => "VARCHAR(100) NULL AFTER learning_level",
    'known_technologies'      => "JSON NULL AFTER career_goal",
    'learning_objective'      => "VARCHAR(255) NULL AFTER known_technologies",
    'daily_availability'      => "VARCHAR(100) NULL AFTER learning_objective",
    'recommended_career_path' => "VARCHAR(100) NULL AFTER daily_availability",
    'recommended_course_ids'  => "JSON NULL AFTER recommended_career_path",
    'recommendation_scores'   => "JSON NULL AFTER recommended_course_ids",
    'skill_gap_analysis'      => "JSON NULL AFTER recommendation_scores",
    'personalized_roadmap'    => "JSON NULL AFTER skill_gap_analysis",
    'daily_study_plan'        => "JSON NULL AFTER personalized_roadmap",
    'project_recommendations' => "JSON NULL AFTER daily_study_plan",
    'estimated_duration'      => "VARCHAR(100) NULL AFTER project_recommendations",
    'idempotency_key'         => "VARCHAR(64) NULL AFTER estimated_duration",
];

foreach ($columnsToAdd as $col => $definition) {
    if (!column_exists($pdo, 'enquiries', $col)) {
        $sql = "ALTER TABLE `enquiries` ADD COLUMN `$col` $definition";
        $pdo->exec($sql);
        echo "  [+] Added column `$col` to `enquiries`\n";
    } else {
        echo "  [.] Column `$col` already exists in `enquiries`\n";
    }
}

$indicesToAdd = [
    'idx_enquiries_career_goal' => "career_goal",
    'idx_enquiries_created_at'  => "created_at",
    'idx_enquiries_idempotency' => "idempotency_key",
];

foreach ($indicesToAdd as $indexName => $colName) {
    if (!index_exists($pdo, 'enquiries', $indexName)) {
        $sql = "ALTER TABLE `enquiries` ADD INDEX `$indexName` (`$colName`)";
        $pdo->exec($sql);
        echo "  [+] Added index `$indexName` on `enquiries`(`$colName`)\n";
    } else {
        echo "  [.] Index `$indexName` already exists\n";
    }
}

echo "Migration completed successfully!\n";
