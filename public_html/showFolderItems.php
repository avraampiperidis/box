
<?php

function showFolderItemsTable($path)
{

    $files = scandir($path);
    $lenght = count($files);

    echo "<br>";
    echo "<table style='width: 75%; height: 200px; border: solid;color: rgba(219, 220, 215, 0.68);'>";
    echo "<tbody>";

    //ksekinaw apo to 2 giati oi dio protoi fakeloi einai oi . ..
    for ($i = 2; $i < $lenght; $i++) {
        $loc = $path.'/'.$files[$i];
        echo "<tr class='div-folder-items' style='border-bottom:1pt solid black;'>";

        if(is_dir($path.'/'.$files[$i])) {
            //esvisa ti methodo pou kalouses giati den mou douleve me javascript me tipota den kserw giati kai to evala sto link apo katw
            echo "<td>";
            echo "<a href='usermainpage.php?path=$loc' /> $files[$i] </a>";
            echo "</td>";

            echo "<td style='padding-left:50px'>";
            echo "<input class='button-action-delete'  type='button' value='delete' onclick='deleteItem(".'"'.$files[$i].'"'.")' />";
            echo "</td>";

            echo "<td style='padding-left: 50px'>";
           // echo "<input class='button-action'  type='button' value='share' onclick='shareItem(".'"'.$files[$i].'"'.")' />";
            echo "</td>";


        } else {
            echo "<td>";
            echo "<a href='$path/$files[$i]' /> $files[$i] </a>";
            //echo "<input type='button' value='delete' onclick='deleteItem(".'"'.$files[$i].'"'.")' />"; //me to pou trexei i methodos ola auta ta echo kataligoun sto usermainpage panw opote i methodos einai ekei
            echo "</td>";                                                                  //ama afou to anoikseis kaneis view source panw stin usermainpage tha to deis ekei

            echo "<td style='padding-left: 50px'>";
            echo "<input class='button-action-delete'  type='button' value='delete' onclick='deleteItem(".'"'.$files[$i].'"'.")' />";
            echo "</td>";

            echo "<td style='padding-left: 50px'>";
            echo "<input class='button-action'  type='button' value='share' onclick='shareItem(".'"'.$files[$i].'"'.")' />";
            echo "</td>";

        }

        echo "</tr>";
        
    }


    echo "</tbody>";
    echo "</table>";

}






?>

