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
                    <a href="../../index2.html" class="logo">
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
                            INVOICE
                            <small>Registration</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                            <li><a href="#">Invoice</a></li>
                            <li class="active">Add</li>
                        </ol>
                    </section>
                    <div class="col-md-2 col-md-offset-5" style="color: red">
                        <?php
                        if (isset($_SESSION['invoice_add_msg'])) {
                            echo $_SESSION['invoice_add_msg'];
                        }
                        ?>
                    </div>
                    <section class="content">
                        <form action="add_invoice.php" type="post" name="invoice_form" id="invoice_form" onsubmit="return stock_validation();">
                            <div class="row">
                                <div class="col-md-10 col-md-offset-1">
                                    <div class="box box-primary">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">Invoice Information</h3>
                                        </div>
                                        <!-- /.box-header -->
                                        <!-- form start -->
                                        <!--<form role="form">-->
                                        <div class="box-body">
                                            <?php
                                            $query_sn = "SELECT COUNT(invoice_id) as count FROM tbl_invoice";
                                            $result_sn = mysqli_query($connection->myconn, $query_sn);
                                            $row_sn = mysqli_fetch_assoc($result_sn);
                                            $inv_no = "";
                                            if ($row_sn['count'] == "") {
                                                $inv_no = "GTM/INV/1";
                                            } else {
                                                $inv_no = "GTM/INV/" . ((int) $row_sn['count'] + 1);
                                            }
                                            ?>
                                            <div class="row">
                                                <div class="col-md-2">
                                                </div>
                                                <!-- ./col -->
                                                <div class="col-md-8">
                                                    <div class="box box-solid">
                                                        <div class="box-header with-border">
                                                            <div class="form-group">
                                                                <label for="stock_no" class="control-label col-xs-2">Inv No.</label>
                                                                <div class="col-xs-10">
                                                                    <input type="text" class="form-control" id="inv_no" name="inv_no" value="<?php echo $inv_no; ?>" required size="25">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="stock_no" class="control-label col-xs-2">Date</label>
                                                                <div class="col-xs-10">
                                                                    <input type="text" class="form-control" id="stock_date" name="stock_date" value="<?php echo date('Y-m-d'); ?>" required>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="stock_no" class="control-label col-xs-2">Customer.</label>
                                                                <div class="col-xs-10">
                                                                    <input type="text" id="cus_name" required="required" class="form-control" onkeyup="load_customers();">
                                                                    <input type="hidden" class="form-control" id="cus_id" name="cus_id" value="">
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

                                            <table id="stock" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th style="text-align: center"></th>
                                                        <th style="text-align: center">Product Name</th>
                                                        <th style="text-align: center">Brand Name</th>
                                                        <th style="text-align: center">Retailer Price</th>
                                                        <th style="text-align: center">Stock</th>
                                                        <th style="text-align: center">Qty.</th>
                                                        <th style="text-align: center">Dis. (%)</th>
                                                        <th style="text-align: center">Value</th>
                                                        <th style="text-align: center"></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="stock">
                                                    <tr id="tr_1">
                                                        <td style="text-align: center"><a onclick="add_row();" style="cursor: pointer"><i class="fa fa-plus"></i></a></td>
                                                        <td style="text-align: center">
                                                            <input type="text" name="pro_name_1" id="pro_name_1" onkeyup="get_brand('1')" />
                                                            <input type="hidden" name="pro_id_1" id="pro_id_1" value="" />
                                                        </td>
                                                        <td style="text-align: center">
                                                            <select id="brand_id_1" name="brand_id_1" onclick="get_price('1')">
                                                                <option>Select Brand</option>
                                                            </select>
                                                        </td>
                                                        <td style="text-align: center">
                                                            <select id="price_id_1" name="price_id_1" onclick="select_price('1')">
                                                                <option>Select Price</option>
                                                            </select>
                                                            <input type="hidden" id="price_1" name="price_1" value="" />
                                                        </td>
                                                        <td style="text-align: center">
                                                            <input type="text" style="text-align: right;padding-right: 3px" id="stock_1" name="stock_1" size="5" readonly="true" />
                                                        </td>
                                                        <td style="text-align: center">
                                                            <input type="text" style="text-align: right;padding-right: 3px" id="qty_1" name="qty_1" size="5" onkeyup="check_qty('1')" />
                                                        </td>
                                                        <td style="text-align: center">
                                                            <input type="text" style="text-align: right;padding-right: 3px" id="discount_1" name="discount_1" size="5" onkeyup="check_qty('1')" />
                                                        </td>
                                                        <td style="text-align: center">
                                                            <input type="text" style="text-align: right;padding-right: 3px" id="value_1" name="value_1" size="15" readonly="true" />
                                                        </td>
                                                        <td style="text-align: center"><a onclick="remove_row('1');" style="cursor: pointer"><i class="fa fa-minus"></i></a></td>
                                                    </tr>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td colspan="2" style="text-align: right"> Total Amount : </td>

                                                        <td style="text-align: center">
                                                            <input type="text" style="text-align: right;padding-right: 3px" id="tot_amt" name="tot_amt" value="" size="15" readonly="true" />
                                                        </td>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                </tfoot>
                                                <input type="hidden" id="row_count" name="row_count" value="1" />
                                                <input type="hidden" id="delete_count" name="delete_count" value="1" />
                                            </table><br/>

                                            <div class="row">
                                                <div class="col-md-3">
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="box box-solid">
                                                        <div class="box-header with-border">
                                                            <div class="form-group">
                                                                <label for="stock_no" class="control-label col-xs-4">Payment Type</label>
                                                                <div class="col-xs-8">
                                                                    <select id="payment_type" name="payment_type" onchange="select_pay_type()">
                                                                        <option value="0">Select Payment Type</option>
                                                                        <option value="1">cash</option>
                                                                        <option value="2">cheque</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                </div>
                                            </div>

                                            <div class="row" id="cash_div" style="display:none">
                                                <div class="col-md-4">
                                                    <!-- /.box -->
                                                </div>
                                                <!-- /.col -->
                                                <div class="col-md-4">
                                                    <div class="box">
                                                        <div class="box-header with-border" style="background-color: #d2d6de">
                                                            <h3 class="box-title">Cash Transaction</h3>
                                                        </div>
                                                        <!-- /.box-header -->
                                                        <div class="box-body" style="text-align: center">
                                                            <input type="text" id="cash_amt" name="cash_amt" value="" style="text-align: right;padding-right: 3px" onkeyup="check_cash_amt();" />
                                                        </div>
                                                    </div>
                                                    <!-- /.box -->
                                                </div>
                                                <!-- /.col -->
                                                <div class="col-md-3">
                                                </div>
                                            </div>

                                            <div class="row" id="cheque_div" style="display:none">
                                                <div class="col-md-2">
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="box-widget">
                                                        <div class="box-header with-border" style="background-color: #d2d6de">
                                                            <h3 class="box-title">Cheque Transaction</h3>
                                                        </div>
                                                        <!-- /.box-header -->
                                                        <div class="box-body" style="text-align: center">
                                                            <table class="table table-bordered table-striped">
                                                                <tr>
                                                                    <th style="text-align: center">Cheque No.</th>
                                                                    <th style="text-align: center">Bank</th>
                                                                    <th style="text-align: center">Amount</th>
                                                                    <th style="text-align: center">Date</th>
                                                                </tr>
                                                                <tr>
                                                                    <td style="text-align: center">
                                                                        <input type="text" id="chq_no" name="chq_no" value="" size="10" maxlength="6" />
                                                                    </td>
                                                                    <td style="text-align: center">
                                                                        <input type="text" id="bank" name="bank" value="" size="8" />
                                                                    </td>
                                                                    <td style="text-align: center">
                                                                        <input type="text" id="chq_amt" name="chq_amt" value="" style="text-align: right;padding-right: 3px" onkeyup="check_chq_amt();" size="8" />
                                                                    </td>
                                                                    <td style="text-align: center">
                                                                        <input type="date" id="chq_date" name="chq_date" value="" size="8" />
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                </div>
                                            </div>


                                        </div>
                                        <!-- /.box-body -->
                                        <div class="box-footer">
                                            <!--<button type="submit" class="btn btn-default">Cancel</button>-->
                                            <button type="button" id="btn_add" class="btn btn-primary" onclick="form_submission('invoice_form', 'btn_add')">Submit</button>
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
                                                function form_submission(form_id, button_id) {
                                                    if (stock_validation()) {
                                                        document.getElementById(button_id).style.display = "none";
                                                        document.forms[form_id].submit();

                                                    }
                                                }
                                                function stock_validation() {
                                                    valid = true;
                                                    var i = 1;
                                                    for (i = 1; i <= parseFloat($('#row_count').val()); i++) {
                                                        if (document.getElementById('pro_id_' + i) && ($('#pro_id_' + i).val() == "" || $('#pro_name_' + i).val() == "")) {
                                                            valid = false;
                                                            alert("Enter Product");
                                                            $('#pro_name_' + i).focus();
                                                            break;
                                                        } else if ($('#brand_id_' + i).val() == "") {
                                                            valid = false;
                                                            alert("Select Brand");
                                                            $('#brand_id_' + i).focus();
                                                            break;
                                                        } else if ($('#price_id_' + i).val() == "") {
                                                            valid = false;
                                                            alert("Select Price");
                                                            $('#price_id_' + i).focus();
                                                            break;
                                                        } else if (document.getElementById('pro_id_' + i) && $('#qty_' + i).val() == "") {
                                                            valid = false;
                                                            alert("Enter Quantity");
                                                            $('#qty_' + i).focus();
                                                            break;
                                                        } else if (document.getElementById('pro_id_' + i) && !$('#qty_' + i).val().match(/^(\d+)$/)) {
                                                            valid = false;
                                                            alert("Enter Valid Quantity");
                                                            $('#qty_' + i).focus();
                                                            break;
                                                        }
                                                    }
                                                    if ($('#payment_type').val() == '0') {
                                                        valid = false;
                                                        alert("Select Payment Type");
                                                    } else if ($('#payment_type').val() == '1') {
                                                        if ($('#cash_amt').val() == '' || $('#cash_amt').val() == '0') {
                                                            valid = false;
                                                            alert('Please Enter Cash Amount');
                                                        } else if($('#cash_amt').val() > $('#tot_amt').val()){
                                                            valid = false;
                                                            alert('You cannot pay more than invoice amount');
                                                            $('#cash_amt').val($('#tot_amt').val());
                                                        } else if($('#cash_amt').val() < $('#tot_amt').val()){
                                                            valid = false;
                                                            alert('You cannot pay less than invoice amount. please check again');
                                                        }
                                                    } else if ($('#payment_type').val() == '2') {
                                                        if ($('#chq_no').val() == ''){
                                                            valid = false;
                                                            alert('Please Enter Cheque Number');
                                                        } else if($('#bank').val() == ''){
                                                            valid = false;
                                                            alert('Please Enter Bank');
                                                        } else if($('#chq_amt').val() == '' ||$('#chq_amt').val() == '0'){
                                                            valid = false;
                                                            alert('Please Enter Cheque Amount');
                                                        } else if($('#chq_amt').val() > $('#tot_amt').val()){
                                                            valid = false;
                                                            alert('You cannot pay more than invoice amount');
                                                            $('#chq_amt').val($('#tot_amt').val());
                                                        } else if($('#chq_amt').val() < $('#tot_amt').val()){
                                                            valid = false;
                                                            alert('You cannot pay less than invoice amount. please check again');
                                                        } else if($('#chq_date').val() == ''){
                                                            valid = false;
                                                            alert('Please Enter Cheque Date');
                                                        }
                                                    }
                                                    return valid;
                                                }
                                                function load_customers() {
                                                    $("#cus_name").autocomplete({
                                                        source: 'get_customers.php',
                                                        minLength: 1,
                                                        select: function (event, ui) {
                                                            $("#cus_name").val(ui.item.label);
                                                            $("#cus_id").val(ui.item.id);
                                                        }
                                                    });
                                                }
                                                function get_brand(num) {
                                                    if ($('#cus_name').text() != "" || $('#cus_id').val() != '') {
                                                        $("#pro_name_" + num).autocomplete({
                                                            source: 'get_products.php',
                                                            minLength: 2,
                                                            select: function (event, ui) {
                                                                $("#pro_name_" + num).val(ui.item.label);
                                                                $("#pro_id_" + num).val(ui.item.id);
                                                                get_products(num, ui.item.id);
                                                            }
                                                        });
                                                    } else {
                                                        alert('please select customer');
                                                        $('#cus_name').focus();
                                                    }
                                                }
                                                function get_products(num, pro_id) {
                                                    $.ajax({
                                                        url: 'get_brands.php',
                                                        type: 'POST',
                                                        data: {
                                                            'pro_id': pro_id
                                                        },
                                                        success: function (data) {
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
                                                        url: 'get_prices.php',
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
                                                                $('#price_id_' + num).append('<option value=' + arr[i].price_id + '>' + arr[i].retailer_price + '</option>');
                                                            }
                                                        }
                                                    });
                                                }
                                                function select_price(num) {
                                                    var x = document.getElementById("price_id_" + num).selectedIndex;
                                                    var y = document.getElementById("price_id_" + num).options;
                                                    $('#price_' + num).val(y[x].text);
                                                    check_stock(num);
                                                }
                                                function check_stock(num) {
                                                    var pro_id = $('#pro_id_' + num).val();
                                                    var brand_id = $('#brand_id_' + num).val();
                                                    var price_id = $('#price_id_' + num).val();
                                                    $.ajax({
                                                        url: 'get_current_stock.php',
                                                        type: 'POST',
                                                        data: {
                                                            'pro_id': pro_id,
                                                            'brand_id': brand_id,
                                                            'price_id': price_id
                                                        },
                                                        success: function (data) {
                                                            $('#stock_' + num).val(data);
                                                        }
                                                    });
                                                }
                                                function check_qty(num) {
                                                    if (!$('#qty_' + num).val().match(/^(\d+)$/) && $('#qty_' + num).val() != "") {
                                                        alert("Enter valid Number");
                                                    } else if ($('#qty_' + num).val() > $('#stock_' + num).val()) {
                                                        alert('Not enough stock to complete this order');
                                                        $('#qty_' + num).val('0');
                                                    } else if ((!$('#discount_' + num).val().match(/^\d+(\.\d{0,1})?$/) || parseFloat($('#discount_' + num).val()) > 100) && $('#discount_' + num).val() != "") {
                                                        alert("Enter Valid Discount");
                                                        $('#discount_' + num).val(0);
                                                    }
                                                    calc_total();
                                                }
                                                function calc_total() {
                                                    var x = 1;
                                                    var tot_amount = 0;
                                                    for (var x = 1; x <= $('#row_count').val(); x++) {
                                                        var discount = 0;
                                                        if (typeof $('#qty_' + x).val() !== 'undefined') {
                                                            if ((!$('#discount_' + x).val().match(/^\d+(\.\d{0,1})?$/) || parseFloat($('#discount_' + x).val()) > 100) && $('#discount_' + x).val() != "") {
                                                                alert("Enter Valid Discount");
                                                                $('#discount_' + x).val(0);
                                                            } else if (parseFloat($('#discount_' + x).val()) > 0) {
                                                                discount = parseFloat($('#discount_' + x).val());
                                                            }

                                                            if (document.getElementById('pro_id_' + x) && $('#qty_' + x).val().match(/^(\d+)$/) && $('#qty_' + x).val() != "") {
                                                                if ($('#qty_' + x).val() > 0) {
                                                                    var line_amount = (parseFloat($('#qty_' + x).val()) * parseFloat($('#price_' + x).val()) * (100 - discount)) / 100;

                                                                    tot_amount += line_amount;
                                                                    $('#value_' + x).val(line_amount);
                                                                }
                                                            } else {
                                                                $('#qty_' + x).val(0);
                                                                $('#value_' + x).val(0);
                                                            }
                                                        }
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
                                                            + '<td style="text-align: center">'
                                                            + '<input type="text" style="text-align: right;padding-right: 3px" id="stock_' + num + '" name="stock_' + num + '" size="5" readonly="true" />'
                                                            + '</td>'
                                                            + '<td>'
                                                            + '<input type="text" style="text-align: right;padding-right: 3px" id="qty_' + num + '" name="qty_' + num + '" size="5" onkeyup="check_qty(' + num + ')" />'
                                                            + '</td>'
                                                            + '<td>'
                                                            + '<input type="text" style="text-align: right;padding-right: 3px" id="discount_' + num + '" name="discount_' + num + '" size="5" onkeyup="check_qty(' + num + ')" />'
                                                            + '</td>'
                                                            + '<td>'
                                                            + '<input type="text" style="text-align: right;padding-right: 3px" id="value_' + num + '" name="value_' + num + '" size="15" readonly="true" />'
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
                                                    calc_total();
                                                }

                                                function select_pay_type() {
                                                    if ($('#tot_amt').val() !== '') {
                                                        if ($('#payment_type').val() == '1') {
                                                            $('#cash_div').show();
                                                            $('#cheque_div').hide();
                                                            $('#chq_amt').val('');
                                                            $('#chq_no').val('');
                                                            $('#bank').val('');
                                                            $('#chq_date').val('');
                                                        } else if ($('#payment_type').val() == '2') {
                                                            $('#cheque_div').show();
                                                            $('#cash_div').hide();
                                                            $('#cash_amt').val('');
                                                        } else if ($('#payment_type').val() == '0') {
                                                            $('#cheque_div').hide();
                                                            $('#cash_div').hide();
                                                            $('#cash_amt').val('');
                                                            $('#chq_amt').val('');
                                                            $('#chq_no').val('');
                                                            $('#bank').val('');
                                                            $('#chq_date').val('');
                                                        }
                                                    } else {
                                                        alert('please add items before you enter payment');
                                                    }
                                                }

                                                function check_cash_amt() {
                                                    if (!$('#cash_amt').val().match(/^\d+(\.\d{0,1})?$/)) {
                                                        alert("Enter Valid Cash Amount");
                                                        $('#cash_amt').val(0);
                                                    }
                                                }

                                                function check_chq_amt() {
                                                    if (!$('#chq_amt').val().match(/^\d+(\.\d{0,1})?$/)) {
                                                        alert("Enter Valid Cheque Amount");
                                                        $('#chq_amt').val(0);
                                                    }
                                                }

            </script>
        </body>
    </html>
    ?>
    <?php
    $connection->close();
} else {
    header('Location:../index.php');
}
