<?php

include( "../settings/connection.php" );

function get_all_products(){
    global $conn;

    $sql = "SELECT i.ItemName, i.Category, i.Price, i.Description, i.ImageURL, s.StatusName 
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

function display_productss($var){
    if ($var['status']== 'success'){
        foreach($var['data'] as $products){
            echo '<div style="flex-basis: calc(25% - 20px); text-align:center;">';
            echo '<img src="'. $products['ImageURL']. '" alt="'. $products['ItemName']. '">';
            echo '<p>'. $products['ItemName']. '</p>';
            echo '<p>'. $products['Category']. '</p>';
            echo '<p>'. $products['Price']. '</p>';
            echo '<p>'. $products['Description']. '</p>';
            echo '<p>'. $products['StatusName']. '</p>';
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


        