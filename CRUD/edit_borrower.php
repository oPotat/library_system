<?php
require_once '../config/config.php';
require_once '../includes/header.php';


$borrower_id = isset($_GET['id']) ? $_GET['id'] : null;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_borrower'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    
    $sql = "UPDATE Borrower SET first_name=?, last_name=?, phone=?, address=? WHERE borrower_num=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi",  $first_name, $last_name, $phone, $address, $borrower_id);
    
    if ($stmt->execute()) {
        echo "<div class='alert alert-success'>Borrower updated successfully!</div>";
    } else {
        echo "<div class='alert alert-danger'>Error updating borrower!</div>";
    }
}

// Fetch current borrower data
$sql = "SELECT * FROM Borrower WHERE borrower_num = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $borrower_id);
$stmt->execute();
$result = $stmt->get_result();
$borrower = $result->fetch_assoc();
?>

<div class="container mt-5">
    <h2>Edit Borrower</h2>
    <div class="card">
        <div class="card-body">
            <form method="POST">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" class="form-control" name="first_name" value="<?php echo $borrower['first_name']; ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" class="form-control" name="last_name" value="<?php echo $borrower['last_name']; ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" class="form-control" name="phone" value="<?php echo $borrower['phone']; ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" name="address" value="<?php echo $borrower['address']; ?>" required>
                    </div>
                </div>
                <button type="submit" name="update_borrower" class="btn btn-primary">Update Borrower</button>
                <a href="../public/borrowers.php" class="btn btn-secondary">Back to Borrowers</a>
            </form>
        </div>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>
