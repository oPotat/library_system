<?php
require_once '../config/config.php';
require_once '../includes/header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_book'])) {
    $isbn = $_POST['isbn'];
    $title = $_POST['title'];
    $copies = $_POST['num_copies'];
    $edition = $_POST['edition'];
    $year = $_POST['publication_year'];
    $price = $_POST['price'];
    
    $sql = "INSERT INTO Book (ISBN, num_Copies, title, edition, publication_year, price) 
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iisiii", $isbn, $copies, $title, $edition, $year, $price);
    $stmt->execute();
}
?>


<div class="container mt-5">
    <h2>Book Management</h2>
    
    <!-- Add Book Form -->
    <div class="card mb-4">
        <div class="card-header">
            <h3>Add New Book</h3>
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="isbn" class="form-label">ISBN</label>
                        <input type="number" class="form-control" id="isbn" name="isbn" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="num_copies" class="form-label">Number of Copies</label>
                        <input type="number" class="form-control" id="num_copies" name="num_copies" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="edition" class="form-label">Edition</label>
                        <input type="number" class="form-control" id="edition" name="edition" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="publication_year" class="form-label">Publication Year</label>
                        <input type="number" class="form-control" id="publication_year" name="publication_year" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" class="form-control" id="price" name="price" required>
                    </div>
                </div>
                <button type="submit" name="add_book" class="btn btn-primary">Add Book</button>
            </form>
        </div>
    </div>

    <!-- Book List -->
    <div class="card">
        <div class="card-header">
            <h3>Book List</h3>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>ISBN</th>
                        <th>Title</th>
                        <th>Copies</th>
                        <th>Edition</th>
                        <th>Year</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM Book";
                    $result = $conn->query($sql);
                    
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['ISBN'] . "</td>";
                        echo "<td>" . $row['title'] . "</td>";
                        echo "<td>" . $row['num_Copies'] . "</td>";
                        echo "<td>" . $row['edition'] . "</td>";
                        echo "<td>" . $row['publication_year'] . "</td>";
                        echo "<td>$" . $row['price'] . "</td>";
                        echo "<td>
                                <a href='../CRUD/edit_book.php?isbn=" . $row['ISBN'] . "' class='btn btn-sm btn-warning'>Edit</a>
                                <a href='../CRUD/delete_book.php?isbn=" . $row['ISBN'] . "' class='btn btn-sm btn-danger' onclick='return confirm(\"Are you sure?\")'>Delete</a>
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
