<html>
<head>

    <title></title>

    <script>
        function gotomainpage() {
            window.location.href = "index.php";
        }
    </script>
    <link rel="stylesheet" type="text/css" href="css/usermainpage.css"/>
    <link rel="stylesheet" type="text/css" href="css/login.css"/>
</head>

<body>

<?php
session_start();

$user = $_SESSION['username'];
$id = $_SESSION['id'];
$folder = $_SESSION['folder'];



if((isset($user)) && (isset($id)) && (isset($folder))) {
    include 'dirstat.php';

?>

<div style="width: 100%">

<h1 class="form-container3">Box</h1>

</div>

    <table>
        <tr>
            <td>
                <table style="width: 107px; height: 32px">
                    <tr>
                        <td>
                            <div style="text-align:center; width: 100px;"  style="width: 66px">
                                <a href='#' class="button"> <?php echo $user ?> </a>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
            <td>
                <table style="width: 107px; height: 32px">
                    <tr>
                        <td>
                            <div style="text-align:center; width: 150px;"  style="width: 66px">
                                <a href='#' class="button">  upload file </a>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>


<br>

    <table style="width: 99%; height: 350px">
        <tr>
            <td style="width: 35px">
            </td>
            <td style="width: 200px">

                <?php dirstat($folder); ?>
            </td>
            <td style="width: 21px">&nbsp;</td>
            <td style="width: 100px">
                <?php dirstat2($folder); ?>
            </td>
            <td style="width: 23px">
            </td>
        </tr>
    </table>


<?php
} else {
    ?>
     <script> gotomainpage(); </script>
    <?php
}
?>

</body>


</html>