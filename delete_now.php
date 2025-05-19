<?php

// Connect to Database
include("connections.php");

// POST user_id from confirm_delete.php
$user_id = $_POST["user_id"];

// Create Query that will delete row from database with the corresponding user_id
mysqli_query(
    $connections,
    "
    DELETE FROM users WHERE id='$user_id'
    "
);

// This will create a pop up for in the page that will show that a new record has been recorded
    echo "<script language='javascript'> alert('Successfully Deleted Record!'); </script>";
// Then proceeds to reload the file/ page
    echo "<script>window.location.href='index.php';</script>";

?>