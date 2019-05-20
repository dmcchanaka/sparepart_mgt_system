<?php

session_start();
require_once '../library/config.php';
require_once '../library/functions.php';
if ($_SESSION['user_type'] == 'cashier') {
    $connection = new createConnection();
    $connection->connectToDatabase();
    
     $term = $_REQUEST['term'];

    $query = "SELECT cus_name AS label, cus_id AS id FROM tbl_customer WHERE cus_name LIKE '%$term%' AND cus_status = '0'";
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


