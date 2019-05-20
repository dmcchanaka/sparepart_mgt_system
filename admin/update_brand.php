<?php

session_start();
require_once '../library/config.php';
require_once '../library/functions.php';
if ($_SESSION['user_type'] == 'admin') {
    $connection = new createConnection();
    $connection->connectToDatabase();

    $query = "UPDATE tbl_brand SET brand_name = '".$_REQUEST['brand_name']."',sup_id = '".$_REQUEST['sup_id']."',product_id= '".$_REQUEST['product_id']."' WHERE brand_id ='".$_REQUEST['brand_id']."'";
    $result = mysqli_query($connection->myconn, $query);
    if ($result) {
        $_SESSION['cus_update_msg'] = "successfully edited";
    } else {
        $_SESSION['cus_update_msg'] = "successfully not edited";
    }
    header('Location:view_brand.php');
    $connection->close();
} else {
    header('Location:../index.php');
}

