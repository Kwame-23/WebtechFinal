<?php
include "../settings/connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id'])) {
        $item_id = $_GET['id'];

        // First, fetch the image URL from the database
        $sql_fetch_image = "SELECT ImageURL FROM Items WHERE ItemID=?";
        $stmt_fetch_image = $conn->prepare($sql_fetch_image);
        $stmt_fetch_image->bind_param('i', $item_id);
        $stmt_fetch_image->execute();
        $stmt_fetch_image->store_result();

        if ($stmt_fetch_image->num_rows > 0) {
            $stmt_fetch_image->bind_result($image_url);
            $stmt_fetch_image->fetch();

            // Delete the item from the database
            $sql_delete_item = "DELETE FROM Items WHERE ItemID=?";
            $stmt_delete_item = $conn->prepare($sql_delete_item);
            $stmt_delete_item->bind_param('i', $item_id);

            if ($stmt_delete_item->execute()) {
                // Delete the image file from the target directory
                if (unlink($image_url)) {
                    header("Location: ../admin/products_view.php?msg=delete successful");
                    exit;
                } else {
                    header("Location: ../admin/products_view.php?msg=Failed to delete image file");
                    exit;
                }
            } else {
                header("Location: ../admin/products_view.php?msg=delete unsuccessful");
                exit;
            }
        } else {
            header("Location: ../admin/products_view.php?msg=Item not found");
            exit;
        }
    }
}
?>
