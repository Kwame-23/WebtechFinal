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
