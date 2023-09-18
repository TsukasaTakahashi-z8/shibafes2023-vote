<?php
session_destroy();
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>投票エラー</title>
    <link href="./img/favicon.ico" rel="icon" />
    <link href="./css/common.css" rel="stylesheet" />
    <link href="./css/voteform.css" rel="stylesheet" />
    <meta http-equiv="refresh" content="5;URL=/vote/index.php">
</head>
<body>
<main>
    <h1>投票エラー</h1>
    <p>投票中にエラーが発生しました。<br>
    <?php
        switch($_GET['code']){
        case "invalid_uid":
            echo "不正なUID(英数字)";
        }
    ?>
    </p>
    <p>5秒後に投票サイトトップへ移動します。</p>
</main>
</body>
</html>
