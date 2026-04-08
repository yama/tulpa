# CLAUDE.md

Claude Code エージェントへのエントリーポイントです。
**作業を始める前に、必ず [AGENTS.md](AGENTS.md) を読んでください。**

---

## このリポジトリの概要

**Tulpa** はフリーランスエンジニアとエージェントの業務をAIで繋ぐOSSです。
詳細は [docs/requirements.md](docs/requirements.md) を参照してください。

---

## 実装前の読書順

[AGENTS.md](AGENTS.md) に記載の通り、次の順で読んでから実装に入ること。

1. `AGENTS.md` — 設計原則・用語・コーディング規約
2. `docs/requirements.md` — MVP要件・フェーズ境界
3. `docs/context-loading-guide.md` — 対象領域の読書パス
4. 対象設計書 → `docs/architecture/open-questions.md`
5. 複雑な変更なら対象の ExecPlan

---

## Claude Code 固有の設定

### 自動フック（`.claude/settings.json`）

このリポジトリには `.claude/settings.json` に PostToolUse フックが設定されています。
`git commit` 完了後、学びの記録を促すリマインダーが表示されます。

フックの目的は **実行忘れの防止** です。記録の要否はエージェント自身が判断してください。

補足:
- リマインダー本体は `scripts/after-commit-reminder.sh` を共通利用する
- Codex など他エージェントで同じ挙動を有効化する場合は `bash scripts/setup-git-hooks.sh` を実行する

### エージェント権限境界

何を自律的に行ってよいか、何は確認が必要かは
[`.agents/knowledge/agent-authority.md`](.agents/knowledge/agent-authority.md) を参照してください。

---

## エージェント自己改善の仕組み

学びの記録・昇格・棚卸しは `.agents/` ディレクトリ以下の仕組みを使います。
詳細は [`.agents/agent-improvement.md`](.agents/agent-improvement.md) を参照してください。
