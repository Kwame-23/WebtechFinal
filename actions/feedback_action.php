<?php
include("../settings/connection.php"); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $feedbackText = htmlspecialchars($_POST["message"]);
    $userID= $_SESSION['user_id'];

    $sql = "INSERT INTO Reviews (UserID, ReviewText) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("is", $userID, $feedbackText);

    if($stmt->execute()){
        header("Location:../views/dashboard.php?msg=Feedback Recorded");
    }
    else{
        header("Location:../views/dashboard.php?msg=Feedback Npt Recorded");

    }
    $stmt->close();

     
    $conn->close();
}
?>
