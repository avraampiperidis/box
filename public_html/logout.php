<?php

if ($_GET["argument"]=='logOut'){

session_start();
session_unset();
session_destroy();
$link = "index.php";
echo $link;
}

?>