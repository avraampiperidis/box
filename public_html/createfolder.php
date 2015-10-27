<?php
/**
 * Created by PhpStorm.
 * User: abraham
 * Date: 18/10/2015
 * Time: 11:53 μμ
 */
session_start();

$newfoldername = $_GET["foldername"];
$arg = $_GET["argument"];

//apoti fenete edo itan to provlima 1 stous 3 fakelous den douleue
if (strcmp($arg,"createfolder") == 0){

    //$folder = $_SESSION["folder"];
    $path = $_SESSION['path']; //xrisimopoiw global path anti gia to folder

    mkdir($path.'/'.$newfoldername, 0777, true);

    if(is_dir($path.'/'.$newfoldername)) {
        $_SESSION['createfolder'] = true;
        echo "success";
    } else {
        echo "failed";
    }

}



?>