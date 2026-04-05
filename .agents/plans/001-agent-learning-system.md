# 学びを圧縮しながらエージェント運用へ昇格できる仕組みを整える

このExecPlanは生きたドキュメントです。`Progress`・`Surprises & Discoveries`・`Decision Log`・`Outcomes & Retrospective` の各セクションは実装の進行に合わせて随時更新してください。

このドキュメントは [.agents/PLANS.md](../PLANS.md) の仕様に従っています。

## Purpose / Big Picture

このExecPlanを完了すると、Tulpa リポジトリ内で AI エージェントがチャットや実装から得た学びを構造化して記録し、肥大化を抑えながら `AGENTS.md` やスキルへ昇格候補を提案できるようになる。確認方法は、学びを1件記録し、要約レポートと昇格提案レポートを生成し、`AGENTS.md` が原則だけを保ったまま参照型構成に更新されていることを読む。

## Progress

- [x] （2026-04-04 07:18Z）既存の `AGENTS.md`・`.agents/PLANS.md`・既存スキル構成を確認し、追加先を決めた
- [x] （2026-04-04 07:29Z）学びの保存形式、昇格基準、圧縮方針を設計した
- [x] （2026-04-04 07:42Z）`.agents` 配下の運用ドキュメント、学び記録用ディレクトリ、知識集約用ディレクトリを追加した
- [x] （2026-04-04 07:49Z）学びの記録・要約・昇格提案を行う PHP CLI スクリプトを実装した
- [x] （2026-04-04 07:56Z）`AGENTS.md` と新規スキルを参照型に更新し、検証を実行した
- [x] （2026-04-04 08:07Z）`.agents/knowledge/MEMORY.md` を索引として導入し、アーカイブ方針を追加した
- [x] （2026-04-04 08:16Z）知識索引を再生成する `.agents/scripts/refresh_memory.php` を実装し、運用文書へ反映した
- [x] （2026-04-04 08:32Z）`knowledge` ノートをトピック別に追加し、将来検討の保留先を文書化した
- [x] （2026-04-04 08:39Z）`.agents/scripts/audit_learnings.php` を実装し、重複・保留・失効候補を監査できるようにした
- [x] （2026-04-04 09:03Z）コミットメッセージ規約を運用文書として追加し、実行手順を commit-writing スキルへ分離した

## Surprises & Discoveries

- Observation: 現在のリポジトリは実装コードよりも文書とスキル定義が中心で、エージェント改善基盤は `.agents` のみで完結できる
  Evidence: ルート直下の主要ファイルは `AGENTS.md`、`docs/requirements.md`、`.agents/skills/*` であり、アプリケーションコードはまだ存在しなかった
- Observation: 既存スキルは `SKILL.md` を薄く保ち、詳細を `references/` に逃がす構成になっている
  Evidence: `.agents/skills/document-writing/` と `.agents/skills/requirements-review/` はどちらも `SKILL.md` と `references/` を分離していた
- Observation: YAML より JSON のほうが依存なしで CLI 実装しやすく、初期段階の仕組みとして十分だった
  Evidence: 標準 PHP だけで JSON 読み書きと集約が完結し、追加ライブラリを要求しない
- Observation: `memory` 的な知識置き場は、索引を手作業で維持するだけではすぐにズレる
  Evidence: 整理済み知識が複数ファイルへ増え始めると、入口ファイルの更新を忘れるリスクが高い
- Observation: 将来検討事項は散在させると忘れやすく、思い出すタイミングも曖昧になる
  Evidence: 口頭の提案だけでは次の基盤整備時に参照漏れが起きやすい
- Observation: コミットメッセージのようなメタ運用は、スキルだけに置くと正式ルールの所在が曖昧になる
  Evidence: スキルは手順には向くが、リポジトリ全体の履歴契約を共有する場としては弱い

## Decision Log

- Decision: 学びの一次保存先は `.agents/learnings/*.json` とする
  Rationale: 人間にも読みやすい程度の構造を維持しつつ、依存なしで機械処理できるため
  Date/Author: 2026-04-04 / Codex
- Decision: `AGENTS.md` には詳細ルールを持ち込まず、短いポリシーと参照先だけを追加する
  Rationale: `AGENTS.md` の肥大化を防ぎ、SSOT を原則レベルに保つため
  Date/Author: 2026-04-04 / Codex
- Decision: 自動更新は `learnings` とレポート生成に限定し、`AGENTS.md` やスキル更新は提案ベースにする
  Rationale: 誤学習やノイズの恒久化を避けるにはレビュー境界が必要なため
  Date/Author: 2026-04-04 / Codex
- Decision: 昇格候補は「高信頼」または「同一論点の再発」のどちらかを満たしたものを抽出する
  Rationale: 一度きりの観察を原則へ昇格させないため
  Date/Author: 2026-04-04 / Codex
- Decision: `.agents/knowledge/MEMORY.md` は手動編集前提ではなく、再生成可能な索引として扱う
  Rationale: 整理済み知識が増えても入口ファイルを保守し続けやすくするため
  Date/Author: 2026-04-04 / Codex
- Decision: 将来検討事項は `.agents/knowledge/future-considerations.md` に集約し、`Revisit When` を必須にする
  Rationale: 「いつ思い出すか」が書かれていない保留事項は、実質的に忘れられるため
  Date/Author: 2026-04-04 / Codex
- Decision: コミットメッセージ規約は `.agents/commit-conventions.md` に置き、生成補助は `commit-writing` スキルへ分離する
  Rationale: 規約と手順を分けることで、正式ルールを短く保ちつつ再利用性も確保できるため
  Date/Author: 2026-04-04 / Codex

## Outcomes & Retrospective

エージェント自己改善の入口として、記録・要約・昇格提案の最小ループを導入した。まだ完全自動更新にはしていないが、それは欠点ではなく、知見を圧縮してから原則へ昇格するための意図的な制約である。今後、実案件を通じて `scope` の語彙や昇格ルールの閾値を調整していく余地がある。

## Context and Orientation

`/home/yamamoto/ghq/github.com/yama/tulpa/AGENTS.md` は Tulpa リポジトリにおける AI エージェント向けの最上位ガイドであり、設計原則・用語・ExecPlan 運用を定義している。`.agents/PLANS.md` は複雑な作業の設計書フォーマットを定義している。`.agents/skills/document-writing/SKILL.md` と `.agents/skills/requirements-review/SKILL.md` は、短い `SKILL.md` と詳細 `references/` を分離する構成を採用しており、今回の「肥大化を防ぐ参照型構造」の先例になる。

今回追加する仕組みは、アプリケーション機能ではなくリポジトリ運用基盤である。主な対象は `.agents` 配下の文書・知識ディレクトリ・スキル・CLI スクリプトであり、学びを `capture -> summarize -> propose` の3段階で扱う。

## Plan of Work

まず `.agents/plans/001-agent-learning-system.md` と `.agents/agent-improvement.md` を追加し、保存先、昇格基準、圧縮方針、レビュー境界を文書として定義する。次に `.agents/learnings/` と `.agents/knowledge/` を作成し、前者を一次記録、後者を人間向けの整理済み知識置き場にする。続いて `.agents/scripts/record_learning.php`、`.agents/scripts/summarize_learnings.php`、`.agents/scripts/propose_agent_updates.php` を追加し、標準 PHP だけで記録・要約・提案ができるようにする。

最後に `AGENTS.md` へ短い運用ポリシーを追加し、新しいスキル `.agents/skills/agent-self-improvement/SKILL.md` と参照資料を追加して、今後のエージェントが同じ流儀で知見を扱える状態にする。さらに `.agents/knowledge/MEMORY.md` を知識索引とし、`.agents/scripts/refresh_memory.php` で再生成できるようにする。加えて、トピック別 `knowledge` ノートと `future-considerations.md` を用意し、`.agents/scripts/audit_learnings.php` で棚卸しを補助する。

## Concrete Steps

    cd /home/yamamoto/ghq/github.com/yama/tulpa
    mkdir -p .agents/plans .agents/learnings .agents/knowledge .agents/skills/agent-self-improvement/references .agents/scripts
    # → エージェント改善基盤の保存先が揃う

    php .agents/scripts/record_learning.php \
      --source=implementation \
      --scope=agent-workflow \
      --title='AGENTS.md should stay principle-only' \
      --observation='Detailed examples belong outside AGENTS.md.' \
      --impact='Keeps the top-level guide compact.' \
      --candidate-rule='Promote only stable cross-cutting rules into AGENTS.md.' \
      --confidence=high \
      --promotion-target=AGENTS.md
    # → .agents/learnings/ に JSON ファイルが1件生成される

    php .agents/scripts/summarize_learnings.php
    # → Markdown の要約が標準出力に表示される

    php .agents/scripts/propose_agent_updates.php
    # → 昇格候補と保留候補をまとめた Markdown が標準出力に表示される

    php .agents/scripts/refresh_memory.php --stdout
    # → `.agents/knowledge/` の索引内容が Markdown で標準出力に表示される

    php .agents/scripts/audit_learnings.php
    # → learnings の重複候補、保留候補、失効レコードが Markdown で表示される

## Validation and Acceptance

`php .agents/scripts/record_learning.php ...` を実行すると `.agents/learnings/` に JSON 学びファイルが作成される。`php .agents/scripts/summarize_learnings.php` を実行すると、件数、トピック別集計、直近の学びが Markdown で出力される。`php .agents/scripts/propose_agent_updates.php` を実行すると、`AGENTS.md`・スキル・参照資料のどこへ昇格すべきかを示す Markdown 提案が表示される。`php .agents/scripts/refresh_memory.php --stdout` を実行すると、`.agents/knowledge/MEMORY.md` 相当の索引と将来リマインダが Markdown で表示される。`php .agents/scripts/audit_learnings.php` を実行すると、重複候補、昇格待ち候補、`superseded` レコードが表示される。さらに `AGENTS.md` を読むと、学びの詳細をそこに溜めず、`.agents/agent-improvement.md` を参照する方針が明記されている。

## Idempotence and Recovery

学びの記録は毎回新しい JSON ファイルを追加するだけなので、再実行しても既存データを壊さない。要約・提案・監査スクリプトは読み取り専用で、標準出力への出力だけを行う。知識索引再生成は同じ入力から同じ Markdown を生成するので冪等である。誤った学びを記録した場合は、該当 JSON を削除または `status` を `superseded` に更新して再集計する。

## Artifacts and Notes

    .agents/learnings/20260404T165000+0900-agents-md-principle-only.json
    .agents/agent-improvement.md
    .agents/scripts/record_learning.php
    .agents/scripts/summarize_learnings.php
    .agents/scripts/propose_agent_updates.php
    .agents/scripts/refresh_memory.php
    .agents/scripts/audit_learnings.php

## Interfaces and Dependencies

`.agents/scripts/record_learning.php` は以下の CLI オプションを受け取る:

    --source=<chat|implementation|review|retrospective|other>
    --scope=<topic>
    --title=<short summary>
    --observation=<what was learned>
    --impact=<why it matters>
    --candidate-rule=<promotable rule>
    --confidence=<low|medium|high>
    --promotion-target=<AGENTS.md|skill|reference|none>
    --evidence=<repeatable, comma separated>
    --related-file=<repeatable>
    --status=<captured|promoted|superseded>

`.agents/scripts/summarize_learnings.php` は `.agents/learnings/*.json` を読み、件数・トピック別集計・直近項目を Markdown として返す。

`.agents/scripts/propose_agent_updates.php` は同じ入力から昇格候補を抽出し、`promotion-target` と再発数に基づいて `AGENTS.md`・スキル・参照資料向けの提案文を返す。

`.agents/scripts/refresh_memory.php` は `.agents/knowledge/` と `.agents/learnings/*.json` を読み、索引としての `MEMORY.md` を生成する。`--stdout` で標準出力へ、指定なしで `.agents/knowledge/MEMORY.md` へ書き出す。

`.agents/scripts/audit_learnings.php` は `.agents/learnings/*.json` を監査し、重複した `candidate_rule` や `title`、昇格前に追加証拠が必要な候補、`superseded` レコードを一覧化する。
