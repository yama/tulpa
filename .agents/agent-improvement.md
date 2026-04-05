# エージェント自己改善ガイド

## 目的

Tulpa で AI エージェントがチャット、設計、実装、レビューを通じて得た学びを、次の作業に再利用できる形へ圧縮して残すための運用ガイドである。
目的は「たくさん書き残すこと」ではなく、「再発しやすい判断を短く正確に共有すること」にある。

## 設計方針

この仕組みは、学びの保存とルールへの昇格を意図的に分離する。

- `AGENTS.md` は原則、用語、判断基準の SSOT とする
- `.agents/skills/*/SKILL.md` は実行手順と使い分けを置く
- `.agents/skills/*/references/` は詳細パターン、失敗例、補足ルールを置く
- `.agents/learnings/` は生の学びを置く
- `.agents/knowledge/` は人間向けに整理済みの知識や索引を置く
- `.agents/knowledge/MEMORY.md` は整理済み知識の入口として使う
- 運用契約は `.agents/*.md` に置き、スキルはその契約を実行する手順として扱う

この分離により、実務のたびに観察は記録できる一方で、最上位文書を肥大化させずに済む。

## 改善ループ

1. 学びを記録する
チャット、実装、レビュー、検証で得た学びを `.agents/learnings/*.json` に保存する。

2. 学びを要約する
一定量たまったらトピック別に集約し、再発している論点を見つける。

3. 昇格候補を作る
横断的に効くルールだけを、`AGENTS.md`、スキル、参照資料のどこへ置くべきか判断する。

4. 人間または担当エージェントがレビューする
最終的な更新は提案ベースで行い、誤学習や一時的事情を固定化しない。

## 昇格基準

次のいずれかを満たす学びだけを昇格候補にする。

- 同じ論点が2回以上発生している
- `confidence=high` で、広い作業範囲に再利用できる
- 再発防止やレビュー品質に直接効く
- Tulpa 固有の用語、設計原則、運用境界に関わる

次のものは昇格させない。

- 一度しか起きていないローカル事情
- 一時的なツール不調や外部障害
- 実装中の思いつきで、ルールにするには根拠が弱いもの
- `AGENTS.md` に載せるには細かすぎる例外処理

## 置き場所の判断

`AGENTS.md` に置くもの:

- プロジェクト全体に効く原則
- 用語、命名、設計境界
- 「何をどこに書くか」という情報アーキテクチャの規則
- プロジェクト全体に効くメタな振る舞い

スキルの `SKILL.md` に置くもの:

- 特定の作業タイプで毎回守る短い手順
- スキルの発火条件と実行順
- 運用契約を具体的な作業へ落とす手順

スキルの `references/` に置くもの:

- 具体的なレビュー観点
- よくある失敗例
- 詳細な判断基準

`.agents/knowledge/` に置くもの:

- トピック別の要約
- 用語集、分類表、索引
- 複数スキルにまたがる整理済み知識
- 棚卸し対象とアーカイブ方針

`.agents/learnings/` に置くもの:

- 生の観察
- 実装時の小さな発見
- まだ昇格させるべきか確信がないメモ

## 圧縮ルール

肥大化を防ぐため、次のルールを守る。

- 1つの学びにつき 1つの論点だけを書く
- `title` は短く、`observation` と `impact` を分ける
- 同じ論点の詳細事例を `AGENTS.md` に重ね書きしない
- 似た学びが増えたら、新規ルールを増やす前に既存ルールへ統合できないか確認する
- 古くなった学びは `superseded` にして、消すよりも失効を明示する
- 整理済み知識は `MEMORY.md` から辿れる状態を維持する

## JSON スキーマ

`.agents/learnings/*.json` は次のキーを持つ。

```json
{
  "id": "20260404T165000+0900-agents-md-principle-only",
  "recorded_at": "2026-04-04T16:50:00+09:00",
  "source": "implementation",
  "scope": "agent-workflow",
  "title": "AGENTS.md should stay principle-only",
  "observation": "Detailed examples belong outside AGENTS.md.",
  "impact": "Keeps the top-level guide compact.",
  "candidate_rule": "Promote only stable cross-cutting rules into AGENTS.md.",
  "confidence": "high",
  "promotion_target": "AGENTS.md",
  "status": "captured",
  "evidence": [
    "The repository already separates SKILL.md from references."
  ],
  "related_files": [
    "AGENTS.md",
    ".agents/skills/document-writing/SKILL.md"
  ]
}
```

## 推奨コマンド

```bash
php .agents/scripts/record_learning.php \
  --source=implementation \
  --scope=agent-workflow \
  --title='AGENTS.md should stay principle-only' \
  --observation='Detailed examples belong outside AGENTS.md.' \
  --impact='Keeps the top-level guide compact.' \
  --candidate-rule='Promote only stable cross-cutting rules into AGENTS.md.' \
  --confidence=high \
  --promotion-target=AGENTS.md \
  --related-file=AGENTS.md

php .agents/scripts/summarize_learnings.php

php .agents/scripts/propose_agent_updates.php

php .agents/scripts/refresh_memory.php

php .agents/scripts/audit_learnings.php
```

## 運用のコツ

- 実装中の発見は、まず ExecPlan の `Surprises & Discoveries` に書き、その後で再利用価値があるものだけを `learnings` に切り出す
- 1回の作業で大量の学びを残すより、後で検索しやすい短い単位に分ける
- レポート生成の結果、昇格候補が多すぎる場合はルールを増やすのではなく分類軸を見直す
- `AGENTS.md` を編集するときは、既存ルールを置き換えるのか、参照先を追加するのかを先に決める
- 整理済み知識を追加したら `.agents/knowledge/MEMORY.md` の索引も更新する
- `.agents/knowledge/` にファイルを追加・削除したら `php .agents/scripts/refresh_memory.php` を実行する
- learnings が増えたら `php .agents/scripts/audit_learnings.php` で重複と棚卸し候補を確認する
- 「これは規約か、スキルか」で迷ったら `.agents/knowledge/meta-behavior.md` を先に見る
