<?php ?>
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="../dist/img/user.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?php echo $_SESSION['user_name']; ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="../../index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
                    <li><a href="../../index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-circle-o text-aqua"></i> <span>Users</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="../admin/user_registration.php"><i class="fa fa-circle-o text-yellow"></i> Add Users</a></li>
                    <li><a href="../admin/user_view.php"><i class="fa fa-circle-o text-yellow"></i> View Users</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-circle-o text-aqua"></i> <span>Customers</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="../admin/customers.php"><i class="fa fa-circle-o text-yellow"></i> Add Customers</a></li>
                    <li><a href="../admin/customer_veiw.php"><i class="fa fa-circle-o text-yellow"></i> View Customers</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-circle-o text-aqua"></i> <span>Products</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="../admin/product_registration.php"><i class="fa fa-circle-o text-yellow"></i> Add Products</a></li>
                    <li><a href="../admin/view_product.php"><i class="fa fa-circle-o text-yellow"></i> View Products</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-circle-o text-aqua"></i> <span>Suppliers</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="../admin/supplier_registation.php"><i class="fa fa-circle-o text-yellow"></i> Add Suppliers</a></li>
                    <li><a href="../admin/supplier_view.php"><i class="fa fa-circle-o text-yellow"></i> View Suppliers</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-circle-o text-aqua"></i> <span>Brand</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="../admin/brand_registration.php"><i class="fa fa-circle-o text-yellow"></i> Add Brands</a></li>
                    <li><a href="../admin/view_brand.php"><i class="fa fa-circle-o text-yellow"></i> View Brands</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-circle-o text-aqua"></i> <span>Price</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="../admin/price_registration.php"><i class="fa fa-circle-o text-yellow"></i> Add Price</a></li>
                    <li><a href="../admin/view_price.php"><i class="fa fa-circle-o text-yellow"></i> View Prices</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-circle-o text-aqua"></i> <span>Reports</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="../admin/daily_sales_report.php"><i class="fa fa-circle-o text-yellow"></i> Daily Sales Summary</a></li>                    
                    <li><a href="../admin/daily_sales_details.php"><i class="fa fa-circle-o text-yellow"></i> Daily Sales Details</a></li>
                    <li><a href="../admin/stock_report.php"><i class="fa fa-circle-o text-yellow"></i> Product Wise Stock Balance</a></li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>

