<?php
/*
 * $_SESSION['voted_times']
 * $_SESSION['id']
 * $_POST['best-exhibition']
 * $_POST['best-poster']
 * $_POST['email']
 * $_POST['impression']
 */
require "./functions.php";

$db = new DBControlClass();
echo $db->update($_SESSION['id'], $_SESSION['voted_times']+1, $_POST['best_exhibition'], $_POST['best_poster'], $_POST['email'], $_POST['impression']);
?>
