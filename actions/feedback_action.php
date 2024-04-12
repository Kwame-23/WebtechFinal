<?php
session_start();

include("../settings/connection.php");


date_default_timezone_set('UTC');
$date_today=date('Y-m-d');



if(isset($_POST['submit'])){
    $userID= $_SESSION['user_id'];
    $feedback_content=$_POST['feedback_content'];
    


    $sql = "INSERT into Feedback(UserID, ReviewText, Timestamp) values(?, ?, ?)";
    $stmt = $conn->prepare($sql); 
    $stmt->bind_param('iss', $userID, $feedback_content,  $date_today);  

    if($stmt->execute()){
        header("Location: ../templates/dashboard.php");
        echo 'Sent';
    }
    else{
        echo "Error" . $conn->error;
        exit;
    }
    


}