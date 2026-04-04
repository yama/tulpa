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
.agents/
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
- **根拠を記録する**: どの文書を読んで、どの境界を採用したかを ExecPlan に明記する

### 文体

- 散文（prose）を基本とする。箇条書き・チェックリストは乱用しない
- 専門用語を使う場合は直後に定義する
- 「前述の通り」「アーキテクチャドキュメントによれば」は使わない。必要な説明はここに書く

---

## ExecPlanのスケルトン

以下をコピーして `.agents/plans/{連番}-{機能名}.md` として保存し、肉付けしてください。

---

# {短く・行動指向の説明}

このExecPlanは生きたドキュメントです。`Progress`・`Surprises & Discoveries`・`Decision Log`・`Outcomes & Retrospective` の各セクションは実装の進行に合わせて随時更新してください。

このドキュメントは [.agents/PLANS.md](.agents/PLANS.md) の仕様に従っています。

## Purpose / Big Picture

このExecPlanを完了すると何ができるようになるか、どうすれば動作を確認できるかを数文で説明します。ユーザーが目にする変化を中心に書いてください。

## Source Documents

このタスクの判断根拠にした文書を列挙します。最低限、`AGENTS.md`、`docs/requirements.md`、対象領域の設計書、`docs/architecture/open-questions.md` の確認結果を残してください。必要なら、どの章やどの節を根拠にしたかも書きます。

## Scope Boundary

このタスクで MVP として実装する範囲、やらない範囲、Phase 2/3 へ送る範囲を明記します。対象外にした理由も短く残します。

## Open Questions Check

`docs/architecture/open-questions.md` を確認し、このタスクに影響する項目があるかを書きます。影響がある場合は、実装を止めるのか、運用確定として扱うのか、将来送りとして無視するのかをここで固定します。

## Terminology Check

`AGENTS.md` の用語定義と衝突しないことを確認します。特にモデル名、画面ラベル、URL、状態名で別名を持ち込む場合は、その理由を書きます。

## Design Priority

文書間で迷いが出た場合の優先順位を書きます。基本は `AGENTS.md -> docs/requirements.md -> architecture docs -> notes -> ExecPlan 内の補足判断` とします。今回のタスクで例外がある場合だけ明記します。

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

この節では、`Source Documents` に書いた文書のうち、実装に直接効く前提を要約して埋め込みます。単に文書名を並べるだけで終わらせません。

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

---

## 追加ガイド

- `docs/context-loading-guide.md` に従って読書順を固定してから ExecPlan を書く
- `Source Documents` は文書名だけでなく、どの判断に使ったかまで残す
- `Open Questions Check` を飛ばさない。未確認のまま実装へ進めない
- `Scope Boundary` が弱い ExecPlan は、MVP と将来対応の混線を招くので差し戻す
