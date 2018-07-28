<?php
$path = realpath(dirname(__DIR__));
include_once $path . '../../classes/Session.php';
include_once "../../classes/Printdata.php";
include_once "../../classes/Laser.php";
Session::checkSession();
$pri = new Printdata();
$las = new Laser();
$db = new Database();
$help = new Helper();
date_default_timezone_set('Asia/Dhaka');
?>


<!DOCTYPE html>
<html>
    <head>
        <script>
            function goBack() {
                window.history.back();
            }
        </script>
        <meta charset="utf-8">
        <?php if (isset($_POST['showalltransaction'])):  ?>
            <title>সরবরাহকারী লেনদেন প্রতিবেদন - <?php echo date('Y-m-d h:i:sA'); ?></title>

        <?php elseif(isset($_POST['supplierstatement'])): ?>
            <title>Supplier Statement Report - <?php echo date('Y-m-d h:i:sA'); ?></title>
        <?php endif; ?>
        
        <link rel="stylesheet" href="../../assets/dist/css/print.css" type="text/css" media="screen">
        <link rel="stylesheet " href="../../assets/dist/css/print.css">
    </head>

    <body>
        <div class="bt-div">
            <INPUT TYPE="button" class="button blue" title="Print" onClick="window.print()" value="প্রিন্ট">
            <button class="button blue" onclick="goBack()">ফিরে যান</button>
        </div>
        

        <div class="wraper">
           <!--all ledger report start-->
            <?php if (isset($_POST['showalltransaction'])): ?>

                <table width="100%" border="0" class="header">
                   

                    <tr>
                        <td width="8%" align="left" valign="top"><a href="dashboard.php"><span class="user_panel "><img src="../../<?php echo Session::get('logo') ?>" class="img_div" width="60" height="60"  alt=""/></span></a></td>
                        <td width="68%" height="67" align="left" valign="middle"><div class="title-1"><?php echo Session::get('company_name'); ?></div>


                                <div class="title-3">সরবরাহকারী লেনদেন প্রতিবেদন </div><?php echo $_POST['starting']?> থেকে </div><?php echo $_POST['ending'];?> পর্যন্ত</div></td>
                                <?php 

                                    $starting = $_POST['starting']." 00:00:00";
                                    $ending = $_POST['ending']." 23:59:59";
                                    $stmt = $db->link->query("SELECT tst.*,ts.supplier_name from tbl_supplier_transaction tst join tbl_supplier ts on tst.supplier = ts.supplier_id where tst.date BETWEEN '$starting' and '$ending'");
                                    if ($stmt) {
                                        $data = $stmt->fetch_object();
                                        
                                    }
                                    
                                ?>
                            <td width="24%" align="right" valign="middle" nowrap="nowrap"><div class="title-2"></div></td>
                        </tr>
                    </table>
                    <div class="line-4"></div>
                    <div class="line-3"></div>

                    <table class="TFtable" id="datatable" >
                         <tr>
                            <th>তারিখ</th>
                            <th>সরবরাহকারী</th>
                            <th>বিস্তারিত</th>
                            <th>ক্রয়মূল্য</th>
                            <th>পেমেন্ট</th>
                            
                            
                        </tr>
                        <tbody style='text-align:center'>
                            <?php echo $pri->ShowAllSupplierTransaction($_POST['starting'],$_POST['ending']); ?>
                        </tbody>
                        
                    </table>
            <?php endif; ?>
            <!--all ledger report end-->


             <!--all ledger report start-->
            <?php if (isset($_POST['supplierstatement'])): ?>

                <table width="100%" border="0" class="header">
                   

                    <tr>
                        <td width="8%" align="left" valign="top"><a href="dashboard.php"><span class="user_panel "><img src="../../<?php echo Session::get('logo') ?>" class="img_div" width="60" height="60"  alt=""/></span></a></td>
                        <td width="68%" height="67" align="left" valign="middle"><div class="title-1"><?php echo Session::get('company_name'); ?></div>


                                <div class="title-3">সরবরাহকারী বিবৃতি প্রতিবেদন</div><?php echo $_POST['starting']?> থেকে </div><?php echo $_POST['ending'];?>পর্যন্ত<br/>
                                সরবরাহকারী: <?php 

                                    $supplier_id = $help->validAndEscape($_POST["supplier_id"]);
                                    $starting = $help->validAndEscape($_POST['starting']." 00:00:00");
                                    $ending = $help->validAndEscape($_POST['ending']." 23:59:59");

                                    $stmt = $db->link->query("select supplier_name from tbl_supplier where supplier_id='$supplier_id'");
                                    if ($stmt) {
                                       echo $stmt->fetch_assoc()['supplier_name']; 
                                    } 
                                  ?>
                                    
                            </div></td>
                                
                            <td width="24%" align="right" valign="middle" nowrap="nowrap"><div class="title-2"></div></td>
                        </tr>
                    </table>
                    <div class="line-4"></div>
                    <div class="line-3"></div>

                    <table class="TFtable" id="datatable" >
                         <tr>
                            <th>তারিখ</th>
                            <th>বিস্তারিত</th>
                            <th>ডেবিট</th>
                            <th>ক্রেডিট</th>
                            <th>ব্যালেন্স</th>
                            
                            
                        </tr>
                        <tbody style='text-align:center'>
                            <?php echo $pri->ShowSupplierStatement($_POST['starting'],$_POST['ending'],$supplier_id); ?>
                        </tbody>
                        
                    </table>
            <?php endif; ?>
            <!--all ledger report end-->


            

            

        </div>

    </body>
</html>