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

## DB構成

以下の2テーブルで構成されます。

- vote
- exhibition

### vote

| column          | 説明                                |
| ---             | ---                                 |
| id              | ユーザid                            |
| votedtimes      | 累計投票、投票内容編集回数          |
| best_exhibition | 最も良いと選択した企画id            |
| best_poster     | 最も良いと選択したポスターの企画id  |
| email           | 返信用email。(任意)                 |
| impression      | 感想欄                              |

```bash
mysql> describe vote;
+-----------------+------------+------+-----+---------+----------------+
| Field           | Type       | Null | Key | Default | Extra          |
+-----------------+------------+------+-----+---------+----------------+
| id              | int        | NO   | PRI | NULL    | auto_increment |
| voted_times     | int        | YES  |     | 0       |                |
| best_exhibition | int        | YES  |     | NULL    |                |
| best_poster     | int        | YES  |     | NULL    |                |
| email           | text       | YES  |     | NULL    |                |
| impression      | mediumtext | YES  |     | NULL    |                |
+-----------------+------------+------+-----+---------+----------------+
```

### exhibition

| column    | 説明 |
| ---       | ---  |
| id        | 各企画に割り当てられるid |
| category  | 集計時に使用される企画の分類(ステージ or 展示 or 体験) ここでは特に使用していません。 |
| title     | 企画名 |
| club_name | 出展団体名 |

```bash
mysql> describe exhibition;
+-----------+---------------+------+-----+---------+----------------+
| Field     | Type          | Null | Key | Default | Extra          |
+-----------+---------------+------+-----+---------+----------------+
| id        | int           | NO   | PRI | NULL    | auto_increment |
| category  | varchar(10)   | NO   |     | NULL    |                |
| title     | varchar(1023) | NO   |     | NULL    |                |
| club_name | varchar(1023) | NO   |     | NULL    |                |
+-----------+---------------+------+-----+---------+----------------+
```

## 動作確認
- Debian12
    - Vivaldi 6.1.3035.302 (Stable channel) stable (64-bit) 

- Windows11
    - Google Chrome 116.0.5845.188 (Official Build) (64bit)
    - Vivaldi 6.1.3035.302 (Stable channel) stable (64-bit) 

- iOS17.0
    - Safari 16.6

- iOS15.5
    - Safari 15.5

- iPadOS16
    - Safari 16.3

## ToDo

- [ ] Unitテスト書く
- [ ] DB出力機能の追加(?)
