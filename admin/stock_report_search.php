<?php
session_start();
require_once '../library/config.php';
require_once '../library/functions.php';
if ($_SESSION['user_type'] == 'admin') {
    $connection = new createConnection();
    $connection->connectToDatabase();
    $pro_id = "";
    $brand_id = "";
    if($_REQUEST['brand_id']!=""){
       $brand_id = "AND sp.brand_id = '".$_REQUEST['brand_id']."'"; 
    }
    if($_REQUEST['pro_id']!=""){
       $pro_id = "AND sp.pro_id = '".$_REQUEST['pro_id']."'"; 
    }
    $query = "SELECT 
        b.brand_name, p.product_code, p.product_name, pp.retailer_price, SUM(sp.remain_qty) AS qty
        FROM
        tbl_stock_product sp
        INNER JOIN 
        tbl_product p ON p.product_id = sp.pro_id 
        INNER JOIN 
        tbl_brand b ON b.brand_id = sp.brand_id
        INNER JOIN
        tbl_price pp ON pp.price_id = sp.price_id
        WHERE 
        sp.remain_qty != '0' $pro_id $brand_id
        GROUP BY sp.pro_id,sp.price_id 
        ORDER BY p.product_name";
    $result = mysqli_query($connection->myconn, $query);
    if (mysqli_num_rows($result) != 0) {
        ?><!-- DataTables -->
        <link rel="stylesheet" href="../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
        <div class="box-body" id="printexcel">
            <table id="daily_sales" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Brand Name</th>
                        <th>Product Code</th>
                        <th>Product Name</th>
                        <th>Retailer Price</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <td><?php echo $row['brand_name'] ?></td>
                            <td><?php echo $row['product_code'] ?></td>
                            <td><?php echo $row['product_name'] ?></td>
                            <td style="text-align: right;padding-right: 5px"><?php echo $row['retailer_price'] ?></td>
                            <td style="text-align: right;padding-right: 5px"><?php echo number_format($row['qty']); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    <?php } else { ?>
        <div style="text-align: center">
            <span style="color:red;text-align: center">No Records Found</span>
        </div>
        <?php
    }
    $connection->close();
} else {
    header('Location:../index.php');
}
?>
<!-- DataTables -->
<script src="../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script>
    $(function () {
        $('#daily_sales').DataTable({
            'paging': true,
            'lengthChange': false,
            'searching': false,
            'ordering': true,
            'info': true,
            'autoWidth': false
        })
    })
    </script>