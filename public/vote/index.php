<?php
require("./functions.php");
if (!isset($_SESSION['voted-times'])) {
    $uid_check = new UidClass();
    $uid_check->redirect();
}
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>第68回2023芝生祭投票ページ</title>
</head>
<body>
    <p>ご来場時に配布されましたパンフレットをご用意ください。<br>以下に、パンフレットの裏表紙の二次元コード部分に記載されている英数字を入力してください。</p>
    <p>QRコードをカメラアプリ等で直接読み込んでいただくことで、入力を省くことも可能です。</p>
    <form action="/vote/vote.php" method="GET">
        <label for="uid">パンフレット裏表紙に記載の英数字：</label>
        <input type="text" id="uid" name="uid">
        <input type="submit" value="OK">
    </form>
</body>
</html>
