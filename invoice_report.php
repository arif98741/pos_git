<?php include 'lib/header.php'; ?> 
<?php if (Session::get('status') !== 'admin') {
    header("Location: index.php");
}?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><i class="lnr lnr-chart-bars"></i> &nbsp;মেমো প্রতিবেদন</h1>
      <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-dashboard"></i> প্রচ্ছদ</a></li>
        <li class="active"><a href="<?php echo BASE_URL; ?>">ড্যাশবোর্ড</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="col-sm-12">
        <div class="box">
          <div class="box-body">
           <div class="row">
        <div class="col-md-12"> 
       
        <form action="printfiles/sale/invoicereport.php" method="POST">
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
            <label for="">ক্রেতা</label>
            <select name="customer_id" id="" class="customer form-control universal_select2_dropdown">
              <option value="">ক্রেতা নির্বাচন করুন</option>
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
                <input type="submit" name="showinvoicereport" class="btn btn-success" value="সবগুলো">
                <input type="submit" name="showinvoiceaccordingtocustomer" class="btn btn-primary" value="ক্রেতা অনুযায়ী">
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