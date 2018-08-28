<?php include 'lib/header.php'; ?> 
<?php if (Session::get('status') !== 'admin') {
    header("Location: index.php");
}?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><i class="lnr lnr-plus-circle"></i>  ADD CUSTOMER</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="col-sm-12">
        <div class="box">
          <div class="box-body">
            <div class="row">
          <div class="col-md-12"> 
            <form action="customerlist.php" method="post">
                <div class="col-md-4">
                    <div class="form-group">
                        <input name="customer_id" class="form-control" type="text" placeholder="Customer ID" required="">
                    </div>

                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <input name="customer_name" class="form-control" type="text" placeholder="Customer Name" required="">

                    </div>

                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <input name="address" class="form-control" type="text" placeholder="Address" required="">

                    </div>

                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <input name="contact_no" class="form-control" type="text" placeholder="Contact No"  required="">
                    </div>

                </div>
                
                <div class="col-md-4">
                    <div class="form-group">
                        <input  name="email" class="form-control" type="email" placeholder="Email" required="">

                    </div>

                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <input  name="opening_balance" class="form-control" type="text" placeholder="Opening Balance"  required="">
                    </div>

                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <input  name="paid_limit" class="form-control" type="text" placeholder="Due Limit"  required="">
                        <!--Paid limit is Due Limit--->
                    </div>

                </div>

                
                
                <div class="col-md-4">
                    <div class="form-group">
                        <input  name="remark" class="form-control" type="text" placeholder="Remark"  required="">
                    </div>

                </div>

                <div class="col-md-offset-4 col-md-6 submit-button">
                    <input type="submit" value="Save Customer" name="addcustomer" class="btn btn-success">
                    <input type="reset" value="Reset" class="btn btn-warning">

                </div>
               </form> 
        </div>
      </div>
        </div>
      </div>
      
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 <!-- footer -->
 <?php include 'lib/footer.php'; ?>