<?php session_start()?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="bootstrap\css\bootstrap.min.css">
    <title>Options</title>
</head>

<body>

    <?php 
    include "connection.php";
    if (isset($_POST['hostsubmit'])) {
        $host = $_POST['host'];
        $user = $_POST['user'];
        $pass = $_POST['pass'];

        $link = connect($host, $user, $pass);
        $sql = "CREATE DATABASE IF NOT EXISTS computer";
        if ($link->query($sql) != true) {
            header("location:index.php");
        } else {
            $link = new mysqli($host, $user, $pass, "computer");
            $_SESSION['host'] = $host;
            $_SESSION['user'] = $user;
            $_SESSION['pass'] = $pass;
            $_SESSION['db'] = "computer";
        }
    }

    ?>

    <!--Options after loging in-->
    <div class="container">
        <div class="col-md-4 col-sm-12 justify-content-center" style="margin:auto;font-size:1.5em">
            <h2>Welcome</h2>
            <div class="card bg-dark text-info">
                Choose the option you want.
            </div>

            <form action="ophandle.php" method="POST">
                <select name="options" class="btn btn-lg">
                    <option value="edit">Edit</option>
                    <option value="view">View List</option>
                    <option value="viewd">View Details</option>
                </select>
                <input type="submit" class="btn btn-dark" value="Submit" name="submit">
            </form>

        </div>
    </div>
</body>

</html>