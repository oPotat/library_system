// edit_book.php - Update book information
<?php
require_once 'config.php';
require_once 'header.php';


require_once '../config.php';
require_once '../header.php';
require_once '../footer.php';

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
    <a class="nav-link" href="../index.php">Home</a>
    <a class="nav-link" href="../public/books.php">Books</a>
    <a class="nav-link" href="../public/borrowers.php">Borrowers</a>

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
                <a href="books.php" class="btn btn-secondary">Back to Books</a>
            </form>
        </div>
    </div>
</div>

<?php require_once 'footer.php'; ?>

// delete_book.php - Delete book record
<?php
require_once 'config.php';

if (isset($_GET['isbn'])) {
    $isbn = $_GET['isbn'];
    
    // First delete related records in Copy table
    $sql = "DELETE FROM Copy WHERE book_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $isbn);
    $stmt->execute();
    
    // Then delete related records in Writes table
    $sql = "DELETE FROM Writes WHERE ISBN = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $isbn);
    $stmt->execute();
    
    // Then delete related records in Publishes table
    $sql = "DELETE FROM Publishes WHERE ISBN = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $isbn);
    $stmt->execute();
    
    // Finally delete the book
    $sql = "DELETE FROM Book WHERE ISBN = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $isbn);
    $stmt->execute();
}

header("Location: books.php");
exit();
?>

// edit_borrower.php - Update borrower information
<?php
require_once 'config.php';
require_once 'header.php';

$borrower_id = isset($_GET['id']) ? $_GET['id'] : null;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_borrower'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    
    $sql = "UPDATE Borrower SET first_name=?, last_name=?, phone=?, address=? WHERE borrower_num=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $first_name, $last_name, $phone, $address, $borrower_id);
    
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
                <a href="borrowers.php" class="btn btn-secondary">Back to Borrowers</a>
            </form>
        </div>
    </div>
</div>

<?php require_once 'footer.php'; ?>

// delete_borrower.php - Delete borrower record
<?php
require_once 'config.php';

if (isset($_GET['id'])) {
    $borrower_id = $_GET['id'];
    
    $sql = "DELETE FROM Borrower WHERE borrower_num = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $borrower_id);
    $stmt->execute();
}

header("Location: borrowers.php");
exit();
?>

// view_book_details.php - View detailed book information
<?php
require_once 'config.php';
require_once 'header.php';

$isbn = isset($_GET['isbn']) ? $_GET['isbn'] : null;

// Fetch book details including author and publisher
$sql = "SELECT b.*, a.first_name, a.middle_name, a.last_name, p.name as publisher_name 
        FROM Book b 
        LEFT JOIN Writes w ON b.ISBN = w.ISBN 
        LEFT JOIN Author a ON w.auth_id = a.auth_id 
        LEFT JOIN Publishes pub ON b.ISBN = pub.ISBN 
        LEFT JOIN Publisher p ON pub.publisher_id = p.publisher_id 
        WHERE b.ISBN = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $isbn);
$stmt->execute();
$result = $stmt->get_result();
$book = $result->fetch_assoc();

// Fetch copy information
$sql = "SELECT * FROM Copy WHERE book_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $isbn);
$stmt->execute();
$copies = $stmt->get_result();
?>

<div class="container mt-5">
    <h2>Book Details</h2>
    <div class="card mb-4">
        <div class="card-body">
            <h3><?php echo $book['title']; ?></h3>
            <div class="row">
                <div class="col-md-6">
                    <p><strong>ISBN:</strong> <?php echo $book['ISBN']; ?></p>
                    <p><strong>Edition:</strong> <?php echo $book['edition']; ?></p>
                    <p><strong>Publication Year:</strong> <?php echo $book['publication_year']; ?></p>
                    <p><strong>Price:</strong> $<?php echo $book['price']; ?></p>
                </div>
                <div class="col-md-6">
                    <p><strong>Author:</strong> <?php 
                        echo $book['first_name'] . ' ' . 
                             ($book['middle_name'] ? $book['middle_name'] . ' ' : '') . 
                             $book['last_name']; 
                    ?></p>
                    <p><strong>Publisher:</strong> <?php echo $book['publisher_name']; ?></p>
                    <p><strong>Total Copies:</strong> <?php echo $book['num_Copies']; ?></p>
                </div>
            </div>
        </div>
    </div>

    <h3>Copy Status</h3>
    <div class="card">
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Copy ID</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($copy = $copies->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $copy['copy_id']; ?></td>
                        <td>
                            <?php 
                            switch($copy['status']) {
                                case 'A':
                                    echo '<span class="badge bg-success">Available</span>';
                                    break;
                                case 'B':
                                    echo '<span class="badge bg-warning">Borrowed</span>';
                                    break;
                                default:
                                    echo '<span class="badge bg-secondary">Unknown</span>';
                            }
                            ?>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="mt-3">
        <a href="books.php" class="btn btn-secondary">Back to Books</a>
        <a href="edit_book.php?isbn=<?php echo $isbn; ?>" class="btn btn-warning">Edit Book</a>
    </div>
</div>

<?php require_once 'footer.php'; ?>