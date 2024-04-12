<?php
session_start();
include("../settings/connection.php");
date_default_timezone_set('UTC');
$date_today = date('Y-m-d');

if (isset($_POST['submit'])) {
    $userID = $_SESSION['user_id'];
    $feedback_content = mysqli_real_escape_string($conn, $_POST['feedback_content']);

    $sql = "INSERT INTO Feedback (UserID, ReviewText, Timestamp) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('iss', $userID, $feedback_content, $date_today);

    if ($stmt->execute()) {
        header("Location: ../views/dashboard.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>