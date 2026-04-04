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

$activeLearnings = array_values(array_filter(
    $learnings,
    static fn (array $learning): bool => ($learning['status'] ?? 'captured') !== 'superseded'
));

$groups = [];

foreach ($activeLearnings as $learning) {
    $rule = trim((string) ($learning['candidate_rule'] ?? ''));
    if ($rule === '') {
        continue;
    }

    $target = (string) ($learning['promotion_target'] ?? 'none');
    $scope = (string) ($learning['scope'] ?? 'unknown');
    $key = $target . '|' . $scope . '|' . $rule;

    if (! isset($groups[$key])) {
        $groups[$key] = [
            'target' => $target,
            'scope' => $scope,
            'rule' => $rule,
            'count' => 0,
            'high_confidence_count' => 0,
            'titles' => [],
            'impacts' => [],
        ];
    }

    $groups[$key]['count']++;
    if (($learning['confidence'] ?? '') === 'high') {
        $groups[$key]['high_confidence_count']++;
    }

    $groups[$key]['titles'][] = (string) ($learning['title'] ?? '(untitled)');
    $groups[$key]['impacts'][] = (string) ($learning['impact'] ?? '');
}

usort($groups, static function (array $left, array $right): int {
    return [$right['count'], $right['high_confidence_count'], $left['rule']]
        <=> [$left['count'], $left['high_confidence_count'], $right['rule']];
});

$promote = [];
$review = [];

foreach ($groups as $group) {
    if ($group['target'] === 'none') {
        $review[] = $group;
        continue;
    }

    if ($group['count'] >= 2 || $group['high_confidence_count'] >= 1) {
        $promote[] = $group;
        continue;
    }

    $review[] = $group;
}

echo "# Proposed Agent Updates\n\n";
echo "このレポートは `.agents/learnings/*.json` から昇格候補を抽出したものです。自動反映ではなく、更新レビューの材料として使います。\n\n";

echo "## Promote\n\n";
if ($promote === []) {
    echo "_No promotion candidates yet._\n\n";
} else {
    foreach ($promote as $group) {
        echo "### {$group['rule']}\n\n";
        echo "- Target: `{$group['target']}`\n";
        echo "- Scope: `{$group['scope']}`\n";
        echo "- Supporting Learnings: {$group['count']}\n";
        echo "- High Confidence Learnings: {$group['high_confidence_count']}\n";
        echo "- Example Titles: " . implode(' / ', array_slice($group['titles'], 0, 3)) . "\n";

        $impact = trim((string) ($group['impacts'][0] ?? ''));
        if ($impact !== '') {
            echo "- Why It Matters: {$impact}\n";
        }

        echo "\n";
    }
}

echo "## Review Before Promotion\n\n";
if ($review === []) {
    echo "_No review candidates._\n";
    exit(0);
}

foreach ($review as $group) {
    echo "### {$group['rule']}\n\n";
    echo "- Target: `{$group['target']}`\n";
    echo "- Scope: `{$group['scope']}`\n";
    echo "- Supporting Learnings: {$group['count']}\n";
    echo "- High Confidence Learnings: {$group['high_confidence_count']}\n";
    echo "- Suggested Action: keep this in `.agents/learnings/` or merge into a reference note until the pattern stabilizes.\n\n";
}
