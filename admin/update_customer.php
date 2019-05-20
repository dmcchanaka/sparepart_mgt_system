<?php

session_start();
require_once '../library/config.php';
require_once '../library/functions.php';
if ($_SESSION['user_type'] == 'admin') {
    $connection = new createConnection();
    $connection->connectToDatabase();

    $query = "UPDATE tbl_customer SET cus_name = '".$_REQUEST['name']."',email = '".$_REQUEST['email']."',telephone = '".$_REQUEST['telephone']."',address = '".$_REQUEST['address']."' WHERE cus_id ='".$_REQUEST['cus_id']."'";
    $result = mysqli_query($connection->myconn, $query);
    if ($result) {
        $_SESSION['cus_update_msg'] = "successfully edited";
    } else {
        $_SESSION['cus_update_msg'] = "successfully not edited";
    }
    header('Location:customer_veiw.php');
    $connection->close();
} else {
    header('Location:../index.php');
}

