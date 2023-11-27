<?php

include "operation_insert.php";


$id = 0;
$name = "";
$value ="";
$date = "";
$image = "";
$update = false;
$path = "";


$name = $_GET['name'];
    $value =$_GET['value'];
    $date = $_GET['date'];
    $image = $_GET['image'];

$con = mysqli_connect($_SESSION['host'], $_SESSION['user'], $_SESSION['pass'], $_SESSION['db']);

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
        <div class="col-md-6 col-sm-12 justify-content-around" style="margin:auto ">

            <!--Create input field form for save and updating data-->
            <div class="container border-dark">

                <form action="operation.php" method="POST" enctype="multipart/form-data">

                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <div class="row">
                        <div class="form-group">
                            <label>Dog Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $name ?>">
                        </div>
                    </div>

                    <div class="row">

                        <div class="form-group">
                            <label>Dog Weight</label>
                            <input type="number" name="value" class="form-control" value="<?php echo $value ?>">
                        </div>


                        <div class="form-group">
                                                    <label>Adult</label>
                                                    <input type="checkbox" name="checked" class="form-control">

                                                </div>

                    </div>

                    <div class="row">
                        <div class="form-group">
                            <label>Birth Date</label>
                            <input type="date" name="date" class="form-control" value="<?php echo $date ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <label>Photo</label>
                            <input type="text" name="image" class="form-control" value="<?php echo $image ?>" disabled>
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
    </div>
</body>

</html>