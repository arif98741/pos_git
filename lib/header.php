<?php
ob_start();
$startScriptTime = microtime(TRUE);
date_default_timezone_set('Asia/Dhaka');
const BASE_URL = 'http://localhost/pos_git/';

$path = realpath(dirname(__DIR__));
spl_autoload_register(function ($class) use ($path) {
    include_once $path . '/classes/' . $class . '.php';
});

Session::checkSession();
include_once $path . '/helper/Helper.php';
error_reporting(E_ALL);

$db = new Database();
$log = new Login();
$pro = new Product();
$sel = new Sell();
$sup = new Supplier();
$cus = new Customer();
$inv = new Invoice();
$sto = new Stock();
$las = new Laser();
$ext = new Extra();
$help = new Helper();


if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    session_destroy();
    echo "<script>window.location = 'login.php';</script>";
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
        <?php echo $ext->dynamicPageTitle(); ?>Point of Sale Management System
    </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <?php include("lib/css/css.php"); ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="index.php" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b><i class="fa fa-ist"></i></b></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>pos</b> software</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Messages: style can be found in dropdown.less-->
                    <li class="dropdown messages-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-envelope-o"></i>
                            <span class="label label-success">4</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have 4 messages</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">
                                    <li><!-- start message -->
                                        <a href="#">
                                            <div class="pull-left">
                                                <img src="<?php echo Session::get('logo'); ?>" class="img-circle"
                                                     alt="User Image">
                                            </div>
                                            <h4>
                                                Support Team
                                                <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                            </h4>
                                            <p>Why not buy a new awesome theme?</p>
                                        </a>
                                    </li>
                                    <!-- end message -->


                                </ul>
                            </li>
                            <li class="footer"><a href="#">See All Messages</a></li>
                        </ul>
                    </li>
                    <!-- Notifications: style can be found in dropdown.less -->
                    <li class="dropdown notifications-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bell-o"></i>
                            <span class="label label-warning">10</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have 10 notifications</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                        </a>
                                    </li>


                                </ul>
                            </li>
                            <li class="footer"><a href="#">View all</a></li>
                        </ul>
                    </li>
                    <!-- Tasks: style can be found in dropdown.less -->
                    <li class="dropdown tasks-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-flag-o"></i>
                            <span class="label label-danger">9</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have 9 tasks</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">
                                    <li><!-- Task item -->
                                        <a href="#">
                                            <h3>
                                                Design some buttons
                                                <small class="pull-right">20%</small>
                                            </h3>
                                            <div class="progress xs">
                                                <div class="progress-bar progress-bar-aqua" style="width: 20%"
                                                     role="progressbar"
                                                     aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                    <span class="sr-only">20% Complete</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>

                                    <!-- end task item -->
                                </ul>
                            </li>
                            <li class="footer">
                                <a href="#">View all tasks</a>
                            </li>
                        </ul>
                    </li>
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="<?php echo Session::get('logo'); ?>" class="user-image" alt="User Image">
                            <span class="hidden-xs"><?php echo ucfirst(Session::get('status')); ?></span>
                        </a>
                        <ul class="dropdown-menu">

                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="profile.php?id=<?php echo Session::get('userid'); ?>"
                                       class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <a href="logout.php?action=logout" class="btn btn-default btn-flat">Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <!-- Control Sidebar Toggle Button -->

                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="<?php echo Session::get('logo'); ?>" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>Administrator</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>

            <!-- /.search form -->
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu" data-widget="tree">
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-database"></i> <span>Products</span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        <?php if (Session::get('status') == 'admin'): ?>

                            <li><a href="addproduct.php"><i class="fa fa-plus"></i>Add Product</a></li>
                        <?php endif; ?>
                        <li><a href="products.php"><i class="fa fa-list"></i>Product List</a></li>
                        <?php if (Session::get('status') == 'admin'): ?>

                            <li><a href="product_report.php"><i class="fa fa-tag"></i>Products Report</a></li>
                        <?php endif; ?>

                    </ul>
                </li>


                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-car"></i> <span>Purchase</span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">

                        <li><a href="addpurchase.php"><i class="fa fa-plus"></i>Add Purchase</a></li>
                        <li><a href="purchaselist.php"><i class="fa fa-list"></i>Purchase List</a></li>
                        <?php if (Session::get('status') == 'admin'): ?>
                            <li><a href="purchasereport.php"><i class="fa fa-tag"></i>Purchase Report</a></li>
                        <?php endif; ?>

                    </ul>
                </li>
                <li class="treeview">

                    <a href="#">
                        <i class="fa fa-handshake-o"></i> <span>Sales</span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">

                        <li><a href="addinvoice.php"><i class="fa fa-plus"></i>Sale Product</a></li>
                        <li><a href="invoicelist.php"><i class="fa fa-list"></i>Sales List</a></li>

                        <?php if (Session::get('status') == 'admin'): ?>

                            <li><a href="profitreport.php"><i class="fa fa-tag"></i>Profit Report</a></li>
                            <li><a href="invoice_report.php"><i class="fa fa-tag"></i>Invoice Report</a></li>
                            <li><a href="sale_report.php"><i class="fa fa-tag"></i>Sales Report</a></li>

                        <?php endif; ?>

                    </ul>
                </li>


                <li class="treeview">

                    <a href="#">
                        <i class="fa fa-briefcase"></i> <span>Payment</span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">

                        <li><a href="billpay.php"><i class="fa fa-plus"></i>Add Payment</a></li>

                        <?php if (Session::get('status') == 'admin'): ?>


                            <li><a href="paymentlist.php"><i class="fa fa-list"></i>Payment Record</a></li>
                            <li><a href="paymentreport.php"><i class="fa fa-tag"></i>Payment Report</a></li>

                        <?php endif; ?>

                    </ul>
                </li>


                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-university"></i> <span>Stock</span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="stocklist.php"><i class="fa fa-list"></i>Stock List</a></li>

                        <?php if (Session::get('status') == 'admin'): ?>
                            <li><a href="stock_report.php"><i class="fa fa-tag"></i>Stock Report</a></li>
                        <?php endif; ?>

                    </ul>
                </li>

                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-money"></i> <span>General Account</span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">


                        <li><a href="transcategorylist.php"><i class="fa fa-list"></i>Transaction Category</a></li>
                        <?php if (Session::get('status') == 'admin'): ?>
                            <li><a href="laserlist.php"><i class="fa fa-list"></i>Transaction List </a></li>
                            <li><a href="laserreport.php"><i class="fa fa-tag"></i>Transaction Report </a></li>

                        <?php endif; ?>

                    </ul>
                </li>


                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-users"></i> <span>Customer</span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        <?php if (Session::get('status') == 'admin'): ?>
                            <li><a href="addcustomer.php"><i class="fa fa-plus"></i>Add Customer</a></li>
                        <?php endif; ?>

                        <li><a href="customerlist.php"><i class="fa fa-list"></i>Customer List </a></li>

                        <?php if (Session::get('status') == 'admin'): ?>
                            <li><a href="customer_statement.php"><i class="fa fa-exchange"></i>Customer Statement </a>
                            </li>
                            <li><a href="printfiles/customer/print.php"><i class="fa fa-tag"></i>Customer Report</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>

                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-user"></i> <span>Supplier</span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="supplierlist.php"><i class="fa fa-list"></i>Supplier List </a></li>
                        <?php if (Session::get('status') == 'admin'): ?>

                            <li><a href="suppliertransaction.php"><i class="fa fa-list"></i>Supplier Transaction</a>
                            </li>
                            <li><a href="supplier_transaction_report.php"><i class="fa fa-tag"></i>Supplier Transaction
                                    Report</a></li>
                            <li><a href="printfiles/supplier/print.php"><i class="fa fa-tag"></i>Supplier Report</a>
                            </li>

                        <?php endif; ?>
                    </ul>
                </li>

                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-cog"></i> <span>Setting</span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        <?php if (Session::get('status') == 'admin'): ?>
                            <li><a href="addgroup.php"><i class="fa fa-plus"></i>Add Product Group</a></li>
                            <li><a href="addtype.php"><i class="fa fa-plus"></i>Add Product Unit</a></li>
                        <?php endif; ?>

                        <li><a href="grouplist.php"><i class="fa fa-list"></i>Group List </a></li>
                        <li><a href="typelist.php"><i class="fa fa-list"></i>Unit List </a></li>
                        <li><a href="users.php"><i class="fa fa-list"></i>User List </a></li>

                    </ul>
                </li>

            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>