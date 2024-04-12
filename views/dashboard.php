<?php
include ("../settings/connection.php");
global $conn;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/dash.css">
    <title>Picture Viewer</title>
</head>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }

   .container {
        max-width: 800px;
        max-height: 800px;

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
</style>
<body>
<header>
        <div class="headie">
        <a href="../admin/dogs_view.php" class="header-link">Dogs</a>
        <!-- <a href="../admin/products_view.php" class="header-link">Products</a> -->
        </div>
        <div class="title"><b>Picture Viewer</b></div>
        <div class="logout">
            <a href="../login/logout.php" class="header-link">Log Out</a>
        </div>
    </header>
<div style="display: flex;">
    <div style="margin-right: 20px;">
        <!-- List the available breeds here -->
        <h3>Available Breeds</h3>
        <ul>
            <?php
            // Fetch and loop through the available breeds
            $sql = "SELECT BreedName FROM Dogs GROUP BY BreedName";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<li style=\"list-style-type: '🐾';\">". $row['BreedName']. "</li>";
                }
            }
         ?>
        </ul>
    </div>
    <div class="container">
        <h1>Pie Chart - Dog Availability</h1>
        <canvas id="pieChart"></canvas>
    </div>
</div>
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
            labels: <?php echo $labels;?>,
            datasets: [{
                data: <?php echo $data;?>,
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