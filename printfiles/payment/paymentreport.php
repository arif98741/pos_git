<?php
$path = realpath(dirname(__DIR__));
include_once $path .'../../classes/Session.php';
include_once $path."../../classes/DB.php";
include_once $path."../../helper/Helper.php";
Session::checkSession();
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
        <title>Student Report - <?php echo date('Y-m-d h:i:sA'); ?></title>
        <link rel="stylesheet" href="../../assets/dist/css/print/print.css" type="text/css" media="screen">
        <link rel="stylesheet " href="../../assets/dist/css/print/print.css">
    </head>
<?php if(isset($_POST['paymentreportbydate'])): ?>

    <body>
        <div class="bt-div">
            <INPUT TYPE="button" class="button blue" title="Print" onClick="window.print()" value="Print">
            <button class="button blue" onclick="goBack()">Back</button>
        </div>

        <div class="wraper">
             
                <table width="100%" border="0" class="header">
                    <tr>
                        <td width="8%" align="left" valign="top"><a href="dashboard.php"></a></td>
                        <td width="68%" height="67" align="left" valign="middle">
                                    
                                <div class="title-3">
                                      <h2 style="margin:0px;">75 Years Celebration - CGSA College</h2>  
                                    Payment Report <br/>
                                    From <?php echo $help->formatDate( $_POST['starting']); ?>  to <?php echo $help->formatDate( $_POST['ending']);  ?> <br/>

                                </div></td>
                            
                        </tr>
                </table>
                    
                <table class="TFtable" id="datatable" >
                      <thead style="text-align: center;">
                            <tr>
                                <th>Serial</th>
                                <th>Name</th>
                                <th>Batch</th>
                                <th>Transaction ID</th>
                                <th>Method</th>
                                <th>Amount</th>
                                <th>Date</th>
                            </tr>
                      </thead>
                      <tbody>
                          <?php 
                           $starting = $_POST['starting']." 00:00:00";
                           $ending = $_POST['ending']." 23:59:59";

                        //$stmt = $db->link->query("SELECT * from ledger join registration on registration.id = ledger.registant_id where registration.status='approved' and ledger.status='active' and  ledger.date between '$starting' and '$ending'");
                        $stmt = $db->link->query("SELECT * from ledger  join registration on ledger.registant_id = registration.id where ledger.date between '$starting' and '$ending'");

                            if ($stmt) { $i = $total = 0;;
                                
                               while ($row = $stmt->fetch_assoc()) {
                                $i++;
                                $total += $row['amount']; 
                                  
                                 ?>
                            <tr>
                                
                                <td style="text-align: center;"><?php echo $i; ?></td>
                                <td style="text-align: center;"><?php echo $row['fullname']; ?></td>
                                <td style="text-align: center;"><?php echo $row['batchyear']; ?></td>

                                <td style="text-align: center;"><?php echo $row['transaction_id']; ?></td>
                                <td style="text-align: center;"><?php echo strtoupper($row['method']); ?></td>
                                <td style="text-align: center;"><?php echo $row['amount']; ?></td>
                                <td style="text-align: center;"><?php echo $help->formatDate($row['date']); ?></td>
                                
                            </tr>
                           

                        <?php } } ?>
                         <tr>
                                <td colspan="5" style="text-align: center;"><strong>Total</strong></td>
                                <td style="text-align: center;"><strong><?php echo $total; ?>/=</strong></td>
                                <td></td>
                            </tr>
                            
                </tbody>
            </table>

        </div>

    </body>

<?php endif; ?>




</html>