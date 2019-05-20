<?php

session_start();
require_once '../library/config.php';
require_once '../library/functions.php';
if ($_SESSION['user_type'] == 'admin') {
    $connection = new createConnection();
    $connection->connectToDatabase();

    $query = "INSERT INTO tbl_price (product_id,brand_id,dealer_price,retailer_price) VALUES ('" . $_REQUEST['product_id'] . "','" . $_REQUEST['brand_id'] . "','".$_REQUEST['dealer_price']."','".$_REQUEST['retailer_price']."')";   
    $result = mysqli_query($connection->myconn, $query) or die(mysqli_error());
    if ($result) {
        $_SESSION['price_add_msg'] = "successfully added";
    } else {
        $_SESSION['price_add_msg'] = "successfully not added";
    }
    header('Location:price_registration.php');
    $connection->close();
} else {
    header('Location:../index.php');
}

