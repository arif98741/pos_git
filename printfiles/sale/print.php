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
    <link rel="stylesheet" href="../../assets/dist/css/print.css" type="text/css" media="screen">
    <link rel="stylesheet " href="../../assets/dist/css/print.css">
</head>

<body>
<div class="bt-div">
    <INPUT TYPE="button" class="button blue" title="Print" onClick="window.print()" value="Print">
    <button class="button blue" onclick="goBack()">Back</button>
</div>


<div class="wraper">

    <?php if (isset($_POST['sellreportallproduct'])): ?>
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


                    <div class="title-3">Sales Report By all Products</div>
                </td>
                <td width="24%" align="right" valign="middle" nowrap="nowrap">
                    <div class="title-2">Total Products: (<?php echo $pri->TotalProducts("select * from tbl_sell"); ?>
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
                <th>Invoice ID</th>
                <th>Customer</th>
                <th>Total</th>
                <th>Due</th>
                <th>Date</th>
            </tr>
            <tbody style='text-align:center'>
            <?php echo $pri->SellReportByall($_POST['starting'], $_POST['ending']); ?>
            </tbody>

        </table>
    <?php endif; ?>


    <?php if (isset($_POST['sellreportbygroup'])): ?>
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


                    <div class="title-3">Sales Report by Group</div>
                </td>
                <td width="24%" align="right" valign="middle" nowrap="nowrap">
                    <div class="title-2">Total Products: (<?php echo $pri->TotalProducts("select * from tbl_sell"); ?>
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
                <th>Invoice ID</th>
                <th>Customer</th>
                <th>Total</th>
                <th>Due</th>
                <th>Date</th>
            </tr>
            <tbody style='text-align:center'>
            <?php echo $pri->SellReportBygroup($_POST['starting'], $_POST['ending'], $_POST); ?>
            </tbody>

        </table>
    <?php endif; ?>


    <?php if (isset($_POST['sellreportbytype'])): ?>
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


                    <div class="title-3">Sales Report by Product Type</div>
                </td>
                <td width="24%" align="right" valign="middle" nowrap="nowrap">
                    <div class="title-2">Total Products: (<?php echo $pri->TotalProducts("select * from tbl_sell"); ?>
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
                <th>Invoice ID</th>
                <th>Customer</th>
                <th>Total</th>
                <th>Due</th>
                <th>Date</th>
            </tr>
            <tbody style='text-align:center'>
            <?php echo $pri->SellReportBytype($_POST['starting'], $_POST['ending'], $_POST); ?>
            </tbody>

        </table>
    <?php endif; ?>


    <?php if (isset($_POST['sellreportbybrand'])): ?>
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


                    <div class="title-3">Sales Report by Product Brand</div>
                </td>
                <td width="24%" align="right" valign="middle" nowrap="nowrap">
                    <div class="title-2">Total Products: (<?php echo $pri->TotalProducts("select * from tbl_sell"); ?>
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
                <th>Invoice ID</th>
                <th>Customer</th>
                <th>Total</th>
                <th>Due</th>
                <th>Date</th>
            </tr>
            <tbody style='text-align:center'>
            <?php echo $pri->SellReportBybrand($_POST['starting'], $_POST['ending'], $_POST); ?>
            </tbody>

        </table>
    <?php endif; ?>


</div>

</body>
</html>