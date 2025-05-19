<!-- Start of PHP ------------------------------------------------------------------------------------------------->
<?php

// $email and $password and their errors are initialized as blank
$email = $password = "";
$emailErr = $passwordErr = "";

// IF the request method is POST,
if($_SERVER["REQUEST_METHOD"] == "POST") {

    // Checks if email is empty
    if(empty($_POST["email"])) {
        $emailErr = "Email is required!";
    } else {
        $email = $_POST["email"];
    }

    // Checks if password is empty
    if(empty($_POST["password"])) {
        $passwordErr = "Password is required!";
    } else {
        $password = $_POST["password"];
    }

    // If email and password has values...
    if($email && $password) {

        // Connects with php file for connection
        include("connections.php");

        // SQL Query to check if email already exists (SAME AS THE ONE IN index.php)
        $check_mail = mysqli_query($connections, "SELECT * FROM users WHERE email = '$email' AND password = '$password'");
        $check_email_row = mysqli_num_rows($check_mail);

        // If there is a result...
        if($check_email_row > 0){

            $emailErr = $passwordErr = "";

            while($row = mysqli_fetch_assoc($check_mail)) {
                
                // get the values from the database (password and account_type)
                $db_password = $row['password'];
                $db_account_type = $row['account_type'];

                // Check if the password is correct
                // If the password is correct, redirect to the appropriate page based on account type
                if($password == $db_password) {

                    // Check the account type
                    // If the account type is 1, redirect to admin page
                    if($db_account_type == "1") {

                        echo "<script>window.location.href='admin';</script>";

                    // If the account type is 2, redirect to user page
                    } else {

                        echo "<script>window.location.href='user';</script>";

                    }

                // If the password is incorrect, show an error message
                } else {

                    $passwordErr = "Incorrect password!";

                }

            }

        // else, if the email is not registered
        // If the email is not registered, show an error message
        } else {

            $emailErr = "Email is not registered!";
            
        }

    }
}

?>
<!-- End of PHP ------------------------------------------------------------------------------------------------->

<!-- Start of STYLES ------------------------------------------------------------------------------------------------->
<style>
    .error {
        color: #FF0000;
    }
</style>
<!-- End of STYLES ------------------------------------------------------------------------------------------------->

<!-- Start of FORM ------------------------------------------------------------------------------------------------->
<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

<!-- Login Fields -->
<!-- Email -->
<input type="text" name="email" placeholder="Email" value="<?php echo $email;?>">
<span class="error">* <?php echo $emailErr;?></span>

<br><br>

<!-- Password -->
<input type="password" name="password" placeholder="Password" value="<?php echo $password;?>">
<span class="error">* <?php echo $passwordErr;?></span>

<br><br>

<!-- Submit Button -->
<input type="submit" name="Submit" value="Login">

</form>
<!-- End of FORM ------------------------------------------------------------------------------------------------->