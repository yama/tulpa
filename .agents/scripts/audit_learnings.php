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
        $decoded['_file'] = basename($file);
        $learnings[] = $decoded;
    }
}

$active = array_values(array_filter(
    $learnings,
    static fn (array $learning): bool => ($learning['status'] ?? 'captured') !== 'superseded'
));

$superseded = array_values(array_filter(
    $learnings,
    static fn (array $learning): bool => ($learning['status'] ?? 'captured') === 'superseded'
));

$byRule = [];
$byTitle = [];
$reviewCandidates = [];

foreach ($active as $learning) {
    $rule = trim((string) ($learning['candidate_rule'] ?? ''));
    if ($rule !== '') {
        $key = normalizeKey($rule);
        $byRule[$key]['rule'] = $rule;
        $byRule[$key]['items'][] = $learning;
    }

    $title = trim((string) ($learning['title'] ?? ''));
    if ($title !== '') {
        $key = normalizeKey($title);
        $byTitle[$key]['title'] = $title;
        $byTitle[$key]['items'][] = $learning;
    }

    $target = (string) ($learning['promotion_target'] ?? 'none');
    $confidence = (string) ($learning['confidence'] ?? 'low');

    if ($rule !== '' && $target !== 'none' && $confidence !== 'high') {
        $reviewCandidates[] = $learning;
    }
}

$duplicateRules = array_values(array_filter($byRule, static fn (array $group): bool => count($group['items']) >= 2));
$duplicateTitles = array_values(array_filter($byTitle, static fn (array $group): bool => count($group['items']) >= 2));

echo "# Learning Audit\n\n";
echo "- Total learnings: " . count($learnings) . "\n";
echo "- Active learnings: " . count($active) . "\n";
echo "- Superseded learnings: " . count($superseded) . "\n\n";

echo "## Duplicate Candidate Rules\n\n";
if ($duplicateRules === []) {
    echo "_No duplicate candidate rules found._\n\n";
} else {
    foreach ($duplicateRules as $group) {
        echo "### {$group['rule']}\n\n";
        foreach ($group['items'] as $item) {
            echo "- `{$item['_file']}` / `{$item['scope']}` / `{$item['confidence']}`\n";
        }
        echo "\n";
    }
}

echo "## Duplicate Titles\n\n";
if ($duplicateTitles === []) {
    echo "_No duplicate titles found._\n\n";
} else {
    foreach ($duplicateTitles as $group) {
        echo "### {$group['title']}\n\n";
        foreach ($group['items'] as $item) {
            echo "- `{$item['_file']}` / `{$item['scope']}` / `{$item['status']}`\n";
        }
        echo "\n";
    }
}

echo "## Review Candidates\n\n";
if ($reviewCandidates === []) {
    echo "_No pending review candidates._\n\n";
} else {
    foreach ($reviewCandidates as $item) {
        echo "### {$item['title']}\n\n";
        echo "- File: `{$item['_file']}`\n";
        echo "- Scope: `{$item['scope']}`\n";
        echo "- Target: `{$item['promotion_target']}`\n";
        echo "- Confidence: `{$item['confidence']}`\n";
        echo "- Suggested Action: keep gathering evidence or merge into a knowledge note before promotion.\n\n";
    }
}

echo "## Superseded Records\n\n";
if ($superseded === []) {
    echo "_No superseded records._\n";
    exit(0);
}

foreach ($superseded as $item) {
    echo "- `{$item['_file']}` / {$item['title']}\n";
}

function normalizeKey(string $value): string
{
    return function_exists('mb_strtolower')
        ? mb_strtolower($value)
        : strtolower($value);
}
