<?php
require 'db.php';
session_start();
if ( $_SESSION['logged_in'] != 1 ) {
  $_SESSION['message'] = "You must log in before viewing your profile page!";
  header("location: error.php");
}
else {
    // Makes it easier to read
    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
    $username = $_SESSION['username'];

}
error_reporting(0);
$name = ''; $type = ''; $size = ''; $error = '';
function compress_image($source_url, $destination_url, $quality) {

  $info = getimagesize($source_url);

      if ($info['mime'] == 'image/jpeg')
            $image = imagecreatefromjpeg($source_url);

      elseif ($info['mime'] == 'image/gif')
            $image = imagecreatefromgif($source_url);

    elseif ($info['mime'] == 'image/png')
            $image = imagecreatefrompng($source_url);

      imagejpeg($image, $destination_url, $quality);
  return $destination_url;
}

if (isset($_POST)) {
  if ($_FILES["file"]["error"] > 0) {
        $error = $_FILES["file"]["error"];
  }
  else if (($_FILES["file"]["type"] == "image/gif") ||
($_FILES["myfile"]["type"] == "image/jpeg") ||
($_FILES["myfile"]["type"] == "image/png") ||
($_FILES["myfile"]["type"] == "image/jpg")) {

        $url = 'your_profile_picture.jpg';

        $path = "uploads/$username/your_profile_picture.jpg";
        $filename = compress_image($_FILES["myfile"]["tmp_name"], $url, 20);
        $buffer = file_get_contents($url);
        chmod($path,0777);
        $file=file_put_contents($path,$buffer);
        if ($file) {
          echo "successfully uploaded";
        }else {
          echo "Error ...Try Again!!!";
        }
        if ($_FILES['myfile']['size'] > 3098888) {
          echo "File should be less than 3 MB";
        }

    //set the valid file extensions
    // $valid_formats = array("jpg", "png", "gif", "jpeg", "GIF", "JPG", "PNG"); //add the formats you want to upload
    //
    // $filename = $_FILES['myfile']['name']; //get the name of the file
    //
    // $size = $_FILES['myfile']['size']; //get the size of the file
    //
    //  $path = "uploads/$username/"; //set your folder path
    //
    //
    // if (strlen($filename)) { //check if the file is selected or cancelled after pressing the browse button.
    //     list($txt, $ext) = explode(".", $filename); //extract the name and extension of the file
    //     if (in_array($ext, $valid_formats)) { //if the file is valid go on.
    //         if ($size < 2098888) { // check if the file size is more than 2 mb
    //             // $file_name = $_POST['filename']; //get the file name
    //             $tmp = $_FILES['myfile']['tmp_name'];//$path . $file_name.'.'.$ext
    //
    //             if (move_uploaded_file($tmp,$path. "your_profile_picture".'.'."jpg" )) { //check if it the file move successfully.
    //                 echo "File uploaded successfully!!!!";
    //             } else {
    //                 echo "failed";
    //             }
    //         } else {
    //             echo "File size max 2 MB";
    //         }
    //     } else {
    //         echo "Invalid file format..";
    //     }
    // } else {
    //     echo "Please select a file..!";
    // }
    // exit;
}else {
      $error = "Uploaded image should be jpg or gif or png";}
}


?>
