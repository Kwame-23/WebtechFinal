<?php
include "../settings/connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id'])) {
        $dog_id = $_GET['id'];

        // First, fetch the image URL from the database
        $sql = "SELECT ImageUrl FROM Dogs WHERE DogID=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $dog_id);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($image_url);
            $stmt->fetch();

            $sql2 = "DELETE FROM Dogs WHERE DogID=?";
            $stmt2 = $conn->prepare($sql2);
            $stmt2->bind_param('i', $dog_id);

            if ($stmt2->execute()) {
                if (unlink($image_url)) {
                    header("Location: ../admin/dogs_view.php?msg=delete successful");
                    exit;
                } else {
                    header("Location: ../admin/dogs_view.php?msg=Failed to delete image file");
                    exit;
                }
            } else {
                header("Location: ../admin/dogs_view.php?msg=delete unsuccessful");
                exit;
            }
        } else {
            header("Location: ../admin/dogs_view.php?msg=Dog not found");
            exit;
        }
    }
}

