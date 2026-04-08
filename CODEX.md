# CODEX.md

Codex エージェントへのエントリーポイントです。
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

## Codex 利用時の運用メモ

- 権限境界の判断基準は [`.agents/knowledge/agent-authority.md`](.agents/knowledge/agent-authority.md) を参照する
- `git commit` 後の学び記録リマインダーを有効化するには、初回だけ `bash scripts/setup-git-hooks.sh` を実行する
- フック有効化後はエージェント種別に関係なく `post-commit` で同じリマインダーが表示される
- 学びの記録・昇格・棚卸しの流れは [`.agents/agent-improvement.md`](.agents/agent-improvement.md) を共通で使う
