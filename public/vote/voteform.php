<?php
require("./functions.php");
require("../vendor/autoload.php");
use Hashids\Hashids;
session_start();
$uid_check = new UidClass($_GET['uid']);
$uid_check->redirect();
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>第68回2023芝生祭投票ページ</title>
</head>
<body>
    <p>uid:<?php echo(htmlspecialchars($uid_check->uid)); ?></p>
    <form action="vote.php" method="POST">
        <h2>最も面白いと思った企画を選択してください。</h2>
        <select name="best_exhibition">
            <option value="1">企画1</option>
        </select>
        <select name="best_poster">
            <option value="1">企画1</option>
            <option value="2" style="display: none;">企画2(画像なし)</option>
            <!--PHPでconfig/exhibition.csvからoptionを生成-->
        </select>
        <h2>ここからは、任意です。</h2>
        <p>頂いたご意見は、今後の芝生祭運営に役立たせていきます。<br>emailを記入していただいた場合は、数週間以内に実行委員会からお返事をさせていただきます。</p>
        <input type="email" name="email">
        <textarea name="impression"></textarea>
        <input type="submit" id="submit">
    </form>
</body>
</html>
