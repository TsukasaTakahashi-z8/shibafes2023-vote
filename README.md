# 芝生祭企画WEB投票システム

**Under development.**

## 注意点

- 内部のURLは、2023年9月29日〜2023年12月11日のみ有効です。

## 説明

- public/ 以下がWEBサーバー上に公開されます。
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
- [ ] CSS書く
    - [ ] 共通
    - [ ] vote.php, edit.php

- [x] DBControllClassを書く
    - [x] 環境変数設定
    - [x] DBのテーブルcreate
    - [x] connectDB()
    - [x] select
    - [x] update

- [x] voteform.phpを書く
    - [x] CSVからの表示
    - [x] CSVからの表示(画像)

- [x] edit.phpを書く
    - [x] CSVからの表示
    - [x] 過去の回答の自動checked

- [ ] 送信先phpファイルを書く
    - [x] POST受信からのDBControllClass
    - [x] 感謝ページ

- [ ] 返信用メアド作成

- [ ] Unitテスト書く
    - [ ] UidClass
    - [ ] DBControllClass
    - [ ] 他手動テスト用
