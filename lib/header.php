<?php
ob_start();
date_default_timezone_set('Asia/Dhaka');
define("BASE_URL", 'http://localhost/pos_v1/');
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
<!DOCTYPE HTML>
<html>
    <head>
        <title>Point of Sale Management Service</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="keywords" content="Point of Sale Management" />
        <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
        <!-- Bootstrap Core CSS -->
        <link href="<?php echo BASE_URL; ?>assets/css/bootstrap.min.css" rel='stylesheet' type='text/css' />
        <!-- Custom CSS -->
        <link href="<?php echo BASE_URL; ?>assets/css/style.css" rel="stylesheet"/>
        <link href="<?php echo BASE_URL; ?>assets/css/custom.css" rel="stylesheet"/>
        <!-- Graph CSS -->
        <link href="<?php echo BASE_URL; ?>assets/css/font-awesome.css" rel="stylesheet">
        <!--datatables-->
		
        <link href="<?php echo BASE_URL; ?>assets/css/datatables.css" rel="stylesheet">
        <!-- jQuery -->
        <!-- lined-icons -->
        <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/icon-font.min.css">
        <!-- //lined-icons -->
        <!-- chart -->
        <script src="<?php echo BASE_URL; ?>assets/js/Chart.js"></script>
        <!-- //chart -->
        <!--animate-->
        <link href="<?php echo BASE_URL; ?>assets/css/animate.css" rel="stylesheet" type="text/css" media="all">
        <script>
            //new WOW().init();
		</script>
        <!--//end-animate-->
        <!----webfonts--->
        <link href='//fonts.googleapis.com/css?family=Cabin:400,400italic,500,500italic,600,600italic,700,700italic' rel='stylesheet' type='text/css'>
        <!---//webfonts---> 
        <!-- Meters graphs -->
        <!-- Placed js at the end of the document so the pages load faster -->
	</head> 
    <body class="sticky-header left-side-collapsed"  onload="initMap()">
        <section>
            <!-- left side start-->
            <div class="left-side sticky-left-side">
                <!--logo and iconic logo start-->
                <div class="logo-icon text-center">
                    <a href="index.php"><i class="lnr lnr-home"></i> </a>
				</div>
                <!--logo and iconic logo end-->
                <div class="left-side-inner">
                    <!--sidebar nav start-->
                    <ul class="nav nav-pills nav-stacked custom-nav">
                        <li class="active"><a href="index.php"><i class="lnr lnr-power-switch"></i><span>Dashboard</span></a></li>
                      <li class="menu-list">
                            <a href="#"><i class="lnr lnr-database"></i>
                                <span>Products</span></a>
                            <ul class="sub-menu-list">
                            <?php if(Session::get('status') == 'admin'): ?>

                                <li><a href="<?php echo BASE_URL; ?>addproduct.php">Add Product</a> </li>

                            <?php endif; ?>

                                <li><a href="<?php echo BASE_URL; ?>products.php">Products List</a> </li>
                                <li><a href="<?php echo BASE_URL; ?>product_report.php">Products Report</a> </li>
                            </ul>
                        </li>

                        <li class="menu-list">
                            <a href="#"><i class="lnr lnr-car"></i>
                                <span>Purchase</span></a>
                            <ul class="sub-menu-list">
                                <?php if(Session::get('status') == 'admin'): ?>
                                    
                                   <li><a href="<?php echo BASE_URL; ?>addpurchase.php">Add Purchase</a></li>
                                   
                                 <?php endif; ?>
                                <li><a href="<?php echo BASE_URL; ?>purchaselist.php">Purchase List</a></li>
                                <li><a href="<?php echo BASE_URL; ?>purchasereport.php">Purchase Report</a></li>

                            </ul>
                        </li>

                        <li class="menu-list">
                            <a href="#"><i class="lnr lnr-cart"></i>
                                <span>Sales</span></a>
                            <ul class="sub-menu-list">
                                <li><a href="<?php echo BASE_URL; ?>addinvoice.php">Sale Product</a> </li>
                                <li><a href="<?php echo BASE_URL; ?>invoicelist.php">Sales List</a> </li>
                                 <?php if(Session::get('status') == 'admin'): ?>

                                     <li><a href="<?php echo BASE_URL; ?>profitreport.php">Profit Report</a> </li>

                                 <?php endif; ?>
                                <li><a href="<?php echo BASE_URL; ?>invoice_report.php">Invoice Report</a> </li>
                                <li><a href="<?php echo BASE_URL; ?>sale_report.php">Sales Report</a> </li>
                            </ul>
                        </li>


                        <li class="menu-list">
                            <a href="#"><i class="lnr lnr-briefcase"></i>
                                <span>Payment</span></a>
                            <ul class="sub-menu-list">
                                <li><a href="<?php echo BASE_URL; ?>billpay.php">Add Payment</a></li>
                                <?php if(Session::get('status') == 'admin'): ?>
                                      <li><a href="<?php echo BASE_URL; ?>paymentlist.php">Payment Record</a></li>
                                 <?php endif; ?>
                               <li><a href="<?php echo BASE_URL; ?>paymentreport.php">Payment Report</a></li>
                            </ul>
                        </li>



                        
                        <li class="menu-list">
                            <a href="#"><i class="lnr lnr-store"></i>
                                <span>Stock</span></a>
                            <ul class="sub-menu-list">
                                <li><a href="<?php echo BASE_URL; ?>stocklist.php">Stock List</a> </li>
                                <li><a href="<?php echo BASE_URL; ?>stock_report.php">Stock Report</a> </li>

                            </ul>
                        </li>

                         <li class="menu-list">
                            <a href="#"><i class="lnr lnr-pie-chart"></i>
                                <span>General Account</span></a>
                            <ul class="sub-menu-list">
                                
                                <?php if (Session::get('status') == 'admin'): ?>

                                <li><a href="<?php echo BASE_URL; ?>addlaser.php">Add Transaction </a> </li>
                                <li><a href="<?php echo BASE_URL; ?>laserlist.php">Transaction List</a> </li>
                                <li><a href="<?php echo BASE_URL; ?>laserreport.php">Transaction Report</a> </li>
                                <li><a href="<?php echo BASE_URL; ?>addtranscategory.php">Add Trans. Category</a></li>
                                
                                <?php else: ?>
                                    
                                    <li><a href="<?php echo BASE_URL; ?>transcategorylist.php">Trans. Categories</a></li>    

                                <?php  endif; ?>    
                               

                            </ul>
                        </li>

                        <li class="menu-list">
                            <a href="#"><i class="lnr lnr-users"></i>
                                <span>Customers</span></a>
                            <ul class="sub-menu-list">

                                <?php if (Session::get('status') == 'admin'): ?>

                                <li><a href="<?php echo BASE_URL; ?>addcustomer.php">Add Customer</a> </li>
                                <li><a href="<?php echo BASE_URL; ?>customerlist.php">Customer List</a> </li>
                                <li><a href="<?php echo BASE_URL; ?>customer_statement.php">Customer Statement</a> </li>
                                <li><a href="<?php echo BASE_URL; ?>printfiles/customer/print.php">Customer Report</a></li>

                            <?php else: ?>
                                <li><a href="<?php echo BASE_URL; ?>customerlist.php">Customer List</a> </li>
                                <li><a href="<?php echo BASE_URL; ?>printfiles/customer/print.php">Customer Report</a></li>    
                                 <?php  endif; ?>    
                            </ul>
                        </li>

                        <li class="menu-list">
                            <a href="#"><i class="lnr lnr-user"></i>
                                <span>Supplier</span></a>
                            <ul class="sub-menu-list">
                                <?php if(Session::get('status') == 'admin'): ?>

                                <li><a href="<?php echo BASE_URL; ?>addsupplier.php">Add Supplier</a> </li>
                                <li><a href="<?php echo BASE_URL; ?>supplierlist.php">Supplier List</a> </li>
                                <li><a href="<?php echo BASE_URL; ?>printfiles/supplier/print.php">Supplier Report</a> </li>
                                 <?php else: ?>
                                    <li><a href="<?php echo BASE_URL; ?>supplierlist.php">Supplier List</a> </li>
                                    <li><a href="<?php echo BASE_URL; ?>printfiles/supplier/print.php">Supplier Report</a> </li>
                                <?php  endif; ?>    

                            </ul>
                        </li>

                         <li class="menu-list">
                            <a href="#"><i class="lnr lnr-cog"></i>
                                <span>Sittings</span></a>
                            <ul class="sub-menu-list">
                                 <?php if(Session::get('status') == 'admin'): ?>

                                <li><a href="<?php echo BASE_URL; ?>addgroup.php">Add Product Group</a> </li>
                                 <li><a href="<?php echo BASE_URL; ?>addtype.php">Add Product Unit</a> </li>
                                <li><a href="<?php echo BASE_URL; ?>grouplist.php">Group List</a> </li>
                                <li><a href="<?php echo BASE_URL; ?>typelist.php">Unit List</a> </li>
                            <?php else: ?>
                                <li><a href="<?php echo BASE_URL; ?>grouplist.php">Group List</a> </li>
                                <li><a href="<?php echo BASE_URL; ?>typelist.php">Unit List</a> </li>


                                 <?php  endif; ?>    
                            </ul>
                        </li>





                    </ul>
                    <!--sidebar nav end-->
                </div>
            </div>
            <!-- left side end-->

            <!-- main content start-->
            <div class="main-content">
                <!-- header-starts -->
                <div class="header-section">

                    <!--toggle button start-->
                    <a class="toggle-btn  menu-collapsed"><i class="fa fa-bars"></i> explore POS</a>
                    <!--toggle button end-->

                    <!--notification menu start -->
                    <div class="menu-right">
                        <div class="user-panel-top">
                            <div class="profile_details_left">
                                <ul class="nofitications-dropdown">
                                    
                                    <li class="login_box" id="loginContainer">

                                        <!-- search-scripts -->
                                        <script src="<?php echo BASE_URL; ?>assets/js/classie.js"></script>

                                        <!-- //search-scripts -->
                                    </li>
                                  
                                  		   							   		
                                    <div class="clearfix"></div>	
                                </ul>
                            </div>
                            <div class="profile_details">		
                                <ul>
                                    <li class="dropdown profile_details_drop">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                            <div class="profile_img">	
                                                <span style="background-image: url(<?php echo Session::get('userid'); ?>);"> </span>
                                                <div class="user-name">
                                                    <?php if (Session::get("login") == true): ?>
                                                    <p><?php echo Session::get("name"); ?><span><?php echo Session::get("status"); ?></span></p>
                                                    <?php endif; ?>
                                                </div>
                                                <i class="lnr lnr-chevron-down"></i>
                                                <i class="lnr lnr-chevron-up"></i>
                                                <div class="clearfix"></div>	
                                            </div>	
                                        </a>
                                        <ul class="dropdown-menu drp-mnu">

                                            <?php if (Session::get("login") == true): ?>
                                            <li> <a href="#"><i class="fa fa-cog"></i> Settings</a> </li> 
                                                <li> <a href="profile.php?id=<?php echo Session::get('userid'); ?>"><i class="fa fa-user"></i>Profile</a> </li> 

                                                <?php if(Session::get("status") == 'admin'): ?>
                                                    <li> <a href="<?php echo BASE_URL; ?>users.php"><i class="lnr lnr-list"></i> Users</a> </li> 

                                                    <li> <a href="<?php echo BASE_URL; ?>adduser.php"><i class="lnr lnr-user"></i> Add User</a> </li> 

                                                <?php endif; ?>    

                                                

                                                <li> <a href="<?php echo BASE_URL; ?>logout.php?action=logout"><i class="fa fa-sign-out"></i> Logout</a> </li>
                                            <?php else: ?>
                                                <li> <a href="<?php echo BASE_URL; ?>login.php"><i class="fa fa-sign-out"></i>Login</a> </li>
                                            <?php endif; ?>
                                        </ul>
                                    </li>
                                    <div class="clearfix"> </div>
                                </ul>
                            </div>		

                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <!--notification menu end -->
                </div>	
               