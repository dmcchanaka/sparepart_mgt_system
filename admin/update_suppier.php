<?php

session_start();
require_once '../library/config.php';
require_once '../library/functions.php';
if ($_SESSION['user_type'] == 'admin') {
    $connection = new createConnection();
    $connection->connectToDatabase();

    $query = "UPDATE tbl_supplier SET sup_name = '".$_REQUEST['sup_name']."',sup_short_name = '".$_REQUEST['sup_shrt_name']."' WHERE sup_id ='".$_REQUEST['sup_id']."'";
    $result = mysqli_query($connection->myconn, $query);
    if ($result) {
        $_SESSION['cus_update_msg'] = "successfully edited";
    } else {
        $_SESSION['cus_update_msg'] = "successfully not edited";
    }
    header('Location:supplier_view.php');
    $connection->close();
} else {
    header('Location:../index.php');
}

