# アーキテクチャ文書ガイド

このディレクトリには、要件定義書を実装判断しやすい粒度に落とした設計書を置きます。コードを書く前に、対象機能に関係する文書をここから辿れる状態を目指します。

---

## 1. 文書一覧

| 文書 | 役割 |
|------|------|
| [access-control-and-roles.md](./access-control-and-roles.md) | 4 ロールの責務、閲覧・操作境界、強いアクセス制御対象の整理 |
| [data-model.md](./data-model.md) | 主要エンティティ、参照関係、履歴保持、MVP と将来拡張の境界 |
| [hosting-and-operations-constraints.md](./hosting-and-operations-constraints.md) | レンタルサーバ前提の実装制約、運用前提、避けるべきインフラ依存 |
| [mvp-implementation-roadmap.md](./mvp-implementation-roadmap.md) | MVP をどの順で実装し、どの粒度で ExecPlan に分けるか |
| [mvp-wbs.md](./mvp-wbs.md) | MVP の簡易進捗管理とタスク単位の完了判定 |
| [open-questions.md](./open-questions.md) | 実装前に確認すべき未決事項、運用吸収項目、将来再設計項目 |
| [artifacts/README.md](./artifacts/README.md) | 暫定 ER 図、テーブル定義、画面遷移図、詳細設計サンプル |
| [review-worklist.md](./review-worklist.md) | MVP 文書レビューの優先順、観点、未決事項チェック |
| [ui-and-screen-design.md](./ui-and-screen-design.md) | ロール別画面、主要導線、画面設計の解釈整理 |
| [workflows/README.md](./workflows/README.md) | 状態遷移と業務フロー文書の入口 |
| [workflows/work-record-and-report-design.md](./workflows/work-record-and-report-design.md) | 稼働記録と月次稼働報告の状態遷移 |
| [workflows/project-contract-lifecycle.md](./workflows/project-contract-lifecycle.md) | クライアント、案件、契約、更新・終了のライフサイクル |

---

## 2. 分類ルール

- 認可、データ、UI のような横断設計は `architecture/` 直下に置く
- 状態遷移や業務フロー中心の設計は `architecture/workflows/` に置く
- 一般的な設計成果物として見せる暫定資料は `architecture/artifacts/` に置く
- `architecture/artifacts/` 配下の暫定資料は、正式化まで `-draft` を付けたままにする
- 単一論点の深掘りメモは `docs/notes/` に置く

---

## 3. 参照順

1. [../requirements.md](../requirements.md)
2. [../context-loading-guide.md](../context-loading-guide.md)
3. この `README`
4. 対象文書
5. 必要なら [../notes/README.md](../notes/README.md)
