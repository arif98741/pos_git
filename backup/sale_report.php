<?php include 'lib/header.php'; ?>
<!-- //header-ends -->
<div class="container">
	<div class="breadcrumb">
		<h3><i class="lnr lnr-plus-circle"></i> &nbsp;Sale Report</h3>
	</div>
	<div class="bs-example4">
        <form action="printfiles/sale/sellreport.php" method="POST">
            
           
    	<div class="row">
				<div class="col-md-12"> 
              <div class="col-md-6">


                  <div class="form-group">
                    <label for=""><strong>From</strong></label>
                    <input type="date" name="starting" id="startdate" class="form-control">
                 </div>  
                  <div class="form-group">
                    <label for=""><strong>To</strong></label>
                    <input type="date" name="ending" id="enddate" class="form-control">
                 </div>
                 <div class="form-group">
                    
                 </div>
              </div>  


          
              <div class="col-md-6">

                  <div class="form-group">
                    <label for=""><strong>Group</strong></label>
                    <select name="groupid" id="" class="form-control">
                      <option value="">Select Group</option>
                      <?php
                            $status = $pro->showGroup();
                            if($status){
                              while ($result = $status->fetch_assoc()) { ?>
                                <option value="<?php echo $result['groupid']; ?>"><?php echo $result['groupname']; ?></option>
                           <?php   } } ?>
                    </select>
                 </div> 

                <div class="form-group">
                    <label for=""><strong>Supplier</strong></label>
                    <select name="brandid" id="" class="form-control">
                      <option value="">Select Supplier</option>
                      <?php
                            $status = $sup->showSupplier();
                            if ($status) {
                              while ($result = $status->fetch_assoc()) {?>
                                <option value="<?php echo $result['supplier_id']; ?>"><?php echo $result['supplier_name']; ?></option>
                         <?php  } } ?>
                    </select>
                 </div> 


                  <div class="form-group">
                    <label for=""><strong>Customer</strong></label>
                    <select name="customer_id" id="" class="customer form-control">
                        <option value="">Select Customer</option>
                        <?php 
                            $cusst = $db->select("select * from tbl_customer order by customer_name asc");
                            if($cusst){
                              while ($row = $cusst->fetch_assoc()) { ?>
                              <option value="<?php echo ucfirst($row['customer_id']); ?>"><?php echo $row['customer_name']; ?></option>
                              
                              <?php  }
                            }
                          ?>
                      </select>
                 </div> 


                  <div class="form-group">
                    <label for=""><strong>Product Name Wise</strong></label>
                    <select name="product_id" id="" class="form-control">
                      <option value="">Select Product</option>
                      <?php
                            $status = $db->link->query("select * from tbl_product order by product_name asc");
                            if ($status) {
                              while ($result = $status->fetch_assoc()) { ?>
                                <option value="<?php echo $result['product_id']; ?>"><?php echo $result['product_name']; ?></option>
                         <?php  } } ?>
                    </select>
                 </div> 



                  
                
              </div>  

              <div class="col-md-12">
                <div class="form-group">
                  
                    <input type="submit" class="btn btn-success " name="showsellreport" value="All Sales">
                    <input type="submit" class="btn btn-warning" name="sellreportbygroup" value="Group Wise">
                    <input type="submit" class="btn btn-info " name="sellreportbybrand" value="Supplier Wise">
                    <input type="submit" class="btn btn-danger " name="sellreportbycustomer" value="Customer Wise">
                    <input type="submit" class="btn btn-warning " name="sellreportbyname" value="Product Name Wise">
 			          </div>
				      </div>
			   </div>
		  </div>
	</form>
</div>
</div>

<?php include 'lib/footer.php'; ?>