<?php

session_start();
require_once '../library/config.php';
require_once '../library/functions.php';
if ($_SESSION['user_type'] == 'cashier') {
    $connection = new createConnection();
    $connection->connectToDatabase();

    $query = "SELECT brand_id AS brnd_id,brand_name AS brnd_name FROM tbl_brand WHERE product_id ='".$_REQUEST['pro_id']."' ORDER BY brand_name";
    $result = mysqli_query($connection->myconn,$query);
    $data = array();
    while ($row= mysqli_fetch_assoc($result)){
        array_push($data, $row);   
    }
    echo json_encode($data);
    $connection->close();
} else {
    header('Location:../index.php');
}