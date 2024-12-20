<?php
require_once '../config/config.php';

if (isset($_GET['id'])) {
    $borrower_id = $_GET['id'];
    
    $sql = "DELETE FROM Borrower WHERE borrower_num = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $borrower_id);
    $stmt->execute();
}

header("Location: /library_system/public/borrowers.php");
exit();
?>