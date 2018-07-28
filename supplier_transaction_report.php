<?php include 'lib/header.php'; ?> 
<?php if (Session::get('status') !== 'admin') {
    header("Location: index.php");
}?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><i class="lnr lnr-chart-bars"></i> সরবরাহকারী লেনদেন প্রতিবেদন</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> প্রচ্ছদ</a></li>
        <li class="active">ড্যাশবোর্ড</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="col-sm-12">
        <div class="box">
          <div class="box-body">
            <form action="printfiles/supplier/transaction_print.php" method="post">
             <div class="row">
        
              <div class="col-md-12"> 
              <div class="col-md-6">


                  <div class="form-group">
                    <label for=""><strong>থেকে</strong></label>
                    <input type="date" name="starting" id="startdate" class="form-control">
                 </div>  
                  <div class="form-group">
                    <label for=""><strong>পর্যন্ত</strong></label>
                    <input type="date" name="ending" id="enddate" class="form-control">
                 </div>
                 <div class="form-group">
                    
                 </div>
              </div>  


              <div class="col-md-6">

                  <div class="form-group">
                    <label for=""><strong>সরবরাহকারী অনুযায়ী</strong></label>
                    <select name="supplier_id"  id="supplier_dropdown"  class="form-control" >
                            <option value="" disabled  selected="" disabled="">নির্বাচন করুন</option>
                            <?php
                            $status = $sup->showSupplier();
                            if ($status) {
                                 while ($result = $status->fetch_assoc()) { ?>
                                       <option value="<?php echo $result['supplier_id']; ?>"><?php echo ucfirst($result['supplier_name']); ?></option>
                           
                              <?php   }  }  ?>
                         
                        </select>
                 </div> 
 
                
              </div>  

              <div class="col-md-12">
                <div class="form-group">
                  
                    <input type="submit" class="btn btn-success " name="showalltransaction" value="সব লেনদেন">
                    
                    <input type="submit" class="btn btn-primary " name="supplierstatement" value="সরবরাহকারী বিবৃতি"> 

                   <!--  <input type="submit" class="btn btn-primary " name="showalltransactionbycat" value="Supplier Statement"> -->


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