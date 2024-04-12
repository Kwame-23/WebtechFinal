<?php

include( "../settings/connection.php" );
function get_all_dogs(){
    global $conn;

    $sql = "SELECT d.DogID, d.DogName, d.Breed, d.Price, d.Description, d.ImageURL, s.StatusName
     FROM Dogs as d 
     JOIN AvailabilityStatuses as s ON d.StatusID = s.StatusID;
    ";

    $result  = mysqli_query($conn, $sql); 

    if (!$result){
        return array(
            'status'  => 'error',
            'message' => 'Error executing query:'  . mysqli_error($conn)
        );        
    }

    if(mysqli_num_rows( $result ) == 0 ){
        // no data
        return array('status'=>'empty');
    }

    $dogs=array();
    while ($row = mysqli_fetch_assoc($result)) {
        $dog[]=$row;
    }

    return array(
        'status' => 'success',
        'data'   => $dog
    );    

}

$dog_list=get_all_dogs();
// print_r($dog_list);

function display_dogs($var){
    if ($var['status']== 'success'){
        foreach($var['data'] as $dog){
            echo '<div style="flex-basis: calc(25% - 20px); text-align:center; overflow: hidden;">';
            echo '<img style="max-width: 100%; height: auto; max-height: 200px;" src="'. $dog['ImageURL']. '" alt="'. $dog['DogName']. '">';
            echo '<p>'. $dog['DogName']. '</p>';
            echo '<p>'. $dog['Breed']. '</p>';
            echo '<p> ¢'. $dog['Price']. '</p>';
            echo '<p>'. $dog['Description']. '</p>';
            echo '<p>'. $dog['StatusName']. '</p>';

            echo '<form method="GET" action="../actions/edit_dog_buy_action.php" style="display: inline;">';
            echo '<input type="hidden" name="id" value="' . $dog['DogID'] . '">';
            echo '<input type="hidden" name="id" value="' . $dog['Price'] . '">';
            echo '<input type="hidden" name="new_status" value="3">'; 
            echo '<button type="submit" name="submit" style="margin-right: 10px;">Reserve</button>';
            echo '</form>';

         
            echo '</div>';
        }
    } elseif ($var['status']== 'empty') {
        echo '<p class="no-dogs-found">No dogs found.</p>';
    } else {
        echo '<p class="error-message">An error occurred: '. $var['message']. '</p>';
    }
}

$dog_list = get_all_dogs();
display_dogs($dog_list);


        