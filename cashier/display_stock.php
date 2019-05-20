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

            <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
            <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
            <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
            <![endif]-->

            <!-- Google Font -->
            <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
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
                        <span class="logo-mini"><b></b></span>
                        <!-- logo for regular state and mobile devices -->
                        <span class="logo-lg"><b></b></span>
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
                            STOCK
                            <small>Display</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                            <li><a href="#">Stock</a></li>
                            <li class="active">Display</li>
                        </ol>
                    </section>
                    <section class="content">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Stock Details</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <?php
                                $query = "SELECT 
                                b.brand_name, p.product_name, pp.dealer_price,pp.retailer_price, sp.qty, sum(sp.qty * pp.dealer_price) as total_value
                                FROM 
                                tbl_stock s 
                                INNER JOIN
                                tbl_stock_product sp ON s.stock_id = sp.stock_id 
                                INNER JOIN 
                                tbl_product p ON p.product_id = sp.pro_id 
                                INNER JOIN 
                                tbl_brand b ON b.brand_id = sp.brand_id 
                                INNER JOIN 
                                tbl_price pp ON pp.price_id = sp.price_id
                                WHERE 
                                s.stock_id = '".$_REQUEST['stock_id']."'
                                GROUP BY pp.price_id,p.product_id
                                ORDER BY b.brand_name, p.product_name";
                                $result = mysqli_query($connection->myconn,$query);
                                if(mysqli_num_rows($result)){ ?>
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center">Product Name</th>
                                                <th style="text-align: center">Brand Name</th>
                                                <th style="text-align: center">Dealer Price</th>
                                                <th style="text-align: center">Retailer Price</th>
                                                <th style="text-align: center">Qty</th>
                                                <th style="text-align: center">Value</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $total = 0;
                                             while ($row = mysqli_fetch_assoc($result)){ 
                                                 $total += $row['total_value'];
                                                 ?>
                                            <tr>
                                                <td><?php echo $row['product_name']; ?></td>
                                                <td><?php echo $row['brand_name']; ?></td>
                                                <td style="text-align: right;padding-right: 5px"><?php echo $row['dealer_price']; ?></td>
                                                <td style="text-align: right;padding-right: 5px"><?php echo $row['retailer_price']; ?></td>
                                                <td style="text-align: right;padding-right: 5px"><?php echo $row['qty']; ?></td>
                                                <td style="text-align: right;padding-right: 5px"><?php echo number_format($row['total_value'],2); ?></td>
                                            </tr>     
                                            <?php } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td style="text-align: right;padding-right: 5px" colspan="5"><b>Total Amount</b></td>
                                                <td style="text-align: right;padding-right: 5px"><b><?php echo number_format($total,2); ?></b></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                <?php } ?>
                            </div>
                        </div>
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
        </body>
    </html>
    ?>
    <?php
    $connection->close();
} else {
    header('Location:../index.php');
}
