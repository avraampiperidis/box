<html>

<head>
    <title>LogIn</title>
<link rel="stylesheet" type="text/css" href="css/login.css"/>

    <script>

        function signin() {
            window.location.href = "signin.php";
        }

        function mainpage() {
            window.location.href = "usermainpage.php";
        }


    </script>

</head>

<body>

<?php
//san to import stin java
include '../resources/config.php';

session_start();

    $username = @$_POST['username'];

    //to password pou evale o xristis to kriptografo
    //kai sigrino me vasi to kriptografimeno apo ekino pou ginete select apo mysql
    //stin mysql den apothikeuete o kanonikos kodikos tou xristi alla to kriptografima sha1(password)
    $password = @sha1($_POST['password']);
    //user must provide password
    if ((!isset($username) || (!isset($password)))) {

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
        $mysqlusername = @$dbaccess["username"];
        $mysqlhost = @$dbaccess["host"];
        $mysqlpassword = @$dbaccess["password"];
        $mysqldatabase = @$dbaccess["database"][0];

        @$mysql = mysqli_connect($mysqlhost, $mysqlusername, $mysqlpassword, $mysqldatabase);

        if (!$mysql) {
            echo "cannot connect to database";
            exit;
        }

        //epilogh tis vasis mas
        $selected = mysqli_select_db($mysql, $mysqldatabase);

        if (!$selected) {
            echo "cannot select database";
            exit;
        }

        //erotima an o xristis iparxi stin vash!
        $query = "select * from users where username = '" . $username . "' and  password = '" . $password . "'";
        $result = mysqli_query($mysql, $query);

        if (!$result) {
            echo "cannot run query";
            exit;
        }


        if ($result->num_rows > 0) {
            while ($row1 = $result->fetch_assoc()) {

                echo "id: " . $row1["id"] . " - username:" . $row1["username"] . " email:" . $row1["email"];
                $_SESSION['id'] = $row1["id"];
                $_SESSION['username'] = $row1["username"];
                $_SESSION['email'] = $row1["email"];
                $_SESSION['folder'] = $row1["folder"];
                $_SESSION['login'] = false;

                if (!file_exists($row1['username'])) {
                    mkdir('../resources/users/'.$row1['username'], 0777, true);
                }


                ?>
                <script>
                    mainpage();
                </script>
                <?php


            }
        } else {
            echo "log failed";
            session_destroy();
        }



}

?>



</body>
</html>


