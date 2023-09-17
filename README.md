# 芝生祭企画WEB投票システム

**Under development.**

## 注意点

- 内部のURLは、2023年9月29日〜2023年12月11日のみ有効です。
- 使用する場合は、環境変数にDBの各種情報を入れる必要があります。

## 説明

- public/ 以下がWEBサーバー上に公開されます。
- public/vote/.envに以下のようにDB接続情報を記述してください。
| key         | value    |
| ---         | ---      |
| DB_NAME     | DB名     |
| DB_HOST     | host     |
| DB_USER     | User名   |
| DB_PASSWORD | password |

## ToDo
- [ ] CSS書く
    - [ ] 共通
    - [ ] vote.php, edit.php

- [ ] DBControllClassを書く
    - [x] 環境変数設定
    - [x] DBのテーブルcreate
    - [x] connectDB()
    - [ ] select
    - [ ] update

- [ ] vote.phpを書く
    - [ ] CSVからの表示

- [ ] edit.phpを書く
    - [ ] CSVからの表示
    - [ ] 過去の回答の自動checked

- [ ] 送信先phpファイルを書く
    - [ ] POST受信からのDBControllClass
    - [ ] 感謝ページ

- [ ] 返信用メアド作成

- [ ] Unitテスト書く
    - [ ] UidClass
    - [ ] DBControllClass
    - [ ] 他手動テスト用
