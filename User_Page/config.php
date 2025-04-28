<?php
// config.php

$host = "localhost";
$user = "root";
$pass = ""; // Default password for XAMPP's MySQL is empty
$db = "ngo"; // ✅ ENSURE THIS IS YOUR CORRECT DATABASE NAME

$con = mysqli_connect($host, $user, $pass, $db);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Set character set to UTF-8 (recommended)
mysqli_set_charset($con, "utf8");
?>