<?php
/* Database connection settings */
$host = 'localhost';
$user = 'root';
// $pass = 'mypass123';
$pass="";
$db = 'accounts';
$mysqli = mysqli_connect($host,$user,$pass,$db) or die($mysqli->error);
?>
