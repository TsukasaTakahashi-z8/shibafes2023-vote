<?php
require "./functions.php";
require("../vendor/autoload.php");
use Hashids\Hashids;
session_start();
$db = new DBControlClass();

if (isset($_SESSION['id']) && isset($_SESSION['voted_times']) && isset($_POST['best_exhibition']) && isset($_POST['best_poster'])) {
    $result = $db->update(intval($_SESSION['id']), intval($_SESSION['voted_times'])+1, intval($_POST['best_exhibition']), intval($_POST['best_poster']), $_POST['email'], $_POST['impression']);
} else {
    header("Location:/vote/error.php");
}

session_destroy();
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>第68回2023芝生祭投票ページ</title>
    <meta http-equiv="refresh" content="3;URL=/index.php">
</head>
<body>
    <p><?php echo $result; ?></p>
</body>
</html>
