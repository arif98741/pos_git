<?php include 'lib/header.php'; ?>
<?php if (Session::get('status') !== 'admin') {
    header("Location: index.php");
}?>

<?php
if (isset($_GET['product_id'])) {
    $sta = $pro->getsingleProduct($_GET['product_id']);
    $data = $sta->fetch_assoc();
    
} else {
    echo "<script>window.location = 'products.php';</script>";
}
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>পণ্য সম্পাদনা</h1>
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
            <form  action="products.php" method="post"  enctype="multipart/form-data">
             <div class="row">
                <div class="col-md-12"> 
                    <div class="col-md-4">
                        <div class="form-group">
                            <input name="product_id" class="form-control" type="text" value="<?php echo $data['product_id']; ?>" placeholder="পণ্যের আইডি"  required="">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <select name="product_type" class="form-control">
                                <option>একক নির্বাচন</option>
                                <?php
                                $status = $pro->showType();
                                while ($result = $status->fetch_assoc()) {
                                    ?>
                                <option <?php if ($data['product_type'] == $result['typeid']): ?> selected="selected" <?php endif; ?> value="<?php echo $result['typeid']; ?>"><?php echo $result['typename']; ?></option>
                            <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <select name="product_group" class="form-control">
                                <option>গ্রুপ নির্বাচন</option>
                                
                            <?php
                            $status = $pro->showGroup();
                            while ($result = $status->fetch_assoc()) {
                                ?>
                            <option <?php if ($data['product_group'] == $result['groupid']): ?> selected="selected" <?php endif; ?>  value="<?php echo $result['groupid']; ?>"><?php echo $result['groupname']; ?></option>
                            <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input name="product_name" class="form-control" type="text"  value="<?php echo $data['product_name']; ?>" placeholder="পণ্যের নাম"   required="">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <select name="product_brand" class="form-control">
                                <option>সরবরাহকারী নির্বাচন</option>
                                <?php
                                    $status = $sup->showSupplier();
                                    while ($result = $status->fetch_assoc()) {
                                        ?>
                                    <option <?php if ($data['product_brand'] == $result['supplier_id']): ?> selected="selected" <?php endif; ?>  value="<?php echo $result['supplier_id']; ?>"><?php echo $result['supplier_name']; ?></option>
                                    <?php } ?>
                            </select>  
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input name="sale_price" class="form-control" type="text" value="<?php echo $data['sale_price']; ?>" placeholder="বিক্রয়মূল্য"  required="">
                        </div>
                    </div>
                    
                    
                   <div class="col-md-4">
                        <div class="form-group">
                            <input  name="purchase_price" class="form-control" type="number"  value="<?php echo $data['purchase_price']; ?>" placeholder="ক্রয়মূল্য" required="">
                        </div>
                    </div>
                   
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" name="piece_in_a_carton" placeholder="পিচ/কাটুন"  class="form-control"  value="<?php echo $data['piece_in_a_carton']; ?>" />
                        </div>
                    </div>
                    <div class="col-md-6 submit-buttom">
                        <hr>
                        <input type="submit" value="সেভ"  name="updateproduct" class="btn btn-success">
                    <input type="reset" value="পুনরায়" class="btn btn-warning" disabled="">
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