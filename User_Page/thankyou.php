<?php
session_start();
$name = $_SESSION['donor_name'] ?? "Donor";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Thank You</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@600&display=swap" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(to right, #a1c4fd, #c2e9fb);
      font-family: 'Inter', sans-serif;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      margin: 0;
    }
    .box {
      background: white;
      padding: 40px;
      border-radius: 15px;
      text-align: center;
      box-shadow: 0 0 20px rgba(0,0,0,0.1);
    }
    h1 {
      color: #007bff;
    }
    .btn {
      margin-top: 20px;
      background: #007bff;
      color: white;
      padding: 10px 20px;
      text-decoration: none;
      border-radius: 8px;
    }
    .btn:hover {
      background: #0056b3;
    }
  </style>
</head>
<body>
  <div class="box">
    <h1>Thank You, <?php echo htmlspecialchars($name); ?>!</h1>
    <p>Your medicine donation has been successfully received.</p>
    <a class="btn" href="home.php">Back to Home</a>
  </div>
</body>
</html>
