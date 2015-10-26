<?php
session_start();
/**
 * Delete a file or recursively delete a directory
 *
 * @param string $str Path to file or directory
 */
function recursiveDelete($str) { //diagrafei anadromika ta pada mesa sto path
    if (is_file($str)) {
        return @unlink($str);
    }
    elseif (is_dir($str)) {
        $scan = glob(rtrim($str,'/').'/*');
        foreach($scan as $index=>$path) {
            recursiveDelete($path);
        }
        return @rmdir($str);
    }
}
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
            recursiveDelete($path.'/'.$filename); //kaleitai i anadromiki diagrafi kala tha itane na vgazei ena confirmation prin to kanei giati an patithei katalathos bam
            if(file_exists($path.'/'.$filename)){ //elenxei an odws to diegrapse
                echo "failed";
            }else{
                echo "success";
            }
        }
    }else{
        echo "failed";
    }
}
?>