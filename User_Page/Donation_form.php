<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = mysqli_connect("localhost", "root", "", "ngo");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Ensure the user is logged in and their username is in the session
    if (isset($_SESSION['uname'])) {
        $username = mysqli_real_escape_string($conn, $_SESSION['uname']);

        // Escape other user inputs
        $Contact_number = mysqli_real_escape_string($conn, $_POST['Contact_number']);
        $Address = mysqli_real_escape_string($conn, $_POST['Address']);
        $Medicine_name = mysqli_real_escape_string($conn, $_POST['Medicine_name']);
        $Tablet_count = (int) $_POST['Tablet_count'];
        $Purchased_date = $_POST['Purchased_date'];
        $Expiry_date = $_POST['Expiry_date'];
        $Details = mysqli_real_escape_string($conn, $_POST['Details']);

        $sql = "INSERT INTO donations (username, Contact_number, Address, Medicine_name, Tablet_count, Purchased_date, Expiry_date, Details)
                VALUES ('$username', '$Contact_number', '$Address', '$Medicine_name', $Tablet_count, '$Purchased_date', '$Expiry_date', '$Details')";

        if (mysqli_query($conn, $sql)) {
            $_SESSION['donor_name'] = $username; // Update session donor name to username
            header("Location: thankyou.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Error: User not logged in.";
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Donate Medicine</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background:#f8f9fa; padding-top:50px;">
<div class="container">
    <div class="form-container bg-white p-4 rounded shadow-sm mx-auto" style="max-width:650px;">
        <h2 class="mb-4 text-primary">Medicine Donation Form</h2>
        <form method="POST" action="">
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" class="form-control" name="Your_name" value="<?php echo isset($_SESSION['uname']) ? htmlspecialchars($_SESSION['uname']) : ''; ?>" readonly>
                <small class="form-text text-muted">This will be automatically filled with your login username.</small>
            </div>
            <div class="mb-3">
                <label class="form-label">Contact Number</label>
                <input type="tel" class="form-control" name="Contact_number" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Address</label>
                <input type="text" class="form-control" name="Address" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Medicine Name</label>
                <input type="text" class="form-control" name="Medicine_name" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Tablet Count</label>
                <input type="number" class="form-control" name="Tablet_count" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Purchased Date</label>
                <input type="date" class="form-control" name="Purchased_date" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Expiry Date</label>
                <input type="date" class="form-control" name="Expiry_date" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Additional Details</label>
                <textarea class="form-control" name="Details" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary w-100">Submit Donation</button>
        </form>
    </div>
</div>
</body>
</html>