<?php

session_start();
require_once '../library/config.php';
require_once '../library/functions.php';
if ($_SESSION['user_type'] == 'cashier') {
    $connection = new createConnection();
    $connection->connectToDatabase();

    $all_query = true;
    mysqli_query($connection->myconn, "SET AUTOCOMMIT=0");
    mysqli_query($connection->myconn, "START TRANSACTION");

    echo '<pre>';
    print_r($_REQUEST);
    echo '</pre>';

    $query_inv = "INSERT INTO  tbl_invoice(invoice_no,cus_id,added_by,invoice_date,invoice_time,invoice_amount) VALUES ('" . $_REQUEST['inv_no'] . "','" . $_REQUEST['cus_id'] . "','" . $_SESSION['user_id'] . "','" . $_REQUEST['stock_date'] . "','" . date('H:i:s') . "','" . $_REQUEST['tot_amt'] . "')";
    mysqli_query($connection->myconn, $query_inv) ? null : $all_query = false;

    $query_max = "SELECT MAX(invoice_id) AS invoice_id FROM tbl_invoice WHERE added_by ='" . $_SESSION['user_id'] . "'";
    $result_max = mysqli_query($connection->myconn, $query_max);
    $row_max = mysqli_fetch_assoc($result_max);

    if (isset($_REQUEST['row_count']) && $_REQUEST['row_count'] > 0) {
        for ($i = 1; $i <= $_REQUEST['row_count']; $i++) {
            if (isset($_REQUEST['qty_' . $i])) {
                $invoice_qty = $_REQUEST['qty_' . $i];

                $discount = 0;
                $dis_per = 0;
                if ($_REQUEST['discount_' . $i] == '' || $_REQUEST['discount_' . $i] == '0') {
                    $dis_per = 0;
                } else {
                    $dis_per = $_REQUEST['discount_' . $i];
                }
                $discount = (($invoice_qty * $_REQUEST['price_' . $i]) * $dis_per) / 100;
                $amount = $_REQUEST['qty_' . $i] * $_REQUEST['price_' . $i];

//                //update stock
                $query_stock = "SELECT 
                    sp.stp_id AS stock_id,
                    sp.remain_qty AS stock 
                    FROM 
                    tbl_stock_product sp 
                WHERE 
                    sp.pro_id = '" . $_REQUEST['pro_id_' . $i] . "'
                    AND sp.brand_id = '" . $_REQUEST['brand_id_' . $i] . "'
                    AND sp.price_id = '" . $_REQUEST['price_id_' . $i] . "'
                    AND sp.remain_qty != '0'
                GROUP BY sp.stp_id";
                $result_stock = mysqli_query($connection->myconn, $query_stock);
                while ($row_stock = mysqli_fetch_assoc($result_stock)) {
                    $remaining_qty = $row_stock['stock'];
                    if ($remaining_qty >= $invoice_qty && $invoice_qty > 0) {

                        $query_inv_pro = "INSERT INTO tbl_invoice_product (invoice_id,pro_id,brand_id,price_id,qty,dis_per,dis_amount,amount) VALUES ('" . $row_max['invoice_id'] . "','" . $_REQUEST['pro_id_' . $i] . "','" . $_REQUEST['brand_id_' . $i] . "','" . $_REQUEST['price_id_' . $i] . "','" . $invoice_qty . "','" . $_REQUEST['discount_' . $i] . "','$discount','$amount')";
                        mysqli_query($connection->myconn, $query_inv_pro) ? null : $all_query = false;

                        $query_up = "UPDATE tbl_stock_product SET remain_qty=remain_qty-{$_REQUEST['qty_' . $i]} WHERE stp_id='" . $row_stock['stock_id'] . "'";
                        mysqli_query($connection->myconn, $query_up) ? null : $all_query = false;
                        $invoice_qty = 0;
                    } elseif ($remaining_qty < $invoice_qty) {
                        $query_inv_pro = "INSERT INTO tbl_invoice_product (invoice_id,pro_id,brand_id,price_id,qty,dis_per,dis_amount,amount) VALUES ('" . $row_max['invoice_id'] . "','" . $_REQUEST['pro_id_' . $i] . "','" . $_REQUEST['brand_id_' . $i] . "','" . $_REQUEST['price_id_' . $i] . "','" . $invoice_qty . "','" . $_REQUEST['discount_' . $i] . "','$discount','$amount')";
                        mysqli_query($connection->myconn, $query_inv_pro) ? null : $all_query = false;

                        $query_up = "UPDATE tbl_stock_product SET remain_qty='0' WHERE stp_id='" . $row_stock['stock_id'] . "'";
                        mysqli_query($connection->myconn, $query_up) ? null : $all_query = false;
                        $invoice_qty -= $remaining_qty;
                    }
                }
            }
        }
    }
    $payments = "INSERT INTO tbl_payment (invoice_id,cus_id,pay_type,payment_date,added_by) VALUES ('" . $row_max['invoice_id'] . "','" . $_REQUEST['cus_id'] . "','" . $_REQUEST['payment_type'] . "','" . $_REQUEST['stock_date'] . "','" . $_SESSION['user_id'] . "')";
    mysqli_query($connection->myconn, $payments) or die(mysqli_error()) ? null : $all_query = false;

    $query_pay_max = "SELECT MAX(pay_id) AS pay_id FROM tbl_payment WHERE added_by ='" . $_SESSION['user_id'] . "'";
    $result_pay_max = mysqli_query($connection->myconn, $query_pay_max);
    $row_pay_max = mysqli_fetch_assoc($result_pay_max);

    if ($_REQUEST['payment_type'] == "1") {
        $query_cash = "INSERT INTO tbl_payment_details (pay_id,amount) VALUES ('" . $row_pay_max['pay_id'] . "','" . $_REQUEST['cash_amt'] . "')";
        mysqli_query($connection->myconn, $query_cash) ? null : $all_query = false;
    } elseif ($_REQUEST['payment_type'] == "2") {
        $query_chq = "INSERT INTO tbl_payment_details (pay_id,amount,cheque_no,bank,cheque_date) VALUES ('" . $row_pay_max['pay_id'] . "','" . $_REQUEST['chq_amt'] . "','" . $_REQUEST['chq_no'] . "','" . $_REQUEST['bank'] . "','" . $_REQUEST['chq_date'] . "')";
        mysqli_query($connection->myconn, $query_chq) ? null : $all_query = false;
    }

    if ($all_query) {
         mysqli_query($connection->myconn,"COMMIT");
         $_SESSION['invoice_add_msg'] = "successfully added";
    }else{
        mysqli_query($connection->myconn,"ROLLBACK");
        $_SESSION['invoice_add_msg'] = "successfully not added";
    }
    header('Location:invoice.php');
    $connection->close();
} else {
    header('Location:../index.php');
}

