<html>

<head>
    <title>SignIn</title>
    <link rel="stylesheet" type="text/css" href="css/login.css"/>

    <script>

        function mainpage() {
            window.location.href = "usermainpage.php";
        }


    </script>

</head>

<body>

<?php
//san to import stin java
include '../resources/config.php';
include 'utils.php';

@$username = $_POST['username'];
@$password = sha1($_POST['password']);
@$rpassword = sha1($_POST['rpassword']); //to deutero password field
@$email = $_POST['email'];
//user must provide password
if((!isset($username) || (!isset($password)) || (!isset($email)))) {

    ?>

    <div align="center">

        <form enctype="multipart/form-data" method="POST" class="form-container">
            <div style="color:#0F7EEC"><h1>Box</h1></div>
            <div class="form-title">username</div>
            <input class="form-field" type="text" name="username"/><br/>

            <div class="form-title">password</div>
            <input class="form-field" type="password" name="password"/><br/>

            <div class="form-title">repeat password</div>
            <input class="form-field" type="password" name="rpassword"/><br/> <!-- password confirmation field -->

            <div class="form-title">email</div>
            <input class="form-field" type="text" name="email"/><br/>


            <div class="submit-container" align="center">
                <input class="submit-button" type="submit" name="submit" value="Register">  </input>
            </div>


        </form>


    </div>

    <?php

} else {

    session_start();
    //validate inputs
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
        echo "invalid email</br>";
        echo "<a href='#' onclick='history.back()'>try again</a>"; //dimiourgei link pou xristimopoiei to back tou browser sto click
        exit;
    }

    if((empty($username)) || empty($password)) {
        echo "the username and password fields must not be empty</br>";
        echo "<a href='#' onclick='history.back()'>try again</a>";
        exit;
    }

    if($password!=$rpassword){ //elenxei ta 2 password fields
        echo "the two passwords do not match</br>";
        echo "<a href='#' onclick='history.back()'>try again</a>";
        exit;
    }

    @$host = $dbaccess["host"];
    @$dbuser = $dbaccess["username"];
    @$dbpasswd = $dbaccess["password"];
    @$dbname = $dbaccess["database"][0];

    @$db = mysqli_connect($host,$dbuser,$dbpasswd,$dbname);

    if(mysqli_connect_errno()) {
        echo "could not connect to database try again later";
        exit;
    }

    //username and email is unique in database
    $query = "INSERT INTO users (username,password,email) VALUES ('".$username."', '".$password."', '".$email."')";

    $result = $db->query($query);

    if($result) {


        $query = "UPDATE users SET folder = '".$username."' WHERE email = '".$email."' ";

        if($db->query($query) === TRUE) {

            echo "<p> sign up completed </p>";

            $query = "select * from users where username = '" . $username . "' and  password = '" . $password . "'";
            $result2 = mysqli_query($db, $query);

            while($row = $result2->fetch_assoc()) {
                $_SESSION['id'] = $row["id"];
                $_SESSION['username'] = $row["username"];
                $_SESSION['email'] = $row["email"];
                $_SESSION['folder'] = $row["folder"];

                if (!file_exists($row['username'])) {
                    mkdir('../resources/users/'.$row['username'], 0777, true);
                }

                $_SESSION['path'] = '../resources/users/'.$row['username']; //arxikopoiei to path wste na douleveoun ta create folder kai upload sto kapaki meta to login

                ?>
                <script>mainpage();</script>
                <?php

            }
        }

    } else {
        echo "<p> error occured </p>";
        session_destroy();
    }


    mysqli_close($db);

}

?>

</body>
</html>


