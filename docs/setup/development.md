# 開発環境セットアップ

この文書は、Tulpa のコードや設計をローカルで確認したい開発者向けの暫定セットアップ手順です。

Tulpa はまだ開発中です。ここに書く内容は、完成版アプリの導入手順ではなく、実装作業やローカル確認のための手順として扱います。

---

## 前提

- PHP 8.2 以上
- Composer
- MySQL 8.0 以上または MariaDB 10.6 以上

Laravel の dev 依存を含めてセットアップするため、`composer install --no-dev` は使いません。

---

## 暫定セットアップ手順

```bash
git clone https://github.com/yama/tulpa.git
cd tulpa
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
```

必要なアプリ設定や追加手順は、実装の進行に合わせてこの文書へ追記します。

---

## 注意点

- この手順はローカル開発用です
- 本番導入時の手順、バックアップ、ログ運用、障害対応は別文書で整理します
- 共有ホスティング前提の導入制約は [../architecture/hosting-and-operations-constraints.md](../architecture/hosting-and-operations-constraints.md) を参照してください
