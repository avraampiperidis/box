<?php
/**
 * Created by PhpStorm.
 * User: abraham
 * Date: 18/10/2015
 * Time: 11:53 μμ
 */
include 'userinfo.php';
session_start();

if ($_GET["argument"]=='createfolder'){

    $newfoldername = $_GET["foldername"];
    $folder = $_SESSION["folder"];

    mkdir('../resources/users/'.$folder.'/'.$newfoldername, 0777, true);

    if(is_dir('../resources/users/'.$folder.'/'.$newfoldername)) {
        $_SESSION['createfolder'] = true;
        echo "success";
    } else {
        echo "failed";
    }

}



?>