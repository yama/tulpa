# コミットメッセージ規約

## Purpose

Tulpa のコミット履歴を、人間の変更追跡だけでなく AI が再利用しやすい運用ログとして残すための規約である。
目的は「見た目を整えること」ではなく、「あとから変更理由、影響範囲、学びを機械的にも読み取りやすくすること」にある。

## Core Rule

件名は Conventional Commits に倣い、次の形式を使う。

```text
type(scope): summary
```

例:

```text
feat(agents): add self-improving knowledge workflow
docs(requirements): clarify AI responsibility boundaries
chore(git): ignore .codex environment marker
```

## Allowed Types

- `feat`: 新しい機能や運用基盤の追加
- `fix`: 不具合修正
- `refactor`: 振る舞いを変えない構造整理
- `docs`: ドキュメント中心の変更
- `test`: テスト追加・修正
- `chore`: 雑務的変更、ignore、補助設定
- `build`: ビルド設定や依存管理
- `ci`: CI/CD 変更
- `perf`: 性能改善

## Scope Rules

- `scope` は AI が履歴を絞り込みやすい粒度で付ける
- ファイル名ではなく、関心領域や責務単位を優先する
- 細かすぎる `scope` は避ける

推奨例:

- `agents`
- `knowledge`
- `skills`
- `requirements`
- `work-records`
- `contracts`
- `matching`
- `git`

## Summary Rules

- `summary` は短い日本語で書く
- 変更結果を動詞で始める
- 実装手段よりも、何が変わったかを優先する

良い例:

- `feat(agents): 学習監査コマンドを追加する`
- `docs(knowledge): 将来検討事項の扱いを定義する`

避ける例:

- `fix stuff`
- `update files`
- `change many things`

## Commit Timing and Granularity

AI が自走で作業するときは、コミットを「最後の儀式」ではなく変更境界の管理として扱う。

次のいずれかに当てはまったら、次の作業へ進む前にコミット可否を判断する。

- 1 つの機能、修正、文書整理として説明できる差分になった
- テスト、確認、レビューが一通り終わった
- 次の作業が別の concern や別の scope に移る
- 差分が増えすぎて、1 行の summary で素直に言えなくなりそう

逆に、次の状態では原則コミットしない。

- テスト不能ではなく、単に未完成で壊れている
- 途中の試行錯誤が混ざっていて、何を残したコミットか説明できない
- 他人の変更や無関係な差分が混ざっている

AI 向けの実行ルール:

1. 区切りごとに `git status --short` を確認する
2. 変更が 1 つの目的にまとまるかを言葉で説明する
3. まとまるなら、その場でコミットする
4. まとまらないなら、次の concern に進む前に分割する

大きい変更では、次のような単位で分ける。

- 設計文書整理
- データモデル変更
- UI 実装
- テスト追加
- 運用補助や README 更新

悪い例:

- 仕様変更とリファクタと README 修正を 1 コミットに詰め込む
- 既に動く機能の直後に別機能へ進み、前の変更を未コミットのまま積み増す
- 「あとでまとめる」前提で 30 ファイル以上を 1 コミットにする

## Body Template

重要な変更では、次のテンプレートを使う。

```text
Why:
- なぜ必要か

What:
- 何を変えたか

Impact:
- 何に影響するか

Learnings:
- 今回の変更から得た知見

Follow-up:
- 今回はやらなかったが、次に検討すべきこと

Refs:
- 関連する ExecPlan やドキュメント
```

すべての見出しを毎回埋める必要はない。
最低限の推奨は `Why` `What` `Impact` である。

## AI-Oriented Rules

- 将来の自走に効く変更では `Learnings` を優先的に残す
- 今回見送ったものがあるなら `Follow-up` に書く
- 関連する ExecPlan や knowledge ノートがあるなら `Refs` を付ける
- 変更理由が差分だけでは読めないときは `Why` を省略しない

## Classification Heuristics

- 新しい運用基盤やスクリプト追加は `feat`
- 既存運用文書の言い換えだけなら `docs`
- 振る舞いを変えない整理は `refactor`
- `.gitignore` や環境マーカーの扱いは `chore`
- 文書を追加しても、その追加自体が新しい運用能力なら `feat` を選んでよい

## Examples

```text
feat(agents): add self-improving knowledge workflow

Why:
- エージェントの学びを継続的に蓄積したい
- AGENTS.md の肥大化を防ぎたい

What:
- .agents/learnings と .agents/knowledge を追加
- scripts/agents に記録・集約・監査コマンドを追加
- AGENTS.md を参照型構成に更新

Impact:
- エージェント運用知見の保存先と昇格フローが明確になった

Learnings:
- 原則と事例は同じ文書に溜めないほうが保守しやすい

Refs:
- .agents/plans/001-agent-learning-system.md
```

日本語運用に置き換える場合の例:

```text
feat(agents): 自己改善ワークフローを追加する
```

## Meta Rule

コミット規約はスキルだけで定義しない。
規約そのものはこの文書のような運用文書に置き、スキルはその規約を実行する手順として扱う。
