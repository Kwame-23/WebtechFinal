<?php
session_start();
include ("../settings/connection.php");

if (isset($_POST['lsubmit'])){
    $email=$_POST['lemail'];
    $password=$_POST['password'];

    if(empty($email)||empty($password)){
        echo "All fields are required!!";
        exit;
    }
    $sql ="SELECT * FROM Users WHERE email=?";
    $stmt =$conn->prepare( $sql );   
    $stmt->bind_param("s", $email);   
    $stmt->execute();      
    $result = $stmt->get_result();       

    if($result->num_rows===0){       
        header("Location: ../login/login_register.php?msg=Unregistered Email");
        echo "Incorrect Email";
        exit;
    }

    $user=$result->fetch_assoc();

    if(!password_verify($password, $user['password'])){
        header("Location: ../login/login_register.php?msg=Wrong Password");
        echo "Incorrect Password";
        exit;
    }
    $_SESSION['user_id']=$user['user_id'];

    header("Location: ../views/dashboard.php");
}