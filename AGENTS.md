# AGENTS.md

このファイルはAIエージェント（Claude等）がTulpaの開発を支援する際のコンテキスト情報です。
コードを書く前に必ずこのファイルを参照してください。

---

## プロジェクト概要

**Tulpa** はフリーランスエンジニアとエージェントの業務をAIで繋ぐOSSです。
案件・クライアントを中心にデータが繋がる設計が核心です。

詳細は [docs/requirements.md](docs/requirements.md) を参照してください。

---

## 技術スタック

- PHP 8.2+ / Laravel 12
- Alpine.js + htmx（ビルド不要・CDN配信）
- Tailwind CSS（ビルド済み軽量版）
- MySQL 8.0+ / MariaDB 10.6+
- Claude API（AIマッチング・オプション）
- Slack API（通知連携・オプション）
- PWA（Service Worker + Web App Manifest）

---

## 設計原則

### 基本原則

| 原則 | 意味 | このプロジェクトでの適用 |
|------|------|------------------------|
| **SOLID** | 単一責任・開放閉鎖・リスコフ置換・インターフェース分離・依存性逆転 | クラス設計・サービス層の分離 |
| **DRY** | Don't Repeat Yourself | ロジックの重複を排除。共通処理はサービスクラスに集約 |
| **YAGNI** | You Aren't Gonna Need It | 今必要でない機能は作らない。要件定義書の「将来の検討事項」は実装しない |
| **KISS** | Keep It Simple, Stupid | シンプルな実装を優先。複雑な抽象化は避ける |
| **SSOT** | Single Source of Truth | データの定義は一箇所に。定数・設定値の重複を排除 |
| **PIE** | Program Intentionally and Expressively | 意図が伝わるコードを書く。コメントより自己説明的な命名を優先 |

### ボーイスカウトルール

> コードをみつけたときよりも、きれいな状態にして返す

- 機能追加と同時に既存コードの改善も行う
- コードを増やす一方にしない。不要になったコードは削除する
- リファクタリングは別PRにせず、関連する変更とまとめて行う

---

## コーディング規約

### PHP / Laravel

```php
// 型宣言を必ず使う
function calculateTotalHours(Carbon $from, Carbon $to): float

// Enumを積極的に使う
enum WorkReportStatus: string
{
    case Draft = 'draft';
    case Submitted = 'submitted';
    case Confirmed = 'confirmed';
}

// サービスクラスでビジネスロジックを分離する
// ControllerにはHTTPの責務だけを持たせる
class WorkReportService
{
    public function submit(WorkReport $report): void { ... }
}
```

- Eloquentのイベント・オブザーバーは使わない（暗黙の挙動を避ける）
- N+1問題を避けるため、Eager Loadingを徹底する
- マジックナンバーは使わない。Enumまたは定数で定義する

### 命名規則

| 対象 | 規則 | 例 |
|------|------|-----|
| クラス | PascalCase | `WorkReportService` |
| メソッド | camelCase | `calculateTotalHours` |
| テーブル | snake_case・複数形 | `work_reports` |
| カラム | snake_case | `started_at` |
| ルート | kebab-case | `/work-reports/{id}` |

### フロントエンド

- Alpine.jsはインラインで書く（別ファイルに分離しない）
- htmxはサーバーサイドレンダリングを基本とする
- JavaScriptで状態管理しない。状態はサーバーに持たせる

---

## 用語定義

コード内の変数名・メソッド名・テーブル名は以下の用語に統一する。
「勤怠」「出勤」「退勤」は使わない。

| 使わない言葉 | 使う言葉 | 英語（コード用） |
|------------|---------|----------------|
| 勤怠 | 稼働記録 | work_record |
| 出勤・打刻開始 | 作業開始 | work_start |
| 退勤・打刻終了 | 作業終了 | work_end |
| 勤務時間 | 稼働時間 | working_hours |
| 勤怠承認 | 稼働確認 | work_confirmation |
| 作業報告書 | 稼働報告 | work_report |

---

## ディレクトリ構成の方針

```
app/
├── Http/Controllers/    # HTTPの責務のみ
├── Services/            # ビジネスロジック
├── Models/              # Eloquentモデル
├── Enums/               # Enum定義
└── Actions/             # 単一責務のアクションクラス（複雑な処理）
```

- Fat Controllerにしない
- Fat Modelにしない
- ServiceクラスはLaravelのサービスコンテナに登録する

---

## ExecPlans

複雑な機能の実装や大きなリファクタリングを行う場合は、ExecPlan（`.agent/PLANS.md` に定義）に従って設計から実装まで進める。

- 実装前に必ずExecPlanを作成し、設計を確定させてから着手する
- ExecPlanは生きたドキュメント。実装中に発見したことや設計変更は必ず記録する
- ExecPlanだけを読めば、前提知識なしに実装を完遂できる状態を維持する
- 小さな修正・バグ修正はExecPlan不要。複雑な機能・複数ファイルにまたがる変更には必須

ExecPlanの書き方の仕様は [.agent/PLANS.md](.agent/PLANS.md) を参照。

## 開発フロー

1. タスクの複雑さを判断する
   - シンプルな修正 → そのまま実装
   - 複雑な機能・大きな変更 → ExecPlanを作成してから実装
2. 実装前にこのAGENTS.mdの設計原則・用語定義を確認する
3. 実装後にボーイスカウトルールを適用する
4. ExecPlanのProgressセクションを更新する

---

## オプション機能の扱い

Claude API・Slack APIはオプション機能。未設定でもコア機能が動作する設計を維持する。

```php
// 良い例：オプション機能は条件付きで実行
if (config('services.claude.api_key')) {
    $summary = $this->aiService->generateSummary($engineer, $project);
}

// 悪い例：オプション機能が必須になっている
$summary = $this->aiService->generateSummary($engineer, $project); // API未設定で例外
```
