---
name: commit-writing
description: Classify a change using Conventional Commits, then draft an AI-readable commit message with Why, What, Impact, Learnings, Follow-up, and Refs when useful.
---

# Commit Writing

## Overview

Tulpa のコミットメッセージ規約に従って、差分から `type(scope): summary` と本文を組み立てる。
このスキルは規約そのものではなく、規約を実行するための手順を扱う。

## Workflow

1. まず [../../../.agents/commit-conventions.md](../../../.agents/commit-conventions.md) を読む
2. 差分の主目的を1つに絞る
3. 適切な `type` と `scope` を選ぶ
4. 件名を `type(scope): summary` で書く
5. 重要な変更なら `Why` `What` `Impact` を付ける
6. 将来の自走に効く知見があれば `Learnings` を付ける
7. 今回見送った事項があれば `Follow-up` を付ける
8. 関連する ExecPlan や knowledge ノートがあれば `Refs` を付ける

## Rules

- summary は短い英語
- 本文は日本語でよい
- 差分の主目的が `docs` か `feat` かは、増えた能力で判断する
- 規約に迷ったら `references/type-scope-guide.md` を参照する

## References

- Read [references/type-scope-guide.md](./references/type-scope-guide.md) when choosing `type` and `scope`.
- Read [references/commit-template.md](./references/commit-template.md) when drafting the body.
