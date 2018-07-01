<?php include 'lib/header.php'; ?>
<?php if (Session::get('status') !== 'admin') {
    header("Location: index.php");
}?>
<!-- //header-ends -->
<div class="container">
	<div class="breadcrumb">
           <h3><i class="lnr lnr-chart-bars"></i> &nbsp;Add Customer</h3>
	</div>
	<div class="bs-example4">
		
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
                        <input  name="remark" class="form-control" type="text" placeholder="Remark"  required="">
                    </div>

                </div>

                <div class="col-md-6 submit-buttom">
                    <input type="submit" value="Save Customer" name="addcustomer" class="btn btn-success">
                    <input type="reset" value="Reset" class="btn btn-warning">

                </div>
				</div>
			</div>
		</div>
	</form>
</div>
</div>

<?php include 'lib/footer.php'; ?>