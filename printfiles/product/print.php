<?php
$path = realpath(dirname(__DIR__));
include_once $path . '../../classes/Session.php';
include_once $path . '/product/print.php';
include_once "../../classes/Printdata.php";
$pri = new Printdata();
$db = new Database();
Session::checkSession();
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
    <title>Product Reports - <?php echo date('Y-m-d h:i:s'); ?></title>
    <link rel="stylesheet" href="../../assets/dist/css/print.css" type="text/css" media="screen">
    <link rel="stylesheet " href="../../assets/dist/css/print.css">
</head>

<body>
<div class="bt-div">
    <INPUT TYPE="button" class="button blue" title="Print" onClick="window.print()" value="Print">
    <button class="button blue" onclick="goBack()">Back</button>
</div>


<div class="wraper">

    <?php if (isset($_POST['reportallproduct'])): ?>
        <table width="100%" border="0" class="header">
            <tr>
                <td width="8%" align="left" valign="top"><a href="dashboard.php"><span class="user_panel "><img
                                    src="../../<?php echo Session::get('logo') ?>" class="img_div" width="60"
                                    height="60" alt=""/></span></a></td>
                <td width="68%" height="67" align="left" valign="middle">
                    <div class="title-1"><?php echo Session::get('company_name'); ?></div>


                    <div class="title-3">All Products List Report</div>
                </td>
                <td width="24%" align="right" valign="middle" nowrap="nowrap">
                    <div class="title-2">Total Products:
                        (<?php echo $pri->TotalProducts("select * from tbl_product"); ?>)
                    </div>
                </td>
            </tr>
        </table>
        <div class="line-4"></div>
        <div class="line-3"></div>

        <table class="TFtable" id="datatable">
            <?php echo $pri->ProductReportbyAll(); ?>
        </table>
    <?php endif; ?>


    <?php if (isset($_POST['reportbygroup'])): ?>
        <table width="100%" border="0" class="header">
            <tr>
                <td width="8%" align="left" valign="top"><a href="dashboard.php"><span class="user_panel "><img
                                    src="../../<?php echo Session::get('logo') ?>" class="img_div" width="60"
                                    height="60" alt=""/></span></a></td>
                <td width="68%" height="67" align="left" valign="middle">
                    <div class="title-1"><?php echo Session::get('company_name'); ?></div>


                    <div class="title-3">Products Report By Group - <?php
                        $Groupname = $pri->PageTitleByCondition("select * from tbl_group WHERE groupid ={$_POST['product_group']}");
                        echo $Groupname['groupname'];
                        ?></div>
                </td>
                <td width="24%" align="right" valign="middle" nowrap="nowrap">
                    <div class="title-2">Total Products:
                        (<?php echo $pri->TotalProducts("select * from tbl_product where product_group = '{$_POST["product_group"]}'") ?>
                        )
                    </div>
                </td>
            </tr>
        </table>
        <div class="line-4"></div>
        <div class="line-3"></div>

        <table class="TFtable" id="datatable">
            <?php echo $pri->ProductReportbyGroup($_POST); ?>
        </table>
    <?php endif; ?>


    <?php if (isset($_POST['reportbybrand'])): ?>
        <table width="100%" border="0" class="header">
            <tr>
                <td width="8%" align="left" valign="top"><a href="dashboard.php"><span class="user_panel "><img
                                    src="../../<?php echo Session::get('logo') ?>" class="img_div" width="60"
                                    height="60" alt=""/></span></a></td>
                <td width="68%" height="67" align="left" valign="middle">
                    <div class="title-1"><?php echo Session::get('company_name'); ?></div>


                    <div class="title-3">Products Report By Supplier - <?php
                        $Brandname = $db->link->query("select * from tbl_supplier where supplier_id = {$_POST['supplier_id']}");
                        if ($Brandname) {
                            echo $Brandname->fetch_assoc()['supplier_name'];
                        }

                        ?>
                    </div>
                </td>
                <td width="24%" align="right" valign="middle" nowrap="nowrap">
                    <div class="title-2">Total Products:
                        (<?php echo $pri->TotalProducts("select * from tbl_product where product_brand = '{$_POST["supplier_id"]}'") ?>
                        )
                    </div>
                </td>
            </tr>
        </table>
        <div class="line-4"></div>
        <div class="line-3"></div>

        <table class="TFtable" id="datatable">
            <?php echo $pri->ProductReportbyBrand($_POST); ?>
        </table>
    <?php endif; ?>


</div>

</body>
</html>