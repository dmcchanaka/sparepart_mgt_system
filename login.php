<?php

session_start();
require_once './library/config.php';
require_once './library/functions.php';
$connection = new createConnection();
$connection->connectToDatabase();

//$query = "SELECT * FROM tbl_user WHERE u_status = '0'";
//$result = mysqli_query($connection->myconn, $query);
//while ($row = mysqli_fetch_assoc($result)){
//    echo $row['u_name'];
//}
$user_info = array();
$user_info = dataFunctions::CheckUser($_POST['user_name'], $_POST['password'], $connection->myconn);
$_SESSION['user_id'] = $user_info['u_id'];
$_SESSION['user_name'] = $user_info['u_name'];
$_SESSION['user_type'] = $user_info['u_type'];
if ($_SESSION['user_id'] != 0) {
    echo $user_info["u_type"];
    if ($user_info["u_type"] == "admin") {
        header('Location:admin/index.php');
    }elseif ($user_info["u_type"] == "cashier") {
        header('Location:cashier/index.php');
    }
} else {
    header('Location:index.php');
    $_SESSION['log_error_mes'] = "Username or password you have entered is incorrect";
}