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

                <?php include_once '../menu/admin_menu.php' ?>

                <!-- =============================================== -->

                <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper">
                    <!-- Content Header (Page header) -->
                    <section class="content-header">
                        <h1>
                            USER
                            <small>Registration</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                            <li><a href="#">User</a></li>
                            <li class="active">Registration</li>
                        </ol>
                    </section>
                    <div class="col-md-2 col-md-offset-5" style="color: red">
                        <?php
                        if(isset($_SESSION['user_add_msg'])){
                        echo $_SESSION['user_add_msg'];
                        }
                        ?>
                    </div>
                    <section class="content">
                        <form action="add_user.php" type="post">
                            <div class="row">
                                <!-- left column -->
                                <div class="col-md-6">
                                    <!-- general form elements -->
                                    <div class="box box-primary">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">Basic Information</h3>
                                        </div>
                                        <!-- /.box-header -->
                                        <!-- form start -->
                                        <!--<form role="form">-->
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label for="name">Full Name</label>
                                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="name">NIC</label>
                                                <input type="text" class="form-control" id="nic" name="nic" placeholder="Enter NIC" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Telephone</label>
                                                <input type="text" class="form-control" id="telephone" name="telephone" placeholder="Enter Mobile No" required maxlength="10">
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Address</label>
                                                <textarea class="form-control" id="address" name="address" rows="3" placeholder="Enter Address" required=""></textarea>
                                            </div>
                                        </div>
                                        <!-- /.box-body -->

                                        <div class="box-footer">
                                        </div>
                                        <!--</form>-->
                                    </div>
                                    <!-- /.box -->
                                </div>
                                <!--/.col (left) -->
                                <!-- right column -->
                                <div class="col-md-6">
                                    <!-- Horizontal Form -->
                                    <div class="box box-info">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">Login Information</h3>
                                        </div>
                                        <!-- /.box-header -->
                                        <!-- form start -->
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">User Type</label>
                                                <select name="user_type" id="user_type" class="form-control" required="required">
                                                    <option value="">SELECT USER TYPE</option>
                                                    <?php
                                                    $query = "SELECT 
                                                        u_tp_id, user_type
                                                        FROM  
                                                        tbl_user_type
                                                        WHERE 
                                                        user_type_status ='0'
                                                        AND u_tp_id !='1'";
                                                    $result = mysqli_query($connection->myconn, $query);
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        ?>
                                                        <option value="<?php echo $row['u_tp_id']; ?>"><?php echo $row['user_type']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="">User Name</label>
                                                <input id="username" type="text" placeholder="User Name" class="form-control" name="username" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword">Password</label>
                                                <input id="password" type="password" placeholder="Password" class="form-control" name="password" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPasswordconfirm">Confirm Password</label>
                                                <input id="password_confirmation" type="password" placeholder="Password" class="form-control" name="password_confirmation" onkeyup="check_password();" required>
                                                <span id="pwd_msg"></span>
                                            </div>
                                        </div>
                                        <!-- /.box-body -->
                                        <div class="box-footer">
                                            <button type="reset" class="btn btn-default">Cancel</button>
                                            <button type="submit" id="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                        <!-- /.box-footer -->
                                        <!--</form>-->
                                    </div>
                                    <!-- /.box -->

                                    <!-- /.box -->
                                </div>
                                <!--/.col (right) -->
                            </div>
                        </form>
                        <!-- /.row -->
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
            <script type="text/javascript">
                                                    function check_password() {
                                                        var password = $('#password').val();
                                                        var password_confirmation = $('#password_confirmation').val();
                                                        if (password === password_confirmation) {
                                                            document.getElementById("pwd_msg").textContent = "password is matching";
                                                            document.getElementById("pwd_msg").style.color = "green";
                                                            document.getElementById("submit").disabled = false;
                                                        } else {
                                                            document.getElementById("pwd_msg").textContent = "password is not matching";
                                                            document.getElementById("pwd_msg").style.color = "red";
                                                            document.getElementById("submit").disabled = true;
                                                        }
                                                    }
            </script>
        </body>
    </html>
    ?>
    <?php
    $connection->close();
    unset($_SESSION['user_add_msg']);
} else {
    header('Location:../index.php');
}
