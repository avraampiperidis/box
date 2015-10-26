

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
        $loc = $path.'/'.$files[$i];
        if(is_dir($path.'/'.$files[$i])) {

            //esvisa ti methodo pou kalouses giati den mou douleve me javascript me tipota den kserw giati kai to evala sto link apo katw
            echo '<div style="width: 95%" class="div-folder-items">';
            echo "<a href='usermainpage.php?path=$loc' /> $files[$i] </a>";
            echo "<input type='button' value='delete' onclick='deleteItem(".'"'.$files[$i].'"'.")' />";
            echo "</div>";
        } else {
            echo "<div style='width: 95%' class='div-folder-items'>";
            echo "<a href='$path/$files[$i]' /> $files[$i] </a>";
            echo "<input type='button' value='delete' onclick='deleteItem(".'"'.$files[$i].'"'.")' />"; //me to pou trexei i methodos ola auta ta echo kataligoun sto usermainpage panw opote i methodos einai ekei
            echo "</div>";                                                                  //ama afou to anoikseis kaneis view source panw stin usermainpage tha to deis ekei
        }


    }

    echo "</td>";
    echo "</tr>";
    echo "</table>";

}




?>

