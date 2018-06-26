<?php include 'lib/header.php'; ?>
<?php

    if(isset($_GET['action'])){
        $id = $help->validAndEscape($_GET['customer_id']);
        $stmt = $db->link->query("select * from tbl_customer join customer_balance on tbl_customer.customer_id = customer_balance.customer_id where tbl_customer.customer_id ='$id'");
        if ($stmt) {
            $customer_data = $stmt->fetch_assoc();

        }
    }
 ?>

<!-- //header-ends -->
<div class="container">
    <div class="breadcrumb">
           <h3><i class="lnr lnr-chart-bars"></i> &nbsp;Payment</h3>
    </div>
    <div class="bs-example4">
        
        <div class="row">
                <div class="col-md-12"> 
            <form action="<?php   echo BASE_URL;  ?>billpay.php" method="post">
                
                <div class="col-md-6">
                    <div class="form-group">
                          <label for="">Customer ID</label>
                        <input name="customer_id"  class="form-control" type="text" placeholder="Customer ID"  value="<?php echo $customer_data['customer_id']; ?>"   readonly="">
                    </div>

                </div>

                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Customer Name</label>
                        <input name="customer_name"  class="form-control" type="text" placeholder="Customer Name" value="<?php echo $customer_data['customer_name']; ?>" readonly="">
                    </div>

                </div>

                
               
                
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Previous Due</label>
                        <input name="previous"  class="form-control" type="text" value="<?php echo round($customer_data['balance']); ?>" placeholder="Previous Balance"  required="">
                    </div>

                </div>
                
                
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Paid Amount</label>
                        <input name="amount"  class="form-control" type="text" placeholder="Amount"  required="">
                    </div>

                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Payment Method</label>
                        <input type="text" name="method" class="form-control" value="" placeholder="">
                       
                        
                    </div>

                </div>





                <div class="col-md-offset-4 col-md-6 submit-button">
                    <input type="submit" value="Pay Now" name="payamount" class="btn btn-success">
                    <input type="reset" value="Reset" class="btn btn-warning">
                </div>
                </div>
            </div>
        </div>
    </form>
</div>
</div>

<?php include 'lib/footer.php'; ?>