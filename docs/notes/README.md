# ノートと補助メモ

このディレクトリには、単一論点の補助設計メモや深掘りメモを置きます。`architecture/` の設計書よりスコープを狭くし、個別の判断を固定するための文書です。

---

## 1. 現在の文書

| 文書 | 役割 |
|------|------|
| [contract-work-record-design.md](./contract-work-record-design.md) | `contract_party_type` と `WorkRecordRevision` の詳細判断 |
| [legal-guardrails-for-outsourcing.md](./legal-guardrails-for-outsourcing.md) | 業務委託前提を崩さないための法務・UI・権限上のガードレール |

---

## 2. 置くべきもの

- 単一モデルや単一カラムの設計メモ
- 実装前に判断を固定したい個別論点
- 将来 `architecture/` に昇格する可能性はあるが、現時点ではスコープが狭いメモ

一方で、複数機能にまたがる継続的な設計判断は `architecture/` に置きます。
