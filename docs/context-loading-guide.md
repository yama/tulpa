# AI 実装時のコンテキスト読込ガイド

この文書は、AI エージェントが Tulpa の実装へ着手するときに、どの順で文書を読むかを固定するためのガイドです。目的は、要件の読み漏れ、MVP と将来対応の混線、未決事項の見落としを減らすことです。

---

## 1. 基本ルール

実装前の最小読書セットは次の順序で読むこと。

1. `AGENTS.md`
2. [requirements.md](./requirements.md)
3. [architecture/README.md](./architecture/README.md)
4. 対象領域の設計書
5. [architecture/open-questions.md](./architecture/open-questions.md)
6. 必要なら `notes/` と対象タスクの ExecPlan

この順序は固定であり、対象領域の設計書だけを先に読んで実装を始めない。
`architecture/artifacts/` は補助資料なので、この最小読書セットの代わりにしてはならない。
特に `-draft` 付き文書は、正式化されるまで仮置き前提で読むこと。

---

## 2. 文書ごとの役割

| 文書 | 実装前に確認すること |
|------|----------------------|
| `AGENTS.md` | 用語、設計原則、実装制約、ExecPlan の要否 |
| [requirements.md](./requirements.md) | Tulpa 全体の目的、MVP 範囲、Phase 2/3 境界 |
| [architecture/README.md](./architecture/README.md) | 対象設計書の所在 |
| 対象領域の設計書 | 具体的な責務、状態遷移、受け入れ条件 |
| [architecture/hosting-and-operations-constraints.md](./architecture/hosting-and-operations-constraints.md) | レンタルサーバ前提で避けるべき実装、運用制約 |
| [architecture/open-questions.md](./architecture/open-questions.md) | 対象実装に関係する未解決事項、運用確定事項、将来送り事項 |
| `architecture/artifacts/` | 全体像や説明補助のための暫定成果物。実装時は SSOT の補助としてのみ使う |
| `notes/` | 単一論点の補足判断 |
| ExecPlan | 今回の変更で採る実装方針、進捗、発見事項 |

---

## 3. 対象領域ごとの読書セット

### 3.1 権限・認可

1. [requirements.md](./requirements.md)
2. [architecture/access-control-and-roles.md](./architecture/access-control-and-roles.md)
3. [architecture/ui-and-screen-design.md](./architecture/ui-and-screen-design.md)
4. [architecture/open-questions.md](./architecture/open-questions.md)

### 3.2 データモデル・マイグレーション

1. [requirements.md](./requirements.md)
2. [architecture/data-model.md](./architecture/data-model.md)
3. [architecture/hosting-and-operations-constraints.md](./architecture/hosting-and-operations-constraints.md)
4. 関係するワークフロー文書
5. [architecture/open-questions.md](./architecture/open-questions.md)
6. 必要なら [notes/contract-work-record-design.md](./notes/contract-work-record-design.md)
7. 補助的に `architecture/artifacts/` を参照してよいが、先に SSOT を読む

### 3.3 稼働記録と月次報告

1. [requirements.md](./requirements.md)
2. [architecture/workflows/work-record-and-report-design.md](./architecture/workflows/work-record-and-report-design.md)
3. [architecture/data-model.md](./architecture/data-model.md)
4. [architecture/hosting-and-operations-constraints.md](./architecture/hosting-and-operations-constraints.md)
5. [architecture/ui-and-screen-design.md](./architecture/ui-and-screen-design.md)
6. [architecture/open-questions.md](./architecture/open-questions.md)
7. 補助的に `architecture/artifacts/` を参照してよいが、先に SSOT を読む

### 3.4 案件・契約

1. [requirements.md](./requirements.md)
2. [architecture/workflows/project-contract-lifecycle.md](./architecture/workflows/project-contract-lifecycle.md)
3. [architecture/data-model.md](./architecture/data-model.md)
4. [architecture/hosting-and-operations-constraints.md](./architecture/hosting-and-operations-constraints.md)
5. [architecture/access-control-and-roles.md](./architecture/access-control-and-roles.md)
6. [architecture/open-questions.md](./architecture/open-questions.md)
7. 必要なら [notes/contract-work-record-design.md](./notes/contract-work-record-design.md)
8. 補助的に `architecture/artifacts/` を参照してよいが、先に SSOT を読む

### 3.5 画面・導線

1. [requirements.md](./requirements.md)
2. [architecture/ui-and-screen-design.md](./architecture/ui-and-screen-design.md)
3. [architecture/hosting-and-operations-constraints.md](./architecture/hosting-and-operations-constraints.md)
4. 関連する権限文書またはワークフロー文書
5. [architecture/open-questions.md](./architecture/open-questions.md)
6. 補助的に `architecture/artifacts/` を参照してよいが、先に SSOT を読む

---

## 4. 実装前チェック

対象タスクに着手する前に、次を確認する。

1. 対象機能が MVP か将来対応か
2. 対象設計書に未解決の判断待ちが残っていないか
3. `運用確定` を AI が勝手に機能化しようとしていないか
4. `将来送り` を migration や UI に持ち込もうとしていないか
5. 複雑な変更であれば ExecPlan があるか
6. `architecture/artifacts/` の仮置きを確定仕様として読んでいないか

---

## 5. 更新ルール

- 新しい設計書を追加したら、この文書の対象領域別読書セットを更新する
- 既存文書の役割が変わったら、`docs/README.md` と `architecture/README.md` も合わせて更新する
- 実装で新しい判断が必要になったら、まず設計書か `open-questions.md` に反映する
