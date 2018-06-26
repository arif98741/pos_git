<?php include 'lib/header.php'; ?>
<!-- //header-ends -->
<div class="container">
	<div class="breadcrumb">
           <h3><i class="lnr lnr-chart-bars"></i> &nbsp;Invoice Report</h3>
	</div>
	<div class="bs-example4">
		
		<div class="row">
				<div class="col-md-12"> 
       
        <form action="printfiles/sale/invoicereport.php" method="POST">
            <div class="col-md-6">
                <div class="form-group">
                  <label for=""><strong>From</strong></label>
                  <input type="date" name="starting" id="startdate" class="form-control">
               </div>  
                <div class="form-group">
                  <label for=""><strong>To</strong></label>
                  <input type="date" name="ending" id="enddate" class="form-control">
               </div>
  		    </div>

          <div class="col-md-6">
            <label for="">Customer</label>
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

          <div class="col-md-offset-3 col-md-6">
             <div class="form-group">
                <input type="submit" name="showinvoicereport" class="btn btn-success" value="All Sales">
                <input type="submit" name="showinvoiceaccordingtocustomer" class="btn btn-primary" value="Customer Wise">
            </div>
          </div>

			</div>
		</div>
	</form>
</div>
</div>

<?php include 'lib/footer.php'; ?>