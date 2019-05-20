<?php

session_start();
require_once '../library/config.php';
require_once '../library/functions.php';
if ($_SESSION['user_type'] == 'cashier') {
    $connection = new createConnection();
    $connection->connectToDatabase();
    
     $term = $_REQUEST['term'];

    $query = "SELECT product_name AS label, product_id AS id FROM tbl_product WHERE product_name LIKE '%$term%'";
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


