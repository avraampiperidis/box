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

$username = $_POST['username'];
$password = sha1($_POST['password']);
$email = $_POST['email'];
//user must provide password
if((!isset($username) || (!isset($password)) || (!isset($email)))) {

    ?>

    <div align="center">

        <form enctype="multipart/form-data" method="POST" class="form-container">
            <div style="color: aliceblue"><h1>Box</h1></div>
            <div class="form-title">username</div>
            <input class="form-field" type="text" name="username"/><br/>

            <div class="form-title">password</div>
            <input class="form-field" type="password" name="password"/><br/>

            <div class="form-title">email</div>
            <input class="form-field" type="text" name="email"/><br/>


            <div class="submit-container" align="center">
                <input class="submit-button" type="submit" name="submit" value="SignIn">  </input>
            </div>


        </form>


    </div>

    <?php

} else {

    session_start();
    //validate inputs
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
        echo "invailed email";
        exit;
    }

    if((empty($username)) || empty($password)) {
        echo "must provide pass n username";
        exit;
    }

    $host = $dbaccess["host"];
    $dbuser = $dbaccess["username"];
    $dbpasswd = $dbaccess["password"];
    $dbname = $dbaccess["database"][0];

    @$db = mysqli_connect($host,$dbuser,$dbpasswd,$dbname);

    if(mysqli_connect_errno()) {
        echo "could not connect to database try again later";
        exit;
    }

    //username and email is unique in database
    $query = "INSERT INTO users (username,password,email) VALUES ('".$username."', '".$password."', '".$email."')";

    $result = $db->query($query);

    if($result) {

        //create user home folder if not exists
    if (!file_exists($row1['username'])) {
        mkdir('../resources/users/'.$row1['username'], 0777, true);
    }

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


