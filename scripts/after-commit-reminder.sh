#!/bin/bash
# scripts/after-commit-reminder.sh
#
# git commit 後の学び記録チェックを表示する共通リマインダー。
# Claude Code / Codex など実行基盤に依存せず再利用する。

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

exit 0
