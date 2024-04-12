<?php
include ("../settings/connection.php");
include ("../settings/core.php");
global $conn;



$current_page = basename($_SERVER['PHP_SELF']);
if (getUserRole() == 1) {
    if ($current_page != 'admin_dash.php') {
        header("Location: ../views/admin_dash.php");
        exit();
    }
} elseif (getUserRole() == 2) {
    if ($current_page != 'dashboard.php') {
        header("Location: ../views/dashboard.php");
        exit();
    }
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/dash.css">
    <title>Buyer's Dashboard</title>
</head>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 800px;
        max-height: 580px;

        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        overflow: hidden; /* Added this line */
    }

    canvas {
        display: block;
        margin: auto;
        max-width: 100%;
        height: auto; /* Added this line */
    }

    .breed-list {
        margin-top: 20px;
        padding: 10px;
        background-color: #f9f9f9;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .breed-item {
        padding: 5px 10px;
        margin-bottom: 5px;
        background-color: #fff;
        border-radius: 5px;
    }

    .feedback-button {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background-color:  #8f1021;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.feedback-button:hover {
    background-color:  #b83838;
}

.form-container {
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #f9f9f9;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    z-index: 1000; /* Ensure it's above other elements */
}


</style>
<body>
<header>
        <div class="headie">
        <a href="../admin/dogs_view.php" class="header-link">Dogs</a>
        <!-- <a href="../admin/products_view.php" class="header-link">Products</a> -->
        </div>
        <div class="title"><b>Dashboard</b></div>
        <div class="logout">
            <a href="../login/logout.php" class="header-link">Log Out</a>
        </div>
    </header>
    <div class="feedback">
        <h3>Feedback:</h3>
        <p>0-19</p>
    </div>
    
<div class="container">
    <h1>Dog Availability</h1>
    <canvas id="pieChart"></canvas>
</div>

<div class="breed-list">
    <h2>Breeds Available</h2>
    <?php
    $sql = "SELECT DISTINCT Breed FROM Dogs";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='breed-item'>" . $row["Breed"] . "</div>";
        }
    } else {
        echo "<div class='breed-item'>No breeds available</div>";
    }
    ?>
</div>

<button class="feedback-button" onclick="toggleForm()">Feedback</button>
	<div class="form-container" style="display: none;">
        <form action="../actions/feedbackStudent_action.php" method="post">
            
            <div class="form-group">
                <label class="form-title">Kindly Provide Feedback</label><br>
                <label for="feedback_content">Comments:</label>
                <textarea id="feedback_content" name="feedback_content" rows="4" cols="50"></textarea>
               
            </div>
            
            <button type="submit" name="submit">Submit</button>
        </form>
    </div>

<script>
   function toggleForm() {
    const formContainer = document.querySelector('.form-container');
    const feedbackButton = document.querySelector('.feedback-button');
    const body = document.querySelector('body'); // Get the body element

    // Toggle the form display
    formContainer.style.display = formContainer.style.display === 'none' ? 'block' : 'none';
    feedbackButton.textContent = formContainer.style.display === 'none' ? 'Feedback' : 'Close';

    // Center the form vertically if it's visible
    if (formContainer.style.display === 'block') {
        const windowHeight = window.innerHeight;
        const formHeight = formContainer.clientHeight;
        const topPosition = (windowHeight - formHeight) / 2;
        formContainer.style.top = topPosition + 'px';
        body.style.overflow = 'hidden'; // Disable scrolling when the form is open
    } else {
        body.style.overflow = ''; // Re-enable scrolling when the form is closed
    }
}
</script>




<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    <?php
include ("../settings/connection.php");

    $sql = "SELECT StatusName, COUNT(*) AS Total FROM Dogs
            INNER JOIN AvailabilityStatuses ON Dogs.StatusID = AvailabilityStatuses.StatusID
            GROUP BY StatusName";
    $result = $conn->query($sql);

    $labels = [];
    $data = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $labels[] = $row['StatusName'];
            $data[] = $row['Total'];
        }
    }

    $labels = json_encode($labels);
    $data = json_encode($data);
    ?>

    // JavaScript code to generate the pie chart using Chart.js
    var ctx = document.getElementById('pieChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: <?php echo $labels; ?>,
            datasets: [{
                data: <?php echo $data; ?>,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.7)',
                    'rgba(54, 162, 235, 0.7)',
                    'rgba(255, 206, 86, 0.7)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            title: {
                display: true,
                text: 'Dog Availability Status'
            }
        }
    });
</script>

</body>
</html>
