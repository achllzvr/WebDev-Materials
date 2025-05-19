<?php

// Database Connectors: IP address, user, password, Database name
$connections = mysqli_connect("127.0.0.1","root","","myDB");

// If there is an error in connecting...
if(mysqli_connect_errno()){
    // ...Echo text + error details
    echo "Failed to Connect to MySQL: " . mysqli_connect_error();
}

?>