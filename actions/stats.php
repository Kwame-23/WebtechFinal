<?php
session_start();
include ("../settings/connection.php");


function displayDogStatusPieChart() {
global $conn;
 

$sql = "SELECT AvailabilityStatuses.StatusID, AvailabilityStatuses.StatusName, COUNT(Dogs.DogID) AS DogCount 
FROM Dogs 
INNER JOIN AvailabilityStatuses ON Dogs.StatusID = AvailabilityStatuses.StatusID
GROUP BY AvailabilityStatuses.StatusID, AvailabilityStatuses.StatusName";
$result = $conn->query($sql);

// Prepare the data for the pie chart
$data = array();
$total_dogs = 0;
while ($row = $result->fetch_assoc()) {
$data[] = array($row['StatusName'], $row['DogCount']);
$total_dogs += $row['DogCount'];
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

// Calculate the start and end angles for each slice
var angles = [];
var startAngle = 0;
for (var i = 0; i < data.length; i++) {
    var sliceAngle = (data[i][1] / <?php echo $total_dogs; ?>) * 360;
    angles.push({
        startAngle: startAngle,
        endAngle: startAngle + sliceAngle
    });
    startAngle += sliceAngle;
}

// Set the start and end angles for each slice
options.sliceVisibilityThreshold = 0;
options.pieSliceText = 'none';
options.pieStartAngle = angles[0].startAngle;
options.pieSliceTextStyle = {
    color: 'white',
    fontSize: 16
};

chart.draw(data, options);
}
</script>
<div id="piechart" style="width: 900px; height: 500px;"></div>
<?php
}