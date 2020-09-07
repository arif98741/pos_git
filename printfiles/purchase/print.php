<?php

$path = realpath(dirname(__DIR__));
include_once $path . '/product/print.php';
include_once "../../classes/Database.php";
include_once "../../classes/Printdata.php";
include_once $path."/classes/Invoice.php";
$pri = new Printdata();
$inv = new Invoice();
$db = new Databse();
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
        ?>

        <div class="wraper">

            <?php if (isset($_POST['purchasereportbyall'])): ?>
                <table width="100%" border="0" class="header">
                    <tr>
                        <td width="8%" align="left" valign="top"><a href="dashboard.php"><span class="user_panel "><img src="" class="img_div" width="60" height="60"  alt=""/></span></a></td>
                        <td width="68%" height="67" align="left" valign="middle"><div class="title-1">explore Point of Sales</div>

                                <div class="title-3">All Purchase Report</div></td>
                            <td width="24%" align="right" valign="middle" nowrap="nowrap"><div class="title-2">Total Purchased Products: (<?php echo $pri->TotalProducts("select * from tbl_invoice_products"); ?>) </div></td>
                        </tr>
                    </table>
                    <div class="line-4"></div>
                    <div class="line-3"></div>

                    <table class="TFtable" id="datatable" >
                      <thead style="text-align: center;">
                            <tr>
                                <th>Serial</th>
                                <th>Product Name</th>
                                <th>Group</th>
                                <th>Quantity</th>
                                <th>Piece</th>
                                <th>Purchase</th>
                                <th>Subtotal</th>
                                <th>Date</th>
                            </tr>
                      </thead>
                      <tbody>
                          
                      </tbody>
                    </table>
            <?php endif; ?>

            <?php if (isset($_POST['purchasereportbygroup'])): ?>

                <table width="100%" border="0" class="header">
                    <tr>
                        <td width="8%" align="left" valign="top"><a href="dashboard.php"><span class="user_panel "><img src="" class="img_div" width="60" height="60"  alt=""/></span></a></td>
                        <td width="68%" height="67" align="left" valign="middle"><div class="title-1">explore Point of Sales</div>

                            <div class="title-3">Purchase Report by Group -
                                <?php $g = $db->selectFetchAssoc("select * from tbl_group WHERE groupid = '{$_POST["product_group"]}'");
                                  echo $g['groupname'];?>
                            </div></td>
                        <td width="24%" align="right" valign="middle" nowrap="nowrap"><div class="title-2">Total Purchased Products: (<?php echo $pri->TotalProducts("select * from tbl_invoice,tbl_invoice_products,tbl_product,tbl_group WHERE tbl_invoice.invoice_number = tbl_invoice_products.invoice_id AND  tbl_invoice_products.product_id = tbl_product.product_id and tbl_product.product_group = tbl_group.groupid and tbl_group.groupid ='{$_POST["product_group"]}' ORDER by tbl_invoice_products.product_id"); ?>) </div></td>
                    </tr>
                </table>
                <div class="line-4"></div>
                <div class="line-3"></div>

                <table class="TFtable" id="datatable" >
                    <tbody style="text-align: center;">
                    <tr>
                        <th>Serial</th>
                        <th>Product ID</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Piece</th>
                        <th>Purchase</th>
                        <th>Subtotal</th>
                        <th>Date</th>
                    </tr>

                    <?php
                    $groupstmt = $db->select("select * from tbl_invoice,tbl_invoice_products,tbl_product,tbl_group WHERE tbl_invoice.invoice_number = tbl_invoice_products.invoice_id AND  tbl_invoice_products.product_id = tbl_product.product_id and tbl_product.product_group = tbl_group.groupid and tbl_group.groupid ='{$_POST["product_group"]}' ORDER by tbl_invoice_products.product_id");
                    if($groupstmt){
                        if($groupstmt->num_rows>0){
                            $i = 0;
                            while ($row = $groupstmt->fetch_assoc()){
                                $i++;
                                echo "<tr>";
                                echo "<td>".$i."</td>";
                                echo "<td>".$row['product_id']."</td>";
                                echo "<td>".$row['product_name']."</td>";
                                echo "<td>".$row['quantity']."</td>";
                                echo "<td>".$row['piece']."</td>";
                                echo "<td>".$row['purchase']."</td>";
                                echo "<td>".$row['subtotal']."</td>";
                                echo "<td>".$help->formatDate( $row['date'],"d-m-Y")."</td>";

                                echo "</tr>";
                            }
                        }
                    }

                    ?>


                    </tbody>


                </table>
            <?php endif; ?>


            <?php if (isset($_POST['purchasereportbybrand'])): ?>

                <table width="100%" border="0" class="header">
                    <tr>
                        <td width="8%" align="left" valign="top"><a href="dashboard.php"><span class="user_panel "><img src="" class="img_div" width="60" height="60"  alt=""/></span></a></td>
                        <td width="68%" height="67" align="left" valign="middle"><div class="title-1">explore Point of Sales</div>

                            <div class="title-3">Purchase Report by Brand -
                                <?php $b = $db->selectFetchAssoc("select * from tbl_brand WHERE brandid = '{$_POST["product_brand"]}'");
                                echo $b['brandname'];?>
                            </div></td>
                        <td width="24%" align="right" valign="middle" nowrap="nowrap"><div class="title-2">Total Purchased Products: (<?php echo $pri->TotalProducts("SELECT * FROM tbl_invoice,tbl_invoice_products,tbl_product,tbl_brand WHERE tbl_invoice.invoice_number = tbl_invoice_products.invoice_id AND tbl_invoice_products.product_id = tbl_product.product_id AND tbl_product.product_brand = tbl_brand.brandid AND tbl_brand.brandid = '{$_POST["product_brand"]}'"); ?>) </div></td>
                    </tr>
                </table>
                <div class="line-4"></div>
                <div class="line-3"></div>

                <table class="TFtable" id="datatable" >
                    <tbody style="text-align: center;">
                    <tr>
                        <th>Serial</th>
                        <th>Product ID</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Piece</th>
                        <th>Purchase</th>
                        <th>Subtotal</th>
                        <th>Date</th>
                    </tr>

                    <?php
                    $groupstmt = $db->select("SELECT * FROM tbl_invoice,tbl_invoice_products,tbl_product,tbl_brand WHERE tbl_invoice.invoice_number = tbl_invoice_products.invoice_id AND tbl_invoice_products.product_id = tbl_product.product_id AND tbl_product.product_brand = tbl_brand.brandid AND tbl_brand.brandid = '{$_POST['product_brand']}'  ORDER by tbl_invoice_products.product_id");
                    if($groupstmt){
                        if($groupstmt->num_rows>0){
                            $i = 0;
                            while ($row = $groupstmt->fetch_assoc()){
                                $i++;
                                echo "<tr>";
                                echo "<td>".$i."</td>";
                                echo "<td>".$row['product_id']."</td>";
                                echo "<td>".$row['product_name']."</td>";
                                echo "<td>".$row['quantity']."</td>";
                                echo "<td>".$row['piece']."</td>";
                                echo "<td>".$row['purchase']."</td>";
                                echo "<td>".$row['subtotal']."</td>";
                                echo "<td>".$help->formatDate( $row['date'],"d-m-Y")."</td>";

                                echo "</tr>";
                            }
                        }
                    }
                    ?>
                    </tbody>
                </table>
            <?php endif; ?>

           

        </div>

    </body>
</html>