<?php
$path = realpath(dirname(__DIR__));
include_once $path . '../../classes/Session.php';
include_once $path . "../../classes/DB.php";
include_once $path . "../../classes/Printdata.php";
Session::checkSession();
$pri = new Printdata();
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
    <title>Payment Report - <?php echo date('Y-m-d h:i:sA'); ?></title>
    <link rel="stylesheet" href="../../assets/dist/css/print.css" type="text/css" media="screen">
    <link rel="stylesheet " href="../../assets/dist/css/print.css">
</head>

<body>
<div class="bt-div">
    <INPUT TYPE="button" class="button blue" title="Print" onClick="window.print()" value="Print">
    <button class="button blue" onclick="goBack()">Back</button>
</div>
<?php
?>

<div class="wraper">


    <?php if (isset($_POST['showallpayments'])): ?>


        <?php
        $starting = $_POST['starting'] . " 00:00:00";

        $ending = $_POST['ending'] . " 23:59:59";

        ?>
        <table width="100%" border="0" class="header">
            <tr>
                <td width="8%" align="left" valign="top"><a href="dashboard.php"><span class="user_panel "><img
                                    src="../../<?php echo Session::get('logo'); ?>" class="img_div" width="60"
                                    height="60" alt=""/></span></a></td>
                <td width="68%" height="67" align="left" valign="middle">
                    <div class="title-1"><?php echo Session::get('company_name'); ?></div>

                    <div class="title-3">All Payments Report
                        <br/>From <?php echo $help->formatDate($_POST['starting']); ?>
                        to <?php echo $help->formatDate($_POST['ending']); ?></div>

                </td>

            </tr>
        </table>


        <table class="TFtable" id="datatable">
            <thead style="text-align: center;">
            <tr>
                <th>Date</th>
                <th>Customer Name</th>
                <th>Payment Method</th>
                <th>Amount</th>
            </tr>
            </thead>
            <tbody>
            <?php

            $stmt = $db->link->query("SELECT p.date,tc.customer_name,p.amount,p.method FROM payment p join tbl_customer tc on p.customer_id = tc.customer_id WHERE  p.date BETWEEN '$starting' and '$ending'");
            if ($stmt) {
                $i = $amount = 0;
                while ($row = $stmt->fetch_assoc()) {
                    $i++;
                    $amount += $row['amount'];
                    ?>

                    <tr>
                        <td style="text-align: center;"><?php echo $help->formatDate($row['date']); ?></td>
                        <td><?php echo $row['customer_name']; ?></td>
                        <td><?php echo ucfirst($row['method']); ?></td>
                        <td style="text-align: center;"><?php echo round($row['amount']); ?></td>

                    </tr>

                <?php }
            } ?>
            <tr>
                <td colspan="3" style="text-align: center;"><strong>Total</strong></td>
                <td style="text-align: center;"><strong><?php echo $amount; ?></strong></td>
            </tr>
            </tbody>
        </table>
    <?php endif; ?>


    <?php if (isset($_POST['paymentcustomerwise'])): ?>


        <?php
        $starting = $_POST['starting'] . " 00:00:00";
        $ending = $_POST['ending'] . " 23:59:59";
        $customer_id = $_POST['customer_id'];

        ?>
        <table width="100%" border="0" class="header">
            <tr>
                <td width="8%" align="left" valign="top"><a href="dashboard.php"><span class="user_panel "><img
                                    src="../../<?php echo Session::get('logo'); ?>" class="img_div" width="60"
                                    height="60" alt=""/></span></a></td>
                <td width="68%" height="67" align="left" valign="middle">
                    <div class="title-1"><?php echo Session::get('company_name'); ?></div>

                    <div class="title-3">Payments Report By Customer
                        - <?php echo $db->link->query("select customer_name from tbl_customer where customer_id ='$customer_id'")->fetch_object()->customer_name; ?>
                        <br/>From <?php echo $help->formatDate($_POST['starting']); ?>
                        to <?php echo $help->formatDate($_POST['ending']); ?></div>

                </td>

            </tr>
        </table>


        <table class="TFtable" id="datatable">
            <thead style="text-align: center;">
            <tr>
                <th>Date</th>
                <th>Payment Method</th>
                <th>Amount</th>
            </tr>
            </thead>
            <tbody>
            <?php

            $stmt = $db->link->query("SELECT p.date,tc.customer_name,p.method,p.amount FROM payment p join tbl_customer tc on p.customer_id = tc.customer_id WHERE p.customer_id='$customer_id' and p.date BETWEEN '$starting' and '$ending'");
            if ($stmt) {
                $i = $amount = 0;
                while ($row = $stmt->fetch_assoc()) {
                    $i++;
                    $amount += $row['amount'];
                    ?>

                    <tr>
                        <td><?php echo $help->formatDate($row['date']); ?></td>
                        <td><?php echo ucfirst($row['method']); ?></td>
                        <td style="text-align: center;"><?php echo round($row['amount']); ?></td>

                    </tr>

                <?php }
            } ?>
            <tr>
                <td colspan="2" style="text-align: center;"><strong>Total</strong></td>
                <td style="text-align: center;"><strong><?php echo $amount; ?></strong></td>
            </tr>
            </tbody>
        </table>
    <?php endif; ?>


</div>

</body>
</html>