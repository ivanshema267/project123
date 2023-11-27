<?php

session_start();

if (isset($_POST['submit'])) {
    $table = $_POST['options'];
}

$id = 0;
$name = "";
$value ="";
$date = "";
$image = "";
$update = false;
$path = "";

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

        <?php

        if (isset($_SESSION['message'])) { ?>

            <div class="alert alert-<?= $_SESSION['msg_type'] ?>">
                <?php echo $_SESSION['message'];
                unset($_SESSION['message']);
                ?>

            </div>

        <?php }



    $name = $_POST['name'];
    $value =$_POST['value'];
    $date = $_POST['date'];
    $image = $_POST['image'];
    $update = false;

         ?>


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
        <div class="col-md-6 col-sm-12">
         <a href="<?php echo $image; ?>"> <img height="500" width="400" src="<?php echo $image; ?>" alt="Item Image"> </a>
        </div>
        </div>
    </div>
</body>

</html>