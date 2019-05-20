<?php
session_start();
require_once '../library/config.php';
require_once '../library/functions.php';
if ($_SESSION['user_type'] == 'admin') {
    $connection = new createConnection();
    $connection->connectToDatabase();

    $query = "SELECT p.product_name,
                b.brand_name,
                pp.retailer_price,
                SUM(ip.qty) AS qty,
                SUM(ip.qty * pp.retailer_price) AS amount
         FROM tbl_invoice i
         INNER JOIN tbl_invoice_product ip ON ip.invoice_id = i.invoice_id
         INNER JOIN tbl_product p ON p.product_id = ip.pro_id
         INNER JOIN tbl_price pp ON pp.product_id = p.product_id
         INNER JOIN tbl_brand b ON b.brand_id = pp.brand_id
         WHERE i.invoice_status = '0'
         GROUP BY ip.pro_id
         ORDER BY ip.pro_id";
    $result = mysqli_query($connection->myconn, $query);
    if (mysqli_num_rows($result) != 0) {
        ?>
        <!-- DataTables -->
        <link rel="stylesheet" href="../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
        <div style="text-align: center"><i class="fa fa-file-excel-o text-blue" style="cursor: pointer;font-size: 18px" onclick="printexcel('printexcel')"></i>Export to Excel</div>
        <div class="box-body" id="printexcel">
            <div class="row" style="display: none">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-sm-12 col-form-label">DAILY SALES DETAILS</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-1"></div>
            </div><br/>
            <table id="daily_sales" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Brand Name</th>
                        <th>Product Name</th>
                        <th>Retailer Price</th>
                        <th>Quantity</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total_amt = 0;
                    $total_qty = 0;
                    while ($row = mysqli_fetch_assoc($result)) {
                        $total_amt += $row['amount'];
                        $total_qty += $row['qty'];
                        ?>
                        <tr>
                            <td><?php echo $row['brand_name'] ?></td>
                            <td><?php echo $row['product_name'] ?></td>
                            <td><?php echo $row['retailer_price'] ?></td>
                            <td style="text-align: right;padding-right: 5px"><?php echo number_format($row['qty']); ?></td>
                            <td style="text-align: right;padding-right: 5px"><?php echo number_format($row['amount'], 2) ?></td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td><b>Total</b></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td style="text-align: right;padding-right: 5px"><b><?php echo number_format($total_qty); ?></b></td>
                        <td style="text-align: right;padding-right: 5px"><b><?php echo number_format($total_amt, 2); ?></b></td>
                    </tr>
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