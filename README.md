# 芝生祭企画WEB投票システム

## 注意点

- 内部のURLは、2023年9月29日〜2023年12月11日のみ有効です。

## 説明

- public/ 以下がWEBサーバー上に公開されます。
- public/vote/img/favicon.ico にファビコンを設定してください。
- public/vote/img/下に{企画id}.{png, gmp等}の企画ポスターを保存してください。
- public/vote/.envに以下のようにDB接続情報を記述してください。

| key         | value    |
| ---         | ---      |
| DB_NAME     | DB名     |
| DB_HOST     | host     |
| DB_USER     | User名   |
| DB_PASSWORD | password |

- public/.envに、以下の情報を記述してください。MYIPは、db_operation.php等からDB制御する際に必要です。ハッシュソルトは、DBのIDをハッシュ化し、QRのUIDにするときに使ったものです。

| key  | value          |
| ---  | ---            |
| MYIP | グローバルIP   |
| SALT | ハッシュソルト |

## ToDo

- [ ] Unitテスト書く
- [ ] DB出力機能の追加(?)
