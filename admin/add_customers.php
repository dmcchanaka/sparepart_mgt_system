<?php

session_start();
require_once '../library/config.php';
require_once '../library/functions.php';
if ($_SESSION['user_type'] == 'admin') {
    $connection = new createConnection();
    $connection->connectToDatabase();

    $query = "INSERT INTO tbl_customer (cus_name,address,telephone,email) VALUES ('" . $_REQUEST['name'] . "','" . $_REQUEST['address'] . "','" . $_REQUEST['telephone'] . "','" . $_REQUEST['email'] . "')";
    $result = mysqli_query($connection->myconn, $query);
     

    $connection->close();
} else {
    header('Location:../index.php');
}
?>