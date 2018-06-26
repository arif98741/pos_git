<?php include 'lib/header.php'; ?>


<!-- //header-ends -->
<div class="container">
	<div class="breadcrumb">
           <h3><i class="lnr lnr-chart-bars"></i> &nbsp;Product Report</h3>
	</div>
	<div class="bs-example4">
		
		<div class="row">
				<div class="col-md-12"> 
        <form action="printfiles/product/print.php" method="post">


 

                <div class="col-md-6">
                    <div class="form-group">
                        <select name="product_group" class="form-control">
                            <option>Select Group</option>
                            <?php
                            $status = $pro->showGroup();
                            if($status) {
                                while ($result = $status->fetch_assoc()) { ?>
                                     <option value="<?php echo $result['groupid']; ?>"><?php echo $result['groupname']; ?></option>

                             <?php   }  } ?>
                            
                              
                        </select>
                    </div>

                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <select name="supplier_id" class="form-control">
                            <option>Select Supplier</option>
                            <?php 
                                    $status = $sup->showSupplier();
                                    //brand is granted as supplier
                                    if($status){
                                         while ($result = $status->fetch_assoc()) { ?>
                                             <option value="<?php echo $result['supplier_id']; ?>"><?php echo $result['supplier_name']; ?></option>

                                        <?php 
                                    }
                                }
                                ?>
                           
                        </select>  
                    </div>

                </div>

               


                <div class="col-md-12 submit-buttom">
				<hr>
                    <input type="submit" value="All Products" name="reportallproduct" class="btn btn-success">
                    <input type="submit" value="Products by Group" name="reportbygroup" class="btn btn-warning">
                    <input type="submit" value="Product by Supplier" name="reportbybrand" class="btn btn-success">
                    
                    <input type="reset" value="Reset" class="btn btn-danger">
</div>
				</div>
			</div>
		</div>
	</form>
</div>
</div>

<?php include 'lib/footer.php'; ?>