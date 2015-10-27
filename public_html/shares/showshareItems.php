
<?php

include '../../resources/config.php';

session_start();

$user = @$dbaccess["username"];
$hostname = @$dbaccess["host"];
$passwd = @$dbaccess["password"];
$db = @$dbaccess["database"][0];

/**
 * travaei apo mysql ola ta arxeia pou exoun ginei shared ston sigkekrimeno xristi kai ta emfanizei!
 */
function showSharedItems()
{

    global $user;
    global $hostname;
    global $passwd;
    global $db;

    @$mysql = mysqli_connect($hostname, $user, $passwd, $db);

    if (!$mysql) {
        echo "cannot connect to database";
        exit;
    }

    //epilogh tis vasis mas
    $selected = mysqli_select_db($mysql, $db);

    if (!$selected) {
        echo "cannot select database";
        exit;
    }

    $query = "SELECT * FROM shares WHERE touser = '".$_SESSION["email"]."' ";

    $files = array();

    $result = mysqli_query($mysql,$query);

    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $files[] = $row["path"];
        }
    }
    $mysql->close();

    $lenght = count($files);

    echo "<br>";
    echo "<table style='width: 75%; height: 200px; border: solid;color: rgba(219, 220, 215, 0.68);'>";
    echo "<tbody>";

    for ($i = 0; $i < $lenght; $i++) {
        echo "<tr class='div-folder-items' style='border-bottom:1pt solid black;'>";

        if(is_dir($files[$i])) {

        } else {
            $finalFile = substr($files[$i],2);
            echo "<td>";
            echo "<a href='$finalFile' style='color:#FFF;text-decoration: none' /> <img  src='../img/file.png' />". typeOfFile($files[$i])." $finalFile </a>";
            echo "</td>";

        }

        echo "</tr>";
        
    }

    echo "</tbody>";
    echo "</table>";


}


/**
 * @param $file
 * @return string to tipo tou arxeiou(to extension mono me ena diaxoristiko '|')
 */
    function typeOfFile($file) {

        $file_ext = explode('.',$file);
        $file_ext_count = count($file_ext);
        $count = $file_ext_count-1;
        $file_extension = $file_ext[$count];
        return $file_extension.'| ';

    }




?>

