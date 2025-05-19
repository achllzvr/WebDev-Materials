<!-- Start of PHP field initializations -->
<?php

// Initializes fields as blank
$name = $address = $email = "";
$nameErr = $addressErr = $emailErr = "";

// POST Request
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // If name is empty, require name
    if (empty ($_POST["name"])) {
        $nameErr = "Name is required!";
    } else {
        $name = $_POST["name"];
    }

    // If address is empty, require address
    if (empty ($_POST["address"])) {
        $addressErr = "Address is required!";
    } else {
        $address = $_POST["address"];
    }

    // If email is empty, require email
    if (empty ($_POST["email"])) {
        $emailErr = "Email is required!";
    } else {
        $email = $_POST["email"];
    }

}

?>
<!-- End of PHP field initializations -->


<!-- Start of STYLES -->
<style>

/* Error Text Color Style */
.error { 
     color:red;
}
   
</style>
<!-- End of STYLES -->



<!-- Start of FORM -->
<form method="POST" action="<?php htmlspecialchars ("PHP_SELF"); ?>">

<!-- Name input field | name as id, type as text -->
<input type="text" name= "name" value="<?php echo $name; ?>"> <br>
<!-- Error echo for error messages -->
<span class="error"><?php echo $nameErr; ?> </span> <br>

<!-- address input field | address as id, type as text -->
<input type="text" name= "address" value="<?php echo $address; ?>"> <br>
<!-- Error echo for error messages -->
<span class="error"><?php echo $addressErr; ?> </span> <br>

<!-- email input field | email as id, type as text -->
<input type="text" name= "email" value="<?php echo $email; ?>"> <br>
<!-- Error echo for error messages -->
<span class="error"><?php echo $emailErr; ?> </span> <br>

<!-- Submit button -->
<input type="submit" name="Submit">

</form>
<!-- End of FORM -->


<!-- Horizontal Line -->
<hr>


<!-- Database Connection -->
<?php

// Connects with php file for connection
// Including connections.php will make sure that everything in connections.php will be inherited into index.php
include("connections.php");

    // When name, address, email has values...
    if ($name && $address && $email) {

        // Start a query for handling and connect with database
        // $connections is to connect to the $connections variable in connections.php to connect the file to the database

        //This query will insert the name, address, and email into the database corresponding columns
        $query = mysqli_query($connections, "
            INSERT INTO users(
                name,
                address,
                email
            )

            VALUES(
                '$name',
                '$address',
                '$email'
            )
        ");

        // INSERT INTO prepares the table 'users' and its columns 'name', 'address', and 'email' for data insertion
        /* VALUES will insert the values for those columns based on the parameters seen on the start of our
                IF statement which are the values of the fields in our FORM
        */

        // This will create a pop up for in the page that will show that a new record has been recorded
        echo "<script language='javascript'› window.alert('New Record has been inserted!'); </script>";
        // Then proceeds to reload the file/ page
        echo "<script>window.location.href='index.php';</script>";

    }

    // Creates a variable named 'view_query'
    // This selects all data from the 'users' table
    $view_query = mysqli_query($connections, "SELECT * FROM users");

    // Start of a Table
    echo "<table border='1' width='50%'>";

    // While loop that will continue to loop as long as there is an existing row from the data fetched
    while($row = mysqli_fetch_assoc($view_query)){

        // The data fetched per row will be stored in these three corresponding variables
        $db_name = $row["name"];
        $db_address = $row["address"];
        $db_email = $row["email"];

        // Echo the fetched data per row into the table
        echo "<tr>
                <td>$db_name</td>
                <td>$db_address</td>
                <td>$db_email</td>
            </tr>";

    }

    // End of Table
    echo "</table>";

?>