<?php
require "./functions.php";
require("../vendor/autoload.php");
use Hashids\Hashids;
session_start();
$db = new DBControlClass();

$result = $db->update(intval($_SESSION['id']), intval($_SESSION['voted_times'])+1, intval($_POST['best_exhibition']), intval($_POST['best_poster']), $_POST['email'], $_POST['impression']);
echo $result
?>
