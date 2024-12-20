<?php
require_once '../config/config.php';
require_once '../includes/header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_borrower'])) {
    $borrower_num = $_POST['borrower_num'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    
    $sql = "INSERT INTO Borrower (borrower_num, first_name, last_name, phone, address) 
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issss", $borrower_num, $first_name, $last_name, $phone, $address);
    $stmt->execute();
}
?>


<div class="container mt-5">
    <h2>Borrower Management</h2>
    
    <!-- Add Borrower Form -->
    <div class="card mb-4">
        <div class="card-header">
            <h3>Add New Borrower</h3>
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="borrower_num" class="form-label">Borrower ID</label>
                        <input type="number" class="form-control" id="borrower_num" name="borrower_num" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address" required>
                    </div>
                </div>
                <button type="submit" name="add_borrower" class="btn btn-primary">Add Borrower</button>
            </form>
        </div>
    </div>

    <!-- Borrower List -->
    <div class="card">
        <div class="card-header">
            <h3>Borrower List</h3>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM Borrower";
                    $result = $conn->query($sql);
                    
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['borrower_num'] . "</td>";
                        echo "<td>" . $row['first_name'] . "</td>";
                        echo "<td>" . $row['last_name'] . "</td>";
                        echo "<td>" . $row['phone'] . "</td>";
                        echo "<td>" . $row['address'] . "</td>";
                        echo "<td>
                                <a href='../CRUD/edit_borrower.php?id=" . $row['borrower_num'] . "' class='btn btn-sm btn-warning'>Edit</a>
                                <a href='../CRUD/delete_borrower.php?id=" . $row['borrower_num'] . "' class='btn btn-sm btn-danger' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                            </td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>