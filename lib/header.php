<?php
ob_start();
$startScriptTime=microtime(TRUE);
date_default_timezone_set('Asia/Dhaka');
define("BASE_URL", 'http://localhost/pos_git/');

//case control
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");


$path = realpath(dirname(__DIR__));
include_once $path . '/classes/Session.php';
Session::checkSession();

function __autoload($class) {
    $filepath = realpath(dirname(__DIR__));
    include_once $filepath . '/classes/' . $class . '.php';
}

include_once $path . '/helper/Helper.php';

error_reporting(E_ALL);

$db  = new Database();
$log = new Login();
$pro = new Product();
$sup = new Supplier();
$cus = new Customer();
$las = new Laser();
$ext = new Extra();
$help = new Helper();

$userid = Session::get('userid');



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
      <span class="logo-lg"><b>POS</b> Man</span>
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
             <span style="font-size: 20px;"><?php echo date('H:iA/d-m-Y'); ?></span>
              
            </a>
          
          </li>
          <!-- Notifications: style can be found in dropdown.less -->
         
          <!-- Tasks: style can be found in dropdown.less -->
         
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
                  <a href="profile.php?id=<?php echo Session::get('userid'); ?>" class="btn btn-default btn-flat">Profile</a>
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
            <?php if(Session::get('status') == 'admin'): ?>

            <li><a href="addproduct.php"><i class="fa fa-plus"></i>Add Product</a></li>
            <?php endif; ?>
            <li><a href="products.php"><i class="fa fa-list"></i>Product List</a></li>
           
          </ul>
        </li>

        </li>

        

        </li>

        </li>


         <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i> <span>Customer</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php if(Session::get('status') == 'admin'): ?>
            <li><a href="addcustomer.php"><i class="fa fa-plus"></i>Add Customer</a></li>
            <?php endif; ?>

            <li><a href="customerlist.php"><i class="fa fa-list"></i>Customer List </a></li>

            
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
            <?php if(Session::get('status') == 'admin'): ?>
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