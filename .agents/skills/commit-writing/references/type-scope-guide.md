# Type And Scope Guide

## Types

- `feat`: 新しい機能や運用能力が増える
- `fix`: 誤動作を正す
- `refactor`: 振る舞いを変えず整理する
- `docs`: 文書中心で、運用能力自体は増えない
- `chore`: ignore、補助設定、雑務的変更

## Choosing Between `feat` And `docs`

- 文書を追加しても、それにより新しい運用能力や作業基盤が増えるなら `feat`
- 単に既存説明を明確化しただけなら `docs`

## Common Scopes In Tulpa

- `agents`
- `knowledge`
- `skills`
- `requirements`
- `git`

## Scope Selection Rule

- 変更の主責務を表す scope を1つ選ぶ
- 複数領域にまたがっても、履歴検索で最も役立つ軸を優先する
