<?php
require 'db.php';

error_reporting(0);
if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {

    //set the valid file extensions
    $valid_formats = array("jpg", "png", "gif", "bmp", "jpeg", "GIF", "JPG", "PNG", "doc", "txt", "docx", "pdf", "xls", "xlsx"); //add the formats you want to upload

    $filename = $_FILES['myfile']['name']; //get the name of the file

    $size = $_FILES['myfile']['size']; //get the size of the file
    $roll =$_POST['roll'];   //to get roll no

    $query ="SELECT username FROM users WHERE id='$roll';";
    $result = mysqli_query($mysqli,$query) or die("Error in connection with db");
    if (mysqli_num_rows($result)==0) {
      echo "database is empty<br>";
    }else {
       list($name)=mysqli_fetch_array($result);
     }
     $path = "uploads/$name/"; //set your folder path


    if (strlen($filename)) { //check if the file is selected or cancelled after pressing the browse button.
        list($txt, $ext) = explode(".", $filename); //extract the name and extension of the file
        if (in_array($ext, $valid_formats)) { //if the file is valid go on.
            if ($size < 5098888) { // check if the file size is more than 2 mb
                $file_name = $_POST['filename']; //get the file name
                $tmp = $_FILES['myfile']['tmp_name'];//$path . $file_name.'.'.$ext

                if (!file_exists("uploads/$name")) {
                 mkdir("uploads/$name", 0777, true);
                }

                if (move_uploaded_file($tmp,$path. $file_name.'.'.$ext )) { //check if it the file move successfully.
                    echo "File uploaded successfully!!.$roll";
                } else {
                    echo "failed";
                }
            } else {
                echo "File size max 2 MB";
            }
        } else {
            echo "Invalid file format..";
        }
    } else {
        echo "Please select a file..!";
    }
    exit;
}
