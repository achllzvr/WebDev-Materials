<?php

// Create search and search error variables and set as blank
$search = $searchErr = "";

// Checks if Server's request method is POST
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    if(empty($_POST["Search"])){

        $searchErr = "Required!";

    }else{

        $search = $_POST["Search"];

    }

    // If $search has a value
    if($search){

        // Proceeds to  the file/ page
        // result.php with the search value
        echo "<script>window.location.href='result.php?search=$search';</script>";

    }

}

?>

<!-- Start of STYLES -->
<style>
/* Error Text Color Style */
.error { 
     color:red;
}
</style>
<!-- End of STYLES -->

<!-- Start of Search Form -->
<form method="POST" action="<?php htmlspecialchars ("PHP_SELF"); ?>">

<!-- Search Field -->
<!-- echoes $search variable value -->
<input type="text" name="Search" placeholder="Search..." value="<?php echo $search; ?>" />

<!-- Search Error -->
<span class="error">* <?php echo $searchErr; ?></span>
<br>
<br>

<!-- Search Button -->
<input type="submit" name="submit" value="Search" />


</form>