<?php include 'lib/header.php'; ?>
<!-- //header-ends -->
<div class="container">
	<div class="breadcrumb">
		<h3><i class="lnr lnr-plus-circle"></i> &nbsp;Ledger Report</h3>
	</div>
	<div class="bs-example4">
        <form action="printfiles/ledger/ledger_report.php" method="POST">
            
           
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
                    <label for=""><strong>By Category</strong></label>
                    <input type="text" name="category" class="form-control">
                 </div> 

                  <div class="form-group">
                    <label for=""><strong>By Payar</strong></label>
                    <input type="text" name="payar" class="form-control">
                 </div> 


                  <div class="form-group">
                    <label for=""><strong>By Receiver</strong></label>
                    <input type="text" name="receiver" class="form-control">
                 </div> 
                
              </div>  

              <div class="col-md-12">
                <div class="form-group">
                  
                    <input type="submit" class="btn btn-success " name="showalledgerreport" value="All Ledgers">
                    <input type="submit" class="btn btn-primary " name="ledgerreportbycategory" value="Category Wise">
                    <input type="submit" class="btn btn-warning" name="ledgerreportbypayar" value="Payar Wise">
                    
                    <input type="submit" class="btn btn-danger " name="ledgerreportbyreceiver" value="Reciever Wise">
 			</div>
				</div>
			</div>
		</div>
	</form>
</div>
</div>

<?php include 'lib/footer.php'; ?>