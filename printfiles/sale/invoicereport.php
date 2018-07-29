<?php
ob_start();
$path = realpath(dirname(__DIR__));
include_once $path . '../../classes/Session.php';
include_once $path . '/product/print.php';
include_once "../../classes/Printdata.php";
$pri = new Printdata();
$help = new Helper();
$db = new Database();
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
        <tittle>Invoice Report</tittle>
        <link rel="stylesheet" href="../../assets/css/print.css" type="text/css" media="screen">
        <link rel="stylesheet " href="../../assets/css/print.css">
    </head>

    <body>
        <div class="bt-div">
            <INPUT TYPE="button" class="button blue" title="Print" onClick="window.print()" value="প্রিন্ট">
            <button class="button blue" onclick="goBack()">ফিরে যান</button>
        </div>
        

       
           <div class="wraper">

           <!--All Invoice Report-->
            <?php if (isset($_POST['showinvoicereport'])): ?>
                 
                <table width="100%" border="0" class="header">
                    <tr>
                        <td width="8%" align="left" valign="top"><a href="dashboard.php"><span class="user_panel "><img src="../../<?php echo Session::get('logo') ?>" class="img_div" width="60" height="60"  alt=""/></span></a></td>
                        <td width="68%" height="67" align="left" valign="middle"><div class="title-1"><?php echo Session::get('company_name'); ?></div>
                                <div class="title-3">বিক্রয় প্রতিবেদন </div><?php echo $_POST['starting']?> থেকে </div><?php echo $_POST['ending'];?> পর্যন্ত</div></td>
                                <?php 

                                    $start = $_POST['starting']." 00:00:00";
                                    $end = $_POST['ending']." 23:59:59";
                                    
                                ?>
                        <td width="24%" align="right" valign="middle" nowrap="nowrap"><div class="title-2">মোট পণ্য: (<?php echo $pri->TotalProducts("select distinct ts.*, tc.customer_name,tc.customer_id from tbl_sell ts join tbl_customer  tc
                                on ts.customer_id = tc.customer_id where ts.date between  '$start' and '$end'"); ?>) </div></td>
                        </tr>
                    </table>
                    <div class="line-4"></div>
                    <div class="line-3"></div>

                    <table class="TFtable" id="datatable" >
                         <tr>
                            <th>তারিখ</th>
                            <th>ইনভয়েচ</th>
                            <th>ক্রেতা</th>
                            <th>সাবটোটাল</th>
                            <th>ডিসকাউন্ট</th>
                            <th>ডেলিভারি চার্জ</th>
                            <th>ভ্যাট</th>
                            <th>পূর্ববর্তী ব্যালেন্স</th>
                            <th>পরিশোধযোগ্য</th>
                            <th>পরিশোধ</th>
                            <th>বকেয়া</th>
                            
                        </tr>
                        <tbody style='text-align:center'>
                            <?php echo $pri->SellReportForinvoice($_POST['starting'],$_POST['ending']); ?>
                        </tbody>
                        
                    </table>
                </table>    
            <?php endif; ?>



            <!--Invoice Report By Customer-->
            <?php if(isset($_POST['showinvoiceaccordingtocustomer'])): ?>
               <table width="100%" border="0" class="header">
                 <?php 

                    $start = $help->validAndEscape($_POST['starting']." 00:00:00");
                    $end = $help->validAndEscape($_POST['ending']." 23:59:59");
                    $customer_id = $help->validAndEscape($_POST['customer_id']);

                    $customer_name = $db->link->query("select * from tbl_customer where customer_id ='$customer_id' limit 1")->fetch_object()->customer_name;
                                    
                   ?>
                    <tr>
                        <td width="8%" align="left" valign="top"><a href="dashboard.php"><span class="user_panel "><img src="../../<?php echo Session::get('logo') ?>" class="img_div" width="60" height="60"  alt=""/></span></a></td>
                        <td width="68%" height="67" align="left" valign="middle"><div class="title-1"><?php echo Session::get('company_name'); ?></div>
                                <div class="title-3">বিক্রয় প্রতিবেদন ক্রেতা অনুযায়ী - <?php echo $customer_name; ?> <br/></div> <?php echo $_POST['starting']?> থেকে </div><?php echo $_POST['ending'];?>পর্যন্ত</div></td>
                               
                        <td width="24%" align="right" valign="middle" nowrap="nowrap"><div class="title-2">মোট পণ্য: (<?php echo $pri->TotalProducts("select distinct ts.*, tc.customer_name,tc.customer_id from tbl_sell ts join tbl_customer  tc
                                on ts.customer_id = tc.customer_id where ts.customer_id='$customer_id' and ts.date between  '$start' and '$end'"); ?>) </div></td>
                        </tr>
                    </table>
                    <div class="line-4"></div>
                    <div class="line-3"></div>

                    <table class="TFtable" id="datatable" >
                         <tr>
						 
							<th>তারিখ</th>
                            <th>ইনভয়েচ</th>
                            <th>সাবটোটাল</th>
                            <th>ডিসকাউন্ট</th>
                            <th>ডেলিভারি চার্জ</th>
                            <th>ভ্যাট</th>
                            <th>পূর্ববর্তী ব্যালেন্স</th>
                            <th>পরিশোধযোগ্য</th>
                            <th>পরিশোধ</th>
                            <th>বকেয়া</th>
                            
                        </tr>
                        <tbody style='text-align:center'>
                            <?php echo $pri->SellReportForinvoiceByCustomer($_POST['starting'],$_POST['ending'],$customer_id); ?>
                        </tbody>
                        
                    </table>
                </table>   


            <?php endif; ?>


        </div>

    </body>
</html>