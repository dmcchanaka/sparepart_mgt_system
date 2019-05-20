<?php

session_start();
require_once '../library/config.php';
require_once '../library/functions.php';
if ($_SESSION['user_type'] == 'admin') {
    $connection = new createConnection();
    $connection->connectToDatabase();

    $query = "INSERT INTO tbl_supplier (sup_name,sup_short_name) VALUES ('" . $_REQUEST['sup_name'] . "','" . $_REQUEST['sup_shrt_name'] . "')";
    $result = mysqli_query($connection->myconn, $query) or die(mysqli_error());
    if ($result) {
        $_SESSION['sup_add_msg'] = "successfully added";
    } else {
        $_SESSION['sup_add_msg'] = "successfully not added";
    }
    header('Location:supplier_registation.php');
    $connection->close();
} else {
    header('Location:../index.php');
}

