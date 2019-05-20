<?php
session_start();
require_once '../library/config.php';
require_once '../library/functions.php';
if ($_SESSION['user_type'] == 'admin') {
    $connection = new createConnection();
    $connection->connectToDatabase();

    $cus_name = "";
    $date = "";
    $invoice = "";
    if ($_REQUEST['cus_id'] != "") {
        $cus_name = "AND c.cus_name LIKE '%" . $_REQUEST['cus_id'] . "%'";
    }
    if ($_REQUEST['inv_no'] != "") {
        $invoice = "AND i.invoice_no LIKE '%" . $_REQUEST['inv_no'] . "%'";
    }
    if ($_REQUEST['fdate'] != "" && $_REQUEST['tdate'] != "") {
        $date = "AND i.invoice_date BETWEEN '" . $_REQUEST['fdate'] . "' AND '" . $_REQUEST['tdate'] . "'";
    }
    $query = "SELECT 
            i.invoice_id,
            i.invoice_no,
            i.invoice_amount,
            i.invoice_date,
            i.invoice_time,
            c.cus_name,
            if(p.pay_type = 1,'Cash','Cheque') AS pay_type,
            i.invoice_status
            FROM 
            tbl_invoice i 
            INNER JOIN 
            tbl_invoice_product ip ON ip.invoice_id = i.invoice_id
            INNER JOIN 
            tbl_customer c ON c.cus_id = i.cus_id 
            INNER JOIN 
            tbl_payment p ON p.invoice_id = i.invoice_id
            WHERE 
            i.invoice_status = '0' $cus_name $invoice $date
            ORDER BY i.invoice_id DESC";
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
                                <label class="col-sm-12 col-form-label">DAILY SALES SUMMARY</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-1"></div>
            </div><br/>
            <table id="daily_sales" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Customer</th>
                        <th>Invoice No</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Payment Type</th>
                        <th>Invoice Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total = 0;
                    while ($row = mysqli_fetch_assoc($result)) {
                        $total += $row['invoice_amount'];
                        ?>
                        <tr>
                            <td><?php echo $row['cus_name'] ?></td>
                            <td><?php echo $row['invoice_no'] ?></td>
                            <td><?php echo $row['invoice_date'] ?></td>
                            <td><?php echo $row['invoice_time'] ?></td>
                            <td><?php echo $row['pay_type'] ?></td>
                            <td style="text-align: right;padding-right: 5px"><?php echo number_format($row['invoice_amount'], 2) ?></td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td colspan="5"><b>Total</b></td>
                        <td style="text-align: right;padding-right: 5px"><b><?php echo number_format($total, 2); ?></b></td>
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

    function printexcel() {
        //creating a temporary HTML link element (they support setting file names)
        var a = document.createElement('a');
        //getting data from our div that contains the HTML table
        var data_type = 'data:application/vnd.ms-excel';
        var table_div = document.getElementById('printexcel');
        var table_html = table_div.outerHTML.replace(/ /g, '%20');
        a.href = data_type + ', ' + table_html;
        //setting the file name
        a.download = 'Daily Sales Summary' + '.xls';
        //triggering the function
        a.click();
        //just in case, prevent default behaviour
        e.preventDefault();
    }
</script>

