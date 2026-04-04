# 要件定義書から実装向け補助ドキュメントを整備する

このExecPlanは生きたドキュメントです。`Progress`・`Surprises & Discoveries`・`Decision Log`・`Outcomes & Retrospective` の各セクションは実装の進行に合わせて随時更新してください。

このドキュメントは [.agents/PLANS.md](./PLANS.md) の仕様に従っています。

## Purpose / Big Picture

`docs/requirements.md` は Tulpa の全体構想として十分に強いが、実装時に参照するには章の守備範囲が広い。今回の作業を完了すると、要件定義書を SSOT として維持しつつ、権限、データモデル、稼働記録と月次報告、案件と契約ライフサイクルをそれぞれ独立した補助ドキュメントとして参照できるようになる。レビュー担当者や実装担当者は、該当機能の文書だけを開けば主要な判断境界と受け入れ条件を追える状態を目指す。

## Progress

- [x] （2026-04-04 16:10 JST）既存の要件定義書とドキュメント運用ルールを確認した
- [x] （2026-04-04 16:18 JST）追加する補助ドキュメントの構成を決めた
- [x] （2026-04-04 16:26 JST）ExecPlan を作成し、ドキュメント追加方針を固定した
- [x] （2026-04-04 16:32 JST）`docs/README.md` を追加し、文書の役割分担を明記した
- [x] （2026-04-04 16:32 JST）権限・データモデル・稼働記録・契約ライフサイクルの補助ドキュメントを追加した
- [x] （2026-04-04 16:44 JST）画面設計を `architecture/ui-and-screen-design.md` に整理し、検索しやすい配置へ再構成した
- [x] （2026-04-04 16:44 JST）要件定義書から新規ドキュメントへの導線を追加した
- [ ] 差分を確認し、ExecPlan の結果を更新する

## Surprises & Discoveries

- Observation: `docs/requirements.md` はすでにスコープ境界、AI責任境界、非機能要件まで含んでおり、要件の不足よりも「実装向けに読む単位が大きい」ことが主な課題だった。
  Evidence: 章 3 から章 7 に、役割、コア機能、画面設計、非機能要件、データモデルが一通り含まれている。

## Decision Log

- Decision: 新規文書は要件書の代替ではなく補助設計書として位置付け、要件書の文言を大きく分解し直さない。
  Rationale: `docs/requirements.md` は全体構想の SSOT としてすでに機能しているため、別文書へ責務を移し過ぎると整合維持コストが増える。
  Date/Author: 2026-04-04 / Codex
- Decision: 最初の整備対象は `権限`, `データモデル`, `稼働記録と月次報告`, `案件と契約ライフサイクル` の4領域に絞る。
  Rationale: いずれも実装判断の曖昧さが出やすく、既存の `contract-work-record-design.md` と自然に連携できるため。
  Date/Author: 2026-04-04 / Codex
- Decision: 文書配置は `docs/` 直下へ並べず、`architecture/` と `notes/` に分類する。
  Rationale: 文書が増えたときに「画面設計はどこか」「個別メモはどこか」がすぐ分かる構成を優先するため。
  Date/Author: 2026-04-04 / Codex

## Outcomes & Retrospective

この作業により、Tulpa のドキュメントは `requirements.md` を起点に `architecture/` と `notes/` へ分かれる構成になった。画面設計の所在も `architecture/ui-and-screen-design.md` として明示されたため、今後の追加文書は分類規則に従って配置しやすくなった。残作業はリンク切れや表記揺れの確認のみである。

## Context and Orientation

作業開始時点のドキュメントは [docs/requirements.md](/home/yamamoto/ghq/github.com/yama/tulpa/docs/requirements.md) と [docs/notes/contract-work-record-design.md](/home/yamamoto/ghq/github.com/yama/tulpa/docs/notes/contract-work-record-design.md) を中心とした最小構成だった。前者は Tulpa の全体構想と段階的スコープを記した要件定義書であり、後者は `Contract` と `WorkRecord` 周辺の補助設計メモである。AGENTS.md では、複雑な変更や複数ファイルにまたがる変更では ExecPlan を先に作成すること、用語の SSOT を守ること、要件書を起点に関連文書を整備することが求められている。

今回追加する文書は、`docs/requirements.md` の章 3, 4, 5, 7 を実装向けに読みやすい単位へ整理する役割を持つ。Laravel 実装へ直接つながる境界として、ロール別アクセス制御、主要エンティティの責務、稼働記録から月次報告までの状態遷移、案件・契約の関係と履歴保持を明文化する。

## Plan of Work

最初に `docs/README.md` を追加し、どの文書が SSOT で、どの文書が補助設計かを明記する。次に `docs/architecture/` を作り、主要な設計書をここへ集約する。`docs/architecture/data-model.md` では主要エンティティ、MVP と将来機能の境界、履歴保持と参照関係を整理する。`docs/architecture/access-control-and-roles.md` では 4 ロールの閲覧・操作境界、強いアクセス制御が必要な情報、将来拡張時の判断基準を定義する。`docs/architecture/workflows/work-record-and-report-design.md` では稼働記録の入力方式、修正履歴、月次報告の状態遷移、差戻し後の挙動をまとめる。`docs/architecture/workflows/project-contract-lifecycle.md` ではクライアント、案件、契約、契約履歴、契約終了後の扱いまでを整理する。画面設計は `docs/architecture/ui-and-screen-design.md` として要件書 5 章の入口を分離し、単一論点の補助メモは `docs/notes/` へ置く。最後に `docs/requirements.md` に新規文書への参照導線を足し、文書群全体の入口を整える。

## Concrete Steps

    cd /home/yamamoto/ghq/github.com/yama/tulpa
    sed -n '1,260p' .agents/PLANS.md
    # → ExecPlan の必須要件を確認できる

    rg '^## |^### ' -n docs/requirements.md
    # → 要件書の章構成を把握できる

    git status --short
    # → 作業開始前にワークツリーがクリーンであることを確認できる

    git diff -- docs .agents/plans
    # → 追加した文書と要件書の導線変更をまとめて確認できる

## Validation and Acceptance

`docs/README.md` を読めば、要件定義書と補助設計書の役割分担がわかること。`docs/architecture/README.md` を読めば、権限、データ、UI、ワークフロー文書の所在がわかること。各補助設計書を単独で読んだとき、対象範囲、主要な判断、状態遷移または責務境界、受け入れ条件が確認できること。`docs/requirements.md` から新規文書への導線があり、既存の個別メモと矛盾しないことを `git diff` と目視で確認する。

## Idempotence and Recovery

今回の作業はドキュメント追加と既存文書へのリンク追記のみであり、複数回編集してもアプリケーション状態には影響しない。文言の過剰な重複や矛盾が見つかった場合は、要件書を SSOT として新規文書側を修正する。大きく方針を変える必要が出た場合は、この ExecPlan の `Decision Log` を更新してから再編集する。

## Artifacts and Notes

重要な成果物は以下の想定である。

    docs/README.md
    docs/architecture/README.md
    docs/architecture/data-model.md
    docs/architecture/access-control-and-roles.md
    docs/architecture/ui-and-screen-design.md
    docs/architecture/workflows/work-record-and-report-design.md
    docs/architecture/workflows/project-contract-lifecycle.md
    docs/notes/contract-work-record-design.md

## Interfaces and Dependencies

外部ライブラリや実行時依存は増やさない。依存先は既存文書のみであり、用語・スコープ・オプション機能の扱いは [AGENTS.md](/home/yamamoto/ghq/github.com/yama/tulpa/AGENTS.md) と [docs/requirements.md](/home/yamamoto/ghq/github.com/yama/tulpa/docs/requirements.md) に従う。`contract_party_type` と `work_record_revisions` の詳細は [docs/notes/contract-work-record-design.md](/home/yamamoto/ghq/github.com/yama/tulpa/docs/notes/contract-work-record-design.md) を参照関係として扱う。
