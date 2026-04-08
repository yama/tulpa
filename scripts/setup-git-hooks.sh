#!/bin/bash
set -euo pipefail

ROOT_DIR="$(cd "$(dirname "$0")/.." && pwd)"
cd "$ROOT_DIR"

git config core.hooksPath .githooks

chmod +x .githooks/post-commit scripts/after-commit-reminder.sh .claude/hooks/after-commit.sh

echo "Configured git hooks path: .githooks"
echo "Enabled executable bits for hook scripts."
