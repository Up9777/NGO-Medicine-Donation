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
if (isset($_GET['Donation'])) {
    $id = $_GET['Donation'];
    $sql = "DELETE FROM donations WHERE id = ?";
    $stmt = $mysqli->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            echo "<script>alert('Record deleted successfully.'); window.location.href='Donations.php';</script>";
        } else {
            echo "<script>alert('Error deleting record: " . $mysqli->error . "');</script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('Failed to prepare delete statement.');</script>";
    }
}

// SQL query to select data from database
$sql = "SELECT id, username AS Donar_Name, Contact_number, Address, Medicine_name, Tablet_count, Purchased_date, Expiry_date, Details FROM donations ORDER BY id DESC";
$result = $mysqli->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Admin Panel - Donations</title>
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
            <a href="NGO_Data.php"><button type="button" class="btn btn-dark btn-lg">NGO Data</button></a>
            <a href="Donations.php"><button type="button" class="btn btn-primary btn-lg active">Donations</button></a>
            <a href="Feedback.php"><button type="button" class="btn btn-dark btn-lg">Feedback</button></a>
        </div>

        <!-- TABLE CONSTRUCTION -->
        <table class="table">
            <tr>
                <th>No</th>
                <th>Donar Name</th>
                <th>Contact No</th>
                <th>Address</th>
                <th>Medicine Name</th>
                <th>Tablet Count</th>
                <th>Purchased Date</th>
                <th>Expiry Date</th>
                <th>Details</th>
                <th>Action</th>
            </tr>
            <?php
            if ($result && $result->num_rows > 0) {
                while ($rows = $result->fetch_assoc()) {
            ?>
            <tr>
                <td><?php echo $rows['id']; ?></td>
                <td><?php echo $rows['Donar_Name']; ?></td>
                <td><?php echo $rows['Contact_number']; ?></td>
                <td><?php echo $rows['Address']; ?></td>
                <td><?php echo $rows['Medicine_name']; ?></td>
                <td><?php echo $rows['Tablet_count']; ?></td>
                <td><?php echo $rows['Purchased_date']; ?></td>
                <td><?php echo $rows['Expiry_date']; ?></td>
                <td><?php echo $rows['Details']; ?></td>
                <td><a class="btn btn-danger" href='Donations.php?Donation=<?php echo $rows['id']; ?>'>Delete</a></td>
            </tr>
            <?php
                }
            } else {
                echo "<tr><td colspan='10'>No donation data available.</td></tr>";
            }
            ?>
        </table>
    </section>
</body>
</html>
<?php
$mysqli->close();
?>