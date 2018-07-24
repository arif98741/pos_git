<?php include 'lib/header.php'; ?> 
<?php if (Session::get('status') !== 'admin') {
    header("Location: index.php");
}?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><i class="lnr lnr-chart-bars"></i>  TRANSACTION REPORT</h1>
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
            <form action="printfiles/ledger/ledger_report.php" method="post">
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
                    <select name="category" class="form-control">
                          <option>Select Category</option>
                          <?php
                              $status = $las->showCategory();
                             
                              if ($status) {
                                  while ($result = $status->fetch_assoc()) { ?>
                                   <option value="<?php echo $result['id']; ?>"><?php echo $result['category_name']; ?></option>
                       <?php  } } ?>
                      </select>
                 </div> 
 
                
              </div>  

              <div class="col-md-12">
                <div class="form-group">
                  
                    <input type="submit" class="btn btn-success " name="showalledgerreport" value="All Transaction">
                    <input type="submit" class="btn btn-primary " name="ledgerreportbycategory" value="Category Wise">
                    
                    <input type="submit" class="btn btn-primary " name="accountsummary" value="Account Summary">
      </div>
        </div>
      </div>
            </div>
          </form>
        </div>
      </div>
      
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 <!-- footer -->
 <?php include 'lib/footer.php'; ?>