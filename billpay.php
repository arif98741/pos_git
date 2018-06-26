<?php include 'lib/header.php'; ?>
<?php
//addproduct product
if (isset($_POST['payamount'])) {
    $customer_id = $_POST['customer_id'];
    $amount = $_POST['amount'];
    $receiver = Session::get('userid');
    $method = $_POST['method'];
    $previous = $_POST['previous'];
    $date = date('Y-m-d H:i:s');
    $after_pay = $previous - $amount;
    $stmt = $db->link->query("insert into payment(customer_id,amount,current_bal,receiver,method,date) values('$customer_id','$amount','$after_pay','$receiver','$method','$date')");

    
    if ($stmt) {
        $cus->sendMessage($customer_id,$amount,$method);
        echo "<script>alert('Paid Successfully');</script>";
    } else {
        echo "<script>alert('Paid Failed);</script>";
    }
}

if (isset($_POST['updatepayment'])) {
    $serial = $_POST['serial'];
    $customer_id = $_POST['customer_id'];
    $amount = $_POST['amount'];
    $method = $_POST['method'];
    $date = date('Y-m-d h:i:s');

    $stmt = $db->link->query("update payment set amount='$amount',method='$method' where serial='$serial'") or die($db->link->error).__LINE__;

    $stmt1 = $db->link->query("select balance from customer_balance where customer_id='$customer_id'") or die($db->link->error).__LINE__;
    if ($stmt1) {
        $current_bal = $stmt1->fetch_assoc()['balance'];
        $stmt = $db->link->query("update payment set current_bal='$current_bal' where serial='$serial'") or die($db->link->error).__LINE__;

    }
}
?>

<!-- //header-ends -->
<div id="page-wrapper">
 
        <div class="breadcrumb">
            <h3><i class="lnr lnr-list"></i> &nbsp;Bill Pay</h3>
        </div>

        <div class="xs tabls">
            <div class="bs-example4">
                <div class="table-responsive ">

                    <table class="table table-striped table-bordered table-hover" cellspacing="4" id="product_table" class="order-column" width="100%">
                        <thead>
                            <tr>
                                <th>Serial</th>
                                <th>Customer ID</th>
                                <th>Customer Name</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Contact no</th>
                                <th>Balance</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody style="text-align: center">
                            <?php
                            $stmt = $db->link->query("select * from tbl_customer tc join customer_balance cb on tc.customer_id = cb.customer_id  order by customer_name asc");

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
                                        <td> <?php echo round( $row['balance']); ?> </td>
                                        <td><a href="payment.php?action=pay&customer_id=<?php echo $row['customer_id']; ?>" class="">Pay</a></td>
                                     </tr>
                                   <?php   } }else{

                            }
                            ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
 
</div>
<?php include 'lib/footer.php'; ?>
