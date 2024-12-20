<?php
require_once '../config/config.php';
require_once '../includes/header.php';

$isbn = isset($_GET['isbn']) ? $_GET['isbn'] : null;


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_book'])) {
    $title = $_POST['title'];
    $copies = $_POST['num_copies'];
    $edition = $_POST['edition'];
    $year = $_POST['publication_year'];
    $price = $_POST['price'];
    
    $sql = "UPDATE Book SET num_Copies=?, title=?, edition=?, publication_year=?, price=? WHERE ISBN=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isiiii", $copies, $title, $edition, $year, $price, $isbn);
    
    if ($stmt->execute()) {
        echo "<div class='alert alert-success'>Book updated successfully!</div>";
    } else {
        echo "<div class='alert alert-danger'>Error updating book!</div>";
    }
}

// Fetch current book data
$sql = "SELECT * FROM Book WHERE ISBN = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $isbn);
$stmt->execute();
$result = $stmt->get_result();
$book = $result->fetch_assoc();
?>

<div class="container mt-5">

    <h2>Edit Book</h2>
    <div class="card">
        <div class="card-body">
            <form method="POST">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="isbn" class="form-label">ISBN</label>
                        <input type="number" class="form-control" value="<?php echo $book['ISBN']; ?>" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" value="<?php echo $book['title']; ?>" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="num_copies" class="form-label">Number of Copies</label>
                        <input type="number" class="form-control" name="num_copies" value="<?php echo $book['num_Copies']; ?>" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="edition" class="form-label">Edition</label>
                        <input type="number" class="form-control" name="edition" value="<?php echo $book['edition']; ?>" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="publication_year" class="form-label">Publication Year</label>
                        <input type="number" class="form-control" name="publication_year" value="<?php echo $book['publication_year']; ?>" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" class="form-control" name="price" value="<?php echo $book['price']; ?>" required>
                    </div>
                </div>
                <button type="submit" name="update_book" class="btn btn-primary">Update Book</button>
                <a href="../public/books.php" class="btn btn-secondary">Back to Books</a>
            </form>
        </div>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>
