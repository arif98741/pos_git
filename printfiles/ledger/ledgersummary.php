<?php
$path = realpath(dirname(__DIR__));
include_once $path .'../../classes/Session.php';
include_once $path."../../classes/Database.php";
include_once $path."../../classes/Printdata.php";
Session::checkSession();
$pri = new Printdata();
$db = new Database();
$help = new Helper();


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
        <title>Ledger Report - Summary</title>
        <link rel="stylesheet" href="../../assets/css/print.css" type="text/css" media="screen">
        <link rel="stylesheet " href="../../assets/css/print.css">
    </head>

    <body>
        <div class="bt-div">
            <INPUT TYPE="button" class="button blue" title="Print" onClick="window.print()" value="Print">
            <button class="button blue" onclick="goBack()">Back</button>
        </div>
        <?php
        ?>

        <div class="wraper">

            
                <table width="100%" border="0" class="header">
                    <tr>
                        <td width="8%" align="left" valign="top"><a href="dashboard.php"><span class="user_panel "><img src="../../<?php echo Session::get('logo'); ?>" class="img_div" width="60" height="60"  alt=""/></span></a></td>
                        <td width="68%" height="67" align="left" valign="middle"><div class="title-1"><?php echo Session::get('company_name'); ?></div>

                                <div class="title-3">Accounts Ledger Summary</div></td>
                            <td width="24%" align="right" valign="middle" nowrap="nowrap"><div class="title-2">Total: (<?php echo $pri->TotalProducts("select category,sum(debit) as 'debit',sum(credit) as 'credit',date from tbl_laser GROUP by category"); ?>) </div></td>
                        </tr>
                    </table>
                    <div class="line-4"></div>
                    <div class="line-3"></div>

                    <table class="TFtable" id="datatable" >
                      <thead style="text-align: center;">
                            <tr>
                                <th>Serial</th>
                                <th>Category</th>
                                <th>Debit</th>
                                <th>Credit</th>
                                <th>Date</th>
                            </tr>
                      </thead>
                      <tbody>
                          <?php 

                            $stmt = $db->link->query("select category,sum(debit) as 'debit',sum(credit) as 'credit',date from tbl_laser GROUP by category");
                            if ($stmt) {
                                $i = $debit = $credit = 0;
                               while ($row = $stmt->fetch_assoc()) {
                                     $i ++;
                                     $debit += $row['debit'];
                                     $credit += $row['credit'];
                                 ?>
                        
                                <tr>
                                    <td style="text-align: center;"><?php echo $i; ?></td>
                                    <td><?php echo $row['category']; ?></td>
                                    <td style="text-align: center;"><?php echo $row['debit']; ?></td>
                                    <td style="text-align: center;"><?php echo $row['credit']; ?></td>
                                    <td><?php echo $help->formatDate($row['date']); ?></td>
                                </tr>

                            <?php } } ?>
                                <tr>
                                    <td colspan="2" style="text-align: center;"><strong>Total</strong></td>
                                    <td style="text-align: center;"><strong><?php echo $debit; ?></strong></td>
                                    <td style="text-align: center;"><strong><?php echo $credit; ?></strong></td>
                                    <td></td>
                                </tr>
                      </tbody>
                    </table>

        </div>

    </body>
</html>