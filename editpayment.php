<?php include 'lib/header.php'; ?>
<?php if (Session::get('status') !== 'admin') {
    header("Location: index.php");
}?>
<?php

    if(isset($_GET['action']) && isset($_GET['serial'])){
        $serial = $help->validAndEscape($_GET['serial']);
        $stmt = $db->link->query("select * from payment p join tbl_customer tc on p.customer_id = tc.customer_id where p.serial ='$serial'") or die($db->link->error).__LINE__;
        if ($stmt) {
            $payment_data = $stmt->fetch_assoc();
          }
    }else {
        header("location: paymentlist.php");
    }
 ?>



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><i class="lnr lnr-pencil"></i>  UPDATE PAYMENT</h1>
      <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="<?php echo BASE_URL; ?>">Dashboard</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="col-sm-12">
        <div class="box">
          <div class="box-body">
           
                

                

        <div class="row">
             <form  action="<?php   echo BASE_URL;  ?>billpay.php" method="post"  enctype="multipart/form-data">
                <div class="col-md-12"> 
           
                
                <div class="col-md-6">
                    <div class="form-group">
                          <label for="">Customer ID</label>
                        <input name="customer_id"  class="form-control" type="text" placeholder="Customer ID"  value="<?php echo $payment_data['customer_id']; ?>"   readonly="">
                    </div>

                </div>

                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Customer Name</label>
                        <input name="customer_name"  class="form-control" type="text" placeholder="Customer Name" value="<?php echo $payment_data['customer_name']; ?>" readonly="">
                    </div>

                </div>


                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Paid Amount</label>
                        <input name="amount"  class="form-control" type="text"  value="<?php echo round($payment_data['amount']); ?>"  placeholder="Amount"  required="">
                    </div>

                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Payment Method</label>
                        <input type="text" name="method" class="form-control"  value="<?php echo $payment_data['method']; ?>" placeholder="">
                    </div>

                </div>

                <div class="col-md-offset-4 col-md-6 submit-button">
                    <input type="hidden" value="<?php echo $serial; ?>" name="serial" >
                    <input type="submit" value="Update Payment" name="updatepayment" class="btn btn-success">
                    <input type="reset" value="Reset" class="btn btn-warning">
                </div>
                </div>
            </div>
           </form>
            
        </div>
      </div>
      
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 <!-- footer -->

 <?php include 'lib/footer.php'; ?>