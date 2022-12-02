<?php
$path = realpath(dirname(__DIR__));
include_once "../../classes/DB.php";
include_once "../../classes/Session.php";
include_once "../../classes/Printdata.php";
include_once "../../helper/Helper.php";
Session::checkSession();
$db = new Database();
$pri = new Printdata();
$help = new Helper();

if (isset($_GET['invoice_id'])) {
    $invoice_id = $help->validAndEscape($_GET['invoice_id']);
    $query = "select * from tbl_invoice ti join tbl_invoice_products tip on 
              ti.invoice_number = tip.invoice_id JOIN tbl_supplier ts on 
              ti.supplier_id = ts.supplier_id JOIN tbl_product tp on 
              tip.product_id = tp.product_id JOIN tbl_group tg on 
              tp.product_group = tg.groupid
               where ti.invoice_number = '$invoice_id' ";
    $status = $db->select($query);
    $purchase_data = $status->fetch_assoc();
} else {
    header("Location: purchaselist.php");

}

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
<?php
?>

<div class="wraper">


    <table width="100%" border="0" class="header">
        <tr>
            <td width="8%" align="left" valign="top"><a href="dashboard.php"><span class="user_panel "><img
                                src="../../<?php echo Session::get('logo'); ?>" class="img_div" width="60" height="60"
                                alt=""/></span></a></td>
            <td width="68%" height="67" align="left" valign="middle">
                <div class="title-1"><?php echo Session::get('company_name'); ?></div>

                <div class="title-3">Accounts Ledger Summary</div>
                Invoice Number- <?php echo $invoice_id; ?> <br>
                Date: <?php echo $purchase_data['date']; ?><br>
                Supplier: <?php echo $purchase_data['supplier_name']; ?>
            </td>
            <td width="24%" align="right" valign="middle" nowrap="nowrap">
                <div class="title-2">Total:
                    (<?php echo $pri->TotalProducts("select category,sum(debit) as 'debit',sum(credit) as 'credit',date from tbl_laser GROUP by category"); ?>
                    )
                </div>
            </td>

        </tr>
    </table>
    <div class="line-4"></div>
    <div class="line-3"></div>

    <table class="TFtable" id="datatable">
        <thead>
        <tr class="bg-warning">
            <th>Serial</th>
            <th>Product ID</th>
            <th>Group</th>
            <th>Product Name</th>
            <th>Purchase</th>
            <th>Quantity</th>
            <th>Subtotal</th>

        </tr>
        </thead>
        <tbody>
        <?php

        $q = "select * from tbl_invoice ti join tbl_invoice_products tip on 

                              ti.invoice_number = tip.invoice_id JOIN tbl_supplier ts on 

                              ti.supplier_id = ts.supplier_id JOIN tbl_product tp on 

                              tip.product_id = tp.product_id JOIN tbl_group tg on 

                              tp.product_group = tg.groupid

                               where ti.invoice_number = '$invoice_id' ";
        $stmt = $db->link->query($q);

        if ($stmt) {

            $total = $i = 0;
            while ($result = $stmt->fetch_assoc()) {
                $i++;
                $total = ($result['quantity'] * $result['purchase']) + $total;
                ?>
                <tr style="text-align: center;" id="rowid-<?php echo $result['serial']; ?>">
                    <td><?php echo $i; ?></td>
                    <td><?php echo $result['product_id']; ?></td>
                    <td><?php echo $result['groupname']; ?></td>
                    <td><?php echo $result['product_name']; ?></td>
                    <td><?php echo $result['quantity']; ?></td>
                    <td><?php echo $result['purchase']; ?></td>
                    <td><?php echo $result['quantity'] * $result['purchase']; ?></td>
                </tr>

            <?php }
        } else { ?>

        <?php } ?>
        <tr class="bg-warning">
            <td colspan="5"></td>
            <td><strong>Total</strong></td>
            <td style="text-align: center;"><strong><?php echo $total; ?></strong></td>
        </tr>
        </tbody>

    </table>


</div>

</body>
</html>