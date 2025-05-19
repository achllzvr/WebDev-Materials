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

<style>

/* Error Text Color Style */
.error { 
     color:red;
}
   
</style>

<!-- Start of Form -->
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
<!-- End of Form -->

<hr>


<!-- Database Connection -->
<?php

// Connects with php file for connection
include("connections.php");

    // When name, address, email has values...
    if ($name && $address && $email) {

        // ...Echo results
        echo $name . "<br>";
        echo $address . "<br>";
        echo $email . "<br>";

    }

?>