<?php
define('TITLE', 'Bookings');
define('PAGE', 'bookings');
include('includes/header.php'); 
include('../dbConnection.php');
session_start();
if (!isset($_SESSION['is_adminlogin'])) {
    echo "<script> location.href='login.php'; </script>";
    exit();
}
?>

<div class="col-sm-9 col-md-10 mt-5 text-center">
    <p class="bg-dark text-white p-2">Member Booking List</p>

    <?php
    $sql = "SELECT * FROM submitbookingt_tb";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        echo '<table class="table table-bordered table-hover">
            <thead>
                <tr class="bg-secondary text-white">
                    <th scope="col">Booking ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Booking Type</th>
                    <th scope="col">Address</th>
                    <th scope="col">Mobile</th>
                    <th scope="col">Date</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>';
        
        while ($row = $result->fetch_assoc()) {
            echo '<tr>
                <th scope="row">' . $row["Booking_id"] . '</th>
                <td>' . $row["member_name"] . '</td>
                <td>' . $row["member_email"] . '</td>
                <td>' . $row["booking_type"] . '</td> 
                <td>' . $row["member_add1"] . '</td>
                <td>' . $row["member_mobile"] . '</td>
                <td>' . $row["member_date"] . '</td>
                <td>
                    <button class="btn btn-danger delete-btn" data-id="' . $row["Booking_id"] . '">
                        <i class="far fa-trash-alt"></i>
                    </button>
                </td>
            </tr>';
        }
        
        echo '</tbody></table>';
    } else {
        echo '<p class="text-danger">No records found</p>';
    }

    // Handle delete request
    if (isset($_POST['delete_id'])) {
        $booking_id = intval($_POST['delete_id']);
        $sql = "DELETE FROM submitbookingt_tb WHERE Booking_id = $booking_id";
        
        if ($conn->query($sql) === TRUE) {
            echo '<meta http-equiv="refresh" content="0;URL=?deleted" />';
        } else {
            echo '<p class="text-danger">Unable to delete record.</p>';
        }
    }
    ?>

</div>

<!-- Include SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll(".delete-btn").forEach(button => {
        button.addEventListener("click", function() {
            let bookingId = this.getAttribute("data-id");

            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to recover this booking!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit a hidden form for deletion
                    let form = document.createElement("form");
                    form.method = "POST";
                    form.action = "";
                    let input = document.createElement("input");
                    input.type = "hidden";
                    input.name = "delete_id";
                    input.value = bookingId;
                    form.appendChild(input);
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        });
    });
});
</script>

<?php include('includes/footer.php'); ?>
