<?php
session_start();

// Database connection
$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'ngo';

$con = new mysqli($servername, $username, $password, $database);
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Initialize messages
$error_msg = "";

// Handle Login
if (isset($_POST['but_submit'])) {
    $uname = mysqli_real_escape_string($con, $_POST['txt_uname']);
    $password = mysqli_real_escape_string($con, $_POST['txt_pwd']);

    if (!empty($uname) && !empty($password)) {
        $sql_query = "SELECT pass FROM admin_login WHERE uname = ?";
        $stmt = $con->prepare($sql_query);
        $stmt->bind_param("s", $uname);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row && password_verify($password, $row['pass'])) {
            $_SESSION['uname'] = $uname;
            header("Location: home.php");
            exit();
        } else {
            $error_msg = "<div class='alert alert-danger'>Invalid Username or Password.</div>";
        }
    } else {
        $error_msg = "<div class='alert alert-warning'>Please fill in both username and password.</div>";
    }
}

$con->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f7f7f7; /* Very light grey background */
            color: #333;
            font-family: 'Roboto', sans-serif; /* A professional and widely used font */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .login-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            padding: 3rem;
            width: 100%;
            max-width: 450px; /* Slightly wider for a more substantial feel */
            text-align: left; /* Align text within the container to the left */
            opacity: 0;
            transform: translateY(-20px);
            animation: fadeInSlideDown 0.5s ease-out forwards;
        }

        @keyframes fadeInSlideDown {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-title {
            color: #2c3e50;
            font-size: 2.5rem;
            margin-bottom: 2.5rem; /* More spacing below the title */
            font-weight: 500; /* Slightly lighter font weight for a modern feel */
            text-align: center; /* Center the title */
        }

        .form-group {
            margin-bottom: 2.5rem; /* More spacing between form groups */
        }

        .form-label {
            display: block;
            color: #555;
            margin-bottom: 0.8rem;
            font-size: 1.1rem; /* Slightly larger label */
            font-weight: 400;
            transition: transform 0.2s ease-in-out, color 0.2s ease-in-out;
            transform-origin: top left;
        }

        .form-control {
            width: 100%;
            padding: 1.2rem;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 1rem;
            color: #333;
            transition: border-color 0.3s ease-in-out;
        }

        .form-control:focus {
            outline: none;
            border-color: #3498db; /* Blue focus color */
            box-shadow: 0 0 8px rgba(52, 152, 219, 0.2);
        }

        .btn-primary {
            width: 100%;
            padding: 1.2rem 2rem;
            border: none;
            border-radius: 6px;
            background-color: #3498db; /* Blue button color */
            color: #fff;
            font-size: 1.1rem;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out, transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
            box-shadow: 0 2px 5px rgba(52, 152, 219, 0.2); /* Subtle button shadow */
        }

        .btn-primary:hover {
            background-color: #2980b9; /* Darker blue on hover */
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(52, 152, 219, 0.3); /* Enhanced hover shadow */
        }

        .alert {
            padding: 1rem;
            margin-bottom: 2rem;
            border-radius: 6px;
            font-size: 1rem;
        }

        .alert-danger {
            background-color: #ffebee; /* Light red */
            color: #d32f2f; /* Dark red */
            border: 1px solid #ef9a9a;
        }

        .alert-warning {
            background-color: #fffde7; /* Light yellow */
            color: #f9a825; /* Dark yellow */
            border: 1px solid #fff9c4;
        }

        /* Floating Label Effect */
        .form-group {
            position: relative;
            overflow: hidden;
        }

        .form-control {
            padding: 1.5rem 1rem 0.5rem; /* Adjust padding to accommodate floating label */
        }

        .form-label {
            position: absolute;
            top: 0.8rem;
            left: 1rem;
            font-size: 1rem;
            color: #777;
            pointer-events: none;
            transition: transform 0.2s ease-in-out, font-size 0.2s ease-in-out, color 0.2s ease-in-out;
        }

        .form-control:focus + .form-label,
        .form-control:not(:placeholder-shown) + .form-label {
            transform: translateY(-0.7rem) scale(0.8);
            color: #3498db; /* Blue when focused or filled */
        }

        /* Remove default placeholder style on focus for better label visibility */
        .form-control::-webkit-input-placeholder { color: transparent; }
        .form-control:-moz-placeholder { color: transparent; }
        .form-control::-moz-placeholder { color: transparent; }
        .form-control:-ms-input-placeholder { color: transparent; }
    </style>
</head>
<body>

<div class="login-container">
    <h2 class="login-title">Admin Login</h2>
    <form method="post" action="">
        <div class="form-group">
            <input type="text" class="form-control" name="txt_uname" id="txt_uname" required placeholder="Username">
            <label for="txt_uname" class="form-label">Username</label>
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="txt_pwd" id="txt_pwd" required placeholder="Password">
            <label for="txt_pwd" class="form-label">Password</label>
        </div>
        <?php if (!empty($error_msg)) echo "<div class='alert alert-danger'>" . $error_msg . "</div>"; ?>
        <button type="submit" name="but_submit" class="btn btn-primary">Log In</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>