<?php
session_start();
date_default_timezone_set('Asia/Dhaka');
$sell_id = $_GET['sell_id'];
$path = realpath(dirname(__DIR__));
include_once 'classes/DB.php';
include_once 'classes/Extra.php';
include 'classes/Session.php';
include_once 'helper/Helper.php';
if (!isset($_SESSION['login'])) {
    header('Location: login.php');
}
$db = new Database();
$ext = new Extra();
$help = new Helper();

if ($_GET['sell_id']) {
    $sell_id = $_GET['sell_id'];
    $seller = Session::get('userid');
    $update_by = Session::get('userid');
    $q = "SELECT ts.date  as 'selldate',tc.* from tbl_sell ts JOIN tbl_customer tc ON
            ts.customer_id = tc.customer_id where ts.sell_id ='$sell_id'";

    $company_stmt = $db->link->query("select * from tbl_user where userid='$seller'");
    if ($company_stmt) {
        $company_details = $company_stmt->fetch_object();

    }
    $stmt = $db->link->query($q);

    if ($stmt) {

        $inv_and_cus = $stmt->fetch_assoc();

    }
}

?>


<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <title>Invoice ID-<?php echo $sell_id; ?></title>

    <style type="text/css">

        body {

            background: #ccc;

            font-size: 14px;

        }

        .main {
            width: 900px;
            min-height: 1000px;
            padding-left: 50px;
            padding-right: 50px;
        }


        .header h1 {
            margin: 0px;
        }

        .break {
            background: #DBDDE0;
            margin-top: 0px;
            height: 7px;
        }

        .address {
        }

        .address h4 {
            text-align: center;
            margin: 0px;
            padding: 4px;
        }

        .page_title {
        }

        .page_title h2 {
            text-align: center;
        }

        .information {
            width: 100%;
        }

        .information_left {
            width: 50%;
            float: left;
        }

        .information_right {
            width: 50%;
            float: right;
        }

        .products_table {
        }

        .products_table table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #000;
        }

        .products_table table tr {
        }

        .products_table table tr th {
            border: 1px solid #000;
        }

        .products_table table tr td {
            border: 1px solid #000;
            text-align: center;
        }

        .calculation {
            width: 100%;
            overflow: hidden;
        }

        .calculation_left {
            width: 50%;
            float: left;
        }

        .calculation_right {
            width: 50%;
            float: right;
        }

        .footer_singature {
            width: 100%;
            margin-top: 50px;
            overflow: hidden;
        }

        .first_part {
            width: 25%;
            float: left;
        }

        .second_part {
            width: 25%;
            float: left;
            padding-left: 110px;
        }

        .third_part {
            width: 25%;
            float: right;
        }


        .command_section {

            text-align: center;

            margin-top: 20px;

        }

        .command_section span {


        }

        .command_section span input {

            padding: 5px;

            width: 50px;

            height: 30px;

            display: inline-block;

        }

    </style>
</head>

<body>

<div class="main" style="padding:10px; background: #fff; margin-top:5px; border:1px solid #FFE2D3; margin:0 auto;">

    <div class="header">

        <h1 style="text-align: center;"><?php echo Session::get('company_name'); ?></h1>

        <img src="">

    </div>

    <div class="break">

        <h1></h1>

    </div>

    <div class="address">

        <h4><?php echo $company_details->address; ?></h4>


    </div>

    <div class="page_title">

        <h2>Bill/Invoice</h2>

    </div>

    <?php


    if (isset($_POST['cus_id'])) {

        $cus_id = $_POST['cus_id'];

        $cus_single_q_st = $db->select("SELECT * FROM tbl_customer WHERE tbl_customer.customer_id ='$cus_id'");

        if ($cus_single_q_st) {

            $single_cus_r = $cus_single_q_st->fetch_assoc();

        }

    }

    ?>

    <div class="information">

        <div class="information_left">

            <table style="text-align: center;">

                <tr>

                    <td>Invoice No</td>

                    <td>:</td>

                    <td><strong><?php echo $sell_id; ?></strong></td>


                </tr>

                <tr>

                    <td>Date</td>

                    <td>:</td>

                    <td><?php echo $help->formatDate($inv_and_cus['selldate'], 'd-m-Y'); ?></td>


                </tr>

                <tr>

                    <td>Time</td>

                    <td>:</td>

                    <td><?php echo $help->formatDate($inv_and_cus['selldate'], 'h:i:s A'); ?></td>


                </tr>

                <tr>

                    <td>User</td>

                    <td>:</td>

                    <td><?php echo Session::get('name'); ?></td>


                </tr>


            </table>

        </div>

        <div class="information_right">

            <table>

                <tr>

                    <td>Customer ID</td>

                    <td>:</td>

                    <td><?php echo $inv_and_cus['customer_id']; ?></td>


                </tr>

                <tr>

                    <td>Name</td>

                    <td>:</td>

                    <td><?php echo $inv_and_cus['customer_name']; ?></td>


                </tr>

                <tr>

                    <td>Address</td>

                    <td>:</td>

                    <td><?php echo $inv_and_cus['address']; ?></td>


                </tr>

                <tr>

                    <td>Contact</td>

                    <td>:</td>

                    <td><?php echo $inv_and_cus['contact_no']; ?></td>


                </tr>


            </table>

        </div>

    </div>


    <div class="products_table">

        <table cellpadding="3">

            <thead>

            <tr>
                <th>SERIAL</th>
                <th>PROUDCT ID</th>
                <th>PRODUCT NAME</th>
                <th>QUANTITY</th>
                <th>PRICE</th>
                <th>SUBTOTAL</th>

            </tr>

            </thead>

            <tbody>

            <?php

            $update_q = "update tbl_sell_products set status = '1' where sell_id='$sell_id' and

                        customer_id='{$inv_and_cus['customer_id']}'";

            $update_q_st = $db->link->query($update_q);

            $q = "SELECT * FROM tbl_sell_products, tbl_product,tbl_group,tbl_type WHERE tbl_sell_products.product_id = tbl_product.product_id and tbl_sell_products.customer_id='{$inv_and_cus['customer_id']}' and tbl_group.groupid = tbl_product.product_group and tbl_sell_products.sell_id='$sell_id' AND tbl_product.product_type = tbl_type.typeid and tbl_sell_products.status='1' ORDER by tbl_sell_products.serial_no ASC";

            $q = "SELECT tsp.subtotal,tsp.unit_price,tsp.purchase_price,tsp.quantity,tp.product_id,tp.product_name FROM tbl_sell_products tsp join tbl_product tp on tsp.product_id = tp.product_id where tsp.sell_id='$sell_id' and tsp.status='1' order by tsp.serial_no asc";


            $st = $db->link->query($q);

            $i = 0;

            $total = 0;

            ?>

            <?php if ($st): ?>


                <?php while ($result = $st->fetch_assoc()): ?>

                    <?php

                    $i++;

                    $total += $result['subtotal'];

                    ?>

                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $result['product_id']; ?></td>
                        <td><?php echo $result['product_name']; ?></td>
                        <td><?php echo $result['quantity']; ?></td>
                        <td><?php echo number_format((float)$result['unit_price'], 2, '.', ''); ?></td>
                        <td><?php echo number_format((float)$result['subtotal'], 2, '.', ''); ?></td>


                    </tr>

                <?php endwhile; ?>


            <?php endif; ?>


            </tbody>


        </table>

    </div>

    <div class="calculation">

        <div class="calculation_right">


            <table width="100%" style="text-align: center;">


                <?php

                $stmt = $db->link->query("select * from tbl_sell where sell_id ='$sell_id'");

                if ($stmt) {

                    $invoice_data = $stmt->fetch_assoc();

                }

                ?>

                <tr>

                    <td width="303" align="right" nowrap="nowrap"><strong>Sub Total</strong></td>

                    <td width="10" nowrap="nowrap">:</td>

                    <td width="121" align="right" nowrap="nowrap">
                        <strong><?php echo $invoice_data['sub_total']; ?></strong></td>


                </tr>


                <tr>

                    <td align="right" nowrap="nowrap">DL.</td>

                    <td nowrap="nowrap">:</td>

                    <td align="right" nowrap="nowrap"> <?php echo $invoice_data['dlcharge']; ?></td>


                </tr>

                <tr>

                    <td align="right" nowrap="nowrap">VAT(%)</td>

                    <td nowrap="nowrap">:</td>

                    <td align="right" nowrap="nowrap"> <?php echo $invoice_data['vat']; ?></td>

                </tr>

                <tr>

                    <td align="right" nowrap="nowrap">Discount</td>

                    <td nowrap="nowrap">:</td>

                    <td align="right" nowrap="nowrap"><?php echo $invoice_data['discount']; ?></td>


                </tr>


                <tr>

                    <td align="right" nowrap="nowrap"><strong>PAYABLE</strong></td>

                    <td nowrap="nowrap">:</td>

                    <td align="right" nowrap="nowrap"><strong><?php echo round($invoice_data['payable']); ?></strong>
                    </td>

                </tr>


                <tr>

                    <td align="right" nowrap="nowrap">Paid</td>

                    <td nowrap="nowrap">:</td>

                    <td align="right" nowrap="nowrap"> <?php echo $invoice_data['paid']; ?></td>


                </tr>

                <tr>

                    <td align="right" nowrap="nowrap">DUE</td>

                    <td nowrap="nowrap">:</td>

                    <td align="right" nowrap="nowrap"><?php echo $invoice_data['due']; ?></td>

                </tr>

                <tr>

                    <td align="right" nowrap="nowrap">Previous Balance</td>

                    <td nowrap="nowrap">:</td>

                    <td align="right" nowrap="nowrap"> <?php echo round($invoice_data['previous_balance']); ?></td>

                </tr>

            </table>

        </div>

    </div>

    <div class="footer_singature">


        <div class="first_part">

            <hr/>

            <p>Customer's Signature</p>

        </div>

        <div class="second_part">

            <hr/>

            <p>Delivery Incharge/Manager</p>

        </div>

        <div class="third_part">

            <hr/>

            <p>For <?php echo Session::get('company_name'); ?></p>

        </div>

    </div>


    <div class="command_section">

                <span>

                    <a href="invoicelist.php" id="backbutton">Sell Product</a>

                    <button class="printbutton" id="printbutton" onclick="printFunction()"
                            style="background: #007fff; width: 100px; height: 30px;">Print</button>

                </span>

    </div>


</div>

<script>

    function printFunction() {

        var printButton = document.getElementById("printbutton");

        var backButton = document.getElementById('backbutton');

        backButton.style.visibility = 'hidden';

        printButton.style.visibility = 'hidden';

        window.print();

        printButton.style.visibility = 'visible';

        backButton.style.visibility = 'visible';

    }

</script>

<a href="invoicelist.php" class="btn btn-success">Back</a>

</body>


</html>
