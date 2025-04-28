<?php
include "config.php";

$num = $_GET['NGO'];

// Prepare a delete statement
$sql = "DELETE FROM ngo_login WHERE id = '$num'";

// Execute the delete statement
if(mysqli_query($con, $sql)) {
    echo "Record deleted successfully.";
}

else {
    echo "Error deleting record: " . mysqli_error($con);
}

?>