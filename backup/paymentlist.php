<?php include 'lib/header.php'; ?>
<?php if (Session::get('status') !== 'admin') {
    header("Location: index.php");
}?>
<?php
//addproduct product
if (isset($_POST['payamount'])) {
    $customer_id = $_POST['customer_id'];
    $amount = $_POST['amount'];
    $previous = $_POST['previous'];
    $date = date('Y-m-d h:i:s');
    $after_pay = $previous- $amount;
    $stmt = $db->link->query("insert into payment(customer_id,amount,date) values('$customer_id','$amount','$date')") or die($db->link->error).__LINE__;
    $stmt = $db->link->query("update tbl_customer set due ='$after_pay' where customer_id ='$customer_id'") or die($db->link->error).__LINE__;;

    
    if ($stmt) {
        echo "<script>alert('Paid Successfully');</script>";
    } else {
        echo "<script>alert('Paid Failed);</script>";
    }
}


?>

<!-- //header-ends -->
<div id="page-wrapper">
 
        <div class="breadcrumb">
            <h3><i class="lnr lnr-list"></i> &nbsp;Payment Record</h3>
        </div>

        <div class="xs tabls">
            <div class="bs-example4">
                <div class="table-responsive ">

                    <table class="table table-striped table-bordered table-hover" cellspacing="4" id="product_table" class="order-column" width="100%">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Customer ID</th>
                                <th>Customer Name</th>
                                <th>Amount</th>
                                <th>Method</th>
                                <th>Receiver</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody style="text-align: center">
                            <?php
                            $stmt = $db->link->query("select p.*,tc.customer_name from payment p join tbl_customer tc on p.customer_id = tc.customer_id");

                            if($stmt){
                                $i= 0;
                                     while ($row = $stmt->fetch_assoc()) {  $i++;?>
                                     <tr>
                                        <td> <?php echo $help->formatDate($row['date'],'d-m-Y');   ?></td>
                                        <td> <?php echo $row['customer_id']  ?></td>
                                        <td style="text-align: left;"> <?php echo $row['customer_name']  ?></td>
                                        <td> <?php echo round($row['amount']);  ?></td>
                                         <td> <?php echo ucfirst($row['method']);  ?></td>
                                        <td> <?php echo $db->link->query("select name from tbl_user where userid='{$row['receiver']}'")->fetch_object()->name; ?></td>
                                        <td>
                                        <a href="editpayment.php?action=edit&serial=<?php echo $row['serial'] ?>" style="border-radius: 3px;" title="click to view" ><i class="fa fa-pencil-square-o"></i>&nbsp;&nbsp;</a>
                                        
                                    </td>
                                        
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
