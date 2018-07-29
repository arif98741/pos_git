<?php include 'lib/header.php'; ?> 
<?php if (Session::get('status') !== 'admin') {
    header("Location: index.php");
}?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><i class="lnr lnr-chart-bars"></i> &nbsp;পণ্যের প্রতিবেদন</h1>
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
                <form action="printfiles/product/print.php" method="post">


 

                <div class="col-md-6">
                    <div class="form-group">
                        <select name="product_group" class="form-control">
                            <option>গ্রুপ নির্বাচন করুন</option>
                            <?php
                            $status = $pro->showGroup();
                            if($status) {
                                while ($result = $status->fetch_assoc()) { ?>
                                     <option value="<?php echo $result['groupid']; ?>"><?php echo $result['groupname']; ?></option>

                             <?php   }  } ?>
                            
                              
                        </select>
                    </div>

                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <select name="supplier_id" class="form-control">
                            <option>সরবরাহকারী নির্বাচন করুন</option>
                            <?php 
                                    $status = $sup->showSupplier();
                                    //brand is granted as supplier
                                    if($status){
                                         while ($result = $status->fetch_assoc()) { ?>
                                             <option value="<?php echo $result['supplier_id']; ?>"><?php echo $result['supplier_name']; ?></option>

                                        <?php 
                                    }
                                }
                                ?>
                           
                        </select>  
                    </div>

                </div>

               


                <div class="col-md-12 submit-buttom">
        <hr>
                    <input type="submit" value="সব পণ্য" name="reportallproduct" class="btn btn-success">
                    <input type="submit" value="গ্রুপ অনুযায়ী" name="reportbygroup" class="btn btn-warning">
                    <input type="submit" value="সরবরাহকারী অনুযায়ী" name="reportbybrand" class="btn btn-success">

                </div>
              </form>
        </div>
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