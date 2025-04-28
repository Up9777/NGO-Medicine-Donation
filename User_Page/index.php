<?php
session_start();
include "config.php"; // Database connection

$mode = isset($_GET['mode']) && $_GET['mode'] === 'signup' ? 'signup' : 'login';
$error = '';

// Handle Login
if (isset($_POST['login'])) {
    $username = $_POST['uname']; // Use the correct form input name
    $password = $_POST['pass'];   // Use the correct form input name

    $query = "SELECT * FROM user_login WHERE username=? AND password=?"; // Use the correct column names
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "ss", $username, $password);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['uname'] = $username; // Store the correct username in the session
        header("Location: home.php");
        exit;
    } else {
        $error = "Invalid Username or Password!";
    }
}

// Handle Sign Up
if (isset($_POST['signup'])) {
    $username = $_POST['uname'];       // Use the correct form input name
    $password = $_POST['pass'];       // Use the correct form input name
    $confirm_pass = $_POST['confirm_pass'];

    if ($password !== $confirm_pass) {
        $error = "Passwords do not match!";
    } else {
        $check_query = "SELECT * FROM user_login WHERE username=?"; // Use the correct column name
        $stmt = mysqli_prepare($con, $check_query);
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $check_result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($check_result) > 0) {
            $error = "Username already exists!";
        } else {
            $insert_query = "INSERT INTO user_login (username, password) VALUES (?, ?)"; // Use the correct column names
            $stmt = mysqli_prepare($con, $insert_query);
            mysqli_stmt_bind_param($stmt, "ss", $username, $password);
            if (mysqli_stmt_execute($stmt)) {
                header("Location: index.php?mode=login");
                exit;
            } else {
                $error = "Sign up failed. Try again.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo ucfirst($mode); ?></title>
    <link rel="stylesheet" href="home.css"> <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .form-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 350px;
            text-align: center;
        }
        .auth-form h2 {
            color: #333;
            margin-bottom: 25px;
        }
        .error {
            color: #d32f2f;
            margin-bottom: 15px;
            padding: 10px;
            background-color: #ffebee;
            border-radius: 4px;
            border: 1px solid #ef9a9a;
        }
        input[type="text"],
        input[type="password"] {
            width: calc(100% - 20px);
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }
        button[type="submit"] {
            background-color: #007bff;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
            transition: background-color 0.3s ease;
        }
        button[type="submit"]:hover {
            background-color: #0056b3;
        }
        .toggle-below {
            margin-top: 20px;
            font-size: 14px;
            color: #555;
        }
        .toggle-below a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }
        .toggle-below a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="form-container">
        <form method="post" class="auth-form">
            <h2><?php echo ucfirst($mode); ?></h2>

            <?php if (!empty($error)): ?>
                <p class="error"><?php echo $error; ?></p>
            <?php endif; ?>

            <input type="text" name="uname" placeholder="Username" required>
            <input type="password" name="pass" placeholder="Password" required>

            <?php if ($mode === 'signup'): ?>
                <input type="password" name="confirm_pass" placeholder="Confirm Password" required>
            <?php endif; ?>

            <button type="submit" name="<?php echo $mode; ?>"><?php echo ucfirst($mode); ?></button>
        </form>

        <div class="toggle-below">
            <?php if ($mode === 'login'): ?>
                <p>Don't have an account? <a href="index.php?mode=signup">Sign Up</a></p>
            <?php else: ?>
                <p>Already have an account? <a href="index.php?mode=login">Login</a></p>
            <?php endif; ?>
        </div>
    </div>

</body>
</html>