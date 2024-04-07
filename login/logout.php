<?php
session_start();
unset($_SESSION['user_id']);
unset($_SESSION['role_id']);

header("Location: ../login/login_register.php");
exit();

