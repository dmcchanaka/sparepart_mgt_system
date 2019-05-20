<?php

session_start();
require_once '../library/config.php';
require_once '../library/functions.php';
if ($_SESSION['user_type'] == 'admin') {
    $connection = new createConnection();
    $connection->connectToDatabase();

    $query = "SELECT brand_id, brand_name FROM tbl_brand WHERE brand_status='0' AND product_id ='" . $_REQUEST['pro_id'] . "' ORDER BY brand_name";
    $result = mysqli_query($connection->myconn, $query);
    $data = array();
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($data, $row);
    }
    echo json_encode($data);
}
