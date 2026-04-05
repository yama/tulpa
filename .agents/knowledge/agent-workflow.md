# Agent Workflow Knowledge

## Purpose

Tulpa でエージェントが作業するときの最小運用フローを整理した知識ノートである。
目的は、毎回同じ判断をゼロからやり直さず、`AGENTS.md` を太らせずに再利用できる流れを保つことにある。

## Default Loop

1. 作業前に `AGENTS.md` と必要なスキルを読む
2. 複雑な変更なら ExecPlan を作る
3. 実装・レビュー中に再利用価値のある発見が出たら、まず ExecPlan に記録する
4. その発見が横断的に効くなら `.agents/learnings/` に 1 論点 1 ファイルで切り出す
5. 区切りで `summarize_learnings.php` と `propose_agent_updates.php` を回す
6. 整理済み知識を追加したら `refresh_memory.php` を回す
7. 区切りで `git status --short` を見て、次の concern に進む前にコミット可否を判断する
8. コミット前に必要なら commit-writing スキルでメッセージ案を整える

## Commit Checkpoints

- 1 つの機能、修正、文書整理が終わったとき
- テストや確認が終わったとき
- 次の変更が別 concern に移るとき
- 自分でもコミット件名を 1 行で言えそうなとき

次の状態なら、コミット前に差分整理を優先する。

- 試行錯誤の残骸が混ざっている
- 他人の変更と自分の変更が混ざっている
- 未完成で失敗する状態をそのまま残そうとしている

## Escalation Rules

- `AGENTS.md` に追加するのは全体原則だけ
- 特定作業の短い手順は `skills/*/SKILL.md`
- 長い説明や失敗例は `references/` または `.agents/knowledge/`
- 一度きりの発見は `.agents/learnings/` に留める

## Review Cadence

- 大きい実装の完了時に learnings を棚卸しする
- 知識ノートを追加・更新したときは `MEMORY.md` を再生成する
- `future-considerations.md` は新しい基盤整備の前後で見返す
