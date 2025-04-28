<?php
// Database connection details
$host = "localhost";
$username = "root";
$password = "";
$database = "ngo";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Start the session
session_start(); // <--- This is where you have it

// Other configurations...
?>