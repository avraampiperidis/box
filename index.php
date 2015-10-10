<html>

<head>
    <title>LogIn</title>
<link rel="stylesheet" type="text/css" href="css/login.css"/>

    <script>

        function signin() {
            window.location.href = "signin.php";
        }

    </script>

</head>

<body>

<?php
//san to import stin java
include 'config.php';
$username = $_POST['username'];
$password = $_POST['password'];
//user must provide password
if((!isset($username) || (!isset($password)))) {

    ?>

    <div align="center">

        <form enctype="multipart/form-data" method="POST" class="form-container">
            <div style="color: aliceblue"><h1>Box</h1></div>
            <div class="form-title">username</div>
            <input class="form-field" type="text" name="username"/><br/>

            <div class="form-title">password</div>
            <input class="form-field" type="password" name="password"/><br/>

            <div class="submit-container" align="center">
                <input class="submit-button" type="submit" name="submit" value="LogIn"/>

                <p></p>
                <input onclick="signin()" class="submit-button" value="SignIn"/>
            </div>

        </form>

    </div>

    <?php

} else {
    //sindesi stin mysql
    $mysqlusername = $dbaccess["username"];
    $mysqlhost = $dbaccess["host"];
    $mysqlpassword = $dbaccess["password"];
    $mysqldatabase = $dbaccess["database"][0];

    $mysql = mysqli_connect($mysqlhost,$mysqlusername,$mysqlpassword,$mysqldatabase);

    if(!$mysql) {
        echo "cannot connect to database";
        exit;
    }

    //epilogh tis vasis mas
    $selected = mysqli_select_db($mysql,$mysqldatabase);

    if(!$selected) {
        echo "cannot select database";
        exit;
    }

    //erotima an o xristis iparxi
    $query = "select count(*) from users where username = '".$username."' and password = '".$password."'";
    $result = mysqli_query($mysql,$query);

    if(!$result) {
        echo "cannot run query";
        exit;
    }

    $row = mysqli_fetch_row($result);
    $count = $row[0];

    if($count > 0) {
        echo "logged in";
    } else {
        echo "log failed";
    }



}

?>



</body>
</html>


