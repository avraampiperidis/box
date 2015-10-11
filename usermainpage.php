<?php
include 'dirstat.php';
include 'userinfo.php';

session_start();

$userpage = new Page($_SESSION['id'],$_SESSION['username'],$_SESSION['email'],$_SESSION['folder']);
$userpage->display();

class Page {
    //empty var
    public $content;
    private  $userinfo;


    function __construct($id, $username, $email, $folder)
    {
        $this->userinfo = new userinfo($id, $username, $email, $folder);
        $_SESSION['user'] = $this->userinfo;
    }


    function display()
    {
        if (isset($this->userinfo)) {

            session_start();

            echo "<html><head>";
            $this->displayTitle();
            $this->addScriptAndStyles();
            echo "<body>";

            $this->displayBody();


            echo "</body>";
            echo "</head></html>";
        } else {
            session_destroy();
            ?>
            <script> gotomainpage(); </script>
            <?php

        }
    }


function displayTitle()
{
    ?>
    <title>main page</title>
    <?php
}

    function addScriptAndStyles() {

    ?>
    <script>
        function gotomainpage() {
            window.location.href = "index.php";
        }
    </script>
    <link rel="stylesheet" type="text/css" href="css/usermainpage.css"/>
    <link rel="stylesheet" type="text/css" href="css/login.css"/>

    <?php
    }


   function displayBody() {

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
                        <div style="text-align:center; width: 100px;" style="width: 66px">
                            <a href='#' class="button"> <?php echo $this->userinfo->getUsername() ?> </a>
                        </div>
                    </td>
                </tr>
            </table>
        </td>
        <td>
            <table style="width: 107px; height: 32px">
                <tr>
                    <td>
                        <div style="text-align:center; width: 150px;" style="width: 66px">
                            <a href='#' class="button"> upload file </a>
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

            <?php dirstat($this->userinfo->getUserfolder()); ?>
        </td>
        <td style="width: 21px">&nbsp;</td>
        <td style="width: 100px">
            <?php dirstat2($this->userinfo->getUserfolder()); ?>
        </td>
        <td style="width: 23px">
        </td>
    </tr>
    </table>


    <?php
    }

}
?>


