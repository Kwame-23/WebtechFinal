<?php

include("../settings/connection.php");


if (isset($_POST['submit'])){
    $userID= $_SESSION['user_id'];
    $dogName=$_POST['name'];
    $breed=$_POST['breed'];
    $age=$_POST['age'];
    $price=$_POST['price'];
    $description=$_POST['description'];
    $statusID=$_POST['status'];

    $target_dir= "../dog_uploads/";
    $target_file = $target_dir.basename($_FILES["image"]["name"]);
    $imageFileType=strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    $allowed_formats = array("jpg", "png", "jpeg");
    if (!in_array($imageFileType, $allowed_formats)) {
        header("Location:../admin/dogs_view.php?msg=File type not supported");
        exit;
    }

    if(move_uploaded_file($_FILES["image"]["tmp_name"],$target_file)) {
        $img=$target_file;
    }
    else{
        header("Location:../admin/dogs_view.php?msg=dImage upload faile!");
        exit;
    }

    $sql= "INSERT INTO Dogs(UserID,DogName,Bed,Age,Price,Description,StatusID,ImageURL)
     VALUES(?,?,?,?,?,?,?,?)";

    $stmt=$conn->prepare($sql);
    $stmt->bind_param("isssdsis", $userID, $dogName, $breed, $age, $price, $description, $statusID, $img);

    if($stmt->execute()){
        header("Location:../admin/dogs_view.php?msg=Dog Added");
    } else {
        header("Location:../admin/dogs_view.php?msg=Error executing query");
    }

    $stmt->close();
    $conn->close();
}

?>