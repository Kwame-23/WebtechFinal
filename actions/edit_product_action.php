<?php
include("../settings/connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id'])) {
        $product_id = $_GET['id']; 
        $new_status_id = $_GET['new_status']; 
        
        $sql = "UPDATE Items SET StatusID= ? WHERE ItemID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ii', $new_status_id, $product_id);
        if ($stmt->execute()) {
            header("Location: ../admin/products_view.php?msg=success");
            exit;
        } else {
            header("Location: ../admin/products_view.php?msg=could not update");
            exit;
        }
    }
}