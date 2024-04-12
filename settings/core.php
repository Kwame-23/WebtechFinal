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

function bounce() {
    $current_page = basename($_SERVER['PHP_SELF']);
    if (getUserRole() == 1) {
        if ($current_page != 'admin_view.php') {
            header("Location: ../admin/admin_view.php");
            exit();
        }
    } elseif (getUserRole() == 2) {
        if ($current_page != 'dogs_view.php') {
            header("Location: ../admin/dogs_view.php");
            exit();
        }
    }
}

function bounce2() {
    $current_page = basename($_SERVER['PHP_SELF']);
    if (getUserRole() == 1) {
        if ($current_page != 'prod_admin.php') {
            header("Location: ../admin/prod_admin.php");
            exit();
        }
    } elseif (getUserRole() == 2) {
        if ($current_page != 'products_view.php') {
            header("Location: ../admin/products_view.php");
            exit();
        }
    }
}
// print_r(getUserRole());
