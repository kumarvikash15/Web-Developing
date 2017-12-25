<?php
if(isset($_GET['id']))
{
// if id is set then get the file with the id from database

include 'dbconfig.php';


$id    = $_GET['id'];
$query = "SELECT name, type, size, content " .
         "FROM upload WHERE id = '$id'";

$result = mysqli_query($conn,$query) or die('Error, Query failed');
list($name, $type, $size, $content) = mysqli_fetch_array($result);
$row=$result->fetch_assoc();

header("Content-length: $size");
header("Content-type: $type");
header("Content-Disposition: attachment; filename=$name");
ob_clean();
flush();
echo $content;
mysqli_close($conn);
exit;
}

?>
