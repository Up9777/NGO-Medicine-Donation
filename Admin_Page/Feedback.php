<?php
// Ensure config.php is included only once
require_once "config.php";

// We assume session is started in config.php, so we don't need to start it here again.
// Remove the following lines:
/*
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
*/

// Check user login or not
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

// Delete Action (Optional)
if (isset($_POST['delete'])) {
    $id = $_POST['id'];

    // Assuming your feedback table is indeed named 'feedback'
    $sql = "DELETE FROM feedback WHERE id = '$id'";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Record deleted successfully.');</script>";
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}

// Fetch feedback data
// Assuming your feedback table is indeed named 'feedback'
$sql = "SELECT * FROM feedback ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Panel - Feedback</title>
    <link rel="stylesheet" href="home.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <section class="hero">
        <nav class="navbar navbar-dark bg-dark d-lg-flex w-100 justify-content-center">
            <h1 class="text-light">Welcome to <br> Healthcare Donation</h1>
        </nav>

        <form method="post" class="d-lg-flex w-80 justify-content-end m-3">
            <button type="submit" class="btn btn-outline-danger" name="but_logout">Logout</button>
        </form>

        <div class="btn-group Header_1 d-flex justify-content-evenly mb-5">
            <a href="home.php"><button type="button" class="btn btn-dark btn-lg">User Data</button></a>
            <a href="NGO_Data.php"><button type="button" class="btn btn-dark btn-lg">NGO Data</button></a>
            <a href="Donations.php"><button type="button" class="btn btn-dark btn-lg">Donations</button></a>
            <a href="Feedback.php"><button type="button" class="btn btn-primary btn-lg active">Feedback</button></a>
        </div>

        <div class="container">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Contact No</th>
                        <th>Address</th>
                        <th>Comment</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result && mysqli_num_rows($result) > 0) {
                        while ($rows = mysqli_fetch_assoc($result)) {
                            echo "<tr>
                                    <td>{$rows['id']}</td>
                                    <td>{$rows['Your_name']}</td>
                                    <td>{$rows['Contact_number']}</td>
                                    <td>{$rows['Address']}</td>
                                    <td>{$rows['Comment']}</td>
                                </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5' class='text-center'>No feedback available.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>
</body>

</html>