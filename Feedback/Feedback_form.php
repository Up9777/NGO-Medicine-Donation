<?php
$insert = false;

// Establish database connection
$conn = mysqli_connect("localhost", "root", "", "ngo");

// Check connection
if (!$conn) {
    die("ERROR: Could Not Connect. " . mysqli_connect_error());
}

// Check if the form has been submitted (POST request)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve data from the form
    $Your_name = isset($_POST['Your_name']) ? $_POST['Your_name'] : '';
    $Contact_number = isset($_POST['Contact_number']) ? $_POST['Contact_number'] : '';
    $Address = isset($_POST['Address']) ? $_POST['Address'] : '';
    $Comment = isset($_POST['Comment']) ? $_POST['Comment'] : '';

    // Prepare the SQL statement using prepared statements to prevent SQL injection
    $sql = "INSERT INTO Feedback (Your_name, Contact_number, Address, Comment) VALUES (?, ?, ?, ?)";

    // Create a prepared statement
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        // Bind the parameters to the prepared statement
        mysqli_stmt_bind_param($stmt, "ssss", $Your_name, $Contact_number, $Address, $Comment);

        // Execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            echo "<p class='submitmsg' style='text-align:center;'>Your submission has been received.</p>";
            $insert = true;
        } else {
            echo "<p style='color:red; text-align:center;'>ERROR: Could not execute query: " . mysqli_error($conn) . "</p>";
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        echo "<p style='color:red; text-align:center;'>ERROR: Could not prepare statement: " . mysqli_error($conn) . "</p>";
    }
}

// Close the connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="thank.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <title><?php echo $insert ? 'Thank You' : 'Feedback Form'; ?></title>
</head>
<body>
    <div class="main" style="text-align:center;">
        <?php
        if (!$insert) { // Display the form if not successfully inserted
            echo '<div data-aos="zoom-in-up" data-aos-duration="1500" class="anim">';
            echo '<h1>Give Us Your Feedback</h1>';
            echo '</div>';
            echo '<form method="post">';
            echo '<div>';
            echo '<label for="Your_name">Your Name:</label>';
            echo '<input type="text" id="Your_name" name="Your_name" required>';
            echo '</div>';
            echo '<div>';
            echo '<label for="Contact_number">Contact Number:</label>';
            echo '<input type="tel" id="Contact_number" name="Contact_number">';
            echo '</div>';
            echo '<div>';
            echo '<label for="Address">Address:</label>';
            echo '<textarea id="Address" name="Address"></textarea>';
            echo '</div>';
            echo '<div>';
            echo '<label for="Comment">Comment:</label>';
            echo '<textarea id="Comment" name="Comment" rows="5" required></textarea>';
            echo '</div>';
            echo '<button type="submit">Submit Feedback</button>';
            echo '</form>';
        } else { // Display the thank you message and timer if successfully inserted
            echo '<div data-aos="zoom-in-up" data-aos-duration="1500" class="anim">';
            echo '<h1>Thank you for Feedback!</h1>';
            echo '</div>';
            echo '<span id="timer"></span>';
        }
        ?>
    </div>

    <script>
        AOS.init();

        <?php if ($insert): ?>
        var count = 5;
        var redirect = "Feedback_form.php"; // Redirect back to the same page to show the form again

        function countDown(){
            var timer = document.getElementById("timer");
            if(count > 0){
                count--;
                timer.innerHTML = "This page will redirect in "+count+" seconds.";
                setTimeout("countDown()", 1000);
            }else{
                window.location.href = redirect;
            }
        }
        countDown();
        <?php endif; ?>
    </script>
</body>
</html>