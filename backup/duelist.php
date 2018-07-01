<?php

$path = realpath(dirname(__DIR__));

include_once 'classes/Session.php';

include_once "classes/Printdata.php";

include_once "classes/DB.php";

Session::checkSession();

$pri = new Printdata();

$db = new Database();

define('BASE_URL', 'http://pos.explorebillingsuite.com/');

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

    <title>Customer Due List - Report</title>

    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/print.css" type="text/css" media="screen">

    <link rel="stylesheet " href="<?php echo BASE_URL; ?>assets/css/print.css">

</head>



<body>

<div class="bt-div">

    <INPUT TYPE="button" class="button blue" title="Print" onClick="window.print()" value="Print">

    <a class="button blue" href="<?php echo BASE_URL; ?>customerlist.php">Back</a>

</div>

<?php

?>



<div class="wraper">



        <table width="100%" border="0" class="header">

            <tr>

                <td width="8%" align="left" valign="top"><a href="dashboard.php"><span class="user_panel "><img src="<?php echo Session::get('logo') ?>" class="img_div" width="60" height="60"  alt=""/></span></a></td>

                <td width="68%" height="67" align="left" valign="middle"><div class="title-1"><?php echo Session::get('company_name'); ?></div>





                    <div class="title-3">Customer Balance List</div></td>

                <td width="24%" align="right" valign="middle" nowrap="nowrap">

                    <div class="title-2">Total: (<?php echo $pri->TotalProducts("select * from tbl_customer where due > '0'"); ?>)</div>

                </td>

            </tr>

        </table>

        <div class="line-4"></div>

        <div class="line-3"></div>



        <table class="TFtable" id="datatable" >

            <thead>

                <tr>

                    <th>Serial</th>

                    <th>Customer ID</th>

                    <th>Customer Name</th>

                    <th>Email</th>

                    <th>Adress</th>

                    <th>Contact</th>

                    <th>Balance</th>





                </tr>

            </thead>

            <tbody style="text-align: center">

                <?php

                $stmt = $db->link->query("select * from tbl_customer where due > '0' order by customer_name asc");



                if($stmt){

                    $i= 0;

                    while ($row = $stmt->fetch_assoc()) {  $i++;?>



                       <tr>

                            <td> <?php echo $i;   ?></td>

                            <td> <?php echo $row['customer_id']  ?></td>

                            <td> <?php echo $row['customer_name']  ?></td>

                            <td> <?php echo $row['email']  ?></td>

                            <td> <?php echo $row['address'] ?> </td>

                            <td> <?php echo $row['contact_no'] ?> </td>

                            <td> <?php echo round( $row['due']); ?> </td>

               <?php   } }else{



                }

                ?>

            </tbody>



        </table>



</div>



</body>

</html>