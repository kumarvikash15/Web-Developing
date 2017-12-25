<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>upload</title>
  </head>
  <body>
    <form method="post" action="upload.php" enctype="multipart/form-data">
    Enter ID:<br>  <input type="number" name="id" value="Enter Id">
    <table width="350" border="0" cellpadding="1" cellspacing="1" class="box">
    <tr>
    <td width="246">
    <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
    <input name="userfile" type="file" id="userfile">
    </td>
    <td width="80"><input name="upload" type="submit" class="box" id="upload" value=" Upload "></td>
    </tr>
    </table>
    </form>
  </body>
</html>
<?php

$host = 'localhost';
$user = 'root';
// $pass = 'mypass123';
$pass="";
$db = 'accounts';
$conn = new mysqli($host,$user,$pass,$db) or die($mysqli->error);

if(isset($_POST['upload']) && $_FILES['userfile']['size'] > 0)
{
$fileName = $_FILES['userfile']['name'];
$tmpName  = $_FILES['userfile']['tmp_name'];
$fileSize = $_FILES['userfile']['size'];
$fileType = $_FILES['userfile']['type'];

$fp      = fopen($tmpName, 'r');
$content = fread($fp, filesize($tmpName));
$content = addslashes($content);
fclose($fp);

if(!get_magic_quotes_gpc())
{
    $fileName = addslashes($fileName);
}

$sql = "INSERT INTO upload (name, size, type, content ) ".
"VALUES ('$fileName', '$fileSize', '$fileType', '$content')";

$conn->query($sql) or die('Error, query failed');


echo "<br>File $fileName uploaded<br>";
$conn->close();
}
?>
