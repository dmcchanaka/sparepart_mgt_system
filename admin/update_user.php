<?php

session_start();
require_once '../library/config.php';
require_once '../library/functions.php';
if ($_SESSION['user_type'] == 'admin') {
    $connection = new createConnection();
    $connection->connectToDatabase();

    $query = "UPDATE tbl_user SET u_name = '".$_REQUEST['name']."',NIC = '".$_REQUEST['nic']."',telephone = '".$_REQUEST['telephone']."',address = '".$_REQUEST['address']."' WHERE u_id ='".$_REQUEST['u_id']."'";
    $result = mysqli_query($connection->myconn, $query);
    if ($result) {
        $_SESSION['user_add_msg'] = "successfully edited";
    } else {
        $_SESSION['user_add_msg'] = "successfully not edited";
    }
    header('Location:user_view.php');
    $connection->close();
} else {
    header('Location:../index.php');
}

