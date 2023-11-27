<?php
session_start();


if (isset($_POST['submit'])) {
    $table = $_POST['options'];
}

include "connection.php";
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
    <title>View List</title>
</head>

<body style="padding-top:10px"> 

    <!-- create data display layout-->
    <div class="container">
        <div class="col-md-6 col-sm-12 justify-content-center" style="margin:auto">
        <table class="table table-bordered table-sm table-responsive">
            <thead class="thead-light">
                <tr>
                   <th>ID</th>
                   <th>Name</th>
                   <th>Cost</th>
                   <th>Production Date</th>
                   <th>Image Location</th>
                </tr>
            </thead>

            <?php while ($rows = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $rows['id']; ?></td>
                    <td><?php echo $rows['iname']; ?></td>
                    <td><?php echo $rows['ivalue']; ?></td>
                    <td><?php echo $rows['idate']; ?></td>
                    <td> <a href="<?php echo $rows['img']; ?>"> <img height="100" width="100" src="<?php echo $rows['img']; ?>" alt="Item Image"> </a> </td>
                </tr>
            <?php } ?>
        </table>
    </div>
    </div>

</body>

</html>