<?php
require "./functions.php";
if ($_SERVER['REMOTE_ADDR'] == $_ENV['MYIP'] && $_GET['k']=="reset")
{
    $db = new DBControlClass;
    echo $db->init_table();
} else {
    echo "No permisssion.";
    echo $_SERVER['REMOTE_ADDR'];
}
