<?php
session_start();

$_SESSION['host'] = "localhost";
$_SESSION['user'] = "root";
$_SESSION['pass'] = "";
$_SESSION['db']  = "dog";

$_SESSION['message'] = "";
$_SESSION['msg_type'] = "";

$db = mysqli_connect($_SESSION['host'], $_SESSION['user'], $_SESSION['pass'], $_SESSION['db']);

$id = 0;
$name = "";
$value ="";
$date = "";
$image = "";
$checked = false;
$update = false;
$path = "";

$jsondata = "";


//handle save button
if(isset($_POST['save'])){
    //variables
    $name = $_POST['name'];
    $value =$_POST['value'];
    $date = $_POST['date'];
    $checked = $_POST['checked'];
    $update = false;


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

            $image = $path . $file_name;
        }

        if ($errors) print_r($errors);

        }
    }


    //add data to database
    $db->query("INSERT INTO tb (iname,ivalue,idate,img,ichecked)
    VALUES('$name','$value','$date','$image', '$checked')")or die(mysqli_error($db));


    $_SESSION['message'] = "Record has been saved";
    $_SESSION['msg_type'] = "warning";

    header("location:index.php");
}


//delete button clicked

if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $db->query("DELETE FROM tb WHERE id =$id")or die(mysqli_error($db));

   $_SESSION['message'] = "Record has been deleted";
   $_SESSION['msg_type'] = "danger";

   header("location: index.php");
}

//edit button clicked
if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = true;
    $result = $db->query("SELECT * FROM tb WHERE id=$id") or die(mysqli_error($db));

    //if(count($result)==1){
    if(true){
        $row = $result->fetch_array();
        $name = $row['iname'];
        $value =$row['ivalue'];
        $date = $row['idate'];
        $image = $row['img'];
        $checked = $row['ichecked'];
        $update = true;
    }
}

//update clicked
if(isset($_POST['update'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $value =$_POST['value'];
    $date = $_POST['date'];
    $image = $_POST['image'];
        $checked = $_POST['checked'];
    $update = false;


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

            $image = $path . $file_name;
        }

        if ($errors) print_r($errors);

        }
    }

    $db->query("UPDATE tb SET
    iname='$name',ivalue='$value',idate='$date',img='$image', ichecked='$checked' WHERE id=$id")
      or die(mysqli_error($db));

  $_SESSION['message'] = "Record has been updated!";
  $_SESSION['msg_type'] = "warning";

  header('location: index.php');
}

//view the detail button cliked
if(isset($_GET['detail'])){
   //Get the json format
   $id = $_GET['detail'];
   $result = $db->query("SELECT * FROM tb WHERE id=$id") or die(mysqli_error($db));

   //if(count($result)==1){
   if(true){
           $row = $result->fetch_array();
           $name = $row['iname'];
           $value =$row['ivalue'];
           $date = $row['idate'];
           $image = $row['img'];
                      $checked = $row['ichecked'];
           $update = true;
   }

   $json = array(); 
   while($row = $result->fetch_assoc()){
       $json[] = $row;
   }

  $jsondata= json_encode($json);

}


//view the details button cliked
if(isset($_GET['details'])){
   //Get the json format
   $sql = "SELECT * FROM tb";
   $result  = mysqli_query($db,$sql);

   $json = array();
   while($row = $result->fetch_assoc()){
       $json[] = $row;
   }

  $jsondata= json_encode($json);

}