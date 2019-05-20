<?php

session_start();
require_once '../library/config.php';
require_once '../library/functions.php';
if ($_SESSION['user_type'] == 'admin') {
    $connection = new createConnection();
    $connection->connectToDatabase();

    $query = "UPDATE tbl_price SET brand_id = '".$_REQUEST['brand_id']."',product_id = '".$_REQUEST['pro_id']."',dealer_price= '".$_REQUEST['dealer_price']."',retailer_price= '".$_REQUEST['retailer_price']."' WHERE brand_id ='".$_REQUEST['brand_id']."'";
    $result = mysqli_query($connection->myconn, $query);
    if ($result) {
        $_SESSION['price_update_msg'] = "successfully edited";
    } else {
        $_SESSION['price_update_msg'] = "successfully not edited";
    }
    header('Location:view_price.php');
    $connection->close();
} else {
    header('Location:../index.php');
}

