<?php

session_start();
require_once '../library/config.php';
require_once '../library/functions.php';
if ($_SESSION['user_type'] == 'admin') {
    $connection = new createConnection();
    $connection->connectToDatabase();

    $query = "UPDATE tbl_brand SET brand_status ='1' WHERE brand_id = '" . $_REQUEST['brand_id'] . "'";
    $result = mysqli_query($connection->myconn, $query);

    if ($result) {
        echo '1';
    } else {
        echo '0';
    }
    $connection->close();
} else {
    header('Location:../index.php');
}
