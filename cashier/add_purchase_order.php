<?php

session_start();
require_once '../library/config.php';
require_once '../library/functions.php';
if ($_SESSION['user_type'] == 'cashier') {
    $connection = new createConnection();
    $connection->connectToDatabase();

    $all_query = true;
    mysqli_query($connection->myconn,"SET AUTOCOMMIT=0");
    mysqli_query($connection->myconn,"START TRANSACTION");

    $query = "INSERT INTO  tbl_purchase_order(po_no,sup_id,added_by,added_date) VALUES ('" . $_REQUEST['po_no'] . "','" . $_REQUEST['sup_id'] . "','" . $_SESSION['user_id'] . "','" . $_REQUEST['stock_date'] . "')";
    mysqli_query($connection->myconn,$query) ? null : $all_query = false;
    
    $query_max = "SELECT MAX(po_id) AS po_id FROM tbl_purchase_order WHERE added_by ='" . $_SESSION['user_id'] . "'";
    $result_max = mysqli_query($connection->myconn, $query_max);
    $row_max = mysqli_fetch_assoc($result_max);
    
    if (isset($_REQUEST['row_count']) && $_REQUEST['row_count'] > 0) {
        for ($i = 1; $i <= $_REQUEST['row_count']; $i++) {
            if (isset($_REQUEST['qty_'.$i])) {
                $query_pro = "INSERT INTO tbl_purchase_order_details (po_id,pro_id,brand_id,price_id,qty) VALUES ('".$row_max['po_id']."','".$_REQUEST['pro_id_'.$i]."','".$_REQUEST['brand_id_'.$i]."','".$_REQUEST['price_id_'.$i]."','".$_REQUEST['qty_'.$i]."')";
                mysqli_query($connection->myconn,$query_pro) ? null : $all_query = false;
            }
        }
    }
    
    if ($all_query) {
         mysqli_query($connection->myconn,"COMMIT");
         $_SESSION['po_add_msg'] = "successfully added";
    }else{
        mysqli_query($connection->myconn,"ROLLBACK");
        $_SESSION['po_add_msg'] = "successfully not added";
    }
    header('Location:purchase_order.php');
    $connection->close();
} else {
    header('Location:../index.php');
}

