<?php   
//connect to the server

function connect($host,$user,$pass){
    //create connection
    $con = new mysqli($host,$user,$pass);
    if($con->connect_error){
        return null;
    }
    else{
        return $con;
    }
    
}


//create table function
function createtable($con,$name){
    $sql = "CREATE TABLE $name(id INT(11) NOT NULL,
    iname VARCHAR(100) NOT NULL,ivalue DOUBLE NOT NULL,
   idate DATE NOT NULL,img VARCHAR(1000) NOT NULL PRIMARY KEY(id))";
    
    $con->query($sql) or die($con->error());

}
?>