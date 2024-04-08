<?php
session_start();

include("../settings/connection.php");


if (isset($_POST['submit'])){
    $userID= $_SESSION['user_id'];
    $dogName=$_POST['name'];
    $breed=$_POST['breed'];
    $price=$_POST['price'];
    $description=$_POST['description'];
    $statusID=$_POST['status'];
    $img= "";

    $target_dir= "../dog_uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType=strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    if (file_exists($target_file)) {
        header("Location:../admin/dogs_view.php?msg=Sorry, file already exists.");
        exit();
    }


    if ($uploadOk == 0) {

        header("Location: ../admin/dogs_view.php?msg=Sorry, your file was not uploaded.");
    }

    // $allowed_formats = array("jpg", "png", "jpeg");
    // if (!in_array($imageFileType, $allowed_formats)) {
    //     header("Location:../admin/dogs_view.php?msg=File type not supported");
    //     exit;
    // }

    if(move_uploaded_file($_FILES["image"]["tmp_name"],$target_file)) {

        $sql= "INSERT INTO Dogs(UserID,DogName,Breed,Price,Description,StatusID,ImageURL)
        VALUES(?,?,?,?,?,?,?)";
   
       $stmt=$conn->prepare($sql);
       $stmt->bind_param("issdsis", $userID, $dogName, $breed, $price, $description, $statusID, $target_file);
   
       if($stmt->execute()){
           header("Location:../admin/dogs_view.php?msg=Dog Added");
       } else {
           header("Location:../admin/dogs_view.php?msg=Error executing query");
       }
   
       $stmt->close();
       $conn->close();
    }
    else{
        header("Location:../admin/dogs_view.php?msg=Image upload failed!");
        exit;
    }

    
}

?>