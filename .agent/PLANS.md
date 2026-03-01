# Codex Execution Plans (ExecPlans)

このドキュメントはTulpaにおけるExecPlanの仕様書です。複雑な機能実装・大きなリファクタリングを行う際は、このドキュメントに従ってExecPlanを作成してから実装を開始してください。

---

## ExecPlanとは

ExecPlanは「完全に自己完結した設計書」です。ExecPlanだけを読めば、このリポジトリに関する前提知識がない人（またはAI）でも、実装を完遂できる状態を目指します。

ExecPlanは生きたドキュメントです。実装中に発見したことや設計変更は必ずExecPlanに記録します。「なぜその判断をしたか」が後から読んでわかることが重要です。

---

## ExecPlanを作成するタイミング

**必要**

- 新しい機能の実装（複数ファイルにまたがるもの）
- 大きなリファクタリング
- データモデルの変更
- 外部API連携（Claude API・Slack API等）の実装

**不要**

- バグ修正
- 小さなUI調整
- 単一ファイルの軽微な変更

---

## ExecPlanの保存場所

```
.agent/
├── PLANS.md              # この仕様書
└── plans/
    ├── 001-auth.md       # 認証・認可
    ├── 002-work-record.md # 稼働記録
    └── ...
```

ファイル名は `{連番}-{機能名}.md` の形式とします。

---

## ExecPlanの書き方

### 原則

- **自己完結**: 外部ドキュメント・ブログ・他のExecPlanへの参照だけで済ませない。必要な知識はExecPlan内に埋め込む
- **初心者向け**: このリポジトリを初めて見る人が読んでも実装できる水準で書く
- **動作する成果物**: コードが書けた、ではなく「動作するものができた」を完了の定義とする
- **観察可能な受け入れ条件**: 「HealthCheckクラスを追加した」ではなく「`/health` にアクセスするとHTTP 200が返る」のように、人間が確認できる形で書く

### 文体

- 散文（prose）を基本とする。箇条書き・チェックリストは乱用しない
- 専門用語を使う場合は直後に定義する
- 「前述の通り」「アーキテクチャドキュメントによれば」は使わない。必要な説明はここに書く

---

## ExecPlanのスケルトン

以下をコピーして `.agent/plans/{連番}-{機能名}.md` として保存し、肉付けしてください。

---

# {短く・行動指向の説明}

このExecPlanは生きたドキュメントです。`Progress`・`Surprises & Discoveries`・`Decision Log`・`Outcomes & Retrospective` の各セクションは実装の進行に合わせて随時更新してください。

このドキュメントは [.agent/PLANS.md](.agent/PLANS.md) の仕様に従っています。

## Purpose / Big Picture

このExecPlanを完了すると何ができるようになるか、どうすれば動作を確認できるかを数文で説明します。ユーザーが目にする変化を中心に書いてください。

## Progress

- [ ] （未着手）ステップ例
- [x] （2026-03-01 09:00Z）完了したステップ例

## Surprises & Discoveries

実装中に発見した予想外の挙動・バグ・最適化・知見を記録します。

- Observation: …
  Evidence: …

## Decision Log

実装中に行ったすべての判断を記録します。

- Decision: …
  Rationale: …
  Date/Author: …

## Outcomes & Retrospective

主要なマイルストーン完了時または全体完了時に、達成したこと・残課題・学びをまとめます。

## Context and Orientation

このタスクに関連する現状を、何も知らない読者向けに説明します。関連するファイルのフルパス・関数名・モジュール名を明示します。前のExecPlanへの参照だけで済ませず、必要な文脈はここに書いてください。

## Plan of Work

編集・追加する内容を散文で説明します。各編集について、ファイル名・場所（関数・クラス）・変更内容を明示します。

## Concrete Steps

実行するコマンドを作業ディレクトリとともに示します。コマンドの出力結果の期待値も記載します。実装が進んだらこのセクションを更新します。

    # 例
    cd /path/to/tulpa
    php artisan make:model WorkRecord -m
    # → app/Models/WorkRecord.php と database/migrations/xxx_create_work_records_table.php が生成される

## Validation and Acceptance

システムをどう起動・操作して何を確認するかを説明します。受け入れ条件は動作として書きます。

    # 例
    php artisan serve でサーバーを起動し、
    http://localhost:8000/work-records にアクセスすると
    稼働記録一覧ページが表示される（ステータスコード200）

## Idempotence and Recovery

手順を複数回実行しても安全かどうか説明します。失敗した場合のリトライ・ロールバック方法を記載します。

## Artifacts and Notes

重要なターミナル出力・差分・コードスニペットをインデントして記載します。

## Interfaces and Dependencies

使用するライブラリ・モジュール・サービスを明示します。作成・変更するクラス・インターフェース・関数シグネチャを具体的に示します。

    # 例
    app/Services/WorkRecordService.php に以下を定義する:

        public function start(Contract $contract, Carbon $startedAt): WorkRecord
        public function end(WorkRecord $record, Carbon $endedAt): WorkRecord
