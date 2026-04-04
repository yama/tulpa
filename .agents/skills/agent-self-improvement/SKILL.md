---
name: agent-self-improvement
description: Capture learnings from chat, implementation, and review; compress them into reusable guidance; and propose updates to AGENTS.md, skills, or reference documents without letting the top-level guidance bloat.
---

# Agent Self Improvement

## Overview

エージェントの学びを「記録」と「昇格」に分けて扱う。
最初から `AGENTS.md` に詳細を書き足さず、まず学びを残し、再利用価値が確認できたものだけを原則へ昇格する。

## Workflow

1. まず [AGENTS.md](../../../AGENTS.md) と [../../agent-improvement.md](../../agent-improvement.md) を読む
2. 学びが生まれたら、原則へ昇格させる前に `.agents/learnings/` へ記録する
3. 学びを次のどこへ置くべきか判定する
   `AGENTS.md`: 全体原則
   `SKILL.md`: 短い手順
   `references/`: 詳細ルールや失敗例
   `learnings/`: まだ生の観察
4. 同じ論点が再発しているか、あるいは高信頼で横断的に効くかを確認する
5. 昇格候補を作るときは、既存ルールを短く置き換えられないか先に見る
6. 更新後は `AGENTS.md` が原則集のまま保たれているか見直す

## Rules

- `AGENTS.md` に事例集を溜めない
- 1つの学びに1つの論点だけを持たせる
- 一度きりの観察は `learnings` に留める
- 詳細は `references/` または `.agents/knowledge/` に逃がす
- ExecPlan がある作業では `Surprises & Discoveries` と `Decision Log` も更新する

## Commands

```bash
php scripts/agents/record_learning.php --help
php scripts/agents/summarize_learnings.php
php scripts/agents/propose_agent_updates.php
php scripts/agents/refresh_memory.php
php scripts/agents/audit_learnings.php
```

## References

- Read [references/promotion-rules.md](./references/promotion-rules.md) when deciding whether a learning belongs in `AGENTS.md`, a skill, a reference note, or should remain a raw learning.
