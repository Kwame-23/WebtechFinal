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
$total_dogs = 0;
$data = array();
while ($row = $result->fetch_assoc()) {
$data[$row['StatusName']] = $row['DogCount'];
$total_dogs += $row['DogCount'];
}

// Close the database connection
$conn->close();

// Generate the pie chart using HTML/CSS
?>
<style>
.pie-chart {
  width: 300px;
  height: 300px;
  position: relative;
  font-size: 16px;
}
.pie-chart .slice {
  position: absolute;
  width: 100%;
  height: 100%;
  clip: rect(0, 300px, 300px, 150px);
}
.pie-chart .slice.blue {
  clip: rect(0, 150px, 300px, 0);
  background-color: #0000FF;
}
.pie-chart .slice.green {
  clip: rect(0, 225px, 300px, 150px);
  background-color: #00FF00;
}
.pie-chart .slice.yellow {
  clip: rect(0, 300px, 300px, 225px);
  background-color: #FFFF00;
}
.pie-chart .label {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}
</style>

<div class="pie-chart">
<?php
$blue_angle = $data['1'] / $total_dogs * 360;
$green_angle = $data['2'] / $total_dogs * 360;
$yellow_angle = $data['3'] / $total_dogs * 360;
?>
<div class="slice blue" style="transform: rotate(<?php echo $blue_angle; ?>deg);"></div>
<div class="slice green" style="transform: rotate(<?php echo $blue_angle + $green_angle; ?>deg);"></div>
<div class="slice yellow" style="transform: rotate(<?php echo $blue_angle + $green_angle + $yellow_angle; ?>deg);"></div>
<div class="label"><?php echo $total_dogs; ?> Dogs</div>
</div>
<?php
}