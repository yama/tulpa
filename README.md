# Tulpa

> Freelance agent management system powered by AI

フリーランスエンジニアとエージェントの業務を、AIを使ってシンプルに繋ぐOSSです。

---

## なぜTulpaか

フリーランスエージェント業界には、データは揃っているのにAIで繋がっていないという問題があります。

- スキルシートと案件要件が揃っているのに、マッチングは手書きのテキスト
- 勤怠・契約・支払いの情報が別々の画面に散らばっている
- コミュニケーションがメール・電話・LINEに分散し、案件と紐付かない

Tulpaはこれらを解消するための、**案件・クライアントを中心にデータが繋がる**管理システムです。

---

## 主な機能

**エンジニア向け**

- スマホから作業開始・終了を記録する打刻型稼働記録
- 年間カレンダーで稼働時間の見通しを確認
- 契約・支払通知・スキルシートの一元管理

**エージェント向け**

- エンジニアCRM・クライアントCRM（営業活動・次アクション管理）
- Claude APIによるスキルシート×案件要件のAIマッチング
- 候補者サマリーの自動生成

**クライアント向け**

- 稼働報告のオンライン確認・差戻し

---

## 技術スタック

- **PHP 8.2+** / **Laravel 12**
- **Alpine.js + htmx**（ビルド不要）
- **Tailwind CSS**
- **MySQL 8.0+** / **MariaDB 10.6+**
- **Claude API**（AIマッチング・オプション）
- **Slack API**（通知連携・オプション）
- **PWA対応**（スマホからホーム画面追加）

レンタルサーバーでも動作する軽量設計です。

---

## インストール

```bash
git clone https://github.com/yama/tulpa.git
cd tulpa
composer install --no-dev
cp .env.example .env
php artisan key:generate
php artisan migrate
```

詳細は [docs/installation.md](docs/installation.md) を参照してください。

---

## ドキュメント

- [要件定義書](docs/requirements.md)
- [インストールガイド](docs/installation.md)
- [開発計画（PLANS.md）](PLANS.md)
- [AI駆動開発のコンテキスト（AGENTS.md）](AGENTS.md)

---

## 開発について

このプロジェクトはexecPlanの方法論に従い、AI駆動開発の実践例として開発プロセスを透明に公開しています。[PLANS.md](PLANS.md) に開発の経緯と進捗を記録しています。

---

## ライセンス

MIT License
