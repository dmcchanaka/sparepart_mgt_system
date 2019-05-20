<?php

session_start();
require_once '../library/config.php';
require_once '../library/functions.php';
if ($_SESSION['user_type'] == 'admin') {
    $connection = new createConnection();
    $connection->connectToDatabase();

    $query = "UPDATE tbl_product SET product_status ='1' WHERE product_id = '" . $_REQUEST['product_id'] . "'";
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
