<?php
// payment_processor.php
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['is_login'])) {
    echo "<script> location.href='payment.php'; </script>";
    exit;
}

// Get the plan and price from the URL
$plan = isset($_GET['plan']) ? htmlspecialchars($_GET['plan']) : "Unknown Plan";
$price = isset($_GET['price']) ? htmlspecialchars($_GET['price']) : "0.00";

// Simulate a successful payment (Replace with your actual payment logic)
$isPaymentSuccessful = true;

if ($isPaymentSuccessful) {
    // Redirect to receipt page with payment details
    header("Location: receipt.php?plan=" . urlencode($plan) . "&price=" . urlencode($price));
    exit;
} else {
    echo "Payment failed. Please try again.";
}
?>
