<?php
$path = realpath(dirname(__DIR__));
include_once $path .'../../classes/Session.php';
include_once $path."../../classes/DB.php";
include_once $path."../../classes/Printdata.php";
Session::checkSession();
$pri = new Printdata();
$db = new Database();
$help = new Helper();
date_default_timezone_set('Asia/Dhaka');

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
        <title>ক্রেতা বিবৃতি প্রতিবেদন - <?php echo date('Y-m-d h:i:sA'); ?></title>
        <link rel="stylesheet" href="../../assets/dist/css/print.css" type="text/css" media="screen">
        <link rel="stylesheet " href="../../assets/dist/css/print.css">
    </head>

    <body>
        <div class="bt-div">
            <INPUT TYPE="button" class="button blue" title="Print" onClick="window.print()" value="প্রিন্ট">
            <button class="button blue" onclick="goBack()">ফিরে যান</button>
        </div>

        <div class="wraper">
              <?php
                    $starting = $_POST['starting']." 00:00:00";
                    $ending = $_POST['ending']." 23:59:59";
                    $customer_id = $_POST['customer_id'];
                    $customer_data = $db->link->query("SELECT * FROM tbl_customer tc JOIN customer_balance cb ON tc.customer_id = cb.customer_id where tc.customer_id='$customer_id'");
                    if ($customer_data) {
                        $customer_data = $customer_data->fetch_object();
                    }

                 ?>


                <table width="100%" border="0" class="header">
                    <tr>
                        <td width="8%" align="left" valign="top"><a href="dashboard.php"><span class="user_panel "><img src="../../<?php echo Session::get('logo'); ?>" class="img_div" width="60" height="60"  alt=""/></span></a></td>
                        <td width="68%" height="67" align="left" valign="middle"><div class="title-1"><?php echo Session::get('company_name'); ?></div>

                                <div class="title-3">ক্রেতা বিবৃতি প্রতিবেদন<br/>ক্রেতার নাম: <?php echo $customer_data->customer_name; ?><br/><?php echo $_POST['starting']; ?> থেকে  <?php echo $_POST['ending']; ?> পর্যন্ত</div></td>
                            
                        </tr>
                </table>
                    
                <table class="TFtable" id="datatable" >
                      <thead style="text-align: center;">
                            <tr>
                                <th>তারিখ</th>
                                <th>ইনভয়েচ. আইডি</th>
                                 <th>বিস্তারিত</th>
                                <th>ডেবিট</th>
                                <th>ক্রেডিট</th>
                                <th>ব্যালেন্স</th>
                                
                            </tr>
                      </thead>
                      <tbody>
                          <?php 

                        $stmt = $db->link->query("SELECT cb.* FROM customer_balancesheet cb JOIN tbl_customer tc on cb.Customer = tc.customer_id where cb.Customer = '$customer_id' and cb.date between '$starting' and '$ending' order by cb.date asc") or die($db->link->error).__LINE__;;
                            if ($stmt) {
                                $i = $debit = $credit = 0;
                              
                               while ($row = $stmt->fetch_assoc()) {
                                     $i ++;
                                     $debit += $row['Debit'];
                                     $credit += $row['Credit'];
                                 ?>
                        
                            <tr>
                                <td style="text-align: center;"><?php echo $help->formatDate($row['date']); ?></td>
                                <td style="text-align: center;"><?php echo $row['Ref']; ?></td>
                                
                                <td style="text-align: left;"><?php echo $row['Drescription']; ?></td>
                                <td style="text-align: center;"><?php echo round($row['Debit']); ?></td>
                                <td style="text-align: center;"><?php echo round($row['Credit']); ?></td>
                                <td style="text-align: center;"><?php echo $row['Balance']; ?></td>

                                
                            </tr>

                        <?php } } ?>
                            <tr>
                                <td colspan="3" style="text-align: right;"><strong>মোট</strong></td>
                                <td style="text-align: center;"><strong><?php echo round($debit); ?></strong></td>
                                <td style="text-align: center;"><strong><?php echo round($credit); ?></strong></td>
                                <td></td>
                            </tr>
                </tbody>
            </table>

        </div>

    </body>
</html>