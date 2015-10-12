<?php

class upload {


function fileupload()
{

    $file = $_FILES["uploadedfile"];

    if (isset($file)) {
        session_start();

        $userfolder = $_SESSION['folder'];

        $target_path = "./"."$userfolder/";
        $target_path = $target_path . basename($_FILES['uploadedfile']['name']);
        $ext = substr(strrchr($_FILES['uploadedfile']['name'], "."), 1);

        if ($ext == 'php') {
            echo "php files not allowed to be uploaded! ";

        } else if (move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {

            chmod($target_path, 0755);
            echo "The file " . basename($_FILES['uploadedfile']['name']) .
                " has been uploaded";
        } else {
            echo "There was an error uploading the file, please try again!";
        }

    }

}

}

$uploadfile = new upload();
$uploadfile->fileupload();

?>