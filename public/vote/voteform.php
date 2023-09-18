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
        <select name="best_exhibition" required>
            <?php
                $f = fopen("./config/exhibition.csv", 'r');
                while ($line = fgetcsv($f)){
                    if ($line[0]=="企画id"){
                        echo "            <option class=\"select_exhibition\"selected disable hidden>{$line[3]}（{$line[2]}）</option>";
                        continue;
                    }
                    echo "            <option class=\"select_exhibition\" value=\"{$line[0]}\">{$line[3]}（{$line[2]}）</option>";
                }
                fclose($f);
            ?>
        </select>
            <?php
                $f = fopen("./config/exhibition.csv", 'r');
                while ($line = fgetcsv($f)){
                    $imgs = glob("./img/{$line[0]}.*");
                    if ($line[0]!="企画id" && isset($imgs[0])){
                        echo "        <input class=\"radio_poster\" id=\"poster_{$line[0]}\" type=\"radio\" name=\"best_poster\" value=\"{$line[0]}\">";
                        echo "        <label for=\"poster_{$line[0]}\"><img class=\"poster\" src=\"{$imgs[0]}\"></label>";
                    }
                }
                fclose($f);
            ?>
        <h2>ここからは、任意です。</h2>
        <p>頂いたご意見は、今後の芝生祭運営に役立たせていきます。<br>emailを記入していただいた場合は、数週間以内に実行委員会からお返事をさせていただきます。</p>
        <input type="email" name="email">
        <textarea name="impression"></textarea>
        <input type="submit" id="submit">
    </form>
</body>
</html>
