<?php
session_start();
include("../settings/connection.php");

function displayDogStatusPieChart() {
    global $conn;

    // Fetch the count of dogs for each status
    $sql = "SELECT AvailabilityStatuses.StatusID, AvailabilityStatuses.StatusName, COUNT(Dogs.DogID) AS DogCount 
            FROM Dogs 
            INNER JOIN AvailabilityStatuses ON Dogs.StatusID = AvailabilityStatuses.StatusID
            GROUP BY AvailabilityStatuses.StatusID, AvailabilityStatuses.StatusName";
    $result = $conn->query($sql);

    // Prepare the data for the pie chart
    $data = array();
    $total_dogs = 0;
    while ($row = $result->fetch_assoc()) {
        $data[$row['StatusName']] = $row['DogCount'];
        $total_dogs += $row['DogCount'];
    }

    // Close the database connection
    $conn->close();

    // Debugging output for data
    echo '<pre>';
    print_r($data);
    echo '</pre>';

    // Generate the pie chart using HTML/CSS
?>
<style>
    .container {
        display: flex;
        justify-content: space-between;
        width: 100%;
    }
    .pie-chart {
        width: 300px;
        height: 300px;
        position: relative;
        font-size: 16px;
        border: 1px solid #ccc; /* Add border for visualization */
        border-radius: 50%; /* Make it circular */
    }
    .pie-chart .slice {
        position: absolute;
        width: 100%;
        height: 100%;
        clip: rect(0, 150px, 300px, 0); /* Set initial clip value */
        border-radius: 50%; /* Make it circular */
    }
    .pie-chart .slice.blue {
        background-color: #0000FF;
    }
    .pie-chart .slice.green {
        background-color: #00FF00;
    }
    .pie-chart .slice.yellow {
        background-color: #FFFF00;
    }
    .pie-chart .label {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
    .available-breeds {
        width: 300px;
        background-color: #f1f1f1;
        padding: 20px;
        border-radius: 5px;
    }
    .available-breeds h2 {
        margin-top: 0;
    }
    .available-breeds ul {
        list-style-type: none;
        padding: 0;
    }
    .available-breeds li {
        margin-bottom: 10px;
    }
</style>

<div class="container">
    <div class="pie-chart">
        <?php
        $blue_angle = isset($data['Available']) ? $data['Available'] / $total_dogs * 360 : 0; // Assuming 'Available' is the status name for ID 1
        $green_angle = isset($data['Reserved']) ? $data['Reserved'] / $total_dogs * 360 : 0; // Assuming 'Reserved' is the status name for ID 2
        $yellow_angle = isset($data['Sold']) ? $data['Sold'] / $total_dogs * 360 : 0; // Assuming 'Sold' is the status name for ID 3
        ?>
        <div class="slice blue" style="transform: rotate(<?php echo $blue_angle; ?>deg);"></div>
        <div class="slice green" style="transform: rotate(<?php echo $blue_angle + $green_angle; ?>deg);"></div>
        <div class="slice yellow" style="transform: rotate(<?php echo $blue_angle + $green_angle + $yellow_angle; ?>deg);"></div>
        <div class="label"><?php echo $total_dogs; ?> Dogs</div>
    </div>

    <div class="available-breeds">
        <h2>Available Breeds</h2>
        <ul>
            <?php
            // Fetch the available dog breeds from the database
            $available_sql = "SELECT DISTINCT Breed FROM Dogs WHERE StatusID = 1"; // Assuming status ID 1 is 'Available'
            $available_result = $conn->query($available_sql);

            while ($row = $available_result->fetch_assoc()) {
                echo "<li>{$row['Breed']}</li>";
            }
            ?>
        </ul>
    </div>
</div>
<?php
}

displayDogStatusPieChart();
?>