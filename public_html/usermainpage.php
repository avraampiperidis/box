<?php
include 'showFolderItems.php';
include 'userinfo.php';
include 'uploader.php';

session_start();

$userpage = new Page($_SESSION['id'],$_SESSION['username'],$_SESSION['email'],$_SESSION['folder']);
$userpage->display();

class Page {
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

            $this->Init();

            if($_SESSION['path']!=$this->userinfo->getCurrentPath()){ //afto simvenei mono meta to delete giati kaleite i usermainpage kai kanei neo userinfo pou exei to default path mesa
                $this->userinfo->setCurrentPath($_SESSION['path']);
            }

            echo "<html><head>";
            echo "<title>";
            $this->displayTitle();
            echo "</title>";

            $this->addScriptAndStyles();

            echo "</head><body>";
            $this->toastNotifications();

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
        main page
        <?php
    }


    function addScriptAndStyles() {
    ?>

     <link rel="stylesheet" type="text/css" href="css/usermainpage.css" />
     <link rel="stylesheet" type="text/css" href="css/folderItems.css" />
     <link rel="stylesheet" type="text/css" href="css/styles.css" />
     <link rel="stylesheet" type="text/css" href="css/actionbuttonstyles.css" />

     <script src="../resources/jquery/jquery-2.1.4.min.js"></script>
     <script src="../resources/jquery/toastr.min.js"></script>

     <script src="js/mainPageFunctions.js"></script>


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
                        <div onclick="showShares()"  style="text-align:center; width: 100px; " style="width: 66px">
                            <a  style="color:black;font-weight: bold; background-image: url('img/bell.png'); background-repeat: no-repeat"  class="button-logout"> <?php echo "notifications/shares" ?> </a>
                        </div>
                    </td>
                    <td>

                    </td>
                    <td style="padding-left: 100px">
                        <div onclick="logOut()"  style="text-align:center; width: 100px; " style="width: 66px">
                            <a href="index.php"  style="color: black;font-weight: bold;  background-image: url('img/usericon.png'); background-repeat: no-repeat"  class="button-logout"> <?php echo $this->userinfo->getUsername().":LogOut" ?> </a>
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

        <table id="table" style="display: none" >
            <tr>
                <td>

                    <form enctype="multipart/form-data" method="POST" class="form-container">
                        <div class="form-title" >Browse file</div>
                        <input type="file" name="uploadedfile" />
                        <br>
                        <div class="submit-container" >
                            <input class="submit-button"  type="submit" value="upload" />
                            <br>
                        </div>
                    </form>

                </td>
            </tr>
        </table>

        <table>
            <tr>
                <td>
                    <div onclick="showTable()" style="text-align:center; width: 150px; margin: 10px;">
                        <a href='#'  class="button-action"> upload file </a>
                    </div>
                </td>
                <td>
                    <div onclick="createFolder()" style="text-align:center; width: 150px;" >
                        <a href=''  class="button-action"> create folder </a>
                    </div>
                </td>
            </tr>
        </table>

        
        <?php
        echo "<table style='width: 95%'><tr ><td class='button-action'>";
        echo "<hr>";
        echo $_SESSION['path']; //emfanizei ana pasa stigmi to path panw sti selida kado alliws kai vale kana css ama mporeis kapoia stigmi
        echo "<hr>";
        echo "</td></tr></table>";
        ?>


        <br>

        <div onclick="loadprevFolder()" style="text-align:center; width: 150px;" >
            <a  class="button-action"> Back </a>
        </div>

        <?php

        showFolderItemsTable($this->userinfo->getCurrentPath());

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



    //userpage initialization
    function Init() {

        if(!empty($_GET["path"])) {
            $temp = "../resources/users/".$_SESSION['folder'];
            $len = strlen($temp);
            if($_GET["path"]=="prev"){ //ama kalestei apo tin loadprevFolder tha exei prev sto path alliws kaleite apo click gia allagi fakelou
                if(!($_SESSION['path']==$temp)) { //elenxei an einai sto root folder kai patise back kai an nai den benei stin if
                    $this->path = $_SESSION['path'];
                    $indx = strrpos($this->path, "/"); //vriskei ti thesi tou teleuteou slash
                    $this->path = substr_replace($this->path, "", $indx); //allazei to string meta to telefteo slash me keno string
                    $this->userinfo->setCurrentPath($this->path); //edw setarei to path tis userinfo
                    $_SESSION['path'] = $this->path; //enimerwnei to global path
                }
            }else if(strncasecmp($_GET['path'],$temp,$len)){ //elenxei an to path arxizei me ..resources/users/tousernametouxristi kai an oxi benei mesa sto else if kai den kanei tipota me apotelesma
                echo "Im in";
                $_SESSION['path']=$temp;
                $this->path=$temp;
                $this->userinfo->setCurrentPath($this->path); //to usermainpage na fortonei to root fakelo tou xristi
            } else {                                         //argotera tha xreiastei na to kanoume alliws giati ama oi xristes mporoun na kanoun share afto tha prepei na allaksei

                $this->path = $_GET["path"];
                $_SESSION['path'] = $this->path;
                $this->userinfo->setCurrentPath($this->path); //edw allazw to path sto userinfo
            }
        }

        echo $_SESSION['path']; //emfanizei ana pasa stigmi to path panw sti selida kado alliws kai vale kana css ama mporeis kapoia stigmi
        if($_SESSION['path']!=$this->userinfo->getCurrentPath()){ //afto simvenei mono meta to delete giati kaleite i usermainpage kai kanei neo userinfo pou exei to default path mesa
            $this->userinfo->setCurrentPath($_SESSION['path']);
        }

    }

    function toastNotifications() {
        if($_SESSION['login'] == false) {
            echo "<link href='../resources/jquery/toastr.min.css' rel='stylesheet' /><script> toastr.success('logged in successfully!');</script>";
        }

        if($_SESSION['createfolder'] == true) {
            echo "<link href='../resources/jquery/toastr.min.css' rel='stylesheet' /><script> toastr.success('folder created !');</script>";
        }

        $_SESSION['login'] = true;
        $_SESSION['createfolder'] = false;
    }



}


?>


