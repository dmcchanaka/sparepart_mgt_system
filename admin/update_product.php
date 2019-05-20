<?php

session_start();
require_once '../library/config.php';
require_once '../library/functions.php';
if ($_SESSION['user_type'] == 'admin') {
    $connection = new createConnection();
    $connection->connectToDatabase();

    $query = "UPDATE tbl_product SET product_code = '".$_REQUEST['product_code']."',product_name = '".$_REQUEST['product_name']."' WHERE product_id ='".$_REQUEST['product_id']."'";
    $result = mysqli_query($connection->myconn, $query);
    if ($result) {
        $_SESSION['product_update_msg'] = "successfully edited";
    } else {
        $_SESSION['product_update_msg'] = "successfully not edited";
    }
    header('Location:view_product.php');
    $connection->close();
} else {
    header('Location:../index.php');
}

