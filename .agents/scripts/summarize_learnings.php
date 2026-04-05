#!/usr/bin/env php
<?php

declare(strict_types=1);

$root = dirname(__DIR__, 2);
$pattern = $root . '/.agents/learnings/*.json';
$files = glob($pattern) ?: [];
$learnings = [];

foreach ($files as $file) {
    $decoded = json_decode((string) file_get_contents($file), true);
    if (is_array($decoded) && isset($decoded['id'])) {
        $learnings[] = $decoded;
    }
}

usort($learnings, static function (array $left, array $right): int {
    return strcmp((string) $right['recorded_at'], (string) $left['recorded_at']);
});

$activeLearnings = array_values(array_filter($learnings, static fn (array $learning): bool => ($learning['status'] ?? 'captured') !== 'superseded'));
$byScope = [];
$byTarget = [];

foreach ($activeLearnings as $learning) {
    $scope = (string) ($learning['scope'] ?? 'unknown');
    $target = (string) ($learning['promotion_target'] ?? 'none');
    $byScope[$scope] = ($byScope[$scope] ?? 0) + 1;
    $byTarget[$target] = ($byTarget[$target] ?? 0) + 1;
}

arsort($byScope);
arsort($byTarget);

echo "# Agent Learnings Summary\n\n";
echo "- Total records: " . count($learnings) . "\n";
echo "- Active records: " . count($activeLearnings) . "\n";
echo "- Superseded records: " . (count($learnings) - count($activeLearnings)) . "\n\n";

echo "## By Scope\n\n";
if ($byScope === []) {
    echo "_No learnings recorded._\n\n";
} else {
    foreach ($byScope as $scope => $count) {
        echo "- `{$scope}`: {$count}\n";
    }
    echo "\n";
}

echo "## By Promotion Target\n\n";
if ($byTarget === []) {
    echo "_No learnings recorded._\n\n";
} else {
    foreach ($byTarget as $target => $count) {
        echo "- `{$target}`: {$count}\n";
    }
    echo "\n";
}

echo "## Recent Learnings\n\n";
if ($activeLearnings === []) {
    echo "_No active learnings recorded._\n";
    exit(0);
}

foreach (array_slice($activeLearnings, 0, 10) as $learning) {
    $title = (string) ($learning['title'] ?? '(untitled)');
    $scope = (string) ($learning['scope'] ?? 'unknown');
    $confidence = (string) ($learning['confidence'] ?? 'unknown');
    $recordedAt = (string) ($learning['recorded_at'] ?? '');
    $impact = (string) ($learning['impact'] ?? '');

    echo "### {$title}\n\n";
    echo "- Scope: `{$scope}`\n";
    echo "- Confidence: `{$confidence}`\n";
    echo "- Recorded At: `{$recordedAt}`\n";
    echo "- Impact: {$impact}\n";

    $rule = trim((string) ($learning['candidate_rule'] ?? ''));
    if ($rule !== '') {
        echo "- Candidate Rule: {$rule}\n";
    }

    echo "\n";
}
