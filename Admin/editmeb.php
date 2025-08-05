<?php
define('TITLE', 'Update Member');
define('PAGE', 'Member');
include('includes/header.php');
include('../dbConnection.php');

// Start session and validate admin login
session_start();
if (!isset($_SESSION['is_adminlogin'])) {
    echo "<script> location.href='login.php'; </script>";
    exit();
}

// Function to sanitize input data
function sanitizeInput($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

// Update member details
if (isset($_REQUEST['mebupdate'])) {
    // Check for empty fields
    if (empty($_REQUEST['m_login_id']) || empty($_REQUEST['m_name']) || empty($_REQUEST['m_email'])) {
        $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert">Fill All Fields</div>';
    } else {
        // Sanitize inputs
        $mid = sanitizeInput($_REQUEST['m_login_id']);
        $mname = sanitizeInput($_REQUEST['m_name']);
        $memail = sanitizeInput($_REQUEST['m_email']);

        // Use prepared statements to prevent SQL injection
        $sql = "UPDATE memberlogin_tb SET m_name = ?, m_email = ? WHERE m_login_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $mname, $memail, $mid);

        if ($stmt->execute()) {
            // Check if any rows were affected
            if ($stmt->affected_rows > 0) {
                $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert">Updated Successfully</div>';
            } else {
                $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert">No changes made.</div>';
            }
        } else {
            $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert">Unable to Update: ' . $stmt->error . '</div>';
        }
        $stmt->close();
    }
}
?>

<div class="col-sm-6 mt-5 mx-3 jumbotron">
    <h3 class="text-center">Update Gym Member Details</h3>
    <?php
    // Fetch member details for editing
    if (isset($_REQUEST['view'])) {
        $id = sanitizeInput($_REQUEST['id']);
        $sql = "SELECT * FROM memberlogin_tb WHERE m_login_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
    }
    ?>
    <form action="" method="POST">
        <div class="form-group">
            <label for="m_login_id">Member ID</label>
            <input type="text" class="form-control" id="m_login_id" name="m_login_id" value="<?= isset($row['m_login_id']) ? $row['m_login_id'] : '' ?>" readonly>
        </div>
        <div class="form-group">
            <label for="m_name">Name</label>
            <input type="text" class="form-control" id="m_name" name="m_name" value="<?= isset($row['m_name']) ? $row['m_name'] : '' ?>">
        </div>
        <div class="form-group">
            <label for="m_email">Email</label>
            <input type="email" class="form-control" id="m_email" name="m_email" value="<?= isset($row['m_email']) ? $row['m_email'] : '' ?>">
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-success" id="mebupdate" name="mebupdate">Update</button>
            <a href="member.php" class="btn btn-secondary">Close</a>
        </div>
        <?php if (isset($msg)) { echo $msg; } ?>
    </form>
</div>

<?php
include('includes/footer.php');
?>