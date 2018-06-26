<?php include 'lib/header.php'; ?>
<?php if (Session::get('status') !== 'admin') {
    header("Location: index.php");
}?>
<!-- //header-ends -->
<!-- //header-ends -->
<div class="container">
	<div class="breadcrumb">
		<h3><i class="lnr lnr-plus-circle"></i> &nbsp; Product Purchase</h3>
	</div>
	<div class="bs-example4">
        <form action="purchaselist.php" method="post">
       
	<div class="row">
				<div class="col-md-12"> 
                <div class="col-md-4">
                    <div class="form-group">
                        <input name="invoice_no" class="form-control" placeholder="Purchase Number" required="">
                    </div>

                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <select name="supplier_id"  id="supplier_dropdown"  class="form-control" >
                            <option value="">Select Supplier</option>
                            <?php
                            $status = $sup->showSupplier();
                            if ($status) {
                                 while ($result = $status->fetch_assoc()) { ?>
                                       <option value="<?php echo $result['supplier_id']; ?>"><?php echo ucfirst($result['supplier_name']); ?></option>
                           
                              <?php   }  }  ?>
                         
                        </select>
                    </div>

                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <input id="supplier_id" class="form-control" placeholder="Supplier ID">
                    </div>

                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <input  name="address" id="address" class="form-control" type="text" placeholder="Address" required="">

                    </div>

                </div>


                <div class="col-md-4">
                    <div class="form-group">
                        <input name="contact" id="contact" class="form-control" type="text" placeholder="Contact" required="">
                    </div>

                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <input name="date" class="form-control" id="date_input" type="date" placeholder="Date"  required="">
                    </div>

                </div>


                <div class="col-md-6 submit-buttom">
                    <input type="submit" value="Save Product" name="addproduct" class="btn btn-success">
                    <input type="reset" value="Reset" class="btn btn-warning">
                </div>


                <div class="col-md-12" style="margin-top: 20px;">

                    <table id="invoice_form_table" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Group</th>
                                <th>Name</th>
                                <th>Unit</th>
                                <th>Quantity</th>
                                <th>Purchase Price</th>
                                <th>Subtotal</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody id="inv_detail">
                            
                        </tbody>
                        <tfoot id="">
                            <tr>
                                <td colspan="7" style="text-align:right; "><b>Invoice Total</b></td>
                                <td colspan="1" style="text-align: center;"><input type="hidden" name="addinvoice"><b class="wholetotal"></b></td>
                                <input type="hidden" name="addpurchase">
                            </tr>

                        </tfoot>
                    </table>
                    <button class="btn btn-success add_new_invoice_table_row" title="Click To Add Product in Purchase List" style="font-size: 17px;">+</button>
                </div>
				</div>
			</div>
		</div>
	</form>
</div>
</div>

<?php include 'lib/footer.php'; ?>