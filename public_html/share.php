<?php
/**
 * Created by PhpStorm.
 * User: abraham
 * Date: 27/10/2015
 * Time: 3:23 μμ
 *
 *vasei mesa stin mysql ston neo table shares
 * to file pou ekane share o xristis.
 *
 * to insert ginete me parametrous(times)
 * apo pion xristi
 * se pion xristi
 * to path.
 *
 * ama to arxeio exei kataliksi panw apo tria gramata px pic.jpeg den douleiei
 *
 */
include '../resources/config.php';
include 'userinfo.php';

session_start();

$argument = $_GET["argument"];
$file = $_GET["file"];
$email = $_GET["email"];
$path = $_SESSION["path"];

$myuser = unserialize($_SESSION["user"]);
$myemail = $myuser->getEmail();


if($argument == "share") {

    $mysqlusername = @$dbaccess["username"];
    $mysqlhost = @$dbaccess["host"];
    $mysqlpassword = @$dbaccess["password"];
    $mysqldatabase = @$dbaccess["database"][0];

    @$mysql = mysqli_connect($mysqlhost,$mysqlusername,$mysqlpassword,$mysqldatabase);

    if(!$mysql) {
        echo "failed1";
        exit;
    }

    //den eimai sigouros an xriazete auto mia kai ti vasi ti dilono akrivos epano
    $selectDb = mysqli_select_db($mysql,$mysqldatabase);

    if(!$selectDb) {
        echo "failed2";
        $mysql->close();
        exit;
    }

    //proto erotima an to email pou evale o xristis iparxei
    $query = "SELECT * FROM users WHERE email = '".$email."' ";
    $result = mysqli_query($mysql,$query);

    if(!$result) {
        echo "failed3";
        $mysql->close();
        exit;
    }

    if($result->num_rows > 0) {

        $query = "SELECT * FROM shares WHERE path = '".$path.'/'.$file."' ";
        $result = mysqli_query($mysql,$query);
        if($result->num_rows > 0) {
            echo "this file has already been shared";
            $mysql->close();
            exit;
        } else {

            $query = "INSERT INTO shares (fromuser, touser, path) VALUES ('" . $myemail . "', '" . $email . "', '" . $path . '/' . $file . "')";

            $result = $mysql->query($query);

            //if ($mysql->query($query) === TRUE) {
                echo 'success';
                $mysql->close();
                exit;
           // }
        }

    } else {
        echo "usernotexists";
        $mysql->close();
        exit;
    }



} else {
    echo "failed4";
}


?>