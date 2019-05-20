<?php
session_start();
require_once '../library/config.php';
require_once '../library/functions.php';
if ($_SESSION['user_type'] == 'cashier') {
    $connection = new createConnection();
    $connection->connectToDatabase();
    ?>
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <title>SPARE PARTS MANAGEMENT SYSTEM</title>
            <!-- Tell the browser to be responsive to screen width -->
            <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
            <!-- Bootstrap 3.3.7 -->
            <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
            <!-- Font Awesome -->
            <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
            <!-- Ionicons -->
            <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
            <!-- Theme style -->
            <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
            <!-- AdminLTE Skins. Choose a skin from the css/skins
                 folder instead of downloading all of them to reduce the load. -->
            <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
            <!-- DataTables -->
            <link rel="stylesheet" href="../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
            <link rel="stylesheet" href="../css/jquery-ui.css.css">
            <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
            <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
            <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
            <![endif]-->

            <!-- Google Font -->
            <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
            <link rel="shortcut icon" type="image/png" href="../images/logo.png"/>
        </head>
        <!-- ADD THE CLASS fixed TO GET A FIXED HEADER AND SIDEBAR LAYOUT -->
        <!-- the fixed layout is not compatible with sidebar-mini -->
        <body class="hold-transition skin-blue fixed sidebar-mini">
            <!-- Site wrapper -->
            <div class="wrapper">

                <header class="main-header">
                    <!-- Logo -->
                    <a href="#" class="logo">
                        <!-- mini logo for sidebar mini 50x50 pixels -->
                        <span class="logo-mini"><b>GTM</b></span>
                        <!-- logo for regular state and mobile devices -->
                        <span class="logo-lg"><b>GT</b>Motors</span>
                    </a>
                    <!-- Header Navbar: style can be found in header.less -->
                    <nav class="navbar navbar-static-top">
                        <!-- Sidebar toggle button-->
                        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </a>

                        <div class="navbar-custom-menu">
                            <ul class="nav navbar-nav">
                                <!-- Messages: style can be found in dropdown.less-->
                                <li class="dropdown messages-menu">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-envelope-o"></i>
                                        <span class="label label-success"></span>
                                    </a>
                                </li>
                                <!-- Notifications: style can be found in dropdown.less -->
                                <li class="dropdown notifications-menu">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-bell-o"></i>
                                        <span class="label label-warning"></span>
                                    </a>
                                </li>
                                <!-- Tasks: style can be found in dropdown.less -->
                                <li class="dropdown tasks-menu">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-flag-o"></i>
                                        <span class="label label-danger"></span>
                                    </a>
                                </li>
                                <!-- User Account: style can be found in dropdown.less -->
                                <li class="dropdown user user-menu">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <img src="../dist/img/user.jpg" class="user-image" alt="User Image">
                                        <span class="hidden-xs"><?php echo $_SESSION['user_name'] ?></span>
                                    </a>
                                </li>
                                <!-- Control Sidebar Toggle Button -->
                                <li>
                                    <a href="./../logout.php"><i class="fa fa-sign-out"></i></a>
                                    <!--<a href="./../logout.php" class="btn btn-default btn-flat">Sign out</a>-->
                                </li>
                            </ul>
                        </div>
                    </nav>
                </header>

                <!-- =============================================== -->

                <?php include_once '../menu/cashier_menu.php' ?>

                <!-- =============================================== -->

                <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper">
                    <!-- Content Header (Page header) -->
                    <section class="content-header">
                        <h1>
                            PURCHASE ORDER
                            <small>Edit</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                            <li><a href="#">Purchase Order</a></li>
                            <li class="active">Edit</li>
                        </ol>
                    </section>
                    <div class="col-md-2 col-md-offset-5" style="color: red">
                        <?php
                        if (isset($_SESSION['po_update_msg'])) {
                            echo $_SESSION['po_update_msg'];
                        }
                        ?>
                    </div>
                    <section class="content">
                        <form action="update_purchase_order.php" type="post">
                            <input type="hidden" id="po_id" name="po_id" value="<?php echo $_REQUEST['po_id']; ?>"
                            <div class="row">
                                <div class="col-md-10 col-md-offset-1">
                                    <div class="box box-primary">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">Purchase Order Information</h3>
                                        </div>
                                        <!-- /.box-header -->
                                        <!-- form start -->
                                        <!--<form role="form">-->
                                        <div class="box-body">
                                            <?php
                                            $query_po = "SELECT po.po_no,po.added_date,po.sup_id,s.sup_name FROM tbl_purchase_order po INNER JOIN tbl_supplier s  WHERE po.po_id = '" . $_REQUEST['po_id'] . "'";
                                            $result_po = mysqli_query($connection->myconn, $query_po);
                                            $row_po = mysqli_fetch_assoc($result_po);
                                            ?>
                                            <div class="row">
                                                <div class="col-md-2">
                                                </div>
                                                <!-- ./col -->
                                                <div class="col-md-8">
                                                    <div class="box box-solid">
                                                        <div class="box-header with-border">
                                                            <div class="form-group">
                                                                <label for="po_no" class="control-label col-xs-2">PO No.</label>
                                                                <div class="col-xs-10">
                                                                    <input type="text" class="form-control" id="po_no" name="po_no" value="<?php echo $row_po['po_no']; ?>" required size="25" readonly="true">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="stock_no" class="control-label col-xs-2">Date</label>
                                                                <div class="col-xs-10">
                                                                    <input type="text" class="form-control" id="po_date" name="po_date" value="<?php echo $row_po['added_date']; ?>" readonly="true">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="sup" class="control-label col-xs-2">Supplier.</label>
                                                                <div class="col-xs-10">
                                                                    <input type="text" class="form-control" value="<?php echo $row_po['sup_name']; ?>" readonly="true" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- /.box-header -->
                                                        <div class="box-body">
                                                        </div>
                                                        <!-- /.box-body -->
                                                    </div>
                                                    <!-- /.box -->
                                                </div>
                                                <!-- ./col -->
                                                <div class="col-md-2">
                                                </div>
                                                <!-- ./col -->
                                            </div>
                                            <?php
                                            $query_pro = "SELECT
                                                p.product_id, 
                                                p.product_name, 
                                                b.brand_id,
                                                b.brand_name,
                                                pp.price_id,
                                                pod.qty,
                                                pp.dealer_price
                                            FROM 
                                                tbl_purchase_order po 
                                                INNER JOIN 
                                                tbl_purchase_order_details pod ON pod.po_id = po.po_id 
                                                INNER JOIN 
                                                tbl_product p ON p.product_id = pod.pro_id
                                                INNER JOIN 
                                                tbl_price pp ON pp.price_id = pod.price_id 
                                                INNER JOIN 
                                                tbl_brand b ON b.brand_id = pod.brand_id
                                            WHERE 
                                            po.po_id = '" . $_REQUEST['po_id'] . "' AND po.po_status='0' AND pod.pod_status='0'";
                                            $result_pro = mysqli_query($connection->myconn, $query_pro);
                                            ?>
                                            <table id="stock" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th style="text-align: center"></th>
                                                        <th style="text-align: center">Product Name</th>
                                                        <th style="text-align: center">Brand Name</th>
                                                        <th style="text-align: center">Dealer Price</th>
                                                        <th style="text-align: center">Qty</th>
                                                        <th style="text-align: center">Value</th>
                                                        <th style="text-align: center"></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="stock">
                                                    <?php
                                                    $count = 0;
                                                    $total_amt = 0;
                                                    while ($row_pro = mysqli_fetch_assoc($result_pro)) {
                                                        $total_amt += $row_pro['qty'] * $row_pro['dealer_price'];
                                                        $count++;
                                                        ?>
                                                        <tr id="tr_<?php echo $count; ?>">
                                                            <td><a onclick="add_row();" style="cursor: pointer"><i class="fa fa-plus"></i></a></td>
                                                            <td>
                                                                <input type="text" name="pro_name_<?php echo $count; ?>" id="pro_name_<?php echo $count; ?>" value="<?php echo $row_pro['product_name']; ?>" onkeyup="get_brand('1')" required="required" />
                                                                <input type="hidden" name="pro_id_<?php echo $count; ?>" id="pro_id_<?php echo $count; ?>" value="<?php echo $row_pro['product_id']; ?>" />
                                                            </td>
                                                            <td>
                                                                <select id="brand_id_<?php echo $count; ?>" name="brand_id_<?php echo $count; ?>" onclick="get_price('<?php echo $count; ?>')">
                                                                    <option>Select Brand</option>
                                                                    <?php dataFunctions::edit_brand($connection->myconn, $row_pro['brand_id']); ?>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <select id="price_id_<?php echo $count; ?>" name="price_id_<?php echo $count; ?>" onclick="select_price('<?php echo $count; ?>')">
                                                                    <option>Select Price</option>
                                                                    <?php dataFunctions::edit_price($connection->myconn, $row_pro['price_id']) ?>
                                                                </select>
                                                                <input type="hidden" id="price_<?php echo $count; ?>" name="price_<?php echo $count; ?>" value="<?php echo $row_pro['dealer_price']; ?>" />
                                                            </td>
                                                            <td>
                                                                <input type="text" style="text-align: right;padding-right: 3px" id="qty_<?php echo $count; ?>" name="qty_<?php echo $count; ?>" value="<?php echo $row_pro['qty']; ?>" onkeyup="calc_total('<?php echo $count; ?>')" />
                                                                <input type="hidden" id="old_qty_<?php echo $count; ?>" name="old_qty_<?php echo $count; ?>" value=""
                                                            </td>
                                                            <td>
                                                                <input type="text" style="text-align: right;padding-right: 3px" id="value_<?php echo $count; ?>" name="value_<?php echo $count; ?>" value="<?php echo $row_pro['qty'] * $row_pro['dealer_price']; ?>" />
                                                            </td>
                                                            <td><a onclick="remove_row('<?php echo $count; ?>');" style="cursor: pointer"><i class="fa fa-minus"></i></a></td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="6" style="text-align: right;padding-right: 25px">
                                                            Total Amount : <input type="text" style="text-align: right;padding-right: 3px" id="tot_amt" name="tot_amt" value="<?php echo $total_amt; ?>" />
                                                        </td>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                </tfoot>
                                                <input type="hidden" id="row_count" name="row_count" value="<?php echo $count; ?>" />
                                                <input type="hidden" id="delete_count" name="delete_count" value="<?php echo $count; ?>" />
                                            </table>

                                        </div>
                                        <!-- /.box-body -->
                                        <div class="box-footer">
                                            <!--<button type="submit" class="btn btn-default">Cancel</button>-->
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                        <div class="box-footer">
                                        </div>
                                        <!--</form>-->
                                    </div>
                                </div>
                            </div>
                        </form>
                    </section>
                </div>
                <!-- /.content-wrapper -->

                <footer class="main-footer">
                    <div class="pull-right hidden-xs">

                    </div>
                </footer>

                <!-- Control Sidebar -->

                <!-- /.control-sidebar -->
                <!-- Add the sidebar's background. This div must be placed
                     immediately after the control sidebar -->
                <div class="control-sidebar-bg"></div>
            </div>
            <!-- ./wrapper -->

            <!-- jQuery 3 -->
            <script src="../bower_components/jquery/dist/jquery.min.js"></script>
            <!-- Bootstrap 3.3.7 -->
            <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
            <!-- SlimScroll -->
            <script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
            <!-- FastClick -->
            <script src="../bower_components/fastclick/lib/fastclick.js"></script>
            <!-- AdminLTE App -->
            <script src="../dist/js/adminlte.min.js"></script>
            <!-- AdminLTE for demo purposes -->
            <script src="../dist/js/demo.js"></script>
            <!-- DataTables -->
            <script src="../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
            <script src="../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
            <script src="../js/jquery-ui.js.js"></script>
            <script>
                                                            function get_brand(num) {
                                                                $("#pro_name_" + num).autocomplete({
                                                                    source: 'get_products.php',
                                                                    minLength: 2,
                                                                    select: function (event, ui) {
                                                                        $("#pro_name_" + num).val(ui.item.label);
                                                                        $("#pro_id_" + num).val(ui.item.id);
                                                                        get_products(num, ui.item.id);
                                                                    }
                                                                });
                                                            }
                                                            function get_products(num, pro_id) {
                                                                $.ajax({
                                                                    url: 'get_brands.php',
                                                                    type: 'POST',
                                                                    data: {
                                                                        'pro_id': pro_id
                                                                    },
                                                                    success: function (data) {
    //                                                                            console.log(data);
                                                                        $('#brand_id_' + num).empty();
                                                                        var arr = JSON.parse(data);
                                                                        $('#brand_id_' + num).append('<option value="">Select Brand</option>');
                                                                        for (var i = 0; i <= arr.length; i++) {
                                                                            $('#brand_id_' + num).append('<option value=' + arr[i].brnd_id + '>' + arr[i].brnd_name + '</option>');
                                                                        }
                                                                    }
                                                                });
                                                            }

                                                            function get_price(num) {
                                                                $.ajax({
                                                                    url: 'get_latest_prices.php',
                                                                    type: 'POST',
                                                                    data: {
                                                                        'pro_id': $('#pro_id_' + num).val(),
                                                                        'brand_id': $('#brand_id_' + num).val()
                                                                    },
                                                                    success: function (data) {
                                                                        var arr = JSON.parse(data);
                                                                        $('#price_id_' + num).empty();
                                                                        $('#price_id_' + num).append('<option value="">Select Price</option>');
                                                                        for (var i = 0; i <= arr.length; i++) {
                                                                            $('#price_id_' + num).append('<option value=' + arr[i].price_id + '>' + arr[i].dealer_price + '</option>');
                                                                        }
                                                                    }
                                                                });
                                                            }
                                                            function select_price(num) {
                                                                var x = document.getElementById("price_id_" + num).selectedIndex;
                                                                var y = document.getElementById("price_id_" + num).options;
                                                                $('#price_' + num).val(y[x].text);
                                                                calc_total(num);
                                                            }
                                                            function calc_total(num) {
                                                                var line_qty = $('#qty_' + num).val();
                                                                var line_price = parseFloat($('#price_' + num).val());
                                                                var amount = parseFloat(line_qty * line_price);
                                                                var old_amt = parseFloat($('#tot_amt').val());
                                                                $('#value_' + num).val(amount);

                                                                var tot_amount = 0;
                                                                for (var x = 1; x <= $('#row_count').val(); x++) {
                                                                    console.log($('#qty_' + x).val() + ' -- ' + parseFloat($('#price_' + x).val()));
                                                                    tot_amount += $('#qty_' + x).val() * parseFloat($('#price_' + x).val());
                                                                }
                                                                if (isNaN(tot_amount)) {
                                                                    tot_amount = 0;
                                                                }
                                                                $('#tot_amt').val(tot_amount);
                                                            }
                                                            function add_row() {
                                                                var num = parseInt($('#row_count').val()) + 1;
                                                                var del_num = parseInt($('#delete_count').val()) + 1;
                                                                $('#row_count').val(num);
                                                                $('#delete_count').val(del_num);
                                                                $('#stock').append('<tr id=tr_' + num + '>'
                                                                        + '<td><a onclick="add_row();"><i class="fa fa-plus"></i></a></td>'
                                                                        + '<td>'
                                                                        + '<input type="text" name="pro_name_' + num + '" id="pro_name_' + num + '" onkeyup="get_brand(' + num + ')" />'
                                                                        + '<input type="hidden" name="pro_id_' + num + '" id="pro_id_' + num + '" value="" />'
                                                                        + '</td>'
                                                                        + '<td>'
                                                                        + '<select id="brand_id_' + num + '" name="brand_id_' + num + '" onclick="get_price(' + num + ')">'
                                                                        + '<option>Select Brand</option>'
                                                                        + '</select>'
                                                                        + '</td>'
                                                                        + '<td>'
                                                                        + '<select id="price_id_' + num + '" name="price_id_' + num + '" onclick="select_price(' + num + ')">'
                                                                        + '<option>Select Price</option>'
                                                                        + '</select>'
                                                                        + '<input type="hidden" id="price_' + num + '" name="price_' + num + '" value="" />'
                                                                        + '</td>'
                                                                        + '<td>'
                                                                        + '<input type="text"style="text-align: right;padding-right: 3px"  id="qty_' + num + '" name="qty_' + num + '" onkeyup="calc_total(' + num + ')" />'
                                                                        + '</td>'
                                                                        + '<td>'
                                                                        + '<input type="text" style="text-align: right;padding-right: 3px" id="value_' + num + '" name="value_' + num + '" />'
                                                                        + '</td>'
                                                                        + '<td><a onclick="remove_row(' + num + ');" style="cursor: pointer"><i class="fa fa-minus"></i></a></td>'
                                                                        );
                                                            }
                                                            function remove_row(num) {
                                                                $('#tr_' + num).remove();
                                                                var count = parseInt($('#delete_count').val()) - 1;
                                                                if (count == 0) {
                                                                    add_row();
                                                                    $('#delete_count').val(1);
                                                                } else {
                                                                    $('#delete_count').val(count);
                                                                }
                                                                calc_total(num);
                                                            }

            </script>
        </body>
    </html>
    ?>
    <?php
    $connection->close();
    unset($_SESSION['po_add_msg']);
} else {
    header('Location:../index.php');
}
