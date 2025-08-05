<?php
define('TITLE', 'Payment');
define('PAGE', 'memberpayment');
include('includes/header.php');
include('../dbConnection.php');
session_start();

if ($_SESSION['is_login']) {
    $mEmail = $_SESSION['mEmail'];
} else {
    echo "<script> location.href='payment.php'; </script>";
    exit;
}

function renderPlanCard($title, $price, $features, $planName, $currency = "INR")
{
    echo '
    <div class="col-md-4 d-flex align-items-stretch">
        <div class="card mb-4 shadow-lg border-0 rounded-lg w-100">
            <div class="card-header py-3 text-white bg-gradient-primary text-center">
                <h4 class="fw-bold mb-0">' . htmlspecialchars($title) . '</h4>
            </div>
            <div class="card-body text-center d-flex flex-column">
                <h2 class="card-title pricing-card-title text-primary fw-bold">₹' . htmlspecialchars($price) . '<small class="text-muted fw-light">/' . htmlspecialchars($currency) . '</small></h2>
                <ul class="list-group list-group-flush text-start px-3 flex-grow-1">';
    foreach ($features as $feature) {
        echo '<li class="list-group-item">✅ ' . htmlspecialchars($feature) . '</li>';
    }
    echo '</ul>
                <a href="qr_payment.php?plan=' . urlencode($planName) . '&price=' . urlencode($price) . '" class="btn btn-primary mt-3 w-100">Pay Money</a>
            </div>
        </div>
    </div>';
}

?>

<style>
    .bg-gradient-primary {
        background: linear-gradient(135deg, #007bff, #0056b3);
    }
    .card {
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        display: flex;
        flex-direction: column;
    }
    .card:hover {
        transform: scale(1.05);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }
    .list-group-item {
        border: none;
        background: transparent;
    }
    .container {
        max-width: 900px;
        margin-left: 20px;
    }
    .membership-header {
        margin-top: 40px;
        text-align: center;
    }
    .membership-header h1 {
        font-size: 2.5rem;
    }
</style>
</head>
<body>
<div class="content">
    <div class="text-center mb-5 membership-header">
        <h1 class="display-5 fw-bold text-primary"><u>Membership Plans</u></h1>
        <p class="fs-5 text-muted">Get started today by selecting your gym membership plan</p>
    </div>

    <main class="container">
        <div class="row justify-content-center">
            <?php
            renderPlanCard(
                "1 Month",
                "1200",
                ["1 week free lessons", "Fast transactions", "Email support", "Help center access"],
                "1 Month"
            );

            renderPlanCard(
                "6 Months",
                "3000",
                ["1 Month free lessons", "Priority email support", "Help center access"],
                "6 Months"
            );

            renderPlanCard(
                "1 Year",
                "10000",
                ["3 months free lessons", "Free beverages", "Phone and email support", "Help center access"],
                "1 Year"
            );
            ?>
        </div>
    </main>
</div>

<?php
include('includes/footer.php');
?>
