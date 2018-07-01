
<?php
session_start();
date_default_timezone_set('Asia/Dhaka');
$sell_id = $_GET['sell_id'];
$path = realpath(dirname(__DIR__));
include_once 'classes/DB.php';
include  'classes/Session.php';
include_once  'helper/Helper.php';
$db = new Database();
$help = new Helper();


if($_GET['sell_id']){
    $sell_id = $_GET['sell_id'];
    $seller = Session::get('userid');
    $update_by = Session::get('userid');

    $q= "SELECT * from tbl_sell JOIN tbl_customer ON
            tbl_sell.customer_id = tbl_customer.customer_id where tbl_sell.sell_id ='$sell_id'";
    $stmt = $db->link->query($q);
    if($stmt){
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
            body{
                background: #ccc;
                font-size: 14px;
            }
            .main{
                width: 900px;
                min-height: 1000px;
                padding-left: 50px;
                padding-right: 50px;

            }
            .header {

            }
            .header h1{
                margin: 0px;
            }
            .break{
                background: #DBDDE0;
                margin-top:0px;
                height: 7px;
            }
            .address{

            }
            .address h4{
                text-align: center;
                margin: 0px;
                padding: 4px;
            }
            .page_title{

            }
            .page_title h2{
                text-align: center;
            }
            .information{
                width: 100%;
            }
            .information_left{
                width: 50%;
                float: left;

            }
            .information_right{
                width: 50%;
                float: right;
            }
            .products_table{

            }
            .products_table table{
                width: 100%;
                border-collapse: collapse;
                border: 1px solid #000;
            }
            .products_table table tr{

            }
            .products_table table tr th{
                border: 1px solid #000;
            }
            .products_table table tr td{
                border: 1px solid #000;
                text-align: center;
            }
            .calculation{
                width: 100%;
                overflow: hidden;
            }
            .calculation_left{
                width: 50%;
                float: left;
            }
            .calculation_right{
                width: 50%;
                float: right;
            }
            .footer_singature{
                width: 100%;
                margin-top: 50px;
                overflow: hidden;
            }
            .first_part{
                width: 25%;
                float: left;
            }
            .second_part{
                width: 25%;
                float: left;
                padding-left: 110px;
            }
            .third_part{
                width: 25%;
                float: right;
            }

            .command_section{
                text-align: center;
                margin-top: 20px;
            }
            .command_section span{

            }
            .command_section span input{
                padding: 5px;
                width: 50px;
                height: 30px;
                display: inline-block;
            }
        </style>
		 
    </head>
    <body>
        <div class="main"  style="padding:10px; background: #fff; margin-top:5px; border:1px solid #FFE2D3; margin:0 auto;">

            <div class="header">
                <h1 style="text-align: center;">explore Point of Sales</h1>
                <img src="">
            </div>
            <div class="break">
                <h1></h1>
            </div>
            <div class="address">
                <h4 >211/2 Didar Mansion, S.S.K Road Feni. Phone: 019XX-3443423, 01790-434322, 563423</h4>

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
                            <td><?php echo $help->formatDate($inv_and_cus['date'],'d-m-Y'); ?></td>

                        </tr>
                        <tr>
                            <td>Time</td>
                            <td>:</td>
                            <td><?php echo $help->formatDate($inv_and_cus['date'],'h:i:s A'); ?></td>

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
                            <th>PRODUCT NAME</th>
                            <th>GROUP</th>
                            <th>SIZE(HxW)</th>
                            <th>COLOR</th>
                            <th>PRICE</th>
                            <th>QUAT.</th>
                            <th>UNIT.</th>
                            <th>TOTAL</th>
                        </tr>   
                    </thead>
                    <tbody>
                        <?php
                        $update_q = "update tbl_sell_products set status = '1' where sell_id='$sell_id' and 
                        customer_id='{$inv_and_cus['customer_id']}'";
                        $update_q_st = $db->link->query($update_q);
                        $q = "SELECT * FROM tbl_sell_products, tbl_product,tbl_group,tbl_color WHERE tbl_sell_products.product_id = tbl_product.product_id and tbl_sell_products.customer_id='{$inv_and_cus['customer_id']}' and tbl_group.groupid = tbl_product.product_group and tbl_sell_products.sell_id='$sell_id' AND tbl_product.color = tbl_color.colorid and tbl_sell_products.status='1' ORDER by tbl_sell_products.serial_no ASC";
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
                                    <td><?php echo $result['product_name']; ?></td>
                                    <td><?php echo $result['groupname']; ?></td>
                                    <td><?php echo $result['size_h'] . ' x ' . $result['size_w']; ?></td>
                                    <td><?php echo ucfirst($result['colorname']); ?></td>
                                    <td><?php echo $result['price'] . ".00"; ?></td>
                                    <td><?php echo $result['quantity']; ?></td>
                                    <td><?php echo $result['unit_price']; ?></td>
                                    <td><?php echo $result['subtotal']; ?></td>
                                </tr>
                            <?php endwhile; ?>
                            <tr>
                                <td colspan="8"  style="text-align: center"><span class="tab-1" style="text-align: center"><strong>Total </strong></td>
                                <td   style="text-align: center"><span class="tab-1" style="text-align: center"><strong>BDT: <?php echo $total; ?>/=</strong></td>
                            </tr>
                        <?php endif; ?>

                    </tbody>

                </table>
            </div>
            <div class="calculation">
              <div class="calculation_right">

                  <table width="100%" style="text-align: center;">

                        <?php 
                            $stmt = $db->link->query("select * from tbl_sell where sell_id ='$sell_id'");
                            if($stmt)
                            {
                                $invoice_data = $stmt->fetch_assoc();
                            }
                        ?>
                        <tr>
                            <td width="303" align="right" nowrap="nowrap">Sub Total</td>
                            <td width="10" nowrap="nowrap">:</td>
                            <td width="121" align="right" nowrap="nowrap"><strong><?php echo $invoice_data['sub_total']; ?></strong></td>

                        </tr>
                        <tr>
                            <td align="right" nowrap="nowrap">Discount</td>
                            <td nowrap="nowrap">:</td>
                            <td align="right" nowrap="nowrap"> <?php echo $invoice_data['discount']; ?></td>

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
                            <td align="right" nowrap="nowrap"><strong>GRAND TOTAL</strong></td>
                            <td nowrap="nowrap">:</td>
                             <td align="right" nowrap="nowrap"> <?php echo $invoice_data['grand_total']; ?></td>

                        </tr>

                        <tr>
                            <td align="right" nowrap="nowrap">Previous DUE</td>
                            <td nowrap="nowrap">:</td>
                             <td align="right" nowrap="nowrap"> <?php echo $invoice_data['paid']; ?></td>

                        </tr>

                        <td align="right" nowrap="nowrap">Paid</td>
                            <td nowrap="nowrap">:</td>
                             <td align="right" nowrap="nowrap"> <?php echo $invoice_data['paid']; ?></td>

                        </tr>


                        <tr>
                            <td align="right" nowrap="nowrap">DUE</td>
                            <td nowrap="nowrap">:</td>
                            <td align="right" nowrap="nowrap"><?php echo $invoice_data['due']; ?></td>

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
                    <p>For Didar-Titles and Sanitary</p>
                </div>
            </div>

            <div class="command_section">
                <span>
                    <a  href="invoicelist.php" id="backbutton">Sell Product</a>
                    <button class="printbutton" id="printbutton" onclick="printFunction()" style="background: #007fff; width: 100px; height: 30px;">Print</button>
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