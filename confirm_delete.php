<?php

// Create variable to store id
$user_id = $_REQUEST["id"];

// Establish connection with database using connections.php
include("connections.php");

// Create a query to select all data where the ID is a match to
$query_delete = mysqli_query(
    $connections,
    "
    SELECT * FROM users WHERE id = '$user_id'
    "
);

// Create a WHILE LOOP to loop through all data til all data is fetched and assigned them to variables
while($row_delete = mysqli_fetch_assoc($query_delete)){
    
        $db_id = $row_delete["id"];
        $db_name = $row_delete["name"];
        $db_address = $row_delete["address"];
        $db_email = $row_delete["email"];
}

// Confirmation Dialogue
echo "<h1> Are you sure you want to delete $db_name ? </h1>";

?>

<!-- Start a Form -->
<form method="POST" action="delete_now.php">

<!-- hidden input to store the user id -->
<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
<br>
<br>

<!-- Yes or No Buttons -->
<input type="submit" value="Yes"> &nbsp; <a href='index.php'>No</a>

</form>