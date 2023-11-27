<?php
/*start session*/
session_start();

$db = mysqli_connect($_SESSION['host'], $_SESSION['user'], $_SESSION['pass'], $_SESSION['db']);

$jsondata = "";


$id = $_GET['detail'];

   $sql = "SELECT * FROM tb WHERE id=$id";

   $result  = mysqli_query($db,$sql);

   $json = array(); 
   while($row = $result->fetch_assoc()){
       $json[] = $row;
   }

  $jsondata= json_encode($json);

  echo $jsondata;
  
?>
