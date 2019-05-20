<?php
session_start();
require_once '../library/config.php';
require_once '../library/functions.php';
if ($_SESSION['user_type'] == 'cashier') {
    $connection = new createConnection();
    $connection->connectToDatabase();
    
    $all_query = true;
    mysqli_query("SET AUTOCOMMIT=0");
    mysqli_query("START TRANSACTION");
    
//    $ck_po_query = "SELECT * FROM tbl_purchase_order WHERE po.po_status = '0' AND po.po_id = '".$_REQUEST['po_id']."'";
//    $ck_po_result = mysqli_query($connection->myconn, $ck_po_query);
//    $ck_po_row = mysqli_fetch_assoc($ck_po_result);
    
    $query_po_details = "UPDATE tbl_purchase_order_details SET pod_status = '1' WHERE pod_status = '0' AND po_id ='".$_REQUEST['po_id']."'";
    mysqli_query($connection->myconn,$query_po_details) ? null : $all_query = false;
    
    if(isset($_REQUEST['row_count']) && $_REQUEST['row_count'] > 0){
        for($i = 1; $i <= $_REQUEST['row_count']; $i++){
            if(isset($_REQUEST['pro_id_'.$i]) && isset($_REQUEST['qty_'.$i])){
                $query_pro = "INSERT INTO tbl_purchase_order_details (po_id,pro_id,brand_id,price_id,qty) VALUES ('".$_REQUEST['po_id']."','".$_REQUEST['pro_id_'.$i]."','".$_REQUEST['brand_id_'.$i]."','".$_REQUEST['price_id_'.$i]."','".$_REQUEST['qty_'.$i]."')";
                mysqli_query($connection->myconn,$query_pro) ? null : $all_query = false;
            }
        }
    }
    if ($all_query) {
         mysqli_query("COMMIT");
         $_SESSION['po_add_msg'] = "successfully added";
    }else{
        mysqli_query("ROLLBACK");
        $_SESSION['po_add_msg'] = "successfully not added";
    }
    header('Location:view_purchase_order.php');
    $connection->close();
}else {
    header('Location:../index.php');
}

