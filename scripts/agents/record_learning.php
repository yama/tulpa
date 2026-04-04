#!/usr/bin/env php
<?php

declare(strict_types=1);

const VALID_SOURCES = ['chat', 'implementation', 'review', 'retrospective', 'other'];
const VALID_CONFIDENCE = ['low', 'medium', 'high'];
const VALID_TARGETS = ['AGENTS.md', 'skill', 'reference', 'none'];
const VALID_STATUS = ['captured', 'promoted', 'superseded'];

$options = getopt('', [
    'source:',
    'scope:',
    'title:',
    'observation:',
    'impact:',
    'candidate-rule::',
    'confidence:',
    'promotion-target::',
    'evidence::',
    'related-file::',
    'status::',
    'stdout::',
    'help::',
]);

if (array_key_exists('help', $options)) {
    fwrite(STDOUT, <<<TEXT
Usage:
  php scripts/agents/record_learning.php --source=implementation --scope=agent-workflow --title='...' --observation='...' --impact='...'

Options:
  --source            chat|implementation|review|retrospective|other
  --scope             Topic key such as agent-workflow or validation
  --title             Short summary
  --observation       What was learned
  --impact            Why it matters
  --candidate-rule    Optional promotable rule
  --confidence        low|medium|high
  --promotion-target  AGENTS.md|skill|reference|none (default: none)
  --evidence          Optional comma-separated evidence items
  --related-file      Optional repeatable related file path
  --status            captured|promoted|superseded (default: captured)
  --stdout            Print JSON to stdout instead of writing a file

TEXT);
    exit(0);
}

$required = ['source', 'scope', 'title', 'observation', 'impact', 'confidence'];

foreach ($required as $requiredKey) {
    if (! isset($options[$requiredKey]) || trim((string) $options[$requiredKey]) === '') {
        fwrite(STDERR, "Missing required option: --{$requiredKey}\n");
        exit(1);
    }
}

$source = (string) $options['source'];
$confidence = (string) $options['confidence'];
$promotionTarget = isset($options['promotion-target']) ? (string) $options['promotion-target'] : 'none';
$status = isset($options['status']) ? (string) $options['status'] : 'captured';

if (! in_array($source, VALID_SOURCES, true)) {
    fwrite(STDERR, "Invalid --source value.\n");
    exit(1);
}

if (! in_array($confidence, VALID_CONFIDENCE, true)) {
    fwrite(STDERR, "Invalid --confidence value.\n");
    exit(1);
}

if (! in_array($promotionTarget, VALID_TARGETS, true)) {
    fwrite(STDERR, "Invalid --promotion-target value.\n");
    exit(1);
}

if (! in_array($status, VALID_STATUS, true)) {
    fwrite(STDERR, "Invalid --status value.\n");
    exit(1);
}

$recordedAt = new DateTimeImmutable('now');
$idBase = strtolower((string) $options['title']);
$slug = preg_replace('/[^a-z0-9]+/', '-', $idBase);
$slug = trim((string) $slug, '-');
$slug = $slug !== '' ? $slug : 'learning';
$id = $recordedAt->format('Ymd\THisO') . '-' . $slug;

$evidence = [];
if (isset($options['evidence']) && trim((string) $options['evidence']) !== '') {
    $evidence = array_values(array_filter(array_map(
        static fn (string $item): string => trim($item),
        explode(',', (string) $options['evidence'])
    ), static fn (string $item): bool => $item !== ''));
}

$relatedFilesOption = $options['related-file'] ?? [];
$relatedFiles = is_array($relatedFilesOption) ? $relatedFilesOption : [$relatedFilesOption];
$relatedFiles = array_values(array_filter(array_map(
    static fn (string $item): string => trim($item),
    $relatedFiles
), static fn (string $item): bool => $item !== ''));

$payload = [
    'id' => $id,
    'recorded_at' => $recordedAt->format(DateTimeInterface::ATOM),
    'source' => $source,
    'scope' => trim((string) $options['scope']),
    'title' => trim((string) $options['title']),
    'observation' => trim((string) $options['observation']),
    'impact' => trim((string) $options['impact']),
    'candidate_rule' => isset($options['candidate-rule']) ? trim((string) $options['candidate-rule']) : '',
    'confidence' => $confidence,
    'promotion_target' => $promotionTarget,
    'status' => $status,
    'evidence' => $evidence,
    'related_files' => $relatedFiles,
];

$root = dirname(__DIR__, 2);
$directory = $root . '/.agents/learnings';

if (! is_dir($directory) && ! mkdir($directory, 0777, true) && ! is_dir($directory)) {
    fwrite(STDERR, "Failed to create directory: {$directory}\n");
    exit(1);
}

$path = sprintf('%s/%s.json', $directory, $id);
$json = json_encode($payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

if ($json === false) {
    fwrite(STDERR, "Failed to encode learning as JSON.\n");
    exit(1);
}

if (array_key_exists('stdout', $options)) {
    fwrite(STDOUT, $json . PHP_EOL);
    exit(0);
}

$bytes = @file_put_contents($path, $json . PHP_EOL);

if ($bytes === false) {
    fwrite(STDERR, "Failed to write learning file: {$path}\n");
    exit(1);
}

fwrite(STDOUT, $path . PHP_EOL);
