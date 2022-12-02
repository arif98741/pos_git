<?php
$path = realpath(dirname(__DIR__));
include_once $path . '/product/print.php';
include_once "../../classes/Printdata.php";
$pri = new Printdata();
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
<?php

echo "<pre>";
print_r($_POST);
echo "</pre>";
?>

<div class="wraper">
    <?php if (isset($_POST['reportallproduct'])): ?>
        <table width="100%" border="0" class="header">
            <tr>
                <td width="8%" align="left" valign="top"><a href="dashboard.php"><span class="user_panel "><img src=""
                                                                                                                class="img_div"
                                                                                                                width="60"
                                                                                                                height="60"
                                                                                                                alt=""/></span></a>
                </td>
                <td width="68%" height="67" align="left" valign="middle">
                    <div class="title-1">Didar Tiles and Factory Ltd</div>


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
            <?php echo $pri->ProductReportbyAll($_POST['starting'], $_POST['ending']); ?>
        </table>
    <?php endif; ?>


    <?php if (isset($_POST['reportbygroup'])): ?>
        <table width="100%" border="0" class="header">
            <tr>
                <td width="8%" align="left" valign="top"><a href="dashboard.php"><span class="user_panel "><img src=""
                                                                                                                class="img_div"
                                                                                                                width="60"
                                                                                                                height="60"
                                                                                                                alt=""/></span></a>
                </td>
                <td width="68%" height="67" align="left" valign="middle">
                    <div class="title-1">Didar Tiles and Factory Ltd</div>


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

    <?php if (isset($_POST['reportbytype'])): ?>
        <table width="100%" border="0" class="header">
            <tr>
                <td width="8%" align="left" valign="top"><a href="dashboard.php"><span class="user_panel "><img src=""
                                                                                                                class="img_div"
                                                                                                                width="60"
                                                                                                                height="60"
                                                                                                                alt=""/></span></a>
                </td>
                <td width="68%" height="67" align="left" valign="middle">
                    <div class="title-1">Didar Tiles and Factory Ltd</div>

                    <div class="title-3">Products Report By Type - <?php
                        $Typename = $pri->PageTitleByCondition("select * from tbl_type WHERE typeid ={$_POST['product_type']}");
                        echo $Typename['typename'];
                        ?></div>
                </td>
                <td width="24%" align="right" valign="middle" nowrap="nowrap">
                    <div class="title-2">Total Products:
                        (<?php echo $pri->TotalProducts("select * from tbl_product where product_type = '{$_POST["product_type"]}'") ?>
                        )
                    </div>
                </td>
            </tr>
        </table>
        <div class="line-4"></div>
        <div class="line-3"></div>

        <table class="TFtable" id="datatable">
            <?php echo $pri->ProductReportbyType($_POST); ?>
        </table>
    <?php endif; ?>


    <?php if (isset($_POST['reportbybrand'])): ?>
        <table width="100%" border="0" class="header">
            <tr>
                <td width="8%" align="left" valign="top"><a href="dashboard.php"><span class="user_panel "><img src=""
                                                                                                                class="img_div"
                                                                                                                width="60"
                                                                                                                height="60"
                                                                                                                alt=""/></span></a>
                </td>
                <td width="68%" height="67" align="left" valign="middle">
                    <div class="title-1">Didar Tiles and Factory Ltd</div>


                    <div class="title-3">Products Report By Brand - <?php
                        $Brandname = $pri->PageTitleByCondition("select * from tbl_brand where brandid = {$_POST['product_brand']}");
                        echo $Brandname['brandname'];
                        ?>
                    </div>
                </td>
                <td width="24%" align="right" valign="middle" nowrap="nowrap">
                    <div class="title-2">Total Products:
                        (<?php echo $pri->TotalProducts("select * from tbl_product where product_brand = '{$_POST["product_brand"]}'") ?>
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