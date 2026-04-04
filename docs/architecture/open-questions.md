# 実装前の未決事項一覧

このドキュメントは、MVP 文書レビューを一巡した時点で残っている判断待ち項目をまとめた一覧です。AI エージェントが実装へ進む前に、ここにある項目が実装を止めるかどうかを確認します。

---

## 1. 使い方

- `要決定`: 実装前に決めないと設計や運用が割れる項目
- `運用で吸収`: MVP ではコードに閉じ込めず、当面は運用で処理する項目
- `将来再設計`: 今は対象外だが、Phase 2 以降で別途設計が必要な項目

原則として、`要決定` が未解消のままコード実装へ進みません。`運用で吸収` と `将来再設計` は、現在の MVP 実装を止めない前提で管理します。

---

## 2. 要決定

### 2.1 運用目標

1. バックアップからの復元目標時間
2. バックアップ保持世代数
3. ログ保持期間
4. 障害通知先と通知手段

関連文書:

- [requirements.md](../requirements.md)

影響:

- 運用設計
- 監視・障害対応
- README やインストールガイドへの記載内容

---

## 3. 運用で吸収

### 3.1 稼働記録の例外

- 日跨ぎ稼働は MVP では対象外とし、当日分を分けて手動入力する
- 休憩時間の厳密管理は MVP では行わない
- 同一契約・同一日の複数セッションは 1 日 1 件へ集約する
- 提出締め日は MVP ではシステム設定で縛らず、運用で吸収する

関連文書:

- [work-record-and-report-design.md](./workflows/work-record-and-report-design.md)

### 3.2 契約添付

- `OrderDocument` は MVP 必須ではなく、契約条件登録を優先する
- 注文書 PDF 添付は必要なら初期対応候補として入れるが、契約成立要件にはしない

関連文書:

- [data-model.md](./data-model.md)
- [project-contract-lifecycle.md](./workflows/project-contract-lifecycle.md)

---

## 4. 将来再設計

### 4.1 契約と案件

- 月途中の契約条件変更をどう扱うか
- `agent_client` を含む請求処理 UI をどう構成するか
- `client_engineer_direct` の専用 UI を作るか

関連文書:

- [project-contract-lifecycle.md](./workflows/project-contract-lifecycle.md)
- [notes/contract-work-record-design.md](../notes/contract-work-record-design.md)

### 4.2 稼働と月次報告

- 精算幅に対する厳密な進捗表示
- 「あと何日休めるか」の余裕日数表示
- 独自フォーマット案件の解析や自動計算

関連文書:

- [requirements.md](../requirements.md)
- [work-record-and-report-design.md](./workflows/work-record-and-report-design.md)

### 4.3 CRM・AI・公開系

- クライアント/エンジニア CRM の属性追加
- AI マッチング専用画面とサマリー仕上げ導線
- 公開プロフィールの UI と公開範囲設計
- 外部サービス連携データの可視化

関連文書:

- [requirements.md](../requirements.md)
- [ui-and-screen-design.md](./ui-and-screen-design.md)
- [data-model.md](./data-model.md)

---

## 5. AI 実装前チェック

実装に入る前に次を確認します。

1. `要決定` に残っている項目が、対象実装に直接影響しないか
2. `運用で吸収` とした項目を、AI が勝手に機能化しようとしていないか
3. `将来再設計` の項目を MVP の migration や画面に持ち込もうとしていないか

判断に迷ったら、まず設計書を更新し、必要なら `notes/` に個別メモを追加します。
