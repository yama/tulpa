# Tulpa ドキュメントガイド

このディレクトリは、Tulpa の全体要件、実装向け設計書、個別メモを役割ごとに分けて管理します。文書が増えても「何を知りたいときにどこを見るか」が分かる構成を維持することを目的とします。

---

## 1. ディレクトリ構成

```text
docs/
├── README.md
├── requirements.md
├── context-loading-guide.md
├── setup/
│   ├── README.md
│   ├── development.md
│   └── installation.md
├── architecture/
│   ├── README.md
│   ├── access-control-and-roles.md
│   ├── artifacts/
│   │   ├── README.md
│   │   ├── detailed-design-draft.md
│   │   ├── entity-relationship-draft.md
│   │   ├── screen-transition-draft.md
│   │   └── table-definition-draft.md
│   ├── data-model.md
│   ├── hosting-and-operations-constraints.md
│   ├── mvp-implementation-roadmap.md
│   ├── mvp-wbs.md
│   ├── open-questions.md
│   ├── review-worklist.md
│   ├── ui-and-screen-design.md
│   └── workflows/
│       ├── README.md
│       ├── project-contract-lifecycle.md
│       └── work-record-and-report-design.md
└── notes/
    ├── README.md
    └── contract-work-record-design.md
```

---

## 2. 読み始める順序

1. [要件定義書](./requirements.md)
2. [AI 実装時のコンテキスト読込ガイド](./context-loading-guide.md)
3. [アーキテクチャ文書ガイド](./architecture/README.md)
4. 対象領域の設計書
5. 必要に応じて `notes/` の個別メモ

セットアップや導入状況を確認したい場合は [setup/README.md](./setup/README.md) を起点にします。

要件定義書は Tulpa の全体構想、スコープ、用語、フェーズ境界の SSOT です。`architecture/` は実装判断に使う設計書、`notes/` は個別論点の補助メモです。

---

## 3. どこに何があるか

| 知りたいこと | 見る文書 |
|------|------|
| Tulpa 全体の狙い、MVP 範囲、用語 | [requirements.md](./requirements.md) |
| AI が実装前にどの順で文書を読むか | [context-loading-guide.md](./context-loading-guide.md) |
| 開発者向けセットアップ | [setup/development.md](./setup/development.md) |
| 導入ガイドの現状 | [setup/installation.md](./setup/installation.md) |
| MVP をどの順で実装するか | [architecture/mvp-implementation-roadmap.md](./architecture/mvp-implementation-roadmap.md) |
| MVP の進捗をどう管理するか | [architecture/mvp-wbs.md](./architecture/mvp-wbs.md) |
| レンタルサーバ前提の実装制約 | [architecture/hosting-and-operations-constraints.md](./architecture/hosting-and-operations-constraints.md) |
| ロール設計、閲覧・操作境界 | [architecture/access-control-and-roles.md](./architecture/access-control-and-roles.md) |
| エンティティ責務、履歴保持 | [architecture/data-model.md](./architecture/data-model.md) |
| 実装前に残っている判断待ち項目 | [architecture/open-questions.md](./architecture/open-questions.md) |
| ER図、テーブル定義、画面遷移、詳細設計の暫定成果物 | [architecture/artifacts/README.md](./architecture/artifacts/README.md) |
| MVP 文書レビューの進め方 | [architecture/review-worklist.md](./architecture/review-worklist.md) |
| 稼働記録から月次報告までの流れ | [architecture/workflows/work-record-and-report-design.md](./architecture/workflows/work-record-and-report-design.md) |
| 案件、契約、更新・終了の扱い | [architecture/workflows/project-contract-lifecycle.md](./architecture/workflows/project-contract-lifecycle.md) |
| 画面設計やロール別の導線 | [architecture/ui-and-screen-design.md](./architecture/ui-and-screen-design.md) |
| 単一論点の設計メモ | [notes/README.md](./notes/README.md) |

---

## 4. 文書追加ルール

- 全体方針やフェーズ境界を変える内容は `requirements.md` に書く
- 開発環境セットアップや導入手順は `setup/` に置く
- 実装判断に使う継続的な設計書は `architecture/` に置く
- 状態遷移や業務フロー中心の設計書は `architecture/workflows/` に置く
- 迷いやすい単一論点や一時的な補助メモは `notes/` に置く

新しい文書を追加するときは、どの文書が SSOT で、どの文書が補助かを明記し、このガイドにも追記します。
