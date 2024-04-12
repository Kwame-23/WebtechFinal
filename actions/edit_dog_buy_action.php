<?php
include("../settings/connection.php");
require_once "../settings/core.php";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id'])) {
        $dog_id = $_GET['id']; 
        $new_status_id = $_GET['new_status']; 
        
        $sql = "UPDATE Dogs SET StatusID= ? WHERE DogID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ii', $new_status_id, $dog_id);
        if ($stmt->execute()) {
            if(getUserRole()==2){
                header("Location: ../payment/pay.php?id=$dog_id");
                exit();
            }else{

            header("Location: ../admin/dogs_view.php?msg=success");
            exit;
        }
    }
         
    else {
        header("Location: ../admin/dogs_view.php?msg=could not update");
        exit;
        }
    }
}