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
    <title>Stock Report - <?php echo date('Y-m-d h:i:s'); ?></title>
    <link rel="stylesheet" href="../../assets/dist/css/print.css" type="text/css" media="screen">
    <link rel="stylesheet " href="../../assets/dist/css/print.css">
</head>

<body>
<div class="bt-div">
    <INPUT TYPE="button" class="button blue" title="Print" onClick="window.print()" value="Print">
    <button class="button blue" onclick="goBack()">Back</button>
</div>

<?php if (isset($_POST['allstock'])) : ?>

    <div class="wraper">


        <table width="100%" border="0" class="header">
            <tr>
                <td width="8%" align="left" valign="top"><a href="dashboard.php"><span class="user_panel "><img
                                    src="../../<?php echo Session::get('logo'); ?>" class="img_div" width="60"
                                    height="60" alt=""/></span></a></td>
                <td width="68%" height="67" align="left" valign="middle">
                    <div class="title-1"><?php echo Session::get('company_name'); ?></div>

                    <div class="title-3">Stock Report </br></div>
                </td>
                <td width="24%" align="right" valign="middle" nowrap="nowrap">
                    <div class="title-2"></div>
                </td>
            </tr>
        </table>

        <table class="TFtable" id="datatable">
            <thead style="text-align: center;">
            <tr>
                <th>Serial</th>
                <th>Pro. ID</th>
                <th>Group</th>
                <th>Product Name</th>
                <th>Sale Price</th>
                <th>Purchase Price</th>
                <th>Current Stock</th>
                <th>Sell Value</th>
                <th>Stock Value</th>
            </tr>
            </thead>
            <tbody>
            <?php

            $stmt = $db->link->query("SELECT * from stock LEFT JOIN tbl_product ON stock.product_id = tbl_product.product_id INNER JOIN tbl_group ON tbl_product.product_group = tbl_group.groupid");
            if ($stmt) {
                $i = $sell_value = $purchase_value = $current_stock = 0;
                while ($row = $stmt->fetch_assoc()) {
                    $i++;
                    $sell_value += $row['sale_price'] * $row['stock'];
                    $purchase_value += $row['purchase_price'] * $row['stock'];
                    $current_stock += $row['stock'];
                    ?>

                    <tr>
                        <td><?php echo ++$i; ?></td>
                        <td><?php echo $row['product_id']; ?></td>
                        <td style="text-align: left;"><?php echo $row['groupname']; ?></td>
                        <td style="text-align: left;"><?php echo $row['product_name']; ?></td>

                        <td style="text-align: center;"><?php echo $row['sale_price']; ?></td>
                        <td style="text-align: center;"><?php echo $row['purchase_price']; ?></td>
                        <td style="text-align: center;"><?php echo $row['stock']; ?></td>
                        <td style="text-align: center;"><?php echo $row['sale_price'] * $row['stock']; ?></td>
                        <td style="text-align: center;"><?php echo $row['purchase_price'] * $row['stock']; ?></td>

                    </tr>

                <?php }
            } ?>
            <tr>
                <td colspan="6" style="text-align: center;"><strong>Total</strong></td>
                <td style="text-align: center;"><strong><?php echo round($current_stock); ?></strong></td>
                <td style="text-align: center;"><strong><?php echo round($sell_value); ?></strong></td>
                <td style="text-align: center;"><strong><?php echo round($purchase_value); ?></strong></td>

            </tr>
            </tbody>
        </table>

    </div>

<?php endif; ?>


<?php if (isset($_POST['stockbysupplier'])) : ?>

    <div class="wraper">
        <?php

        $supplier_id = $_POST['supplier_id'];
        $stmt = $db->link->query("select * from tbl_supplier where supplier_id='$supplier_id'");
        if ($stmt) {
            $supplier_data = $stmt->fetch_object();
        }

        ?>


        <table width="100%" border="0" class="header">
            <tr>
                <td width="8%" align="left" valign="top"><a href="dashboard.php"><span class="user_panel "><img
                                    src="../../<?php echo Session::get('logo'); ?>" class="img_div" width="60"
                                    height="60" alt=""/></span></a></td>
                <td width="68%" height="67" align="left" valign="middle">
                    <div class="title-1"><?php echo Session::get('company_name'); ?></div>

                    <div class="title-3">Stock Report by Supplier
                        - <?php echo $supplier_data->supplier_name; ?></br></div>
                </td>
                <td width="24%" align="right" valign="middle" nowrap="nowrap">
    </div></td>
    </tr>
    </table>

    <table class="TFtable" id="datatable">
        <thead style="text-align: center;">
        <tr>
            <th>Serial</th>
            <th>Pro. ID</th>
            <th>Group</th>
            <th>Product Name</th>
            <th>Sale Price</th>
            <th>Purchase Price</th>
            <th>Current Stock</th>
            <th>Sell Value</th>
            <th>Stock Value</th>
        </tr>
        </thead>
        <tbody>
        <?php

        $stmt = $db->link->query("SELECT * from stock LEFT JOIN tbl_product ON stock.product_id = tbl_product.product_id INNER JOIN tbl_group ON tbl_product.product_group = tbl_group.groupid");
        if ($stmt) {
            $i = $sell_value = $purchase_value = $current_stock = 0;
            while ($row = $stmt->fetch_assoc()) {
                $i++;
                $sell_value += $row['sale_price'] * $row['stock'];
                $purchase_value += $row['purchase_price'] * $row['stock'];
                $current_stock += $row['stock'];
                ?>

                <tr>
                    <td><?php echo ++$i; ?></td>
                    <td><?php echo $row['product_id']; ?></td>
                    <td style="text-align: left;"><?php echo $row['groupname']; ?></td>
                    <td style="text-align: left;"><?php echo $row['product_name']; ?></td>

                    <td style="text-align: center;"><?php echo $row['sale_price']; ?></td>
                    <td style="text-align: center;"><?php echo $row['purchase_price']; ?></td>
                    <td style="text-align: center;"><?php echo $row['stock']; ?>

                    </td>
                    <td style="text-align: center;"><?php echo $row['sale_price'] * $row['stock']; ?></td>
                    <td style="text-align: center;"><?php echo $row['purchase_price'] * $row['stock']; ?></td>

                </tr>

            <?php }
        } ?>
        <tr>
            <td colspan="6" style="text-align: center;"><strong>Total</strong></td>

            <td style="text-align: center;"><strong><?php echo $current_stock; ?></strong></td>
            <td style="text-align: center;"><strong><?php echo round($sell_value); ?></strong></td>
            <td style="text-align: center;"><strong><?php echo round($purchase_value); ?></strong></td>

        </tr>
        </tbody>
    </table>

    </div>

<?php endif; ?>


<?php if (isset($_POST['stockbygroup'])) : ?>

    <div class="wraper">
        <?php

        $groupid = $_POST['groupid'];
        $stmt = $db->link->query("select * from tbl_group where groupid='$groupid'");
        if ($stmt) {
            $groupdata = $stmt->fetch_object();
        }

        ?>


        <table width="100%" border="0" class="header">
            <tr>
                <td width="8%" align="left" valign="top"><a href="dashboard.php"><span class="user_panel "><img
                                    src="../../<?php echo Session::get('logo'); ?>" class="img_div" width="60"
                                    height="60" alt=""/></span></a></td>
                <td width="68%" height="67" align="left" valign="middle">
                    <div class="title-1"><?php echo Session::get('company_name'); ?></div>

                    <div class="title-3">Stock Report by Group - <?php echo $groupdata->groupname; ?></br></div>
                </td>
                <td width="24%" align="right" valign="middle" nowrap="nowrap">
    </div></td>
    </tr>
    </table>

    <table class="TFtable" id="datatable">
        <thead style="text-align: center;">
        <tr>
            <th>Serial</th>
            <th>Pro. ID</th>
            <th>Product Name</th>
            <th>Sale Price</th>
            <th>Purchase Price</th>
            <th>Current Stock</th>
            <th>Sell Value</th>
            <th>Stock Value</th>
        </tr>
        </thead>
        <tbody>
        <?php

        $stmt = $db->link->query("SELECT * from stock LEFT JOIN tbl_product ON stock.product_id = tbl_product.product_id INNER JOIN tbl_group ON tbl_product.product_group = tbl_group.groupid");
        if ($stmt) {
            $i = $sell_value = $purchase_value = $stockamount = 0;
            while ($row = $stmt->fetch_assoc()) {
                $i++;
                $sell_value += $row['sale_price'] * $row['stock'];
                $purchase_value += $row['purchase_price'] * $row['stock'];
                $stockamount += $row['stock'];
                ?>

                <tr>
                    <td><?php echo ++$i; ?></td>
                    <td><?php echo $row['product_id']; ?></td>
                    <td style="text-align: left;"><?php echo $row['product_name']; ?></td>
                    <td style="text-align: center;"><?php echo $row['sale_price']; ?></td>
                    <td style="text-align: center;"><?php echo $row['purchase_price']; ?></td>
                    <td style="text-align: center;"><?php echo $row['stock']; ?></td>
                    <td style="text-align: center;"><?php echo $row['sale_price'] * $row['stock']; ?></td>
                    <td style="text-align: center;"><?php echo $row['purchase_price'] * $row['stock']; ?></td>

                </tr>

            <?php }
        } ?>
        <tr>
            <td colspan="5" style="text-align: center;"><strong>Total</strong></td>

            <td style="text-align: center;"><strong><?php echo round($stockamount); ?></strong></td>
            <td style="text-align: center;"><strong><?php echo round($sell_value); ?></strong></td>
            <td style="text-align: center;"><strong><?php echo round($purchase_value); ?></strong></td>

        </tr>
        </tbody>
    </table>

    </div>

<?php endif; ?>

</body>
</html>