<?php
session_start();
if (!isset($_SESSION['uname'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>NGO & Government Schemes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container py-4">

        <h2 class="section-heading">NGO Programs & Campaigns</h2>

        <div id="schemeCarousel" class="carousel slide mb-5" data-bs-ride="carousel">
            <div class="carousel-inner">

                <div class="carousel-item active text-center">
                    <img src="charity.jpg" alt="Charity for Children">
                    <div class="carousel-caption-custom">
                        <h5>Charity for Children</h5>
                    </div>
                </div>

                <div class="carousel-item text-center">
                    <img src="healthcare volunteer.jpg" alt="Healthcare Volunteers">
                    <div class="carousel-caption-custom">
                        <h5>Healthcare Volunteers</h5>
                    </div>
                </div>

                <div class="carousel-item text-center">
                    <img src="medicine.jpg" alt="Medicine Donations">
                    <div class="carousel-caption-custom">
                        <h5>Medicine Donations</h5>
                    </div>
                </div>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#schemeCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#schemeCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>

        <h2 class="section-subheading">Your Profile & Investments</h2>

        <div class="card shadow p-4 profile-card d-flex flex-md-row flex-column justify-content-between align-items-center">
            <div>
                <p><strong>Username:</strong> <?php echo htmlspecialchars($_SESSION['uname']); ?></p>
                <p><strong>Total Contributions:</strong> ₹10,000</p>
                <p><strong>Last Donation:</strong> 2nd April 2025</p>
                <p><strong>Ongoing Subscriptions:</strong> Monthly Health Scheme</p>
            </div>
            <div class="donate-button-wrapper mt-3 mt-md-0 ms-md-5">
    <a href="Donation_form.php" class="btn btn-donate">Donate</a>
    <a href="mydonations.php" class="btn btn-info ms-2">My Donations</a>
</div>



        </div>

        <div class="text-end mt-4">
            <a href="logout.php" class="btn btn-outline-danger px-4">Logout</a>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
