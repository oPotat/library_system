<?php
require_once '../config/config.php';

if (isset($_GET['isbn'])) {
    $isbn = $_GET['isbn'];
    
    // Delete related records in Copy table
    $sql = "DELETE FROM Copy WHERE book_id = ?";    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $isbn);
    $stmt->execute();
    
    // Delete from other related tables
    $tables = ['Writes', 'Publishes', 'Book'];
    foreach ($tables as $table) {
        $sql = "DELETE FROM $table WHERE ISBN = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $isbn);
        $stmt->execute();
    }
}

header("Location: /library_system/public/books.php");
exit();
?>