<?php include 'lib/header.php'; ?>
<?php if (Session::get('status') !== 'admin') {
    header("Location: index.php");
}?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><i class="lnr lnr-chart-bars"></i> ক্রেতা বিবৃতি</h1>
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
            <form action="printfiles/customer/printstatement.php" method="POST">
             <div class="row">
                  <div class="row">
                  <div class="col-md-12"> 
         
          <form action="printfiles/customer/printstatement.php" method="POST">
              <div class="col-md-6">
                  <div class="form-group">
                    <label for=""><strong>থেকে</strong></label>
                    <input type="date" name="starting" id="startdate" class="form-control">
                 </div>  
                  <div class="form-group">
                    <label for=""><strong>পর্যন্ত</strong></label>
                    <input type="date" name="ending" id="enddate" class="form-control">
                 </div>
              </div>

            <div class="col-md-6">
              <label for="">কেতা</label>
              <select name="customer_id" id="" class="customer form-control">
                <option value="">নির্বাচন করুন</option>
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
                  <input type="submit" name="showallstatement" class="btn btn-success" value="দেখুন">
              </div>
            </div>

              </div>
          </div>
             </div>
        </form>
            
          </div>
        </div>
      </div>
      
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 <!-- footer -->
 <?php include 'lib/footer.php'; ?>