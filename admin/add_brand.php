<?php

session_start();
require_once '../library/config.php';
require_once '../library/functions.php';
if ($_SESSION['user_type'] == 'admin') {
    $connection = new createConnection();
    $connection->connectToDatabase();

    $query = "INSERT INTO tbl_brand (brand_name,sup_id,product_id) VALUES ('" . $_REQUEST['brand_name'] . "','" . $_REQUEST['sup_id'] . "','" . $_REQUEST['product_id'] . "')";
    $result = mysqli_query($connection->myconn, $query) or die(mysqli_error());
    if ($result) {
        $_SESSION['brand_add_msg'] = "successfully added";
    } else {
        $_SESSION['brand_add_msg'] = "successfully not added";
    }
    header('Location:brand_registration.php');
    $connection->close();
} else {
    header('Location:../index.php');
}

