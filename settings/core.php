<?php

session_start();

function check_login(){
    if(!isset($_SESSION['user_id'])){
        header("Location: ../login/login_register.php");
        die();
    }
}

function getUserRole(){
    if(isset($_SESSION['role_id'])){
        return $_SESSION['role_id'];
    }
    else{
        return null;
    }
}

function bounce(){
    if(getUserRole() == 1){
        header("Location: ../admin/admin_view.php");
        exit();
    }
    else if(getUserRole() == 2){
    header("Location: ../admin/dogs_view.php");
    exit();
    }
}

// print_r(getUserRole());
