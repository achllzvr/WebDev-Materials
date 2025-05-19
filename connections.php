<?php

$connections = mysqli_connect("127.0.0.1","root","","myDB");

if(mysqli_connect_errno()){
    echo "Failed to Connect to MySQL: " . mysqli_connect_error();
}else{
    echo "Connected.";
}

?>