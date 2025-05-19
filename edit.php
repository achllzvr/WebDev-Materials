<?php

// This will fetch the id when the Update button is clicked calling the file with an attached id
$user_id = $_REQUEST["id"];

// Establish connection with database using connections.php
include("connections.php");

// Creates a variable that will hold data from the retrieve query
$get_record = mysqli_query(
    // Create connection with database
    $connections, 
    // SQL Query WHERE the id is the corresponding id clicked
    "SELECT * FROM users WHERE id='$user_id'"
    );

// Loop through values til there isn't a value anymore
while($row_edit = mysqli_fetch_assoc($get_record)){

    // Initialize variables to store fetched records
    $db_name = $row["name"];
    $db_address = $row["address"];
    $db_email = $row["email"];

}

?>

<!-- Start a Form -->
<form method="POST" action="update_records.php">

<!-- hidden input to store the user id -->
<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">

<br>

<!-- Input for New Name -->
<input type="text" placeholder="Enter New Name" ="new_name" value="<?php echo $db_name; ?>">

<br>

<!-- Input for New Address -->
<input type="text" placeholder="Enter New Address" name="new_address" value="<?php echo $db_address; ?>">

<br>

<!-- Input for New Email -->
<input type="text" placeholder="Enter New Email" name="new_email" value="<?php echo $db_email; ?>">

<br>

<!-- Update Button -->
<input type="submit" value="update">

</form>