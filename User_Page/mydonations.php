<?php
session_start();

// Include the database configuration
include "./config.php";

// Check if user is logged in
if (!isset($_SESSION['uname'])) {
    header("Location: ../login.php");
    exit();
}

$username = $_SESSION['uname'];

// ✅ Fetch donations only for the logged-in user using prepared statements for security
$sql = "SELECT username, Contact_number, Medicine_name, Tablet_count, Purchased_date FROM donations WHERE username = ?";
$stmt = $con->prepare($sql);

if ($stmt) {
    $stmt->bind_param("s", $username); // "s" indicates a string parameter
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    die("Error: Could not prepare SQL statement: " . $con->error);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Donations</title>
    <style>
        body {
            font-family: sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        table {
            border-collapse: collapse;
            width: 80%;
            max-width: 800px;
            background-color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: white;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        p {
            color: #555;
        }
    </style>
</head>
<body>
    <h2>Welcome, <?php echo htmlspecialchars($username); ?>! Here are your donations:</h2>

    <?php
    if ($result && $result->num_rows > 0) {
        echo "<table>
                <tr><th>Username</th><th>Contact Number</th><th>Medicine</th><th>Quantity</th><th>Purchase Date</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . htmlspecialchars($row['username']) . "</td>
                    <td>" . htmlspecialchars($row['Contact_number']) . "</td>
                    <td>" . htmlspecialchars($row['Medicine_name']) . "</td>
                    <td>" . htmlspecialchars($row['Tablet_count']) . "</td>
                    <td>" . htmlspecialchars($row['Purchased_date']) . "</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No donations yet.</p>";
    }

    // ✅ Close the prepared statement and the database connection
    if ($stmt) {
        $stmt->close();
    }
    if ($con) {
        mysqli_close($con); // Use mysqli_close for consistency
    }
    ?>
</body>
</html>