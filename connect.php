<?php
$hostName = "localhost:3307";
$dbUser = "root";
$dbPassword = "";
$dbName = "ec";
$conn = mysqli_connect($hostName, $dbUser, $dbPassword,$dbName);
if(!$conn){
die("error connection");
}
?>