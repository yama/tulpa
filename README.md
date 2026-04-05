# Tulpa

![PHP](https://img.shields.io/badge/PHP-8.2%2B-777BB4?logo=php&logoColor=white)
![Laravel](https://img.shields.io/badge/Laravel-12-FF2D20?logo=laravel&logoColor=white)
![Status](https://img.shields.io/badge/Status-In%20Development-2563eb)
![Development](https://img.shields.io/badge/Development-AI%20Driven-0f766e)
![License](https://img.shields.io/badge/License-MIT-16a34a)

> 案件を中心に、フリーランスエンジニアとエージェントの業務をつなぐ OSS

Tulpa は、フリーランスエージェント業務を整理するためのオープンソースソフトウェアです。案件、契約、稼働記録を案件中心でつなぎ、属人的になりやすい運用をシンプルに扱える状態を目指します。

AI はオプション機能として扱います。Tulpa のコアは、AI がなくても動く業務基盤です。

---

## まず読む場所

- プロダクト全体像: [docs/requirements.md](docs/requirements.md)
- ドキュメント入口: [docs/README.md](docs/README.md)
- 実装ロードマップ: [docs/architecture/mvp-implementation-roadmap.md](docs/architecture/mvp-implementation-roadmap.md)
- 進捗管理: [docs/architecture/mvp-wbs.md](docs/architecture/mvp-wbs.md)
- レンタルサーバ前提の実装制約: [docs/architecture/hosting-and-operations-constraints.md](docs/architecture/hosting-and-operations-constraints.md)
- AI 実装時の読書順: [docs/context-loading-guide.md](docs/context-loading-guide.md)

---

## Tulpa が解決したいこと

- 稼働記録、契約、クライアント情報が別々のツールに散らばる状態を減らす
- エンジニア、エージェント、クライアントのやり取りを案件単位で追いやすくする
- 月次の稼働報告と確認フローをスマホ前提で扱いやすくする
- スキルシートと案件情報を、将来のマッチング支援へつながる形で管理する

---

## 画面イメージ

エンジニア向けダッシュボードのモックです。案件、稼働状況、通知を一画面で把握できる構成を目指しています。

![Tulpa dashboard mock](docs/images/dashboard-mock.png)

スマホ向けモックです。PWA を前提に、移動中でも主要導線へすぐ入れる構成を想定しています。

![Tulpa mobile mock](docs/images/sp-mock.png)

現在のモックには将来機能を含む場合があります。

---

## MVP の対象範囲

MVP では、まず次を対象にします。

- 4 ロールの認証・認可
- クライアント企業、担当者、案件、契約の管理
- エンジニア管理とスキルシート
- 稼働記録の入力
- 月次稼働報告の提出、差戻し、確認
- PWA 基本対応
- 年間カレンダービュー

次は MVP 後の拡張です。

- 支払通知、請求書の自動生成
- CRM 機能
- Claude API によるマッチング支援
- Slack 連携
- 外部サービス連携

詳細は [docs/requirements.md](docs/requirements.md) を参照してください。

---

## 開発の進め方

Tulpa は、要件と設計を先に固定し、その上で AI を使って実装を進める構成を取っています。

```text
Requirements
  -> Architecture Docs
  -> MVP Roadmap
  -> MVP WBS
  -> ExecPlan
  -> Implementation
```

各文書の役割は次の通りです。

- [AGENTS.md](AGENTS.md)
  AI エージェント向けの原則、用語、実装制約
- [docs/requirements.md](docs/requirements.md)
  プロダクト全体の SSOT
- [docs/architecture/mvp-implementation-roadmap.md](docs/architecture/mvp-implementation-roadmap.md)
  マイルストーン単位の実装順
- [docs/architecture/mvp-wbs.md](docs/architecture/mvp-wbs.md)
  簡易進捗管理
- [docs/architecture/hosting-and-operations-constraints.md](docs/architecture/hosting-and-operations-constraints.md)
  レンタルサーバ前提での実装制約と運用前提
- [.agents/PLANS.md](.agents/PLANS.md)
  ExecPlan の仕様

---

## 技術スタック

軽量構成を維持し、レンタルサーバーでも動かしやすい構成を目指します。

| カテゴリ | 技術 |
|------|------|
| バックエンド | PHP 8.2+ / Laravel 12 |
| フロントエンド | Alpine.js + htmx / Tailwind CSS |
| データベース | MySQL 8.0+ / MariaDB 10.6+ |
| オプション | Claude API / Slack API |
| モバイル | PWA |

---

## 現在の提供状態

Tulpa はまだ開発中です。現時点では、エージェント会社や個人事業主がそのまま業務投入できる完成版アプリとしては提供していません。

この README にある手順は、現状のコードや設計を確認したい開発者向けの暫定情報です。実運用を前提とした導入手順、バックアップ方針、運用手順は、実装と設計の確定に合わせて別途整理します。

- 開発者向けセットアップ: [docs/setup/development.md](docs/setup/development.md)
- 導入ガイドの受け皿: [docs/setup/installation.md](docs/setup/installation.md)

---

## 開発環境の暫定セットアップ

```bash
git clone https://github.com/yama/tulpa.git
cd tulpa
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
```

`--no-dev` は本番配布や検証用ビルドを想定したオプションであり、現段階の開発セットアップ手順としては使いません。

詳細は [docs/setup/development.md](docs/setup/development.md) を参照してください。

本番導入向けの正式なインストールガイドは未整備です。共有ホスティングを含む配布・運用手順は、MVP の実装と運用要件が固まった段階で [docs/setup/installation.md](docs/setup/installation.md) に整理します。

---

## リポジトリ案内

- プロダクトと設計の文書: [docs/README.md](docs/README.md)
- AI エージェント向けガイド: [AGENTS.md](AGENTS.md)
- ExecPlan 仕様: [.agents/PLANS.md](.agents/PLANS.md)
- エージェント改善運用ガイド: [.agents/agent-improvement.md](.agents/agent-improvement.md)

### `.agents` 配下の構成

AI エージェント運用に関するファイルは `.agents/` 配下へ集約しています。

| 場所 | 役割 | 主な中身 |
|------|------|---------|
| `.agents/` | エージェント運用のルール・知識・計画・補助コマンドを置く | `PLANS.md`、`agent-improvement.md`、`plans/`、`skills/`、`learnings/`、`knowledge/`、`scripts/` |
| `.agents/scripts/` | `.agents/` の内容を記録・集約・監査するための CLI を置く | `record_learning.php`、`summarize_learnings.php`、`propose_agent_updates.php`、`refresh_memory.php`、`audit_learnings.php` |

要するに、`.agents/` は AI エージェント運用のまとまり全体で、`.agents/scripts/` はその中の更新・棚卸し用ツールです。

---

## ライセンス

MIT License
