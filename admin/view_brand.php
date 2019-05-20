<?php
session_start();
require_once '../library/config.php';
require_once '../library/functions.php';
if ($_SESSION['user_type'] == 'admin') {
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

                <?php include_once '../menu/admin_menu.php' ?>

                <!-- =============================================== -->

                <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper">
                    <!-- Content Header (Page header) -->
                    <section class="content-header">
                        <h1>
                            BRAND
                            <small>View</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                            <li><a href="#">Brand</a></li>
                            <li class="active">View</li>
                        </ol>
                    </section>
                    <section class="content">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Brand Details</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <?php
                                $query = "SELECT 
                                    b.brand_id,b.brand_name,p.product_name,s.sup_name,b.brand_status
                                    FROM 
                                    tbl_brand b 
                                    inner join 
                                    tbl_product p on p.product_id = b.product_id
                                    inner join 
                                    tbl_supplier s on s.sup_id = b.sup_id
                                    ORDER BY b.brand_name";
                                $result = mysqli_query($connection->myconn, $query);
                                if (mysqli_num_rows($result) != 0) {
                                    ?>
                                    <table id="view_brand" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center">Brand Name</th>
                                                <th style="text-align: center">Product Name</th>
                                                <th style="text-align: center">Supplier Name</th>
                                                <th style="text-align: center">Status</th>
                                                <th style="text-align: center">Edit</th>
                                                <th style="text-align: center">Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $row['brand_name']; ?></td>
                                                    <td><?php echo $row['product_name']; ?></td>
                                                    <td><?php echo $row['sup_name']; ?></td>
                                                    <td style="text-align: center">
                                                        <?php if ($row['brand_status'] == '0') { ?>
                                                            <span style="color:green">Active</span>
                                                        <?php } else { ?>
                                                            <span style="color:red">Inactive</span>
                                                        <?php } ?>
                                                    </td>
                                                    <td style="text-align: center" ><?php if ($row['brand_status'] == '0') { ?>
                                                            <img src="../images/edit.png" width="15px" height="15px" style="cursor: pointer" onclick="window.open('edit_brand.php?brand_id=<?php echo $row['brand_id']; ?>')" />
                                                        <?php } ?></td>
                                                    <td style="text-align: center" ><?php if ($row['brand_status'] == '0') { ?>
                                                            <img src="../images/Recycle_Bin.png" width="20px" height="20px" style="cursor: pointer" onclick="delete_brand('<?php echo $row['brand_id']; ?>')" />
                                                        <?php } ?></td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                    <?php
                                }
                                ?>

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
            <!-- DataTables -->
            <script src="../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
            <script src="../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
            <script type="text/javascript">
                                                    $(function () {
                                                        $('#view_brnad').DataTable();
                                                    });

                                                    function delete_brand(brand_id) {
                                                        var userselection = confirm("Are you sure you want to inactive this brand permanently?");
                                                        $.ajax({
                                                            url: 'delete_brand.php',
                                                            type: 'POST',
                                                            data: {
                                                                brand_id: brand_id
                                                            },
                                                            success: function (data) {
                                                                if (userselection == true && data == '1') {
                                                                    alert("Your Account deleted!");
                                                                    location.reload();
                                                                } else {
                                                                    alert("Your account is not deleted!");
                                                                }
                                                            }
                                                        });
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


