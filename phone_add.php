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


$name = $_GET['name'];
    $value =$_GET['value'];
    $date = $_GET['date'];
    $image = $_GET['image'];
    $update = false;

    //add data to database
    $db->query("INSERT INTO tb (iname,ivalue,idate,img) 
    VALUES('$name','$value','$date','$image')")or die(mysqli_error($db));

    
    if (isset($_FILES['files'])) {
        $errors = [];
        $path = 'uploads/';
        $extensions = ['jpg', 'jpeg', 'png', 'gif'];
        
        $all_files = count($_FILES['files']['tmp_name']);

        for ($i = 0; $i < $all_files; $i++) {  
        $file_name = $_FILES['files']['name'][$i];
        $file_tmp = $_FILES['files']['tmp_name'][$i];
        $file_type = $_FILES['files']['type'][$i];
        $file_size = $_FILES['files']['size'][$i];
        $file_ext = strtolower(end(explode('.', $_FILES['files']['name'][$i])));

        $file = $path . $file_name;

        if (!in_array($file_ext, $extensions)) {
            $errors[] = 'Extension not allowed: ' . $file_name . ' ' . $file_type;
        }

        if ($file_size > 2097152) {
            $errors[] = 'File size exceeds limit: ' . $file_name . ' ' . $file_type;
        }

        if (empty($errors)) {
            move_uploaded_file($file_tmp, $file);
        }

        if ($errors) print_r($errors);
        
        }
    }



    $_SESSION['message'] = "Record has been saved";
    $_SESSION['msg_type'] = "warning";

    header("location:index.php");

?>