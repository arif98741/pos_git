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
    <title>Transaction Report - <?php echo date('Y-m-d h:i:sA'); ?></title>
    <link rel="stylesheet" href="../../assets/dist/css/print.css" type="text/css" media="screen">
    <link rel="stylesheet " href="../../assets/dist/css/print.css">
</head>

<body>
<div class="bt-div">
    <INPUT TYPE="button" class="button blue" title="Print" onClick="window.print()" value="Print">
    <button class="button blue" onclick="goBack()">Back</button>
</div>


<div class="wraper">
    <!--all ledger report start-->
    <?php if (isset($_POST['showalledgerreport'])): ?>

    <table width="100%" border="0" class="header">


        <tr>
            <td width="8%" align="left" valign="top"><a href="dashboard.php"><span class="user_panel "><img
                                src="../../<?php echo Session::get('logo') ?>" class="img_div" width="60" height="60"
                                alt=""/></span></a></td>
            <td width="68%" height="67" align="left" valign="middle">
                <div class="title-1"><?php echo Session::get('company_name'); ?></div>


                <div class="title-3">Transaction Report From</div><?php echo $_POST['starting'] ?> to
</div>
<?php echo $_POST['ending']; ?></div></td>
<?php

$starting = $_POST['starting'] . " 00:00:00";
$ending = $_POST['ending'] . " 23:59:59";
$stmt = $db->link->query("select sum(debit) as 'debit', sum(credit) as 'credit' from tbl_laser where date between '$starting' and '$ending'");
if ($stmt) {
    $data = $stmt->fetch_object();
    $balance = $data->debit - $data->credit;
}

?>
<td width="24%" align="right" valign="middle" nowrap="nowrap">
    <div class="title-2">Total: (<?php echo $balance; ?>)</div>
</td>
</tr>
</table>
<div class="line-4"></div>
<div class="line-3"></div>

<table class="TFtable" id="datatable">
    <tr>
        <th>Date</th>
        <th>Category</th>
        <th>Debit</th>
        <th>Credit</th>


    </tr>
    <tbody style='text-align:center'>
    <?php echo $pri->ShowAllLedgerReport($_POST['starting'], $_POST['ending']); ?>
    </tbody>

</table>
<?php endif; ?>
<!--all ledger report end-->


<!--all ledger reportby category start-->
<?php if (isset($_POST['ledgerreportbycategory'])): ?>
    <table width="100%" border="0" class="header">


        <tr>
            <td width="8%" align="left" valign="top"><a href="dashboard.php"><span class="user_panel "><img
                                src="../../<?php echo Session::get('logo') ?>" class="img_div" width="60" height="60"
                                alt=""/></span></a></td>
            <td width="68%" height="67" align="left" valign="middle">
                <div class="title-1"><?php echo Session::get('company_name'); ?></div>


                <div class="title-3">Transaction Report by Category
                    - <?php echo $las->showCategoryByID($_POST['category']); ?></div>
                From
                <?php echo $_POST['starting'] ?> to </div><?php echo $_POST['ending']; ?></div></td>
            <?php

            $starting = $_POST['starting'] . " 00:00:00";
            $ending = $_POST['ending'] . " 23:59:59";
            $category = $_POST['category'];
            $stmt = $db->link->query("select sum(debit) as 'debit', sum(credit) as 'credit' from tbl_laser where category='$category' and date between '$starting' and '$ending'");
            if ($stmt) {
                $data = $stmt->fetch_object();
                $balance = $data->debit - $data->credit;
            }

            ?>
            <td width="24%" align="right" valign="middle" nowrap="nowrap">
                <div class="title-2">Total: (<?php echo $balance; ?>)</div>
            </td>
        </tr>
    </table>
    <div class="line-4"></div>
    <div class="line-3"></div>

    <table class="TFtable" id="datatable">
        <tr>
            <th>Date</th>
            <th>Debit</th>
            <th>Credit</th>


        </tr>
        <tbody style='text-align:center'>
        <?php echo $pri->ledgerReportbyCategory($_POST['starting'], $_POST['ending'], $_POST['category']); ?>
        </tbody>

    </table>
<?php endif; ?>
<!--all ledger report by category end-->


<!--all ledger reportby payar start-->
<?php if (isset($_POST['ledgerreportbypayar'])): ?>
    <table width="100%" border="0" class="header">


        <tr>
            <td width="8%" align="left" valign="top"><a href="dashboard.php"><span class="user_panel "><img
                                src="../../<?php echo Session::get('logo') ?>" class="img_div" width="60" height="60"
                                alt=""/></span></a></td>
            <td width="68%" height="67" align="left" valign="middle">
                <div class="title-1"><?php echo Session::get('company_name'); ?></div>


                <div class="title-3">Transaction Report by Payar - <?php echo $_POST['payar']; ?></div>
                From
                <?php echo $_POST['starting'] ?> to </div><?php echo $_POST['ending']; ?></div></td>
            <?php

            $starting = $_POST['starting'] . " 00:00:00";
            $ending = $_POST['ending'] . " 23:59:59";
            $payar = $_POST['payar'];
            $stmt = $db->link->query("select sum(debit) as 'debit', sum(credit) as 'credit' from tbl_laser where payar='$payar' and date between '$starting' and '$ending'");
            if ($stmt) {
                $data = $stmt->fetch_object();
                $balance = $data->debit - $data->credit;
            }

            ?>
            <td width="24%" align="right" valign="middle" nowrap="nowrap">
                <div class="title-2">Total: (<?php echo $balance; ?>)</div>
            </td>
        </tr>
    </table>
    <div class="line-4"></div>
    <div class="line-3"></div>

    <table class="TFtable" id="datatable">
        <tr>
            <th>Date</th>
            <th>Category</th>
            <th>Receiver</th>
            <th>Debit</th>
            <th>Credit</th>


        </tr>
        <tbody style='text-align:center'>
        <?php echo $pri->ledgerReportbyPayar($_POST['starting'], $_POST['ending'], $_POST['payar']); ?>
        </tbody>

    </table>
<?php endif; ?>
<!--all ledger reportby payar end-->

<!--all ledger reportby receiver start-->
<?php if (isset($_POST['ledgerreportbyreceiver'])): ?>

    <table width="100%" border="0" class="header">


        <tr>
            <td width="8%" align="left" valign="top"><a href="dashboard.php"><span class="user_panel "><img
                                src="../../<?php echo Session::get('logo') ?>" class="img_div" width="60" height="60"
                                alt=""/></span></a></td>
            <td width="68%" height="67" align="left" valign="middle">
                <div class="title-1"><?php echo Session::get('company_name'); ?></div>


                <div class="title-3">Ledger Report by Reciver - <?php echo $_POST['receiver']; ?></div>
                From
                <?php echo $_POST['starting'] ?> to </div><?php echo $_POST['ending']; ?></div></td>
            <?php

            $starting = $_POST['starting'] . " 00:00:00";
            $ending = $_POST['ending'] . " 23:59:59";
            $receiver = $_POST['receiver'];
            $stmt = $db->link->query("select sum(debit) as 'debit', sum(credit) as 'credit' from tbl_laser where receiver='$receiver' and date between '$starting' and '$ending'");
            if ($stmt) {
                $data = $stmt->fetch_object();
                $balance = $data->debit - $data->credit;
            }

            ?>
            <td width="24%" align="right" valign="middle" nowrap="nowrap">
                <div class="title-2">Balance: (<?php echo $balance; ?>)</div>
            </td>
        </tr>
    </table>
    <div class="line-4"></div>
    <div class="line-3"></div>

    <table class="TFtable" id="datatable">
        <tr>
            <th>Date</th>
            <th>Category</th>
            <th>Payar</th>
            <th>Debit</th>
            <th>Credit</th>


        </tr>
        <tbody style='text-align:center'>
        <?php echo $pri->ledgerReportbyReceiver($_POST['starting'], $_POST['ending'], $_POST['receiver']); ?>
        </tbody>

    </table>
<?php endif; ?>
<!--all ledger reportby receiver end-->

<!--account summary report start-->
<?php if (isset($_POST['accountsummary'])): ?>

    <table width="100%" border="0" class="header">


        <tr>
            <td width="8%" align="left" valign="top"><a href="dashboard.php"><span class="user_panel "><img
                                src="../../<?php echo Session::get('logo') ?>" class="img_div" width="60" height="60"
                                alt=""/></span></a></td>
            <td width="68%" height="67" align="left" valign="middle">
                <div class="title-1"><?php echo Session::get('company_name'); ?></div>


                <div class="title-3">Account Summary</div>
                From
                <?php echo $_POST['starting'] ?> to </div><?php echo $_POST['ending']; ?></div></td>
            <?php

            $starting = $_POST['starting'] . " 00:00:00";
            $ending = $_POST['ending'] . " 23:59:59";
            $stmt = $db->link->query("select sum(debit) as 'debit', sum(credit) as 'credit' from tbl_laser");
            if ($stmt) {
                $data = $stmt->fetch_object();
                $balance = $data->debit - $data->credit;
            }

            ?>
            <td width="24%" align="right" valign="middle" nowrap="nowrap">
                <div class="title-2">Balance: (<?php echo $balance; ?>)</div>
            </td>
        </tr>
    </table>
    <div class="line-4"></div>
    <div class="line-3"></div>

    <table class="TFtable" id="datatable">
        <tr>
        <tr>
            <th>Date</th>
            <th>Category</th>
            <th>Debit</th>
            <th>Credit</th>
        </tr>

        </tr>
        <tbody>
        <?php

        $starting = $help->validAndEscape($_POST['starting'] . " 00:00:00");
        $ending = $help->validAndEscape($_POST['ending'] . " 23:59:59");
        $stmt = $db->link->query("select category,sum(debit) as 'debit',sum(credit) as 'credit',date,category_name from tbl_laser join tbl_transactioncat on tbl_laser.category = tbl_transactioncat.id where tbl_laser.date between '$starting' and '$ending' GROUP by tbl_laser.category ");
        if ($stmt) {
            $i = $debit = $credit = 0;
            while ($row = $stmt->fetch_assoc()) {
                $i++;
                $debit += $row['debit'];
                $credit += $row['credit'];
                ?>
                <tr>
                    <td><?php echo $help->formatDate($row['date']); ?></td>
                    <td><?php echo $row['category_name']; ?></td>
                    <td style="text-align: center;"><?php echo $row['debit']; ?></td>
                    <td style="text-align: center;"><?php echo $row['credit']; ?></td>
                </tr>

            <?php }
        } ?>
        <tr>
            <td colspan="2" style="text-align: center;"><strong>Total</strong></td>
            <td style="text-align: center;"><strong><?php echo $debit; ?></strong></td>
            <td style="text-align: center;"><strong><?php echo $credit; ?></strong></td>

        </tr>
        </tbody>

    </table>
<?php endif; ?>
<!--account summary report end-->


</div>

</body>
</html>