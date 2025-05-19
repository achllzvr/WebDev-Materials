<?php

// Establish connection with database using connections.php
include("connections.php");

// Create variables to store data from edit.php
$user_id = $_POST["user_id"];
$new_name = $_POST["new_name"];
$new_address = $_POST["new_address"];
$new_email = $_POST["new_email"];

// Create SQL Query
mysqli_query(
    $connections,
    "
    UPDATE users SET name='$new_name',
    address='$new_address',
    email='$new_email'
    WHERE id='$user_id'
    "
);

// This will create a pop up for in the page that will show that a new record has been recorded
    echo "<script language='javascript'> alert('Successfully Updated Record!'); </script>";
// Then proceeds to reload the file/ page
    echo "<script>window.location.href='index.php';</script>";

?>