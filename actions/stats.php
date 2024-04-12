<?php
session_start();
include ("../settings/connection.php");


function displayDogStatusPieChart() {
global $conn;
 

    // Fetch the count of dogs for each status
    $sql = "SELECT 
              AvailabilityStatuses.StatusID,
              AvailabilityStatuses.StatusName,
              COUNT(Dogs.DogID) AS DogCount
            FROM Dogs
            INNER JOIN AvailabilityStatuses ON Dogs.StatusID = AvailabilityStatuses.StatusID
            GROUP BY AvailabilityStatuses.StatusID, AvailabilityStatuses.StatusName";
    $result = $conn->query($sql);

    // Prepare the data for the pie chart
    $data = array();
    $data[] = array('Status', 'Count');
    while ($row = $result->fetch_assoc()) {
        $data[] = array($row['StatusName'], $row['DogCount']);
    }

    // Close the database connection
    $conn->close();

    // Generate the pie chart using Google Charts
    ?>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable(<?php echo json_encode($data); ?>);

            var options = {
                title: 'Dogs by Status',
                pieHole: 0.4,
                colors: ['#0000FF', '#00FF00', '#FFFF00']
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));
            chart.draw(data, options);
        }
    </script>
    <div id="piechart" style="width: 900px; height: 500px;"></div>
    <?php
}