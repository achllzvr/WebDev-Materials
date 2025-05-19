<?php

// Establish a connection to the database
include("connections.php");

// If there is no search term in the URL, display an error message
if(empty($_GET['search'])) {
    
    echo "<h2>Please enter a search term.</h2>";

// ELSE, assign the search term to a variable
} else {

    $check = $_GET['search'];

    // Explode the search term into an array of terms
    // This will split the search term by spaces
    // For example, "hello world" will become ["hello", "world"]
    $terms = explode(" ", $check);

    // Prepare the SQL query
    $q = "SELECT * FROM users WHERE ";

    // $i is used to keep track of the number of terms
    $i = 0;

    // Loop through each term
    // The exploded words in $terms will be looped through and assigned to $each
    foreach($terms as $each) {

        $i++;

        // If $i is 1, this is the first term
        if($i == 1) {
            // Add the first term to the query
            $q .= "name LIKE '%$each%'";
        // If $i is greater than 1, this is not the first term which means it is a subsequent term
        // So we add an OR condition to the query to be added to the first term query
        } else {
            // Add the subsequent term to the query
            $q .= " OR name LIKE '%$each%'";
        }

    }

    // The completed query after the loop will look like this:
    // SELECT * FROM users WHERE name LIKE '%hello%' OR name LIKE '%world%'
    // Connect the Database, add the complete query (After the loop), Execute the query
    $query = mysqli_query($connections, $q);

    // Check if the query returned any results
    // If it did, assign the number of rows to $c_q
    $c_q = mysqli_num_rows($query);

    // Loop through the results
    // If the query returned results and $check is not empty...
    if($c_q > 0 && $check!=""){

        // While loop that will continue to loop as long as there is an existing row from the data fetched
        while($row = mysqli_fetch_assoc($query)){

            // Echo the result (name)
            echo $name = $row["name"] . "<br>";

        }

    } else {

        // Display a message if no results were found
        echo "<h2>No results found for '$check'.</h2>";

    }


}

?>