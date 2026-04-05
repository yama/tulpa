# 暫定テーブル定義書

この文書は、MVP で中心になるテーブルの暫定定義をまとめたものです。
確定版のスキーマ仕様ではなく、要件定義と設計書を実装に落とすためのたたき台です。

---

## 1. 文書ステータス

| 項目 | 内容 |
|------|------|
| 確定度 | 暫定 |
| ダミー利用 | あり |
| SSOT | [../data-model.md](../data-model.md), [../workflows/work-record-and-report-design.md](../workflows/work-record-and-report-design.md), [../../notes/contract-work-record-design.md](../../notes/contract-work-record-design.md) |
| 主な用途 | マイグレーション設計の入口、レビュー観点の共有 |

この文書の列名、型、制約は仮置きを含みます。特に長さ、索引、 nullable の最終判断は実装時に見直します。

---

## 2. この文書で伝えたいこと

この文書で伝えたいのは、全テーブルを細かく確定することではありません。
先に固定すべきなのは「どのテーブルが何の責務を持つか」であり、細部の型や索引はその後で詰めるという設計姿勢です。

特に次の判断を見やすくすることを狙っています。

1. `contracts` を契約条件の本体として扱う
2. `work_records` と `work_record_revisions` を分離する
3. `work_reports` を月次確定の単位として独立させる

---

## 3. 記法ルール

- `仮` と書かれた項目はダミーまたは未確定
- 型は Laravel / MySQL を想定したラフな表記
- `必須` は UI 必須ではなく、データ保持上の基本方針を示す

---

## 4. 主要テーブル

### 3.1 `clients`

| カラム | 型 | 必須 | 備考 |
|------|------|------|------|
| `id` | bigint | 必須 | PK |
| `name` | varchar(255) | 必須 | クライアント名 |
| `status` | varchar(50) | 必須 | 仮。将来 Enum 化想定 |
| `notes` | text | 任意 | 内部メモ |
| `created_at` | timestamp | 必須 |  |
| `updated_at` | timestamp | 必須 |  |

### 3.2 `projects`

| カラム | 型 | 必須 | 備考 |
|------|------|------|------|
| `id` | bigint | 必須 | PK |
| `client_id` | bigint | 必須 | `clients.id` |
| `name` | varchar(255) | 必須 | 案件名 |
| `status` | varchar(50) | 必須 | 仮。募集中、進行中、終了など |
| `description` | text | 任意 | 案件概要 |
| `started_on` | date | 任意 | 仮 |
| `ended_on` | date | 任意 | 仮 |
| `created_at` | timestamp | 必須 |  |
| `updated_at` | timestamp | 必須 |  |

### 3.3 `engineer_leads`

| カラム | 型 | 必須 | 備考 |
|------|------|------|------|
| `id` | bigint | 必須 | PK |
| `full_name` | varchar(255) | 必須 | 仮 |
| `email` | varchar(255) | 必須 | 初回接点用 |
| `source` | varchar(100) | 任意 | 取得経路。仮 |
| `status` | varchar(50) | 必須 | 見込み、面談中、正式登録待ちなどの仮置き |
| `created_at` | timestamp | 必須 |  |
| `updated_at` | timestamp | 必須 |  |

### 3.4 `engineers`

| カラム | 型 | 必須 | 備考 |
|------|------|------|------|
| `id` | bigint | 必須 | PK |
| `user_id` | bigint | 必須 | `users.id` 想定 |
| `engineer_lead_id` | bigint | 任意 | 見込みから移行した場合 |
| `display_name` | varchar(255) | 必須 | 表示名 |
| `email` | varchar(255) | 必須 | ログイン兼連絡先の可能性あり |
| `profile_visibility` | varchar(50) | 必須 | 仮 |
| `created_at` | timestamp | 必須 |  |
| `updated_at` | timestamp | 必須 |  |

### 3.5 `contracts`

| カラム | 型 | 必須 | 備考 |
|------|------|------|------|
| `id` | bigint | 必須 | PK |
| `project_id` | bigint | 必須 | `projects.id` |
| `engineer_id` | bigint | 必須 | `engineers.id` |
| `contract_party_type` | varchar(50) | 必須 | Enum 想定 |
| `status` | varchar(50) | 必須 | 仮 |
| `start_date` | date | 必須 | 契約開始日 |
| `end_date` | date | 任意 | 契約終了日 |
| `billing_unit_price` | decimal(10,2) | 任意 | 仮。請求側条件 |
| `payment_unit_price` | decimal(10,2) | 任意 | 仮。支払側条件 |
| `terms_summary` | text | 任意 | 契約条件の説明 |
| `created_at` | timestamp | 必須 |  |
| `updated_at` | timestamp | 必須 |  |

想定制約:

- `project_id + engineer_id + contract_party_type + start_date` の複合一意を候補とする
- `contract_party_type` は自由入力にしない

### 3.6 `work_records`

| カラム | 型 | 必須 | 備考 |
|------|------|------|------|
| `id` | bigint | 必須 | PK |
| `contract_id` | bigint | 必須 | `contracts.id` |
| `work_date` | date | 必須 | 稼働日 |
| `started_at` | datetime | 必須 | 作業開始 |
| `ended_at` | datetime | 必須 | 作業終了 |
| `working_hours_minutes` | integer | 必須 | 仮。分単位保持 |
| `memo` | text | 任意 | 備考 |
| `created_by_user_id` | bigint | 必須 | 入力者 |
| `updated_by_user_id` | bigint | 必須 | 最終更新者 |
| `created_at` | timestamp | 必須 |  |
| `updated_at` | timestamp | 必須 |  |

### 3.7 `work_record_revisions`

| カラム | 型 | 必須 | 備考 |
|------|------|------|------|
| `id` | bigint | 必須 | PK |
| `work_record_id` | bigint | 必須 | `work_records.id` |
| `changed_by_user_id` | bigint | 必須 | 修正者 |
| `previous_started_at` | datetime | 必須 | 修正前 |
| `previous_ended_at` | datetime | 必須 | 修正前 |
| `new_started_at` | datetime | 必須 | 修正後 |
| `new_ended_at` | datetime | 必須 | 修正後 |
| `reason` | text | 必須 | 修正理由 |
| `created_at` | timestamp | 必須 | 修正日時 |

### 3.8 `work_reports`

| カラム | 型 | 必須 | 備考 |
|------|------|------|------|
| `id` | bigint | 必須 | PK |
| `contract_id` | bigint | 必須 | `contracts.id` |
| `target_month` | char(7) | 必須 | 仮。`YYYY-MM` |
| `status` | varchar(50) | 必須 | Enum 想定 |
| `submitted_at` | datetime | 任意 | 提出日時 |
| `returned_at` | datetime | 任意 | 差戻し日時 |
| `confirmed_at` | datetime | 任意 | 確認日時 |
| `confirmed_by_user_id` | bigint | 任意 | 確認者 |
| `summary_working_hours_minutes` | integer | 必須 | 仮。集計値固定用 |
| `client_comment` | text | 任意 | 差戻しや確認メモ |
| `created_at` | timestamp | 必須 |  |
| `updated_at` | timestamp | 必須 |  |

### 3.9 `skill_sheets`

| カラム | 型 | 必須 | 備考 |
|------|------|------|------|
| `id` | bigint | 必須 | PK |
| `engineer_id` | bigint | 必須 | `engineers.id` |
| `version` | integer | 必須 | 仮 |
| `summary` | text | 任意 | スキル要約 |
| `skills_json` | json | 任意 | 仮。後で正規化の余地あり |
| `is_current` | boolean | 必須 | 現行版フラグ |
| `created_at` | timestamp | 必須 |  |
| `updated_at` | timestamp | 必須 |  |

---

## 5. 今は書かないこと

- 全テーブルの完全網羅
- 全索引の確定
- 添付ファイル系テーブルの最終構造
- Claude API や Slack API 連携の詳細テーブル

これらは、MVP のコア実装が進んでから別途詰める前提です。

---

## 6. 未確定事項の扱い

- 仮置きの列は、実装前に [../open-questions.md](../open-questions.md) と照合する
- 未確定事項が大きい箇所は、マイグレーションに先行して正式化しない
- 先に責務境界を固定し、その後で型、長さ、索引を詰める

---

## 7. 実装前の確認ポイント

1. `contracts` を契約書ファイルの保存先ではなく契約条件の本体として扱えているか
2. `work_records` と `work_record_revisions` の責務を混同していないか
3. `work_reports` の集計固定タイミングを状態遷移と合わせて説明できるか
4. 仮置きカラムをそのまま量産せず、必要性を実装時に再確認しているか
