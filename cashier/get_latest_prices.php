<?php

session_start();
require_once '../library/config.php';
require_once '../library/functions.php';
if ($_SESSION['user_type'] == 'cashier') {
    $connection = new createConnection();
    $connection->connectToDatabase();

    $query = "SELECT price_id,dealer_price FROM tbl_price WHERE product_id ='".$_REQUEST['pro_id']."' AND brand_id = '".$_REQUEST['brand_id']."' AND price_status = 0 ORDER BY price_id DESC LIMIT 1";
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