<?php
include("../settings/connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['submit'])) {
        $dog_id=$_POST['DogID'];
        $statusID=$_POST['status'];
        
        $sql = "UPDATE Dogs SET StatusID= 3 WHERE DogID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ii', $statusID, $dog_id);
        if ($stmt->execute()) {
            header("Location: ../admin/dogs_view.php?msg=success");
            exit;
        } else {
            header("Location: ../admin/dogs_view.php?msg=could not update");
            exit;
        }
    }
}