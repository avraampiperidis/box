<?php
include 'userinfo.php';

if ($_GET["argument"]=='logOut'){

session_start();
    $_SESSION["id"] = "";
session_unset();
session_destroy();
$link = "index.php";
echo $link;
}

?>