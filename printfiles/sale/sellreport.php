<?php
$path = realpath(dirname(__DIR__));
include_once $path . '/product/print.php';
include_once "../../classes/Printdata.php";
$pri = new Printdata();
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
    <title>::: Report of :::</title>
    <link rel="stylesheet" href="../../assets/css/print.css" type="text/css" media="screen">
    <link rel="stylesheet " href="../../assets/css/print.css">
</head>

<body>
<div class="bt-div">
    <INPUT TYPE="button" class="button blue" title="Print" onClick="window.print()" value="Print">
    <button class="button blue" onclick="goBack()">Back</button>
</div>


<div class="wraper">

    <!--all sales list-->
    <?php if (isset($_POST['showsellreport'])): ?>

    <table width="100%" border="0" class="header">


        <tr>
            <td width="8%" align="left" valign="top"><a href="dashboard.php"><span class="user_panel "><img
                                src="../../<?php echo Session::get('logo') ?>" class="img_div" width="60" height="60"
                                alt=""/></span></a></td>
            <td width="68%" height="67" align="left" valign="middle">
                <div class="title-1"><?php echo Session::get('company_name'); ?></div>


                <div class="title-3">Sales Report From</div><?php echo $_POST['starting'] ?> to
</div>
<?php echo $_POST['ending']; ?></div></td>
<?php

$starting = $_POST['starting'] . " 00:00:00";

$ending = $_POST['ending'] . " 23:59:59";

?>
<td width="24%" align="right" valign="middle" nowrap="nowrap">
    <div class="title-2">Total Products:
        (<?php echo $pri->TotalProducts("SELECT * FROM tbl_sell join tbl_sell_products on tbl_sell.sell_id = tbl_sell_products.sell_id JOIN tbl_product on tbl_sell_products.product_id = tbl_product.product_id where tbl_sell.date between '$starting' and '$ending'"); ?>
        )
    </div>
</td>
</tr>
</table>
<div class="line-4"></div>
<div class="line-3"></div>

<table class="TFtable" id="datatable">
    <tr>
        <th>Date</th>
        <th>Invoice</th>
        <th>Product ID</th>
        <th>Product Name</th>
        <th>Quantity</th>
        <th>Sale Price</th>
        <th>Sub Total</th>
    </tr>
    <tbody style='text-align:center'>
    <?php echo $pri->SellReportForsales($starting, $ending); ?>
    </tbody>

</table>
<?php endif; ?>


<!--all sales by group-->
<?php if (isset($_POST['sellreportbygroup'])): ?>

    <table width="100%" border="0" class="header">
        <?php

        $starting = $_POST['starting'] . " 00:00:00";
        $ending = $_POST['ending'] . " 23:59:59";
        $groupid = $_POST['groupid'];

        $groupname = $db->link->query("select groupname from tbl_group where groupid ='$groupid' limit 1")->fetch_object()->groupname;

        ?>

        <tr>
            <td width="8%" align="left" valign="top"><a href="dashboard.php"><span class="user_panel "><img
                                src="../../<?php echo Session::get('logo') ?>" class="img_div" width="60" height="60"
                                alt=""/></span></a></td>
            <td width="68%" height="67" align="left" valign="middle">
                <div class="title-1"><?php echo Session::get('company_name'); ?></div>


                <div class="title-3">Sales Report by Group - <?php echo $groupname; ?> </div>
                From <?php echo $_POST['starting'] ?> to </div><?php echo $_POST['ending']; ?></div></td>

            <td width="24%" align="right" valign="middle" nowrap="nowrap">
                <div class="title-2">Total Products:
                    (<?php echo $pri->TotalProducts("SELECT * FROM tbl_sell join tbl_sell_products on tbl_sell.sell_id = tbl_sell_products.sell_id JOIN tbl_product on tbl_sell_products.product_id = tbl_product.product_id where tbl_product.product_group='$groupid' and tbl_sell.date between '$starting' and '$ending'"); ?>
                    )
                </div>
            </td>
        </tr>
    </table>
    <div class="line-4"></div>
    <div class="line-3"></div>

    <table class="TFtable" id="datatable">
        <tr>
            <th>Date</th>
            <th>Invoice</th>
            <th>Product ID</th>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Sale Price</th>
            <th>Sub Total</th>
        </tr>
        <tbody style='text-align:center'>
        <?php echo $pri->SellReportByGroup($_POST['starting'], $_POST['ending'], $groupid); ?>
        </tbody>

    </table>
<?php endif; ?>


<!--all sales by brand-->
<?php if (isset($_POST['sellreportbybrand'])): ?>

    <table width="100%" border="0" class="header">
        <?php

        $starting = $_POST['starting'] . " 00:00:00";
        $ending = $_POST['ending'] . " 23:59:59";
        $brandid = $_POST['brandid'];

        $supplier_name = $db->link->query("select supplier_name from tbl_supplier where supplier_id ='$brandid' limit 1")->fetch_object()->supplier_name;

        ?>

        <tr>
            <td width="8%" align="left" valign="top"><a href="dashboard.php"><span class="user_panel "><img
                                src="../../<?php echo Session::get('logo') ?>" class="img_div" width="60" height="60"
                                alt=""/></span></a></td>
            <td width="68%" height="67" align="left" valign="middle">
                <div class="title-1"><?php echo Session::get('company_name'); ?></div>


                <div class="title-3">Sales Report by Supplier - <?php echo $supplier_name; ?></div>
                From <?php echo $_POST['starting'] ?> to </div><?php echo $_POST['ending']; ?></div></td>
            <?php


            ?>
            <td width="24%" align="right" valign="middle" nowrap="nowrap">
                <div class="title-2">Total Products:
                    (<?php echo $pri->TotalProducts("SELECT * FROM tbl_sell join tbl_sell_products on tbl_sell.sell_id = tbl_sell_products.sell_id JOIN tbl_product on tbl_sell_products.product_id = tbl_product.product_id where tbl_product.product_brand='$brandid' and tbl_sell.date between '$starting' and '$ending'"); ?>
                    )
                </div>
            </td>
        </tr>
    </table>
    <div class="line-4"></div>
    <div class="line-3"></div>

    <table class="TFtable" id="datatable">
        <tr>
            <th>Date</th>
            <th>Invoice</th>
            <th>Product ID</th>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Sale Price</th>
            <th>Sub Total</th>
        </tr>
        <tbody style='text-align:center'>
        <?php echo $pri->SellReportByBrand($_POST['starting'], $_POST['ending'], $brandid); ?>
        </tbody>

    </table>
<?php endif; ?>

<!--all sales by brand-->
<?php if (isset($_POST['sellreportbycustomer'])): ?>

    <table width="100%" border="0" class="header">
        <?php

        $starting = $_POST['starting'] . " 00:00:00";
        $ending = $_POST['ending'] . " 23:59:59";
        $customer_id = $_POST['customer_id'];

        $customer_name = $db->link->query("select customer_name from tbl_customer where customer_id ='$customer_id' limit 1")->fetch_object()->customer_name;

        ?>


        <tr>
            <td width="8%" align="left" valign="top"><a href="dashboard.php"><span class="user_panel "><img
                                src="../../<?php echo Session::get('logo') ?>" class="img_div" width="60" height="60"
                                alt=""/></span></a></td>
            <td width="68%" height="67" align="left" valign="middle">
                <div class="title-1"><?php echo Session::get('company_name'); ?></div>


                <div class="title-3">Sales Report By Customer - <?php echo $customer_name; ?></div>
                From <?php echo $_POST['starting'] ?> to </div><?php echo $_POST['ending']; ?></div></td>

            <td width="24%" align="right" valign="middle" nowrap="nowrap">
                <div class="title-2">Total Products:
                    (<?php echo $pri->TotalProducts("SELECT * FROM tbl_sell join tbl_sell_products on tbl_sell.sell_id = tbl_sell_products.sell_id JOIN tbl_product on tbl_sell_products.product_id = tbl_product.product_id where tbl_sell.customer_id='$customer_id' and tbl_sell.date between '$starting' and '$ending'"); ?>
                    )
                </div>
            </td>
        </tr>
    </table>
    <div class="line-4"></div>
    <div class="line-3"></div>

    <table class="TFtable" id="datatable">
        <tr>
            <th>Date</th>
            <th>Invoice</th>
            <th>Product ID</th>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Sale Price</th>
            <th>Sub Total</th>
        </tr>
        <tbody style='text-align:center'>
        <?php echo $pri->SellReportByCustomer($_POST['starting'], $_POST['ending'], $customer_id); ?>
        </tbody>

    </table>
<?php endif; ?>


<!--all sales by name-->
<?php if (isset($_POST['sellreportbyname'])): ?>

    <table width="100%" border="0" class="header">

        <?php

        $starting = $_POST['starting'] . " 00:00:00";
        $ending = $_POST['ending'] . " 23:59:59";
        $product_id = $_POST['product_id'];

        $product_name = $db->link->query("select product_name from tbl_product where product_id ='$product_id' limit 1")->fetch_object()->product_name;

        ?>

        <tr>
            <td width="8%" align="left" valign="top"><a href="dashboard.php"><span class="user_panel "><img
                                src="../../<?php echo Session::get('logo') ?>" class="img_div" width="60" height="60"
                                alt=""/></span></a></td>
            <td width="68%" height="67" align="left" valign="middle">
                <div class="title-1"><?php echo Session::get('company_name'); ?></div>


                <div class="title-3">Sales Report by Product - <?php echo $product_name; ?> </div>
                From <?php echo $_POST['starting'] ?> to </div><?php echo $_POST['ending']; ?></div></td>

            <td width="24%" align="right" valign="middle" nowrap="nowrap">
                <div class="title-2">Total Products:
                    (<?php echo $pri->TotalProducts("SELECT * FROM tbl_sell join tbl_sell_products on tbl_sell.sell_id = tbl_sell_products.sell_id JOIN tbl_product on tbl_sell_products.product_id = tbl_product.product_id join tbl_customer on tbl_sell_products.customer_id = tbl_customer.customer_id where tbl_product.product_id='$product_id' and tbl_sell.date between '$starting' and '$ending'"); ?>
                    )
                </div>
            </td>
        </tr>
    </table>
    <div class="line-4"></div>
    <div class="line-3"></div>

    <table class="TFtable" id="datatable">
        <tr>
            <th>Date</th>
            <th>Invoice</th>
            <th>Customer</th>
            <th>SalePrice</th>
            <th>Quantity</th>
            <th>Sub-Total</th>
        </tr>
        <tbody style='text-align:center'>
        <?php echo $pri->SellReportByProductName($_POST['starting'], $_POST['ending'], $product_id); ?>
        </tbody>

    </table>
<?php endif; ?>


</div>

</body>
</html>