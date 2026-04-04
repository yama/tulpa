# Future Considerations

## Purpose

今は実装しないが、適切なタイミングで思い出したい改善候補を保持する。
思いつきを溜め込む場所ではなく、「どの局面で再検討するか」を明示するためのノートである。

## Candidates

### `.agents/agents/` の導入

- Status: pending
- Revisit When: 役割ごとのレビュー観点や実装観点が増え、`skills/` だけでは責務分離が弱くなったとき
- Why It Matters: `requirements-reviewer` や `agent-knowledge-curator` のような役割テンプレートを定義できる
- Do Not Start Yet: 現時点ではスキル数も少なく、管理対象だけ増えるリスクがある

### ExecPlan 限定の handoff ノート

- Status: pending
- Revisit When: 1つの ExecPlan が複数日にまたがり、途中再開コストが高い作業が増えたとき
- Why It Matters: セッション依存の文脈を ExecPlan 本体から分離して保持できる
- Do Not Start Yet: 現時点では ExecPlan 自体が十分に手がかりを持っている

### 軽い自動フックの導入

- Status: pending
- Revisit When: `record_learning.php` や `refresh_memory.php` の実行忘れが繰り返し発生したとき
- Why It Matters: 作業後の最低限の棚卸しを自動で促せる
- Do Not Start Yet: 先に運用ルールを安定させないと、フックがノイズ源になる

### Learnings の監査自動化強化

- Status: in_progress
- Revisit When: `superseded` 候補や重複候補が増え、手では追いづらくなったとき
- Why It Matters: 知識は増えるより腐るほうが危険なので、棚卸しの自動化価値が高い
- Current Step: `scripts/agents/audit_learnings.php` を導入して最小監査を始める

## Review Rule

- 基盤整備タスクに着手するときは、このノートを先に読む
- `Status` が変わったら `MEMORY.md` に反映されるよう `refresh_memory.php` を実行する
- すでに不要になった候補は削除せず、理由を添えて `archive/` へ移す
