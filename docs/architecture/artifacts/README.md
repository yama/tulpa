# Tulpa 設計概要

このディレクトリには、Tulpa の設計を短時間で把握しやすい形式に並べた成果物を置きます。
目的は文書を増やすことではなく、「何をどう切り分け、どこを未確定として管理しているか」を読み取りやすくすることです。

ここにある文書は確定仕様ではなく、既存の要件定義書と設計書をもとに構成した暫定版です。

---

## 1. 先に伝えたいこと

Tulpa の設計で先に押さえるべき点は次の 4 つです。

1. クライアント、案件、契約を中心にデータがつながる
2. 稼働記録と月次稼働報告は `Contract` を起点に整合を保つ
3. ロールごとの閲覧境界を強く分け、クライアント担当者には最小限だけ見せる
4. 未確定事項は本文に混ぜ込まず、別文書で管理して実装判断を汚さない

この配下の成果物は、上の 4 点をそれぞれ別角度から確認するための入口です。

---

## 2. この一式の見方

短く読む場合は次の順を推奨します。

1. この文書で設計の全体像を掴む
2. [entity-relationship-draft.md](./entity-relationship-draft.md) で中心データ構造を見る
3. [screen-transition-draft.md](./screen-transition-draft.md) でロール別の導線を見る
4. [detailed-design-draft.md](./detailed-design-draft.md) で設計判断が実装粒度に落ちる様子を見る
5. 必要に応じて [table-definition-draft.md](./table-definition-draft.md) でスキーマのたたき台を見る

---

## 3. 位置づけ

- 目的は「一般的な設計成果物の見た目」で設計判断を伝えやすくすること
- SSOT は引き続き [requirements.md](../../requirements.md) と `architecture/` 直下の設計書
- この配下の文書には、未確定事項を埋めるためのダミー値や仮置き案を含む

---

## 4. 文書ごとの読みどころ

| 文書 | 読みどころ |
|------|------|
| [entity-relationship-draft.md](./entity-relationship-draft.md) | Tulpa が「契約を起点に稼働系と請求系をつなぐ」構造であること |
| [table-definition-draft.md](./table-definition-draft.md) | 実装前にどのテーブル責務を先に固定すべきか |
| [screen-transition-draft.md](./screen-transition-draft.md) | ロールごとにどこまで画面を分け、どこを最小構成に留めるか |
| [detailed-design-draft.md](./detailed-design-draft.md) | 要件と設計思想が、入出力、状態遷移、例外系にどう落ちるか |

---

## 5. 未確定事項の扱い

- 確定事項を知りたいときは、先に `requirements.md` と対応する設計書を読む
- この配下の文書を読むときは、各文書冒頭の `確定度` と `ダミー利用` を先に確認する
- `-draft` が付いている文書名は、正式化されるまで仮置きであることを示す
- ダミーや仮置きを実装条件として扱わない
- 実装に影響する未確定事項は [../open-questions.md](../open-questions.md) で別管理する

---

## 6. 更新ルール

- `architecture/` 直下の SSOT が更新されたら、この配下も追従する
- `artifacts/` 配下の文書は、正式文書へ昇格するまで `-draft` を外さない
- 未確定事項が確定したら、ダミー表記を削るか `open-questions.md` へ参照を張る
- 文書が確定仕様に近づいたら、必要に応じて `artifacts/` から適切な正式文書へ昇格させる
