<?php
session_start();
if($_GET['argument']=='deleteitem'){
    $path = $_SESSION['path'];
    $filename = $_GET['filename'];
    if(file_exists($path.'/'.$filename)){
        if(!is_dir($path.'/'.$filename)){ //elenxos an dn einai fakelos
            unlink($path.'/'.$filename); //diagrafei to arxeio
            if(file_exists($path.'/'.$filename)){ //elenxei an odws to diegrapse
                echo "failed";
            }else{
                echo "success";
            }
        }else{ //sto else paei an einai fakelos

        }
    }else{
        echo "failed";
    }
}
?>