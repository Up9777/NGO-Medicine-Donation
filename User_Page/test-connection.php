<?php
include "./config.php";

if ($con) {
    echo "Successfully connected to the database!";
    mysqli_close($con); // Close the connection in the test file
} else {
    // The die() in config.php would have already stopped execution
    // but it's good practice to have a check here too.
    echo "Connection failed. Please check your config.php file.";
}
?>