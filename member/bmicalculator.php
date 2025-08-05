<?php
define('TITLE', 'BMI Calculator');
define('PAGE', 'bmicalculator');

// Update paths to your header and footer files
include('includes/header.php');
?>

<style>
    /* Container Style */
    .container {
        max-width: 600px;
        margin: 0 auto;
        padding-top: 50px;
    }

    /* Form Container Style */
    .form-container {
        background-color: #f9f9f9;
        border-radius: 10px;
        padding: 30px;
        box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
    }

    /* Result Section Style */
    .result-section {
        margin-top: 30px;
        text-align: center;
    }

    .result-section h3 {
        font-size: 2rem;
    }

    .result-section p {
        font-size: 1.2rem;
        font-weight: bold;
    }

    /* Text Colors for BMI Category */
    .text-warning {
        color: #f39c12;
    }

    .text-success {
        color: #28a745;
    }

    .text-danger {
        color: #dc3545;
    }

    /* Media Queries for Responsiveness */
    @media (max-width: 768px) {
        .container {
            padding-top: 30px;
            padding-left: 15px;
            padding-right: 15px;
        }

        .form-container {
            padding: 20px;
        }

        .result-section h3 {
            font-size: 1.8rem;
        }

        .result-section p {
            font-size: 1rem;
        }
    }

    @media (max-width: 576px) {
        .container {
            padding-top: 20px;
        }

        .form-container {
            padding: 15px;
        }

        .result-section h3 {
            font-size: 1.5rem;
        }

        .result-section p {
            font-size: 0.9rem;
        }
    }
</style>

<div class="container py-4">
    <h1 class="text-center mb-4">BMI Calculator</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="post" action="" class="form-container">
                <div class="mb-3">
                    <label for="weight" class="form-label">Weight (kg)</label>
                    <input type="number" step="0.1" class="form-control" id="weight" name="weight" placeholder="Enter your weight" required>
                </div>
                <div class="mb-3">
                    <label for="height" class="form-label">Height (cm)</label>
                    <input type="number" step="0.1" class="form-control" id="height" name="height" placeholder="Enter your height" required>
                </div>
                <button type="submit" name="calculate" class="btn btn-primary w-100">Calculate BMI</button>
            </form>
        </div>
    </div>

    <?php
    if (isset($_POST['calculate'])) {
        $weight = $_POST['weight'];
        $height = $_POST['height'] / 100; // Convert height from cm to meters

        if ($weight > 0 && $height > 0) {
            $bmi = $weight / ($height * $height);
            $bmi = round($bmi, 2);

            echo "<div class='row mt-4 justify-content-center result-section'>
                    <div class='col-md-8'>
                        <h3>Your BMI: $bmi</h3>";
            if ($bmi < 18.5) {
                echo "<p class='text-warning'>You are underweight.</p>";
            } elseif ($bmi >= 18.5 && $bmi <= 24.9) {
                echo "<p class='text-success'>You have a normal weight.</p>";
            } elseif ($bmi >= 25 && $bmi <= 29.9) {
                echo "<p class='text-warning'>You are overweight.</p>";
            } else {
                echo "<p class='text-danger'>You are obese.</p>";
            }
            echo "  </div>
                  </div>";
        } else {
            echo "<div class='row mt-4 justify-content-center result-section'>
                    <div class='col-md-8'>
                        <p class='text-danger'>Invalid input. Please enter positive values for weight and height.</p>
                    </div>
                  </div>";
        }
    }
    ?>
</div>

<?php
include('includes/footer.php');
?>
