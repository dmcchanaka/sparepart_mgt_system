<?php

session_start();
require_once '../library/config.php';
require_once '../library/functions.php';
if ($_SESSION['user_type'] == 'admin') {
    $connection = new createConnection();
    $connection->connectToDatabase();

    $query = "INSERT INTO tbl_product (product_code,product_name) VALUES ('" . $_REQUEST['product_code'] . "','" . $_REQUEST['Product_name'] . "')";
    $result = mysqli_query($connection->myconn, $query) or die(mysqli_error());
    if ($result) {
        $_SESSION['product_add_msg'] = "successfully added";
    } else {
        $_SESSION['product_add_msg'] = "successfully not added";
    }
    header('Location:product_registration.php');
    $connection->close();
} else {
    header('Location:../index.php');
}
