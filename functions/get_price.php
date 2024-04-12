<?php
include( "../settings/connection.php" );


function getPrice($dogID){
    global $conn;

    $sql="SELECT Price FROM Dogs WHERE DogID= $dogID";

    $result=$conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $price = $row["Price"];

        return $price;
    } else {
        return null; 
    }
}


