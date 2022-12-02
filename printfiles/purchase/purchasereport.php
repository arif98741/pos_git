<?php
ob_start();

$path = realpath(dirname(__DIR__));
include_once $path . '/product/print.php';
include_once "../../classes/Session.php";
include_once "../../classes/Printdata.php";
include_once "../../classes/Product.php";

$pri = new Printdata();
$pro = new Product();
?>

<!DOCTYPE html class="hi">
<html>
<body>
<div class="bt-div">
    <INPUT TYPE="button" class="button blue" title="Print" onClick="window.print()" value="Print">
    <button class="button blue" onclick="goBack()">Back</button>
</div>


<div class="wraper">

    <?php if (isset($_POST['showallpurchase'])): ?>

    <table width="100%" border="0" class="header">


        <tr>
            <td width="8%" align="left" valign="top"><a href="dashboard.php"><span class="user_panel "><img
                                src="../../<?php echo Session::get('logo'); ?>" class="img_div" width="60" height="60"
                                alt=""/></span></a></td>
            <td width="68%" height="67" align="left" valign="middle">
                <div class="title-1"><?php echo Session::get('company_name'); ?></div>


                <div class="title-3">Purchase Report</div>
                From <?php echo $_POST['starting'] ?> to
</div>
<?php echo $_POST['ending']; ?></div></td>
<?php

$starting = $_POST['starting'] . " 00:00:00";
$ending = $_POST['ending'] . " 23:59:59";

?>
<td width="24%" align="right" valign="middle" nowrap="nowrap">
    <div class="title-2">Total Products:
        (<?php echo $pri->TotalProducts("SELECT DISTINCT ti.invoice_number, tg.groupname, tp.product_name, tss.supplier_name, ti.quantity, ti.subtotal, ti.date FROM tbl_invoice ti JOIN tbl_invoice_products tip ON ti.invoice_number = tip.invoice_id JOIN tbl_product tp ON tip.product_id = tp.product_id JOIN tbl_supplier tss ON tp.product_brand = tss.supplier_id JOIN tbl_group tg ON tp.product_group = tg.groupid WHERE ti.date BETWEEN '$starting' AND '$ending' GROUP BY (ti.serial) order by ti.serial desc"); ?>
        )
    </div>
</td>
</tr>
</table>
<div class="line-4"></div>
<div class="line-3"></div>

<table class="TFtable" id="datatable">
    <tr>
        <th>Serial</th>
        <th>Inv. No</th>
        <th>Group</th>
        <th>Product Name</th>
        <th>Supplier</th>
        <th>Purchase Price</th>
        <th>Quantity</th>
        <th>Subtotal</th>
        <th>Date</th>
    </tr>
    <tbody>
    <?php echo $pri->ShowAllPurchase($_POST['starting'], $_POST['ending']); ?>
    </tbody>

</table>
<?php endif; ?>




<?php if (isset($_POST['showpurchasebygroup'])): ?>

    <table width="100%" border="0" class="header">


        <tr>
            <td width="8%" align="left" valign="top"><a href="dashboard.php"><span class="user_panel "><img
                                src="../../<?php echo Session::get('logo'); ?>" class="img_div" width="60" height="60"
                                alt=""/></span></a></td>
            <td width="68%" height="67" align="left" valign="middle">
                <div class="title-1"><?php echo Session::get('company_name'); ?></div>
                <?php


                ?>

                <div class="title-3">Purchase Report by Group
                    - <?php echo $pro->showGroupById($_POST['groupid'])['groupname']; ?> <br/></div>
                From <?php echo $_POST['starting'] ?> to </div><?php echo $_POST['ending']; ?></div></td>
            <?php

            $starting = $_POST['starting'] . " 00:00:00";
            $ending = $_POST['ending'] . " 23:59:59";

            $groupid = $_POST['groupid'];

            ?>
            <td width="24%" align="right" valign="middle" nowrap="nowrap">
                <div class="title-2">Total Products:
                    (<?php echo $pri->TotalProducts("SELECT ti.invoice_number, tip.product_id, tg.groupname, tp.product_name, tu.supplier_name, tip.purchase as 'purchase_price', tip.quantity, tip.subtotal, ti.date FROM tbl_invoice_products tip JOIN tbl_invoice ti ON tip.invoice_id = ti.invoice_number JOIN tbl_product tp ON tip.product_id = tp.product_id JOIN tbl_group tg ON tp.product_group = tg.groupid JOIN tbl_supplier tu ON tp.product_brand = tu.supplier_id WHERE tg.groupid = '$groupid' and ti.date BETWEEN '$starting' AND '$ending' GROUP BY tip.product_id"); ?>
                    )
                </div>
            </td>
        </tr>
    </table>
    <div class="line-4"></div>
    <div class="line-3"></div>

    <table class="TFtable" id="datatable">
        <tr>
            <th>Serial</th>
            <th>Invoice Number</th>
            <th>Product Name</th>
            <th>Supplier</th>
            <th>Quantity</th>
            <th>Subtotal</th>
            <th>Date</th>
        </tr>
        <tbody>
        <?php echo $pri->ShowPurchaseByGroup($_POST['starting'], $_POST['ending'], $_POST['groupid']); ?>
        </tbody>

    </table>
<?php endif; ?>



<?php if (isset($_POST['showpurchasebybrand'])): ?>

    <table width="100%" border="0" class="header">


        <tr>
            <td width="8%" align="left" valign="top"><a href="dashboard.php"><span class="user_panel "><img
                                src="../../<?php echo Session::get('logo'); ?>" class="img_div" width="60" height="60"
                                alt=""/></span></a></td>
            <td width="68%" height="67" align="left" valign="middle">
                <div class="title-1"><?php echo Session::get('company_name'); ?></div>


                <div class="title-3">Purchase Report by Supplier
                    - <?php echo $pro->showBrandById($_POST['brandid'])['supplier_name']; ?> <br/></div>
                From <?php echo $_POST['starting'] ?> to </div><?php echo $_POST['ending']; ?></div></td>
            <?php

            $starting = $_POST['starting'] . " 00:00:00";
            $ending = $_POST['ending'] . " 23:59:59";

            $supplier_id = $_POST['brandid'];

            ?>
            <td width="24%" align="right" valign="middle" nowrap="nowrap">
                <div class="title-2">Total Products: (<?php echo $pri->TotalProducts("SELECT DISTINCT ti.invoice_number, tg.groupname, tp.product_name, tss.supplier_name, ti.quantity, ti.subtotal, ti.date FROM tbl_invoice ti JOIN tbl_invoice_products tip ON ti.invoice_number = tip.invoice_id JOIN tbl_product tp ON tip.product_id = tp.product_id JOIN tbl_supplier tss ON tp.product_brand = tss.supplier_id JOIN tbl_group tg ON tp.product_group = tg.groupid WHERE tss.supplier_id = '$supplier_id' and
                             ti.date BETWEEN '$starting' AND '$ending' GROUP BY (ti.serial) order by ti.serial desc"); ?>
                    )
                </div>
            </td>
        </tr>
    </table>
    <div class="line-4"></div>
    <div class="line-3"></div>

    <table class="TFtable" id="datatable">
        <tr>
            <th>Serial</th>
            <th>Invoice Number</th>
            <th>Group</th>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Subtotal</th>
            <th>Date</th>
        </tr>
        <tbody>
        <?php echo $pri->ShowPurchaseByBrand($_POST['starting'], $_POST['ending'], $_POST['brandid']); ?>
        </tbody>

    </table>
<?php endif; ?>

</div>

</body>
</html>