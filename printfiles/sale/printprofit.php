<?php
$path = realpath(dirname(__DIR__));
include_once $path .'../../classes/Session.php';
include_once $path."../../classes/DB.php";
include_once $path."../../classes/Sell.php";
Session::checkSession();
$db = new Database();
$help = new Helper();
$sel = new Sell();
date_default_timezone_set("Asia/Dhaka");


?>

<?php if (Session::get('status') !== 'admin') {
    header("Location: ../../index.php");
}?>

<!DOCTYPE html>
<html>
    <head>
        <script>
            function goBack() {
                window.history.back();
            }
        </script>
        <meta charset="utf-8">
        <title>লাভ-ক্ষতি প্রতিবেদন - <?php echo date('Y-m-d h:i:sA'); ?></title>
        <link rel="stylesheet" href="../../assets/dist/css/print.css" type="text/css" media="screen">
        <link rel="stylesheet " href="../../assets/dist/css/print.css">
    </head>

    <body>
        <div class="bt-div">
            <INPUT TYPE="button" class="button blue" title="Print" onClick="window.print()" value="প্রিন্ট">
            <button class="button blue" onclick="goBack()">ফিরে যান</button>
        </div>
        <?php
        ?>

        <div class="wraper">

            
            <?php if(isset($_POST['showprofit'])):  ?>


                <?php
                    $starting = $_POST['starting']." 00:00:00";
                    $ending = $_POST['ending']." 23:59:59";

                 ?>
                <table width="100%" border="0" class="header">
                    <tr>
                        <td width="8%" align="left" valign="top"><a href="dashboard.php"><span class="user_panel "><img src="../../<?php echo Session::get('logo'); ?>" class="img_div" width="60" height="60"  alt=""/></span></a></td>
                        <td width="68%" height="67" align="left" valign="middle"><div class="title-1"><?php echo Session::get('company_name'); ?></div>

                                <div class="title-3">লাভ-ক্ষতি প্রতিবেদন <br/> <?php echo $help->formatDate($_POST['starting']); ?> থেকে <?php echo $help->formatDate($_POST['ending']); ?>পর্যন্ত</div>

                        </td>
                            
                        </tr>
                </table>
                   
                   
                <table class="TFtable" id="datatable" >
                    <thead>
                        <tr>
                            <th width="10%">তারিখ</th>
                            <th width="25%">ইনভয়েচ আইডি</th>
                            <th width="20%">বিক্রেতা</th>
                            <th width="20%">ক্রেতা</th>
                            <th width="25%">লাভ</th>
                        </tr>
                    </thead>
                  <tbody>
                      <?php 

                        $stmt = $db->link->query("SELECT * FROM `profit` WHERE date BETWEEN '$starting' and '$ending'");
                        if ($stmt) {

                            $i = $amount = 0;
                           while ($row = $stmt->fetch_assoc()) {
                                 $i ++;
                                 $amount += $row['profit'];
                             ?>
                    
                            <tr style="text-align: center;" id="rowid-<?php echo $row['serial']; ?>">
                                    <td><?php echo $help->formatDate($row['date'],'d-m-y'); ?></td>
                                    <td><?php echo $row['sell_id']; ?></td>
                                    <td style="text-align: left;"><?php echo $row['name']; ?></td>
                                    <td style="text-align: left;"><?php echo $row['customer_name']; ?></td>
                                    <td><?php echo number_format((float)$row['profit'], 2, '.', ''); ?></td>    

                            </tr>

                        <?php } } ?>
                            <tr>
                                <td colspan="4" style="text-align: center;"><strong>মোট</strong></td>
                               
                                <td style="text-align: center;"><strong><?php echo number_format((float)$amount, 2, '.', ''); ?></strong></td>
                            </tr>
                  </tbody>
                </table>
            <?php endif; ?>    


            <?php if(isset($_POST['showprofitproductwise'])):  ?>


                <?php
                    $starting = $_POST['starting']." 00:00:00";
                    $ending = $_POST['ending']." 23:59:59";
                    $product_id = $_POST['product_id'];

                 ?>
                <table width="100%" border="0" class="header">
                    <tr>
                        <td width="8%" align="left" valign="top"><a href="dashboard.php"><span class="user_panel "><img src="../../<?php echo Session::get('logo'); ?>" class="img_div" width="60" height="60"  alt=""/></span></a></td>
                        <td width="68%" height="67" align="left" valign="middle"><div class="title-1"><?php echo Session::get('company_name'); ?></div>

                                <div class="title-3">লাভ-ক্ষতি প্রতিবেদন  <br/> <?php echo $help->formatDate($_POST['starting']); ?> থেকে <?php echo $help->formatDate($_POST['ending']); ?> পর্যন্ত</div>
                                <div class="title-3">পণ্যের নাম - 
                                    <?php echo $db->link->query("select product_name from tbl_product where product_id ='$product_id'")->fetch_object()->product_name; ?>
                                </div>

                        </td>
                            
                        </tr>
                </table>
                   
                <table class="TFtable" id="datatable" >
                    <thead>
                        <tr>
                            <th width="10%">তারিখ</th>
                            <th width="25%">ইনভয়েচ আইডি</th>
                            <th width="20%">ক্রেতা</th>
                            <th width="25%">লাভ</th>
                        </tr>
                    </thead>
                  <tbody>
                      <?php 

                        $stmt = $db->link->query("SELECT * FROM `profit` WHERE product_id='$product_id' and date BETWEEN '$starting' and '$ending'");
                        if ($stmt) {
                            
                            $i = $amount = 0;
                           while ($row = $stmt->fetch_assoc()) {
                                 $i ++;
                                 $amount += $row['profit'];
                             ?>
                    
                            <tr style="text-align: center;" id="rowid-<?php echo $row['serial']; ?>">
                                    <td><?php echo $help->formatDate($row['date'],'d-m-y'); ?></td>
                                    <td><?php echo $row['sell_id']; ?></td>
                                    <td style="text-align: left;"><?php echo $row['customer_name']; ?></td>
                                    <td><?php echo number_format((float)$row['profit'], 2, '.', ''); ?></td>            
                            </tr>

                        <?php } } ?>
                            <tr>
                                <td colspan="3" style="text-align: center;"><strong>মোট</strong></td>
                                <td style="text-align: center;"><strong><?php echo number_format((float)$amount, 2, '.', ''); ?></strong></td>
                            </tr>
                  </tbody>
                </table>
            <?php endif; ?>    


           



        </div>

    </body>
</html>