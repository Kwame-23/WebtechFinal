<?php
session_start();

include ("../settings/connection.php");

// var_dump($_POST);

if(isset($_POST['submitBtn'])){
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $role=$_POST['role'];
    $contact=$_POST['contact'];
    $email=$_POST['remail'];
    $password=$_POST['password'];
    $confirm_password=$_POST['confirm_password'];

    if($password!= $confirm_password){
        header("Location: ../login/login_register.php?msg=Passwords do not match!");
        exit;
    }

    $sql = "SELECT * FROM Users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        header("Location: ../login/login_register.php?msg=Email Already Registered!");
        exit;
    }
    $hashpassword=password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO Users (first_name, last_name, role_id, contact, email, password) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssisss", $fname, $lname, $role, $contact, $email, $hashpassword);

    if ($stmt->execute()){
        header("Location: ../login/login_register.php?msg=Email Registered Successfully!");
        exit;
    }
    else{
        echo "Error" . $conn->error;
        exit;
    }

}