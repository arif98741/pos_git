<?php include 'lib/header.php'; ?>
<?php
//addproduct product
if (isset($_POST['addproduct'])) {
    $add = $pro->addProduct($_POST);
    if ($add) {
        echo "<script>alert('সফলভাবে যুক্ত হয়েছে');</script>";
    } else {
        echo "<script>alert('পণ্য সংযোজন ব্যর্থ');</script>";
    }
}


//update product
if (isset($_POST['updateproduct'])) {
    $update = $pro->updateProduct($_POST);
    if ($update) {
        echo "<script>alert('পণ্য সফলভাবে সম্পাদন হয়েছে');</script>";
    } else {
        echo "<script>alert('পণ্য সম্পাদন ব্যর্থ');</script>";
    }
}
//delete products

if (isset($_GET['product_id'])) {
    $sta = $pro->deleteProduct($_GET['product_id']);
    if ($sta) {
       echo "<script>alert('পণ্য সফলভাবে ডিলিট হয়েছে');</script>";
    } else {
        echo "<script>alert('পণ্য ডিলিট ব্যর্থ');</script>";
    }
}
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><i class="lnr lnr-list"></i> &nbsp;পণ্য সমূহ</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> প্রচ্ছদ</a></li>
        <li class="active"><a href="<?php echo BASE_URL; ?>">ড্যাশবোর্ড</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
     <div class="row">
       <div class="col-xs-12">
         
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                <thead>
                <tr role="row">
                  <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" width="10%">পণ্যের আইডি</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending"  width="10%">গ্রুপ</th>
				  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending"  width="15%">পণ্যের নাম</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"  width="10%">সরবরাহকারী</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"  width="5%">একক</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"  width="10%">ক্রয়মূল্য</th>

                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"  width="10%">সর্বশেষ সম্পাদন</th>

                   <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"  width="10%">-</th>

                </tr>
                </thead>
                <tbody>
                            <?php
                            $status = $pro->showProduct();

                            if ($status) {

                                while ($result = $status->fetch_assoc()) {
                                    ?>
                            <tr style="text-align: center;" id="rowid-<?php echo $result['serial']; ?>">
                                        <td><?php echo $result['product_id']; ?></td>
                                        <td style="text-align: left;"><?php echo $result['groupname']; ?></td>
                                        <td style="text-align: left;"><?php echo $result['product_name']; ?></td>
                                        <td  style="text-align: left;"><?php echo $result['supplier_name']; ?></td>
                                        <td style="text-align: left;"><?php echo $result['typename']; ?></td>
                                        <td><?php echo $result['purchase_price']; ?></td>
                                        <td><?php echo $help->formatDate($result['last_update'], 'd-m-Y'); ?></td>


                                        <td>
                                            <?php if(Session::get('status') == 'admin'): ?>

                                            <a href="<?php echo BASE_URL; ?>editproduct.php?product_id=<?php echo $result['product_id']; ?>" style="border-radius: 3px;" title="click to edit" ><i class="fa fa-pencil-square-o btn"></i></a>
                                            <a href="?action=del&serial=<?php echo $result['serial']; ?>&product_id=<?php echo $result['product_id']; ?>"  title="click to delete" onclick="return confirm('are you sure to delete?')" ><i class="fa fa-trash-o btn"></i></a>
                                            <?php else: ?>
                                                -
                                            <?php endif; ?>

                                        </td>

                                            </tr>

                                            <?php
                                        }
                                    } else {
                                        ?>

                                    <?php }
                                    ?>
                        </tbody>
              
              </table>
            </div>

            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>

      
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 <!-- footer -->

 <?php include 'lib/footer.php'; ?>