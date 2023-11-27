<?php session_start()?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="bootstrap\css\bootstrap.min.css">
    <title>Options Check</title>
</head>
<body>
    
<!--check yhe selected option-->
<?php

  //connect db
  include "connection.php";
   $link = mysqli_connect($_SESSION['host'],$_SESSION['user'],$_SESSION['pass'],$_SESSION['db']);

     //create table if not exist
     $sql = "CREATE TABLE IF tb(id INT(11) NOT NULL AUTO_INCREMENT,
     iname VARCHAR(100) NOT NULL,ivalue DOUBLE NOT NULL,
     idate DATE NOT NULL,img VARCHAR(1000) NOT NULL, PRIMARY KEY(id))";

        if ($link->query($sql) === TRUE) {
            echo "Table MyGuests created successfully";
        } else {
            echo "Error creating table: " . $conn->error;
        }

    if (isset($_POST['submit'])) {
        $op = $_POST['options'];

        if ($op == "edit") { 
        
            header("location: edit.php");

        } else if ($op == "view") {
          header("location: view.php");
        

        } else if ($op == "viewd") {
            //show create db option
            header("location:detail.php");
        }
    }
    ?>
</body>
</html>