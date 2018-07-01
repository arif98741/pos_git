<?php include 'lib/header.php'; ?>
<?php if (Session::get('status') !== 'admin') {
    header("Location: index.php");
}?>
<!-- //header-ends --><div class="container">
	<div class="breadcrumb">
           <h3><i class="lnr lnr-chart-bars"></i> &nbsp;Add Supplier</h3>
	</div>
	<div class="bs-example4">
		
		<div class="row">
				<div class="col-md-12"> 
            <form action="supplierlist.php" method="post">

                <div class="col-md-4">
                    <div class="form-group">
                        <input name="supplier_id" class="form-control" type="text" placeholder="Supplier ID" required="">
                    </div>

                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <input name="supplier_name" class="form-control" type="text" placeholder="Supplier Name" required="">

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
                        <input name="contact_person" class="form-control" type="text" placeholder="Contact Person"  required="">
                    </div>

                </div>


               
                <div class="col-md-4">
                    <div class="form-group">
                        <input  name="email" class="form-control" type="email" placeholder="Email" required="">

                    </div>

                </div>
                
                <div class="col-md-4">
                    <div class="form-group">
                        <input  name="remark" class="form-control" type="text" placeholder="Remark"  required="">
                    </div>

                </div>

                <div class="col-md-offset-8 col-md-6 submit-buttom">
                    <input type="submit" value="Save supplier" name="addsupplier" class="btn btn-success">
                    <input type="reset" value="Reset" class="btn btn-warning">
                </div>

            </form>

        </div>
    </div>
</div>
<?php include 'lib/footer.php'; ?>