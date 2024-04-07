<?php
$dbservername="localhost";
$dbusername="root";
$dbpassword="";
$database="dogmarket";

$conn= new mysqli($dbservername, $dbusername, $dbpassword, $database);


if(!$conn){
    die("Connection Failed".$conn->connect_error);
}




