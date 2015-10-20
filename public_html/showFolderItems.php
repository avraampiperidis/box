<?php


function showFolderItemsTable($path)
{

    $files = scandir($path);
    $lenght = count($files);

    echo "<table style='width: 99%; height: 350px'>";
    echo "<tr>";
    echo "<td style='width: 200px'>";

    //ksekinaw apo to 2 giati oi dio protoi fakeloi einai oi . ..
    for ($i = 2; $i < $lenght; $i++) {

        if(is_dir($path.'/'.$files[$i])) {
            echo "<div onclick='loadFolder(".'"'.$path.'/'.$files[$i].'"'.");' style='width: 95%' class='div-folder-items'>";
            echo "<a href='' /> $files[$i] </a>";
            echo "</div>";
        } else {
            echo "<div style='width: 95%' class='div-folder-items'>";
            echo "<a href='$path/$files[$i]' /> $files[$i] </a>";
            echo "</div>";
        }


    }

    echo "</td>";
    echo "</tr>";
    echo "</table>";

}




?>