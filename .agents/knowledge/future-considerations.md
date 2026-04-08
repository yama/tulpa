# Future Considerations

## Purpose

今は実装しないが、適切なタイミングで思い出したい改善候補を保持する。
思いつきを溜め込む場所ではなく、「どの局面で再検討するか」を明示するためのノートである。

## Candidates

### `.agents/agents/` の導入

- Status: pending
- Revisit When: 役割ごとのレビュー観点や実装観点が増え、`skills/` だけでは責務分離が弱くなったとき、または複数エージェントが並行して異なる役割を担う運用になったとき
- Why It Matters: `requirements-reviewer` や `knowledge-curator` のような役割テンプレートを定義できる
- Do Not Start Yet: 現時点ではスキル数も少なく、管理対象だけ増えるリスクがある

### ExecPlan 限定の handoff ノート

- Status: pending
- Revisit When: 1つの ExecPlan が複数日にまたがり、途中再開コストが高い作業が増えたとき
- Why It Matters: セッション依存の文脈を ExecPlan 本体から分離して保持できる
- Do Not Start Yet: 現時点では ExecPlan 自体が十分に手がかりを持っている

### 軽い自動フックの導入

- Status: done
- Completed: 2026-04-08
- What Was Done: Claude Code では `.claude/settings.json` の PostToolUse フックを設定。`git commit` 完了後に `.claude/hooks/after-commit.sh` が動き、共通リマインダー `scripts/after-commit-reminder.sh` を呼ぶ
- What Was Done (Codex): `.githooks/post-commit` と `scripts/setup-git-hooks.sh` を追加し、`bash scripts/setup-git-hooks.sh` でエージェント非依存の post-commit リマインダーを有効化できるようにした
- Next: 実運用で「ノイズが多い」「コミット種別で出し分けたい」事例が出たら `.agents/learnings/` に記録して見直す

### Learnings の監査自動化強化

- Status: in_progress
- Revisit When: `superseded` 候補や重複候補が増え、手では追いづらくなったとき
- Why It Matters: 知識は増えるより腐るほうが危険なので、棚卸しの自動化価値が高い
- Current Step: `.agents/scripts/audit_learnings.php` を導入して最小監査を始める

### エージェント権限境界の精緻化

- Status: in_progress
- Revisit When: 「確認が必要かどうか迷った」事例が 3 件以上 `.agents/learnings/` に蓄積されたとき
- Why It Matters: 自走範囲が広がるほど、境界の曖昧さが意思決定コストを増やす
- Current Step: `.agents/knowledge/agent-authority.md` に初版の 3 層モデルを定義済み。実運用で事例を積み上げる段階

## Review Rule

- 基盤整備タスクに着手するときは、このノートを先に読む
- `Status` が変わったら `MEMORY.md` に反映されるよう `refresh_memory.php` を実行する
- すでに不要になった候補は削除せず、理由を添えて `archive/` へ移す
