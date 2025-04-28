<?php
session_start(); // Start the session

// Database connection
$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'ngo';

$mysqli = new mysqli($servername, $username, $password, $database);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Check if user is logged in, else redirect
if (!isset($_SESSION['uname'])) {
    header('Location: index.php');
    exit();
}

// Logout
if (isset($_POST['but_logout'])) {
    session_destroy();
    header('Location: index.php');
    exit();
}

// Fetch user data (if needed in future)
$sql = "SELECT id, uname AS NGO_Name, pass AS Password FROM admin_login ORDER BY id DESC";
$result = $mysqli->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="home.css">
</head>
<body>
    <section class="hero">
        <nav class="navbar navbar-dark bg-dark d-lg-flex w-100 justify-content-center">
            <h1 class="text-light">Welcome to <br> Healthcare Donation</h1>
        </nav>

        <form method='post' class="d-lg-flex w-80 justify-content-end m-3">
            <button type="submit" class="btn btn-outline-danger" name="but_logout">Logout</button>
        </form>

        <div class="btn-group Header_1 d-flex justify-content-evenly mb-5">
            <a href="NGO_Data.php"><button type="button" class="btn btn-dark btn-lg">NGO Data</button></a>
            <a href="Donations.php"><button type="button" class="btn btn-dark btn-lg">Donations</button></a>
            <a href="Feedback.php"><button type="button" class="btn btn-dark btn-lg">Feedback</button></a>
        </div>

        <!-- Replaced table with welcome message -->
        <div class="container text-center mt-5">
            <h2 class="display-5 fw-bold">Explore the Fields</h2>
            <p class="lead">Welcome to the Admin Panel of the Healthcare Donation Portal.</p>
            <p class="fs-5">Connect with trusted NGOs, manage donations, and make a real difference in the world of medical aid.</p>
            <img src="https://cdn-icons-png.flaticon.com/512/1029/1029183.png" alt="Explore" style="width:150px;" class="mt-4">
        </div>

    </section>
</body>
</html>

<?php $mysqli->close(); ?>
