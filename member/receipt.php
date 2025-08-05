<?php
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['is_login'])) {
    echo "<script> location.href='payment.php'; </script>";
    exit;
}

// Get user details from session
$owner = isset($_SESSION['user_name']) ? htmlspecialchars($_SESSION['user_name']) : "Unknown User";

// Get payment details
$plan = isset($_GET['plan']) ? htmlspecialchars($_GET['plan']) : "Unknown Plan";
$price = isset($_GET['price']) ? htmlspecialchars($_GET['price']) : "0.00";
$services = isset($_GET['services']) ? htmlspecialchars($_GET['services']) : "Fitness";
$last_payment = isset($_GET['last_payment']) ? htmlspecialchars($_GET['last_payment']) : date("Y-m-d");
$date = date("F j, Y - g:i a");
$invoice_number = "GMS_" . rand(100000, 99999999);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Receipt</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            background: rgb(248, 248, 249);
            font-family: Arial, sans-serif;
        }

        /* Header Styling */
        .receipt-header {
            margin-top: 10px;
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }

        .container {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            text-align: center;
            margin-top: 10px; /* Space between header and container */
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
        }

        .invoice-header {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
            margin-bottom: 20px;
            text-align: left;
        }

        .invoice-header div {
            text-align: left;
        }

        .member-info {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            text-align: left;
        }

        .table th, .table td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        .table th {
            background: #f8f9fa;
            font-weight: bold;
        }

        .total {
            font-weight: bold;
            border-top: 2px solid black;
            border-bottom: 2px solid black;
        }

        .footer-text {
            margin-top: 20px;
            font-size: 14px;
            color: #555;
        }

        .btn-container {
            margin-top: 20px;
            margin-bottom: 20px;
            text-align: center;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background: #dc3545;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            border: none;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .btn:hover {
            background: #c82333;
        }

        .btn i {
            margin-right: 5px;
        }
    </style>
</head>
<body>

    <!-- Payment Receipt Header -->
    <div class="receipt-header">Payment Receipt</div>

    <div class="container">
        <h1>Receipt Details</h1>

        <div class="invoice-header">
            <div>
                Invoice <?php echo $invoice_number; ?><br>
                ProFitness,Warje,Pune-58
            </div>
            <div>
                Last Payment: <?php echo $last_payment; ?>
            </div>
        </div>

        <div class="member-info">
            Member: <?php echo $owner; ?>
        </div>
        <p>Paid On: <?php echo $date; ?></p>

        <table class="table">
            <tr>
                <th>Service Taken</th>
                <th>Valid Upto</th>
            </tr>
            <tr>
                <td><?php echo $services; ?></td>
                <td><?php echo $plan; ?> </td>
            </tr>
            <tr>
                <td>Charge Per Month</td>
                <td>₹<?php echo $price; ?></td>
            </tr>
            <tr class="total">
                <td class="alignright">Total Amount</td>
                <td>₹<?php echo $price; ?></td>
            </tr>
        </table>

        <p class="footer-text">
            We sincerely appreciate your promptness regarding all payments from your side.
        </p>
    </div>

    <!-- Print Button Outside the Container -->
    <div class="btn-container">
        <button onclick="window.print()" class="btn"><i class="fas fa-print"></i> Print</button>
    </div>

</body>
<?php
include('includes/footer.php');
?>
</html>
