<?php
/*start session*/
session_start();

$db = mysqli_connect($_SESSION['host'], $_SESSION['user'], $_SESSION['pass'], $_SESSION['db']);

$id = 0; 
$name = ""; 
$value ="";
$date = "";
$image = "";
$update = false;
$path = "";

$jsondata = "";


$id = $_GET['delete'];
$db->query("DELETE FROM tb WHERE id =$id")or die(mysqli_error($db));

   $_SESSION['message'] = "Record has been deleted";
   $_SESSION['msg_type'] = "danger";

   header("location: edit.php");
?>
