<?php

/**
 * Class upload
 *
 * to arxeio kalite apo html form me submit kai value parametro to onoma tis klassis
 * prota dimiourgite to antikimeno kai meta ektelite i methodos line 49
 */
class upload {

    /**
     * i methodos pernei to onoma arxei o tin Global metavliti $_FILES pou egine apo html input submit
     * kai anevazei to arxio ston server ston folder pou einai kai o xristis.
     */
function fileupload()
{
    //to name uploadedfile apo to html input value pou einai type="file"
    $file = $_FILES["uploadedfile"];

    if (isset($file)) {
        session_start();

        //$userfolder = $_SESSION['folder'];
        $userfolder = $_SESSION['path'];
        //to allazw edw apo to folder na xrisimopoiei to path gia na doulevei swsta
        $target_path = "$userfolder/";
        $target_path = $target_path . basename($_FILES['uploadedfile']['name']);
        $ext = substr(strrchr($_FILES['uploadedfile']['name'], "."), 1);

        if ($ext == 'php') {
            echo "php files not allowed to be uploaded! ";

        } else if (move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {

            chmod($target_path, 0755);
            //echo "The file " . basename($_FILES['uploadedfile']['name']) .
             //   " has been uploaded";

            echo "<script> toastr.success('file uploaded successfully!'); </script>";

        } else {
            echo "There was an error uploading the file, please try again!";
        }

    }

}

}

$uploadfile = new upload();
$uploadfile->fileupload();

?>