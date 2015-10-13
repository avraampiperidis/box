<?php
include 'dirstat.php';
include 'userinfo.php';
include 'uploader.php';

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

    //display the user page
    function display()
    {

        if (!empty($_SESSION["id"])) {

            session_start();
            echo "<html><head>";
            echo "<title>";
            $this->displayTitle();
            echo "</title>";

            $this->addScriptAndStyles();
            echo "</head><body>";

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


function displayTitle()
{
    ?>
    main page
    <?php
}

    function addScriptAndStyles() {
    ?>
     <link rel="stylesheet" type="text/css" href="css/usermainpage.css"/>
     <link rel="stylesheet" type="text/css" href="css/login.css"/>
     <script src="../resources/jquery/jquery-2.1.4.min.js"></script>

    <script>
        function gotomainpage() {
            window.location.href = "index.php";
        }

        function logOut() {
            $.ajax({
                url: 'logout.php?argument=logOut',
                success: function(data) {
                    window.location.href = data;
                }
            })
        }

        function showTable() {
            var table = document.getElementById("table");
            table.style.display = "table";
        }

    </script>

    <?php
    }


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

<table>
    <tr>
        <td>
            <table style="width: 107px; height: 32px">
                <tr>
                    <td>
                        <div onclick="showTable();" style="text-align:center; width: 150px;" style="width: 66px">
                            <a href='#'  class="button"> upload file </a>
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


