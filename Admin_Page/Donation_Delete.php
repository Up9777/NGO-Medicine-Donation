<?php
session_start();
if (!isset($_SESSION['uname'])) {
    header('Location: index.php');
    exit();
}
$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'ngo';
$mysqli = new mysqli($servername, $username, $password, $database);
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
if (isset($_GET['Donation'])) {
    $id = $_GET['Donation'];
    $sql = "DELETE FROM donations WHERE id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        header('Location: Donations.php');
    } else {
        echo "Error deleting record: " . $mysqli->error;
    }
    $stmt->close();
}
$mysqli->close();
?>