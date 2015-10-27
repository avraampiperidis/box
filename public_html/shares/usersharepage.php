<?php

include 'showshareItems.php';
include '../userinfo.php';

session_start();

$userpage = new SharePage($_SESSION['id'],$_SESSION['username'],$_SESSION['email'],$_SESSION['folder']);
$userpage->display();

/**
 * Class SharePage
 * auti i selida kalite mono gia na emfanisi shared arxeia ston xristi pou exoun ginei apo alous
 * mporei mono na ta dei den mporei na ta svisei!
 *
 * to arxeio showshareitems.php einai ipethino gia na emfanisi ta arxeia stin selida
 */

class SharePage {
    //still empty variable
    //mporei na xrisimopieithei sto melon gia perasma epipleon periexomeno
    public $content;

    private  $userinfo;
    public $path;


    function __construct($id, $username, $email, $folder)
    {
        $this->userinfo = new userinfo($id, $username, $email, $folder);
        $_SESSION['user'] = serialize($this->userinfo);
    }


    /**
     * display the user page
     * i vasiki methodos pou ftaxnei dinamika tin selida
     */
    function display() {

        if (!empty(@$_SESSION["id"])) {

            session_start();

            echo "<html><head>";
            echo "<title>";
            $this->displayTitle();
            echo "</title>";

            $this->addScriptAndStyles();

            echo "</head><body>";
            //$this->toastNotifications();

            $this->displayHeader();
            $this->displayBody();
            $this->displayFooter();

            echo "</body>";
            echo "</html>";

        } else {
            session_destroy();
            ?>
            <script> window.location.href = "index.php"; </script>
            <?php
        }

    }


    function displayTitle()
    {
        ?>
        share page
        <?php
    }


    function addScriptAndStyles() {
    ?>

     <link rel="stylesheet" type="text/css" href="../css/usermainpage.css" />
     <link rel="stylesheet" type="text/css" href="../css/folderItems.css" />
     <link rel="stylesheet" type="text/css" href="../css/styles.css" />
     <link rel="stylesheet" type="text/css" href="../css/actionbuttonstyles.css" />

     <script src="../../resources/jquery/jquery-2.1.4.min.js"></script>
     <script src="../../resources/jquery/toastr.min.js"></script>

     <script src="../js/mainPageFunctions.js"></script>


    <?php
    }


    function displayHeader() {
        ?>

        <div class="div-header" id="header">

            <table >
                <tr>
                    <td style="padding-left: 10px;color: #FFF">
                        <h1>box</h1>
                    </td>
                    <td>

                    </td>
                    <td style="padding-left: 25px">
                        <div  onclick="window.location.href='../usermainpage.php'" style="text-align:center; width: 100px; " style="width: 66px">
                            <a   style="color:black;font-weight: bold; background-image: url('../img/bell.png'); background-repeat: no-repeat"  class="button-logout"> <?php echo "main Page" ?> </a>
                        </div>
                    </td>
                    <td>

                    </td>
                    <td style="padding-left: 100px">
                        <div onclick="logOut()"  style="text-align:center; width: 100px; " style="width: 66px">
                            <a href="../index.php"  style="color: black;font-weight: bold;  background-image: url('../img/usericon.png'); background-repeat: no-repeat"  class="button-logout"> <?php echo $this->userinfo->getUsername().":LogOut" ?> </a>
                        </div>
                    </td>
                </tr>
            </table>

        </div>

        <?php
    }


   function displayBody() {

?>

    <div id="content" >


        <br>

        <?php
            showSharedItems();
        ?>


    </div>
    <?php
    }


    function displayFooter() {
        ?>
        <div  class="div-footer" id="footer" >
            <table>
                <tr>
                    <td style="font-size: small">
                        footer
                    </td>
                    <td style="font-size: small">
                        copyright
                    </td>
                    <td style="font-size: small">
                        contact@email.gr
                    </td>
                </tr>
            </table>

        </div>


       <?php
    }






}


?>


