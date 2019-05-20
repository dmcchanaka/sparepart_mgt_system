<?php

session_start();
require_once '../library/config.php';
require_once '../library/functions.php';
if ($_SESSION['user_type'] == 'cashier') {
    $connection = new createConnection();
    $connection->connectToDatabase();

    $query = "UPDATE tbl_purchase_order SET po_status ='1' WHERE grn_status = '0' AND po_id = '" . $_REQUEST['po_id'] . "'";
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
