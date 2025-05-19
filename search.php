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
        echo "<script>window.location.href='result.php';</script>";

    }

}

?>