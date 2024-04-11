<?php

include( "../settings/connection.php" );
session_start();
include( "../settings/core.php" );
$role_ID = $_SESSION['role_id'];


function get_all_products(){
    global $conn;

    $sql = "SELECT i.ItemID, i.ItemName, i.Category, i.Price, i.Description, i.ImageURL, s.StatusName 
            FROM Items as i 
            JOIN AvailabilityStatuses as s ON i.StatusID = s.StatusID;
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
        $products[]=$row;
    }

    return array(
        'status' => 'success',
        'data'   => $products
    );    

}

$products_list=get_all_products();
// print_r($products_list);

function display_productss($var){
    $role_ID = $_SESSION['role_id'];

    if ($var['status']== 'success'){
        foreach($var['data'] as $products){
            echo '<div style="flex-basis: calc(25% - 20px); text-align:center;">';
            echo '<img src="'. $products['ImageURL']. '" alt="'. $products['ItemName']. '">';
            echo '<p>'. $products['ItemName']. '</p>';
            echo '<p>'. $products['Category']. '</p>';
            echo '<p>'. $products['Price']. '</p>';
            echo '<p>'. $products['Description']. '</p>';
            echo '<p>'. $products['StatusName']. '</p>';
    
            if ($role_ID == 1) {

            echo '<form method="GET" action="../actions/edit_product_action.php" style="display: inline;">';
            echo '<input type="hidden" name="id" value="' . $products['ItemID'] . '">';
            echo '<input type="hidden" name="new_status" value="3">'; 
            echo '<button type="submit" name="submit" style="margin-right: 10px;">Reserve</button>';
            echo '</form>';
            }
            elseif($role_ID==2){
            echo '<form method="GET" action="../actions/edit_product_action.php" style="display: inline;">';
            echo '<input type="hidden" name="id" value="' . $products['ItemID'] . '">';
            echo '<input type="hidden" name="new_status" value="2">'; 
            echo '<button type="submit" name="submit" style="margin-right: 10px;">Sold</button>';
            echo '</form>';

            echo '<form method="GET" action="../actions/edit_product_action.php" style="display: inline;">';
            echo '<input type="hidden" name="id" value="' . $products['ItemID'] . '">';
            echo '<input type="hidden" name="new_status" value="1">'; 
            echo '<button type="submit" name="submit" style="margin-right: 10px;">Available</button>';
            echo '</form>';

            echo '<form method="GET" action="../actions/delete_product_action.php" style="display: inline;">';
            echo '<input type="hidden" name="id" value="' . $products['ItemID'] . '">';
            echo '<button type="submit" name="submit" style="margin-right: 10px;">Delete</button>';
            echo '</form>';
        }
        echo '</div>';
    }
    } elseif ($var['status']== 'empty') {
        echo '<p class="no-products-found">No products found.</p>';
    } else {
        echo '<p class="error-message">An error occurred: '. $var['message']. '</p>';
    }
}

$prod_list = get_all_products();
display_productss($prod_list);


        