<?php

session_start();

$_SESSION['host'] = "localhost";
$_SESSION['user'] = "root";
$_SESSION['pass'] = "";
$_SESSION['db']  = "computer";

$con = mysqli_connect($_SESSION['host'], $_SESSION['user'], $_SESSION['pass'], $_SESSION['db']);

$jsondata = "";


$sql = "SELECT * FROM tb";
$result  = mysqli_query($con,$sql);

$json = array();

while($row = $result->fetch_assoc()){
       $json[] = $row;
}

  $jsondata= json_encode($json);

  echo $jsondata;

?>