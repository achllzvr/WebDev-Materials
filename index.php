<!-- Start of PHP field initializations -->
<?php

// Connects with php file for connection
// Including connections.php will make sure that everything in connections.php will be inherited into index.php
include("connections.php");

// Initializes fields as blank
$name = $address = $email = $password = $account_type ="";
$nameErr = $addressErr = $emailErr = $account_typeErr = $passwordErr = "";

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

    // If password is empty, require password
    if (empty ($_POST["password"])) {
        $passwordErr = "Password is required!";
    } else {
        $password = $_POST["password"];
    }

    // if confirm_password is empty, require confirm_password
    if (empty ($_POST["confirm_password"])) {
        $confirm_passwordErr = "Confirm Password is required!";
    } else {
        $confirm_password = $_POST["confirm_password"];
    }

    // If account_type is empty, require account_type
    if (empty ($_POST["account_type"])) {
        $account_typeErr = "Account Type is required!";
    } else {
        $account_type = $_POST["account_type"];
    }

    // When name, address, email has values...
    if ($name && $address && $email && $password && $confirm_password) {

        // EMAIL VALIDATION -------------------------------------------------------------------------------------------------

        // Check if email already exists in database
        $check_email = mysqli_query($connections, "SELECT * FROM users WHERE email='$email'");

        // and grab the data from row in database
        $check_email_row = mysqli_num_rows($check_email);

        // If email already exists, show error message
        if($check_email_row > 0){

            $emailErr = "Email already exists!";

        // If email is available, insert data into database
        } else {

            $query = mysqli_query($connections, "
                INSERT INTO users(
                    name,
                    address,
                    email,
                    password,
                    account_type
                )

                VALUES(
                    '$name',
                    '$address',
                    '$email',
                    '$password',
                    '$account_type'
                )
            ");

            // INSERT INTO prepares the table 'users' and its columns 'name', 'address', and 'email' for data insertion
            /* VALUES will insert the values for those columns based on the parameters seen on the start of our
                    IF statement which are the values of the fields in our FORM
            */

            // This will create a pop up for in the page that will show that a new record has been recorded
            echo "<script language='javascript'> alert('New Record has been inserted!'); </script>";
            // Then proceeds to reload the file/ page
            echo "<script>window.location.href='index.php';</script>";

        }

    }

}

?>
<!-- End of PHP field initializations  ----------------------------------------------------------------------------------->


<!-- Start of STYLES ------------------------------------------------------------------------------------------------->
<style>

/* Error Text Color Style */
*{
    font-family: Arial, Helvetica, sans-serif;
}

.error { 
     color:red;
}
   
</style>
<!-- End of STYLES ------------------------------------------------------------------------------------------------->


<!-- Start of NAV ------------------------------------------------------------------------------------------------->

<?php

// Include Nav (NavBar file) in the main file (index.php)
include("nav.php");

?>

<!-- End of NAV ------------------------------------------------------------------------------------------------->


<!-- Start of FORM ------------------------------------------------------------------------------------------------->
<form method="POST" action="<?php htmlspecialchars ("PHP_SELF"); ?>">
<br>

<!-- Name input field | name as id, type as text -->
Name: <input type="text" name= "name" placeholder="Enter your name" value="<?php echo $name; ?>"> <br>
<!-- Error echo for error messages -->
<span class="error"><?php echo $nameErr; ?> </span> <br>

<!-- address input field | address as id, type as text -->
Address: <input type="text" name= "address" placeholder="Enter your Address" value="<?php echo $address; ?>"> <br>
<!-- Error echo for error messages -->
<span class="error"><?php echo $addressErr; ?> </span> <br>

<!-- email input field | email as id, type as text -->
Email: <input type="text" name= "email" placeholder="Enter your Email" value="<?php echo $email; ?>"> <br>
<!-- Error echo for error messages -->
<span class="error"><?php echo $emailErr; ?> </span> <br>

<!-- password input field | password as id, type as text -->
Password: <input type="password" name= "password" placeholder="Enter your Password" value="<?php echo $password; ?>"> <br>
<!-- Error echo for error messages -->
<span class="error"><?php echo $passwordErr; ?> </span> <br>

<!-- confirm password input field | confirm_password as id, type as text -->
Confirm Password: <input type="password" name= "confirm_password" placeholder="Confirm Password" value="<?php echo $confirm_password; ?>"> <br>
<!-- Error echo for error messages -->
<span class="error"><?php echo $confirm_passwordErr; ?> </span> <br>

<!-- Submit button -->
<input type="submit" name="Submit">

</form>
<!-- End of FORM ------------------------------------------------------------------------------------------------->


<!-- Horizontal Line -->
<hr>


<!-- Queries ------------------------------------------------------------------------------------------------->
<?php

include("connections.php");

    /* DATA INSERTION -----------------------------------------------------------------------------------------------

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

    // This will create a pop up for in the page that will show that a new record has been recorded
    echo "<script language='javascript'> alert('New Record has been inserted!'); </script>";
    // Then proceeds to reload the file/ page
    echo "<script>window.location.href='index.php';</script>";

    */


    // DATA VIEWING -----------------------------------------------------------------------------------------------

    // Creates a variable named 'view_query'
    // This selects all data from the 'users' table
    $view_query = mysqli_query($connections, "SELECT * FROM users");

    // Start of a Table
    echo "<table border='1' width='50%'>";
    echo "<tr>
                <td>Names:</td>
                <td>Address:</td>
                <td>Email:</td>

                <td>Option</td>
            </tr>";

    // While loop that will continue to loop as long as there is an existing row from the data fetched
    while($row = mysqli_fetch_assoc($view_query)){

        // The data fetched per row will be stored in these four corresponding variables
        $db_id = $row["id"];
        $db_name = $row["name"];
        $db_address = $row["address"];
        $db_email = $row["email"];

        // Echo the fetched data per row into the table
        echo "<tr>
                <td>$db_name</td>
                <td>$db_address</td>
                <td>$db_email</td>

                
                <td>
                <a href='edit.php?id=$db_id'>Update</a>
                &nbsp;
                <a href='confirm_delete.php?id=$db_id'>Delete</a>
                </td>

            </tr>";

    }

    // End of Table
    echo "</table>";

?>
<!-- End of Queries ------------------------------------------------------------------------------------------------->

<hr>

<!-- FOR EACH  ------------------------------------------------------------------------------------------------->
<?php

// Initialize Variables
$fn = "Chi";
$ln = "Rab";

// Initialize Array and its content
$names = array("$fn","$ln");

// For each loop where $display_names is the array $names
foreach($names as $display_names){

    // Echo all display names concatenating with a break line
    echo $display_names . "<br>";
}

?>