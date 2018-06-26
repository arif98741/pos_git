<?php
ob_start();
include 'classes/Session.php';
include_once 'classes/Login.php';
Session::checkLogin();
$log = new Login();
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Point Of Sale Management</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="keywords" content="Easy Admin Panel Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
              Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
        <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
        <!-- Bootstrap Core CSS -->
        <link href="assets/css/bootstrap.min.css" rel='stylesheet' type='text/css' />
        <!-- Custom CSS -->
        <link href="assets/css/style.css" rel='stylesheet' type='text/css' />
        <!-- Graph CSS -->
        <link href="assets/css/font-awesome.css" rel="stylesheet"> 
        <!-- jQuery -->
        <!-- lined-icons -->
        <link rel="stylesheet" href="assets/css/icon-font.min.css" type='text/css' />
        <!-- //lined-icons -->
        <!-- chart -->
        <script src="assets/js/Chart.js"></script>
        <!-- //chart -->
        <!--animate-->
        <link href="assets/css/animate.css" rel="stylesheet" type="text/css" media="all">
        <script src="assets/js/wow.min.js"></script>
        <script>
            new WOW().init();
        </script>
        <!--//end-animate-->
        <!----webfonts--->
        <link href='//fonts.googleapis.com/css?family=Cabin:400,400italic,500,500italic,600,600italic,700,700italic' rel='stylesheet' type='text/css'>
        <!---//webfonts---> 
        <!-- Meters graphs -->
        <script src="assets/js/jquery-1.10.2.min.js"></script>
        <!-- Placed js at the end of the document so the pages load faster -->

    </head> 

    <body class="sign-in-up">
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $status = $log->login($_POST);
        }
        ?>
        <section>
            <div id="page-wrapper" class="sign-in-wrapper">
                <div class="graphs">
                    <div class="sign-in-form">
                        <div class="sign-in-form-top">
                            <p><span>Login </span> <a href="index.php">Panel</a></p>
                        </div>
                        <div class="signin">

                            <form role="form" action="" method="POST">
                                <div class="log-input">
                                    <div class="log-input-left">
                                        <input type="text" name="username" class="user" value="username" onfocus="this.value = '';" onblur="if (this.value == '') {
                                                    this.value = 'Username';
                                                }"/>
                                    </div>

                                    <div class="clearfix"> </div>
                                </div>
                                <div class="log-input">
                                    <div class="log-input-left">
                                        <input type="password" name="password" class="lock" value="password" onfocus="this.value = '';" onblur="if (this.value == '') {
                                                    this.value = 'Email address:';
                                                }"/>
                                    </div>

                                    <div class="clearfix"> </div>
                                </div>
                                <input type="submit" value="Login to your account">
                            </form>
                            <div class="card text-center">
                                <br/>
                                <?php
                                if (isset($status))
                                    echo $status;
                                ?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!--footer section start-->
            <footer>
                <p>&copy Copyright-explore-it 2018. All Rights Reserved</p>
            </footer>
            <!--footer section end-->
        </section>

        <script src="assets/js/jquery.nicescroll.js"></script>
        <script src="assets/js/scripts.js"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="assets/js/bootstrap.min.js"></script>
    </body>
</html>