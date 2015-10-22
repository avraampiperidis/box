<?php
include 'showFolderItems.php';
include 'userinfo.php';
include 'uploader.php';

session_start();

$userpage = new Page($_SESSION['id'],$_SESSION['username'],$_SESSION['email'],$_SESSION['folder']);
$userpage->display();

class Page {
    //empty var
    public $content;

    private  $userinfo;
    public $path;



    function __construct($id, $username, $email, $folder)
    {
        $this->userinfo = new userinfo($id, $username, $email, $folder);
        $_SESSION['user'] = $this->userinfo;
    }


    /**
     * display the user page
     * i vasiki methodos pou ftaxnei dinamika tin selida
     */
    function display()
    {

        if (!empty(@$_SESSION["id"])) {

            session_start();


            if(!empty($_GET["path"])) {
                if($_GET["path"]=="prev"){ //ama kalestei apo tin loadprevFolder tha exei prev sto path alliws kaleite apo click gia allagi fakelou
                    //edw prepei na bei mia if akoma gia na elenxei mipws einai sto root folder prin kanei back alla kalitera tha itane na ginei messa stin loadprevfolder na mi kanei kan
                    //window.location.href kai refresh
                    echo "Hello";
                    $this->path=$_SESSION['path'];
                    $indx = strrpos($this->path,"/");
                    $indx++;
                    $this->path = substr_replace($this->path,"",$indx);
                    $this->userinfo->setCurrentPath($this->path);
                }else {

                    $this->path = $_GET["path"];
                    $_SESSION['path'] = $this->path;
                    $this->userinfo->setCurrentPath($this->path); //edw allazw to path sto userinfo
                }
            }

            echo "<html><head>";
            echo "<title>";
            $this->displayTitle();
            echo "</title>";

            $this->addScriptAndStyles();


            echo "</head><body>";
            if($_SESSION['login'] == false) {
                echo "<link href='../resources/jquery/toastr.min.css' rel='stylesheet' /><script> toastr.success('logged in successfully!');</script>";
            }

            if($_SESSION['createfolder'] == true) {
                echo "<link href='../resources/jquery/toastr.min.css' rel='stylesheet' /><script> toastr.success('folder created !');</script>";
            }

            $_SESSION['login'] = true;
            $_SESSION['createfolder'] = false;

            $this->displayBody();

            echo "</body>";
            echo "</html>";

        } else {
            session_destroy();
            ?>
            <script> window.location.href = "index.php"; </script>
            <?php

        }
    }

    /**
     *
     */
    function displayTitle()
    {
        ?>
        main page
        <?php
    }

    /**
     *
     */
    function addScriptAndStyles() {
    ?>
     <link rel="stylesheet" type="text/css" href="css/usermainpage.css"/>
     <link rel="stylesheet" type="text/css" href="css/login.css"/>
     <link rel="stylesheet" type="text/css" href="css/folderItems.css" />

     <script src="../resources/jquery/jquery-2.1.4.min.js"></script>
     <script src="../resources/jquery/toastr.min.js"></script>

     <script src="js/mainPageFunctions.js"></script>


    <?php
    }

    /**
     *
     */
   function displayBody() {

?>

    <div style="width: 100%">

        <h1 class="form-container3">Box</h1>


    </div>

       <table id="table" style="display: none">
           <tr>
               <td>

                   <form enctype="multipart/form-data" method="POST" class="form-container">
                       <div class="form-title">Browse file</div>
                       <input type="file" name="uploadedfile" />
                       <br>
                       <div class="submit-container">
                           <input class="submit-button" type="submit" value="upload" />
                           <br>
                       </div>
                   </form>

               </td>
           </tr>
       </table>

       <table align="right">
           <tr>
               <td >
                   <table  style="width: 107px; height: 32px">
                       <tr>
                           <td>
                               <div onclick="logOut();"  style="text-align:center; width: 100px; " style="width: 66px">
                                   <a href='#'  style="color: black;font-weight: bold;  background-image: url('img/usericon.png'); background-repeat: no-repeat"  class="button"> <?php echo $this->userinfo->getUsername().":LogOut" ?> </a>
                               </div>
                           </td>
                       </tr>
                   </table>
               </td>
           </tr>
       </table>

<table style="border: inherit; margin: 10px">
    <tr>
        <td>
            <table style="width: 107px; height: 32px">
                <tr>
                    <td>
                        <div onclick="showTable();" style="text-align:center; width: 150px; margin: 10px;">
                            <a href='#'  class="button"> upload file </a>
                        </div>
                    </td>
                    <td>
                        <div onclick="createFolder();" style="text-align:center; width: 150px;" >
                            <a href=''  class="button"> create folder </a> <!-- evgala ti diesi apo to link giati alliws kanei refresh kai paei sto arxiko folder gia kapoio logo-->
                        </div>
                    </td>
                </tr>
            </table>
        </td>

    </tr>
</table>

<br>
       <input type="button" value="Back" onclick="loadprevFolder();"/> <!-- to onclick de doulevei gia kapoio logo-->


       <?php
            showFolderItemsTable($this->userinfo->getCurrentPath());
       ?>



    <?php

    }

}
?>


