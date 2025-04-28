<!-------------------------------------------------- SignUp form -------------------------------------------->
<?php
 $insert= false;

$conn = mysqli_connect("localhost", "root", "", "ngo");

if($conn === false){
    die("ERROR: Could Not Connect. ". mysqli_connect_error());
}

$id = $_POST['id'];
$uname = $_POST['uname'];
$gender = $_POST['gender'];
$age = $_POST['age'];
$phone = $_POST['phone'];
$city = $_POST['city'];
$email = $_POST['email'];
$pass = $_POST['pass'];

$sql = "INSERT INTO user_login VALUES ('$id', '$uname', '$gender', '$age', '$phone', '$city', '$email', '$pass')";

if($conn->query($sql) ==true) {
    echo"Successfully Inserted";
    $insert = true;
  }
  else{
    echo "ERROR: $sql <br> $conn->error";
  }

mysqli_close($conn);

?>
<!-------------------------------------------------- SignUp form close -------------------------------------------->


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="thank.css">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <title>Thank You</title>
</head>
<body>
     <div class="main" style="text-align:center;">
        <?php
        if($insert == true){
         echo "<p class='submitmsg'>Your submission has been received.</p>";
        }
        ?>
        <div data-aos="zoom-in-up" data-aos-duration="1500" class="anim">
          <h1>Thank You! For SingUp</h1> 
        </div>

        <span id="timer"></span>
        
     </div>

     <script>
        AOS.init();
    </script>

<script type="text/javascript">
  var count = 5;
  var redirect = "index.php";
 
  function countDown(){
    var timer = document.getElementById("timer");
    if(count > 0){
        count--;
        timer.innerHTML = "This page will redirect in "+count+" seconds.";
        setTimeout("countDown()", 1500);
    }else{
        window.location.href = redirect;
    }
  }
  countDown();
</script>