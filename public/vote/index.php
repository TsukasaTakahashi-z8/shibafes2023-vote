<?php
require("./functions.php");
require("../vendor/autoload.php");
use Hashids\Hashids;
$uid_check = new UidClass($_GET['uid']);
$uid_check->redirect();
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>第68回2023芝生祭投票ページ</title>
    <link href="./img/favicon.ico" rel="icon" />
    <link href="./css/common.css" rel="stylesheet" />
    <link href="./css/index.css" rel="stylesheet" />
    <link href="./css/voteform.css" rel="stylesheet" />
</head>
<body>
    <main>
        <h1>第68回芝生祭 投票ページ</h1>
        <p>ご来場時に配布されましたパンフレットをご用意ください。<br>以下に、パンフレットの裏表紙の二次元コード部分に記載されている英数字を入力してください。</p>
        <p>QRコードをカメラアプリ等で直接読み込んでいただくことで、入力を省くことも可能です。</p>
        <form action="/vote/voteform.php" method="GET">
            <label for="uid">パンフレット裏表紙に記載の英数字：</label>
            <input type="text" id="uid" name="uid">
            <input type="submit" id="submit" value="OK">
        </form>
    </main>
</body>
</html>
