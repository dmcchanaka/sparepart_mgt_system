<?php

session_start();
require_once '../library/config.php';
require_once '../library/functions.php';
if ($_SESSION['user_type'] == 'cashier') {
    $connection = new createConnection();
    $connection->connectToDatabase();

    $query = "SELECT 
        SUM(sp.remain_qty) AS stock 
        FROM 
        tbl_stock_product sp 
    WHERE 
        sp.pro_id = '".$_REQUEST['pro_id']."'
        AND sp.brand_id = '".$_REQUEST['brand_id']."'
        AND sp.price_id = '".$_REQUEST['price_id']."'
    GROUP BY sp.price_id";
    $result = mysqli_query($connection->myconn, $query);
    if (mysqli_num_rows($result) != 0) {
        $row = mysqli_fetch_assoc($result);
        echo $row['stock'];
    } else {
        echo 0;
    }

    $connection->close();
} else {
    header('Location:../index.php');
}

