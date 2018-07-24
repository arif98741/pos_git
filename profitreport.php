<?php include 'lib/header.php'; ?> 
<?php if (Session::get('status') !== 'admin') {
    header("Location: index.php");
}?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><i class="lnr lnr-chart-bars"></i> &nbsp;PROFIT REPORT</h1>
      <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="<?php echo BASE_URL; ?>">Dashboard</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="col-sm-12">
        <div class="box">
          <div class="box-body">
           
           <div class="row">
        <div class="col-md-12"> 
       
        <form action="printfiles/sale/printprofit.php" method="POST">
            <div class="col-md-6 ">
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
                <div class="form-group">
                  <label for=""><strong>Product</strong></label>
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

          <div class="col-md-offset-5 col-md-6">
             <div class="form-group">
                <input type="submit" name="showprofit" class="btn btn-primary" value="Preview">
                 <input type="submit" name="showprofitproductwise" class="btn btn-warning" value="Product Wise">
            </div>
          </div>
      </form>
      </div>
    </div>
             
        </div>
      </div>
      
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 <!-- footer -->

 <?php include 'lib/footer.php'; ?>