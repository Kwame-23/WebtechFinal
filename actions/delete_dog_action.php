<?php
include "../settings/connection.php";

if ($_SERVER['REQUEST_METHOD']=='GET'){
    if(isset($_GET['id'])){
        $dog_id=$_GET['id'];

        $sql="DELETE FROM Dogs WHERE DogID=?";
        $stmt=$conn->prepare($sql);
        $stmt->bind_param('i',$dog_id);

        if ($stmt->execute()){
            header("Location: ../admin/dogs_view.php?msg=delete successful");
            exit;
        }
        else{
            header("Location: ../admin/dogs_view.php?msg=delete unsuccessful");
        }
    }
}