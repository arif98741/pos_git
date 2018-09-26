<?php

session_start();

date_default_timezone_set('Asia/Dhaka');

$sell_id = $_GET['sell_id'];

$path = realpath(dirname(__DIR__));

include_once 'classes/DB.php';

include_once  'classes/Extra.php';

include_once  'helper/Helper.php';

if (!isset($_SESSION['login'])) {

    header('Location: login.php');

}

$db = new Database();

$ext = new Extra();

$help = new Helper();



if($_GET['sell_id']){

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



    if($stmt){



        $inv_and_cus = $stmt->fetch_assoc();



    }

}



?>







<!DOCTYPE html>



<html lang="en">



    <head>



        <meta charset="utf-8">



        <title>Invoice ID-<?php echo $sell_id; ?></title>



        <style type="text/css">



            body{

                background: #eee;

                font-size: 14px;

            }



            .main{

                width: 900px;



                padding-left: 50px;

                padding-right: 50px;

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







        body,td,th {

	font-family: Cambria, "Hoefler Text", "Liberation Serif", Times, "Times New Roman", serif;

}

        </style>

    </head>



<body>



        <div class="main"  style="padding: 10px;

    background: #fff;

    margin-top: 5px;

    /* border: 1px solid #FFE2D3; */

    margin: 0 auto;

    box-shadow: 0 0 2px #ccc; margin:0 auto; border-radius:4px;">



            <table width="100%">

              <tr>

                <td width="9%" height="66" valign="top" class="header"><img src="<?php echo  Session::get('logo'); ?>" width="64"></td>

                <td align="left" valign="top">  <div style="font-size:28px; font-weight:bold; color:#C00;"><?php echo Session::get('company_name'); ?></div>

              <div style="font-size: 16px; font-weight: bold; color: #039;"><?php echo $company_details->address; ?></div></td>

              </tr>

              <tr>

                <td height="25" colspan="2" align="center" bgcolor="#C6C6FF"><div style="font-size:18px; font-weight:bold;">BILL/INVOICE</div></td>

              </tr>

            </table>



            <!-- <div class="address">

            

                <h4 ><?php //echo $company_details->address; ?></h4>

            

            </div> -->



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



  



                   <table width="100%" cellpadding="0">



                        <tr>

                          <td colspan="6" nowrap="nowrap">&nbsp;</td>

                        </tr>

                        <tr>

                          <td width="8%" nowrap="nowrap">Invoice No</td>

                          <td width="1%">:</td>

                          <td width="41%"><strong><?php echo $sell_id; ?></strong></td>



                            <td width="8%" nowrap="nowrap">Customer ID</td>



                            <td width="1%">:</td>



                            <td width="40%"><strong><?php echo $inv_and_cus['customer_id']; ?></strong></td>

                        </tr>



                        <tr>

                          <td nowrap="nowrap">Date</td>

                          <td>:</td>

                          <td><strong><?php echo $help->formatDate($inv_and_cus['selldate'],'d-m-Y'); ?></strong></td>



                            <td nowrap="nowrap">Name</td>



                            <td>:</td>



                            <td><strong><?php echo $inv_and_cus['customer_name']; ?></strong></td>

                        </tr>



                        <tr>

                          <td nowrap="nowrap">Time</td>

                          <td>:</td>

                          <td><strong><?php echo $help->formatDate($inv_and_cus['selldate'],'h:i:s A'); ?></strong></td>



                            <td nowrap="nowrap">Address</td>



                            <td>:</td>



                            <td><strong><?php echo $inv_and_cus['address']; ?></strong></td>

                        </tr>



                        <tr>

                          <td nowrap="nowrap">Sold by</td>

                          <td>:</td>

                          <td><strong><?php echo Session::get('name'); ?></strong></td>



                            <td nowrap="nowrap">Contact</td>



                            <td>:</td>



                            <td><strong><?php echo $inv_and_cus['contact_no']; ?></strong></td>

                        </tr>

                        <tr>

                          <td colspan="6" nowrap="nowrap">&nbsp;</td>

                        </tr>

              </table>



            </div>


            <div class="products_table">

              <table width="100%" cellpadding="0" cellspacing="0">

                <thead>

                  <tr>

                    <th width="11%" bgcolor="#C6C6FF">SERIAL</th>

                    <th width="15%" bgcolor="#C6C6FF">PROUDCT ID</th>

                    <th width="43%" bgcolor="#C6C6FF">PRODUCT NAME</th>

                    <th width="10%" bgcolor="#C6C6FF">QUANTITY</th>

                    <th width="9%" bgcolor="#C6C6FF">PRICE</th>

                    <th width="12%" bgcolor="#C6C6FF">SUBTOTAL</th>

                  </tr>

                </thead>

                <tbody>

                  <?php

                        $update_q = "update tbl_sell_products set status = '1' where sell_id='$sell_id' and

                        customer_id='{$inv_and_cus['customer_id']}'";



                        $update_q_st = $db->link->query($update_q);



                        /*$q = "SELECT * FROM tbl_sell_products, tbl_product,tbl_group,tbl_type WHERE tbl_sell_products.product_id = tbl_product.product_id and tbl_sell_products.customer_id='{$inv_and_cus['customer_id']}' and tbl_group.groupid = tbl_product.product_group and tbl_sell_products.sell_id='$sell_id' AND tbl_product.product_type = tbl_type.typeid and tbl_sell_products.status='1' ORDER by tbl_sell_products.serial_no ASC";*/

                         $q = "SELECT tsp.subtotal,tsp.unit_price,tsp.purchase_price,tsp.product_serial,tsp.warranty_expire,tsp.quantity,tp.product_id,tp.product_name FROM tbl_sell_products tsp join tbl_product tp on tsp.product_id = tp.product_id where tsp.sell_id='$sell_id' and tsp.status='1' order by tsp.serial_no asc";


                        $st = $db->link->query($q);



                        $i = $total = 0;



                        ?>

                  <?php if ($st): ?>

                  <?php while ($result = $st->fetch_assoc()): ?>

                  <?php

                                $i++;
                                $total += $result['subtotal'];

                                ?>

                  <tr>

                    <td align="center"><?php echo $i; ?></td>

                    <td align="left"><?php echo $result['product_id']; ?></td>

                    <td align="left"><?php echo $result['product_name']; ?><br>

                      <?php echo $result['product_serial']; ?> <?php
                        if ($result['warranty_expire'] > 1971 ) {
                            echo $help->formatDate($result['warranty_expire'],'d-m-Y');
                        }
                        ?>

                   </td>

                    <td align="center"><?php echo $result['quantity']; ?></td>

                    <td align="right"><?php echo  number_format((float)$result['unit_price'], 2, '.', ''); ?></td>

                    <td align="right"><?php echo  number_format((float)$result['subtotal'], 2, '.', ''); ?></td>

                  </tr>

                  <?php endwhile; ?>

                  <?php endif; ?>

                </tbody>

              </table>

            </div>



            <div class="calculation">


                <table width="100%" cellpadding="0" cellspacing="0" style="text-align: center;">


                        <?php



                            $stmt = $db->link->query("select * from tbl_sell where sell_id ='$sell_id'");



                            if($stmt)

                            {

                                $invoice_data = $stmt->fetch_assoc();

                            }

                        ?>



                        <tr>



                            <td width="791" align="right" nowrap="nowrap"><strong>Sub Total</strong></td>



                            <td width="107" align="right" nowrap="nowrap"><strong><?php echo $invoice_data['sub_total']; ?></strong></td>




                        </tr>



                        <tr>



                            <td align="right" nowrap="nowrap">DL.</td>



                            <td align="right" nowrap="nowrap"> <?php echo $invoice_data['dlcharge']; ?></td>



                        </tr>



                        <tr>



                            <td align="right" nowrap="nowrap">VAT(%)</td>



                            <td align="right" nowrap="nowrap"> <?php echo $invoice_data['vat']; ?></td>



                        </tr>



                          <tr>



                            <td align="right" nowrap="nowrap">Discount</td>



                            <td align="right" nowrap="nowrap"><?php echo $invoice_data['discount']; ?></td>





                        </tr>







                         <tr>



                            <td align="right" nowrap="nowrap"><strong>PAYABLE</strong></td>



                            <td align="right" nowrap="nowrap"><strong><?php echo round($invoice_data['payable']); ?></strong></td>



                        </tr>











                        <tr>



                            <td align="right" nowrap="nowrap">Paid</td>



                            <td align="right" nowrap="nowrap"> <?php echo $invoice_data['paid']; ?></td>







                        </tr>



                        <tr>



                            <td align="right" nowrap="nowrap">DUE</td>



                            <td align="right" nowrap="nowrap"><?php echo $invoice_data['due']; ?></td>



                        </tr>



                        <tr>



                            <td align="right" nowrap="nowrap">Previous Balance</td>



                            <td align="right" nowrap="nowrap"> <?php echo round($invoice_data['previous_balance']); ?></td>



                        </tr>



                </table>



          </div>



     



            <table width="100%">

              <tr>

                <td height="57" colspan="6" align="center">&nbsp;</td>

              </tr>

              <tr>

                <td width="7%" align="center">&nbsp;</td>

                <td width="23%" align="center"><hr/>

                <p>Customer's Signature</p></td>

                <td width="21%"><p>&nbsp;</p></td>

                <td width="21%">&nbsp;</td>

                <td width="22%" align="center"><hr/>

                  <p>For

                    <?php  echo Session::get('company_name'); ?>

                </p></td>

                <td width="6%" align="center">&nbsp;</td>

              </tr>

            </table>

            <hr>

            <center>

            <span style="text-align: center; font-size: 10px;">Developed by: Ariful Islam</span></center>

<div class="command_section">



      <span>



          <a  href="addinvoice.php" id="backbutton">Sale again</a>



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





</body>











</html>

