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

// Delete Action
if (isset($_GET['NGO'])) {
    $id = $_GET['NGO'];
    $sql = "DELETE FROM ngo_login WHERE id = ?";
    $stmt = $mysqli->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            echo "<script>alert('Record deleted successfully.'); window.location.href='NGO_Data.php';</script>";
        } else {
            echo "<script>alert('Error deleting record: " . $mysqli->error . "');</script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('Failed to prepare delete statement.');</script>";
    }
}

// SQL query to select data from database
$sql = "SELECT id, uname, phone, city, email, pass FROM ngo_login ORDER BY uname DESC";
$result = $mysqli->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Admin Panel - NGO Data</title>
    <link rel="stylesheet" href="home.css">
</head>
<body>
    <section class="hero">
        <nav class="navbar navbar-dark bg-dark d-lg-flex w-100 justify-content-center">
            <h1 class="text-light">Welcome to <br> Healthcare Donation</h1>
        </nav>

        <form method='post' action="" class="d-lg-flex w-80 justify-content-end m-3">
            <button type="submit" class="btn btn-outline-danger" name="but_logout">Logout</button>
        </form>

        <div class="btn-group Header_1 d-flex justify-content-evenly mb-5">
            <a href="home.php"><button type="button" class="btn btn-dark btn-lg">Home</button></a>
            <a href="NGO_Data.php"><button type="button" class="btn btn-primary btn-lg active">NGO Data</button></a>
            <a href="Donations.php"><button type="button" class="btn btn-dark btn-lg">Donations</button></a>
            <a href="Feedback.php"><button type="button" class="btn btn-dark btn-lg">Feedback</button></a>
        </div>

        <!-- TABLE CONSTRUCTION -->
        <table class="table">
            <tr>
                <th>No</th>
                <th>NGO Name</th>
                <th>Contact No</th>
                <th>City</th>
                <th>Email</th>
                <th>Password</th>
                <th>Action</th>
            </tr>
            <?php
            if ($result && $result->num_rows > 0) {
                while ($rows = $result->fetch_assoc()) {
            ?>
            <tr>
                <td><?php echo $rows['id']; ?></td>
                <td><?php echo $rows['uname']; ?></td>
                <td><?php echo $rows['phone']; ?></td>
                <td><?php echo $rows['city']; ?></td>
                <td><?php echo $rows['email']; ?></td>
                <td><?php echo $rows['pass']; ?></td>
                <td><a class="btn btn-danger" href='NGO_Data.php?NGO=<?php echo $rows['id']; ?>'>Delete</a></td>
            </tr>
            <?php
                }
            } else {
                echo "<tr><td colspan='7'>No NGO data available.</td></tr>";
            }
            ?>
        </table>
    </section>
</body>
</html>
<?php
$mysqli->close();
?>