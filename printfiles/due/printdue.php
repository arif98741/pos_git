<?php
$path = realpath(dirname(__DIR__));
include_once $path . '/product/print.php';
include_once "../../classes/Printdata.php";
include_once "../../classes/Sell.php";
$pri = new Printdata();
$sel = new Sell();
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


    <table width="100%" border="0" class="header">
        <tr>
            <td width="8%" align="left" valign="top"><a href="dashboard.php"><span class="user_panel "><img src=""
                                                                                                            class="img_div"
                                                                                                            width="60"
                                                                                                            height="60"
                                                                                                            alt=""/></span></a>
            </td>
            <td width="68%" height="67" align="left" valign="middle">
                <div class="title-1">Point of Sales</div>


                <div class="title-3">All Products List Report</div>
            </td>
            <td width="24%" align="right" valign="middle" nowrap="nowrap">
                <div class="title-2">Total Products: (<?php echo $pri->TotalProducts("select ts.sell_id,ts.customer_id,ts.grand_total,ts.paid,tc.customer_name,ts.due,tc.contact_no,ts.date from tbl_sell ts join tbl_customer tc on 
            ts.customer_id = tc.customer_id order by ts.serial desc limit 1"); ?>)
                </div>
            </td>
        </tr>
    </table>
    <div class="line-4"></div>
    <div class="line-3"></div>

    <table class="table table-bordered" cellspacing="4" id="product_table" class="order-column" width="100%">
        <thead>
        <tr>
            <th>#SL</th>
            <th>Customer Name</th>
            <th>Customer No</th>
            <th>Address</th>
            <th>Balance</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $status = $sel->showduelist();

        if ($status) {
            $i = 0;
            while ($result = $status->fetch_assoc()) {
                $i++;
                ?>
                <tr style="text-align: center;" id="rowid-<?php echo $result['serial']; ?>">

                    <td><?php echo $i; ?></td>
                    <td><?php echo $result['customer_name']; ?></td>
                    <td><?php echo $result['contact_no']; ?></td>
                    <td><?php echo $result['address']; ?></td>
                    <td><?php echo $result['grand_total'] - $result['paid'] ?></td>


                </tr>

                <?php
            }
        } else {
            ?>

        <?php }
        ?>
        </tbody>

    </table>


</div>

</body>
</html>