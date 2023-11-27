<?php
session_start();

$_SESSION['host'] = "localhost";
$_SESSION['user'] = "root";
$_SESSION['pass'] = "";
$_SESSION['db']  = "dog";

$_SESSION['message'] = "";
$_SESSION['msg_type'] = "";

    $link =  mysqli_connect($_SESSION['host'],$_SESSION['user'],$_SESSION['pass']);
    // create database
    $sql = "CREATE DATABASE IF NOT EXISTS dog";
        if ($link->query($sql) != true) {
            header("location:index.php");
        } else {
           
        }

   $link = mysqli_connect($_SESSION['host'],$_SESSION['user'],$_SESSION['pass'],$_SESSION['db']);

  //create table if not exist
  $sql = "CREATE TABLE tb(id INT(11) NOT NULL AUTO_INCREMENT,
  iname VARCHAR(100) NOT NULL,ivalue DOUBLE NOT NULL,
  idate DATE NOT NULL,img VARCHAR(1000) NOT NULL, ichecked VARCHAR(100) NOT NULL, PRIMARY KEY(id))";

     if ($link->query($sql) === TRUE) {
        
     } else {
        
     }

//include "operation.php";

$con = mysqli_connect($_SESSION['host'], $_SESSION['user'], $_SESSION['pass'], $_SESSION['db']);
$sql = "SELECT * FROM tb";
$result = $con->query($sql) or die(mysqli_error($con));

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="bootstrap\css\bootstrap.min.css">
    <title>Dogs</title>



	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="css/pricing-tables.css">
	<!--[if lte IE 9]><link rel="stylesheet" href="css/ie.css"><![endif]-->

	<style>body{min-height: 500px;-webkit-box-shadow:inset 0 0 0 5px #f2f2f2,inset 0 0 0 10px #90c0aa,inset 0 0 0 15px #f2f2f2;-mox-box-shadow:inset 0 0 0 5px #f2f2f2,inset 0 0 0 10px #90c0aa,inset 0 0 0 15px #f2f2f2;box-shadow:inset 0 0 0 5px #f2f2f2,inset 0 0 0 10px #90c0aa,inset 0 0 0 15px #f2f2f2;margin:0}.pricing-table{margin: 0 auto;top: 20px;position: relative;}</style>
<meta name="robots" content="noindex,follow" />

</head>

<body style="padding-top:10px">

        <?php if (isset($_SESSION['message'])) { ?>

            <div class="alert alert-<?= $_SESSION['msg_type'] ?>">
                <?php echo $_SESSION['message'];
                unset($_SESSION['message']);
                ?>

            </div>

        <?php } ?>


    <!-- create data display layout-->
    <div class="container justify-content-center">
        <div class="row">
        <div class="col-md-10 col-sm-12  style="margin:auto ">
            <table class="table table-bordered table-sm class="pricing-table">
                <thead class="thead-light">
                    <tr>
                        <th>Code</th>
                        <th>Dog Name</th>
                        <th>Dog Weight</th>
                        <th>Adult</th>
                        <th>Bith Date</th>
                        <th>Photo</th>
                        <th colspan="2">Dashboard</th>
                    </tr>
                </thead>

                <?php while ($rows = $result->fetch_assoc()) { ?>
                    <tr  class="clock-icon">
                        <td class="green"><?php echo $rows['id']; ?></td>
                        <td><?php echo $rows['iname']; ?></td>
                        <td class="green"><?php echo $rows['ivalue']; ?></td>
                        <td><?php echo $rows['ichecked']; ?></td>
                        <td class="green"><?php echo $rows['idate']; ?></td>
                        <td> <a href="<?php echo $rows['img']; ?>"> <img height="100" width="100" src="<?php echo $rows['img']; ?>" alt="Item Image"> </a> </td>

                        <td class="green">
                            <a href="edit.php?edit=<?php echo $rows['id'] ?>" class="btn btn-danger">Edit</a>
                            <a href="detail.php?detail=<?php echo $rows['id'] ?>" class="btn btn-danger">Detail</a>
                            <a href="operation.php?delete=<?php echo $rows['id'] ?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </table>


            <!--Create input field form for save and updating data-->
            <div hidden class="container border-dark">

                <form action="operation.php" method="POST" enctype="multipart/form-data">

                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <div class="row">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $name ?>">
                        </div>
                    </div>

                    <div class="row">

                        <div class="form-group">
                            <label>Value</label>
                            <input type="number" name="value" class="form-control" value="<?php echo $value ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <label>Date</label>
                            <input type="date" name="date" class="form-control" value="<?php echo $date ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <label>Image</label>
                            <input type="text" name="image" class="form-control" value="<?php echo $path ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <input type="file" name="files[]" id="files[]" value="Upload">  
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <?php
                            if ($update == true) {
                                ?><button type="submit" name="update" class="btn btn-outline-info">Update</button>
                            <?php } else {
                            ?><button type="submit" name="save" class="btn btn-outline-success">Save</button>
                            <?php }
                        ?>

                        </div>
                    </div>

                </form>
            </div>

           
        </div>

        <div class="col-md-2 col-sm-4">
        <a href="add.php" class="btn btn-danger">Add Dog</a>
        </div>

        </div>
    </div>


</body>

</html>