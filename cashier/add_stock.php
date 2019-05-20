<?php

session_start();
require_once '../library/config.php';
require_once '../library/functions.php';
if ($_SESSION['user_type'] == 'cashier') {
    $connection = new createConnection();
    $connection->connectToDatabase();

    $query = "INSERT INTO tbl_stock( stock_no,invoice_no,added_by,added_date) VALUES ('" . $_REQUEST['stock_no'] . "','" . $_REQUEST['inv_no'] . "','" . $_SESSION['user_id'] . "','" . $_REQUEST['stock_date'] . "')";
    $result = mysqli_query($connection->myconn, $query) or die(mysqli_error());

    $query_max = "SELECT MAX(stock_id) AS stock_id FROM tbl_stock WHERE added_by ='" . $_SESSION['user_id'] . "'";
    $result_max = mysqli_query($connection->myconn, $query_max);
    $row_max = mysqli_fetch_assoc($result_max);
    $success_count = 0;
    if (isset($_REQUEST['row_count']) && $_REQUEST['row_count'] > 0) {
        for ($i = 1; $i <= $_REQUEST['row_count']; $i++) {
            if (isset($_REQUEST['qty_'.$i])) {
                $query_pro = "INSERT INTO tbl_stock_product (stock_id,pro_id,brand_id,price_id,qty,remain_qty) VALUES ('".$row_max['stock_id']."','".$_REQUEST['pro_id_'.$i]."','".$_REQUEST['brand_id_'.$i]."','".$_REQUEST['price_id_'.$i]."','".$_REQUEST['qty_'.$i]."','".$_REQUEST['qty_'.$i]."')";
                $result_pro = mysqli_query($connection->myconn,$query_pro) or die(mysqli_error());
                
                if($result_pro){
                   $success_count++; 
                }
            }
        }
    }
    if ($result && $success_count > 0) {
        $_SESSION['stock_add_msg'] = "successfully added";
    } else {
        $_SESSION['stock_add_msg'] = "successfully not added";
    }
    header('Location:stock.php');
    $connection->close();
} else {
    header('Location:../index.php');
}