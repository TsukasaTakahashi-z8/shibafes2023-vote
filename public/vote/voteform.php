<?php
require("./functions.php");
require("../vendor/autoload.php");
use Hashids\Hashids;
session_start();
$uid_check = new UidClass($_GET['uid']);
$uid_check->redirect();

$db = new DBControlClass();
$exhibition_list = $db->get_exhibitions();

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>第68回2023芝生祭投票ページ</title>
    <link href="./img/favicon.ico" rel="icon" />
    <link href="./css/common.css" rel="stylesheet" />
    <link href="./css/voteform.css" rel="stylesheet" />
    <script>
    window.onload = function(){
        let email = document.getElementsByName("email")[0];
        let impression = document.getElementsByName("impression")[0];

        email.value = localStorage['email'];
        impression.value = localStorage['impression'];

        window.addEventListener("keyup", function(e){
            localStorage['email']= email.value;
            localStorage['impression'] = impression.value;
        });
    }
    </script>
</head>
<body>
    <main>
        <h1>投票フォーム</h1>
        <form action="vote.php" method="POST">
            <div id="best">
                <h2>企画・ポスター投票</h2>
                <h3>最も良い、面白いと思った企画を1つ選択してください。</h3>
                <div id="best_exhibition_area">
                    <select name="best_exhibition" required>
                        <?php
                            echo "            <option class=\"select_exhibition\"selected disable hidden>企画名（出展団体名）</option>";

                            for($i=0; $i<count($exhibition_list); $i++){
                                echo "            <option class=\"select_exhibition\" value=\"{$exhibition_list[$i]['id']}\">{$exhibition_list[$i]['title']}（{$exhibition_list[$i]['club_name']}）</option>";
                            }
                        ?>
                    </select>
                </div>

                <h3>最も良いと思うポスターを1つ選択してください。</h3>
                <div id="best_poster_area">
                    <?php
                        for($i=0; $i<count($exhibition_list); $i++){
                            $imgs = glob("./img/{$exhibition_list[$i]['id']}.*");
                            if (isset($imgs[0])){
                                echo "        <input class=\"radio_poster\" id=\"poster_{$exhibition_list[$i]['id']}\" type=\"radio\" name=\"best_poster\" value=\"{$exhibition_list[$i]['id']}\">";
                                echo "        <label for=\"poster_{$exhibition_list[$i]['id']}\"><img class=\"poster\" src=\"{$imgs[0]}\"></label>";
                            }
                        }
                    ?>
                </div>
            </div>
            <div id="impression_area">
                <h2>ここからは、任意です。</h2>
                <p>頂いたご意見は、今後の芝生祭運営に役立たせていきます。<br>emailを記入していただいた場合は、数週間以内に実行委員会からお返事をさせていただきます。</p>
                <h3>E-mailアドレス</h3>
                <input type="email" name="email">
                <h3>ご意見・ご感想等</h3>
                <textarea name="impression"></textarea>
            </div>
            <div id="submit_box">
                <input type="submit" id="submit">
            </div>
        </form>
    </main>
</body>
</html>
