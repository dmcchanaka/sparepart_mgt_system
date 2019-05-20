<?php

session_start();
require_once '../library/config.php';
require_once '../library/functions.php';
if ($_SESSION['user_type'] == 'admin') {
    $connection = new createConnection();
    $connection->connectToDatabase();

    date_default_timezone_set('Asia/Colombo');
    
    $query = "INSERT INTO tbl_user (u_name,NIC,telephone,address,u_tp_id,username,password,added_date,added_time) VALUES ('" . $_REQUEST['name'] . "','" . $_REQUEST['nic'] . "','" . $_REQUEST['telephone'] . "','" . $_REQUEST['address'] . "','" . $_REQUEST['user_type'] . "','" . $_REQUEST['username'] . "','" . md5($_REQUEST['password']) . "','" . date('Y-m-d') . "','" . date('H:i:s') . "')";
    $result = mysqli_query($connection->myconn, $query);
    if ($result) {
        $_SESSION['user_add_msg'] = "successfully added";
    } else {
        $_SESSION['user_add_msg'] = "successfully not added";
    }
    header('Location:user_registration.php');
    $connection->close();
} else {
    header('Location:../index.php');
}

