#!/bin/bash
# .claude/hooks/after-commit.sh
#
# PostToolUse フック: git commit 完了後に学びの記録を促すリマインダーを表示する。
# Claude Code が Bash ツールを実行した後、このスクリプトがツール入力を stdin で受け取る。
#
# 目的: 実行忘れを防ぐリマインダー。記録の要否はエージェント自身が判断する。

STDIN_DATA=$(cat)

# stdin の JSON から実行コマンドを抽出する
COMMAND=""
if command -v python3 &>/dev/null; then
    COMMAND=$(echo "$STDIN_DATA" | python3 -c "
import sys, json
try:
    data = json.load(sys.stdin)
    cmd = (data.get('tool_input') or {}).get('command', '') or \
          data.get('command', '') or ''
    print(cmd)
except Exception:
    pass
" 2>/dev/null)
elif command -v jq &>/dev/null; then
    COMMAND=$(echo "$STDIN_DATA" | jq -r '.tool_input.command // .command // ""' 2>/dev/null)
fi

# git commit コマンドのときだけリマインダーを表示する
if echo "$COMMAND" | grep -qE "git commit"; then
    echo ""
    echo "=== 学びの記録チェック（コミット完了） ==="
    echo ""
    echo "今回の作業で横断的に再利用できる発見があれば記録してください。"
    echo "一度限りのローカル事情は記録不要です。"
    echo ""
    echo "  # 記録する場合"
    echo "  php .agents/scripts/record_learning.php \\"
    echo "    --source=implementation \\"
    echo "    --scope=<scope> \\"
    echo "    --title='...' \\"
    echo "    --observation='...' \\"
    echo "    --impact='...' \\"
    echo "    --confidence=high"
    echo ""
    echo "  # 棚卸し（learnings が 10 件以上たまったら）"
    echo "  php .agents/scripts/audit_learnings.php"
    echo "  php .agents/scripts/summarize_learnings.php"
    echo "  php .agents/scripts/refresh_memory.php"
    echo ""
    echo "==========================================="
fi

exit 0
