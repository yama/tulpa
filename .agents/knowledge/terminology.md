# Agent Terminology Knowledge

## Purpose

エージェント運用まわりの用語を固定し、同じ概念を別名で増やさないための補助ノートである。

## Preferred Terms

| Avoid | Use | Meaning |
|------|-----|---------|
| 生ログ | `learning` | まだ昇格していない単一論点の観察 |
| まとめメモ | `knowledge` | 人間向けに整理済みの知識 |
| ルール候補 | `candidate_rule` | 将来 `AGENTS.md` やスキルへ昇格しうる規則 |
| 失効 | `superseded` | 古くなったが履歴として残す状態 |
| 索引更新 | `refresh memory` | `MEMORY.md` を再生成して入口を同期する操作 |

## Placement Vocabulary

- `AGENTS.md`: 全体原則の SSOT
- `learnings`: 原子的な観察
- `knowledge`: 整理済み知識
- `archive`: 現役ではないが履歴価値はある知識
- `review queue`: 昇格先や失効判断がまだ固まっていない項目

## Naming Rules

- `knowledge` ノート名はトピック単位にする
- 1ファイルに複数テーマを詰め込みすぎない
- 将来の検討事項は `future-considerations.md` に集約し、散在させない
