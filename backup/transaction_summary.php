<?php include 'lib/header.php'; ?>
<!-- //header-ends -->
<div class="container">
	<div class="breadcrumb">
           <h3><i class="lnr lnr-chart-bars"></i> &nbsp;Account Summary</h3>
	</div>
	<div class="bs-example4">
		
		<div class="row">
				<div class="col-md-12"> 
        <form action="printfiles/ledger/print_summary.php" method="POST">
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
                <input type="hidden" name="showinvoicereport">
                <input type="submit" class="btn btn-success" value="Search">
          </div>
		  </div>
			</div>
		</div>
	</form>
</div>
</div>

<?php include 'lib/footer.php'; ?>