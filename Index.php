<?php
require_once 'config/config.php';
require_once 'includes/header.php';
?>

<div class="container mt-5">
    <h1>Welcome to Library Management System</h1>
    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Books</h5>
                    <?php
                    $sql = "SELECT COUNT(*) as total FROM Book";
                    $result = $conn->query($sql);
                    $row = $result->fetch_assoc();
                    echo "<p class='card-text'>" . $row['total'] . "</p>";
                    ?>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Borrowers</h5>
                    <?php
                    $sql = "SELECT COUNT(*) as total FROM Borrower";
                    $result = $conn->query($sql);
                    $row = $result->fetch_assoc();
                    echo "<p class='card-text'>" . $row['total'] . "</p>";
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>