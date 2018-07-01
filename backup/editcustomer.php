<?php include 'lib/header.php'; ?>
<?php if (Session::get('status') !== 'admin') {
    header("Location: index.php");
}?>

 <?php if (isset($_GET['serial']) && isset($_GET['customer_id']) && isset($_GET['action'])): ?>
            <?php
            $serial = $help->validAndEscape($_GET['serial']);
            $customer_id = $help->validAndEscape($_GET['customer_id']);
            $single_cus_q = "select * from tbl_customer join customer_balance on tbl_customer.customer_id = customer_balance.customer_id where tbl_customer.serial='$serial' and tbl_customer.customer_id='$customer_id'";
            $single_cus_st = $db->link->query($single_cus_q);
            ?>
            <?php if ($single_cus_st): ?>
                <?php $result = $single_cus_st->fetch_assoc(); ?>
            <?php endif; ?>
        <?php else: ?>
            <p class="alert alert-danger fadeout">Invalid Url</p>
<?php endif; ?>
<!-- //header-ends -->
<div class="container">
    <div class="breadcrumb">
           <h3><i class="lnr lnr-chart-bars"></i> &nbsp;Edit Customer</h3>
    </div>
    <div class="bs-example4">
        
        <div class="row">
                <div class="col-md-12"> 
            <form action="customerlist.php" method="post">
                <div class="col-md-4">
                    <div class="form-group">
                        <input name="customer_id" class="form-control" type="text" value="<?php echo $result['customer_id']; ?>" placeholder="Customer ID" required="">
                        <input name="serial" class="form-control" type="hidden" value="<?php echo $result['serial']; ?>">
                    </div>

                </div>

                <div class="col-md-4">
                    <div class="form-group">
                       <input name="customer_name" class="form-control" type="text" value="<?php echo $result['customer_name']; ?>"   placeholder="Customer Name" required="">


                    </div>

                </div>

                <div class="col-md-4">
                    <div class="form-group">
                      <input name="address" class="form-control" type="text" value="<?php echo $result['address']; ?>"  placeholder="Address" required="">
                    </div>

                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <input name="contact_no" class="form-control" type="text" value="<?php echo $result['contact_no']; ?>"  placeholder="Contact No."  required="">
                    </div>

                </div>
                
                <div class="col-md-4">
                    <div class="form-group">
                          <input  name="email" class="form-control" type="text" value="<?php echo $result['email']; ?>"  placeholder="Email" required="">

                    </div>

                </div>

                <div class="col-md-4">
                    <div class="form-group">
                          <input  name="opening_balance" class="form-control" type="text" placeholder="Opening Balance" value="<?php echo round($result['balance']); ?>"  placeholder="Email" required="">

                    </div>

                </div>


                
                <div class="col-md-4">
                    <div class="form-group">
                        <input  name="remark" class="form-control" type="text" value="<?php echo $result['remark']; ?>"  placeholder="Remark"  required="">
                    </div>

                </div>

                <div class="col-md-6 submit-buttom">
                    <input type="submit" value="Update Customer" name="updatecustomer" class="btn btn-success">
                    <input type="reset" value="Reset" class="btn btn-warning">

                </div>
                </div>
            </div>
        </div>
    </form>
</div>
</div>

<?php include 'lib/footer.php'; ?>