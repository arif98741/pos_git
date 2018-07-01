<?php include 'lib/header.php'; ?>
<!-- //header-ends -->
<div class="container">
	<div class="breadcrumb">
		<h3><i class="lnr lnr-chart-bars"></i> &nbsp;Purchase Report</h3>
	</div>
	<div class="bs-example4">
        <form action="printfiles/purchase/purchasereport.php" method="POST">
            
                  
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
                            if($status)
                            {
                              while ($result = $status->fetch_assoc()) { ?>
                                <option value="<?php echo $result['groupid']; ?>"><?php echo $result['groupname']; ?></option>

                           <?php } } ?>
                    </select>
                 </div> 

                  <div class="form-group">
                    <label for=""><strong>Supplier</strong></label>
                    <select name="brandid" id="" class="form-control">
                      <option value="">Select Supplier</option>
                      <?php
                            $status = $sup->showSupplier();
                            if ($status) {
                              while ($result = $status->fetch_assoc()) { ?>
                                  <option value="<?php echo $result['supplier_id']; ?>"><?php echo $result['supplier_name']; ?></option>
                                <?php } } ?>
                    </select>
                 </div>  
                  
                
              </div>  
        <div class="col-md-12"><hr>
      
                <div class="form-group">
                  
                    <input type="submit" class="btn btn-success " name="showallpurchase" value="All Purchase">
                    <input type="submit" class="btn btn-warning" name="showpurchasebygroup" value="Group Wise">
                    <input type="submit" class="btn btn-info " name="showpurchasebybrand" value="Supplier Wise">
				</div>
				</div>
			</div>
		</div>
	</form>
</div>
</div>

<?php include 'lib/footer.php'; ?>