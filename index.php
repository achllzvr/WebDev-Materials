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

    // If address is empty, require name
    if (empty ($_POST["address"])) {
        $addressErr = "Address is required!";
    } else {
        $address = $_POST["address"];
    }

    // If email is empty, require name
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

    }

?>