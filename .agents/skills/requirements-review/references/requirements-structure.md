# Requirements Structure

## Core Principle

A strong requirements document is not just descriptive. It exposes the exact places where review should happen.

Use this structure when the current document reads like a vision note, concept paper, or feature inventory but still lacks review boundaries.

## Recommended Sections

### 1. Scope Boundary

Add a section such as `本バージョンのスコープ` when the document mixes current requirements, roadmap ideas, and optional integrations.

Minimum shape:

- `In Scope`: what the current version must support.
- `Out of Scope`: what is intentionally excluded.
- `Assumptions`: market, geography, contract form, scale, and deployment assumptions.

Good examples for Tulpa-like products:

- 単一エージェント会社利用
- 日本国内利用前提
- 業務委託契約前提
- 月次精算型契約
- 多重商流管理は対象外
- フル会計機能は対象外

### 2. Non-Functional Requirements

Add a dedicated `非機能要件` section when the document uses qualitative language such as `軽量`, `シンプル`, or `スマホファースト` without measurable targets.

Cover at least:

- `性能`: expected user count, record volume, response-time target.
- `可用性`: operating environment, backup expectation, restore expectation.
- `セキュリティ`: API key handling, access boundary, personal-data classification.
- `運用性`: minimum logs, failure visibility, manual fallback.

If exact numbers are unknown, write them as explicit open decisions:

- `同時利用ユーザー数はMVPで要決定`
- `画面応答時間目標は1秒以内を仮置き`

### 3. Data Integrity Rules

Add a section when workflows imply irreversible state changes or historical records.

Typical rules to make explicit:

- 契約終了後に稼働記録を編集できるか
- 確認済み稼働報告を再編集できるか
- 単価変更時に過去データをどう固定するか
- 差戻し後にどの状態へ戻るか
- 外部連携データ削除時にキャッシュを保持するか

Prefer rule form:

- `X の後は Y だけが可能`
- `Z は履歴を保持したまま無効化する`
- `金額計算は対象月の契約条件をスナップショットとして固定する`

### 4. AI Boundary

When AI appears anywhere in the product, define the boundary in requirements rather than leaving it as an implementation detail.

State explicitly:

- AI出力は下書きか、確定値か
- 人間が必ず確認・編集するか
- 誤生成時の責任主体は誰か
- AI未設定時のフォールバックは何か
- AIログを保存するか

For Tulpa-like products, prefer:

- AIは意思決定しない
- AI出力は人間の確認前提
- API未設定でもコア機能は利用可能

### 5. Risk and Tradeoff

Add a section such as `リスクとトレードオフ` when design choices are visible but not defended.

Common tradeoff format:

- `捨てるもの`
- `得るもの`
- `受け入れる制約`

Examples:

- マルチテナントを捨てる代わりに実装と運用を簡潔にする
- ネイティブアプリを捨てる代わりにPWAで配布性を優先する
- 税計算を捨てる代わりに会計ソフト連携前提で複雑性を抑える

### 6. Review Checklist

Add a checklist at the end when multiple reviewers will inspect the document from different angles.

The checklist should not repeat every requirement. It should tell reviewers what to challenge:

- スコープ肥大化
- 曖昧語
- 数値未定義
- AI責任境界
- 法務・公開リスク
- 実装現実性

## Section Ordering

For large requirement documents, this order works well:

1. Product overview and design intent
2. Terminology and actors
3. Scope boundary
4. Functional requirements
5. Non-functional requirements
6. Data model or integrity rules
7. Delivery phases and MVP
8. Risks and tradeoffs
9. Review checklist

## Editing Heuristics

- Preserve strong product framing at the top; structure does not require flattening the voice.
- Move future ideas out of core sections when they dilute the current version.
- Split long sections when one paragraph mixes motivation, requirement, and implementation choice.
- Convert soft claims into reviewable statements with an actor, condition, and expected result.
