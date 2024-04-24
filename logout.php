<?php
session_start();
if(!empty($_SESSION["id"])){
$_SESSION['id']='';
    header("location: index.php");
    session_destroy();

}
?>