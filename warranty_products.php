<?php include 'lib/header.php'; ?>
<?php
//addproduct product
if (isset($_POST['addproduct'])) {
    $add = $pro->addProduct($_POST);
    if ($add) {
        echo "<script>alert('Product Added Successfully');</script>";
    } else {
        echo "<script>alert('Product Added Failed');</script>";
    }
}


//update product
if (isset($_POST['updateproduct'])) {
    $update = $pro->updateProduct($_POST);
    if ($update) {
        echo "<script>alert('Product Updated Successfully');</script>";
    } else {
        echo "<script>alert('Product Update Failed');</script>";
    }
}
//delete products

if (isset($_GET['product_id'])) {
    $sta = $pro->deleteProduct($_GET['product_id']);
    if ($sta) {
        echo "<script>alert('Product Deleted Successful');</script>";
    } else {
        echo "<script>alert('Failed to Delete Product');</script>";
    }
}
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><i class="lnr lnr-list"></i> &nbsp;Warranty PRODUCTS</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="<?php echo BASE_URL; ?>">Dashboard</a></li>
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
                  <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" width="10%">ID</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending"  width="15%">Group</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending"  width="20%">Product Name</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"  width="20%">Invoice ID</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"  width="15%">Serial</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"  width="15%">Expire Date</th>

                </tr>
                </thead>
                <tbody>
                      <?php
                            

					         $q = "SELECT * FROM tbl_sell_products tsp join tbl_product tp on tsp.product_id = tp.product_id join tbl_group tg on tp.product_group = tg.groupid where tsp.status='1' order by tsp.serial_no asc";           
                            $st = $db->link->query($q);

                            if ($st) {

                                while ($result = $st->fetch_assoc()) {
                                    ?>
	                            <tr style="text-align: center;">
                                    <td><?php echo $result['product_id']; ?></td>
                                    <td style="text-align: left;"><?php echo $result['groupname']; ?></td>
                                    <td style="text-align: left;"><?php echo $result['product_name']; ?></td>
                                    <td  style="text-align: center;"><?php echo $result['sell_id']; ?></td>
                                    <td style="text-align: center;">
                                      <?php if($result['product_serial'] !== ''){
                                          echo $result['product_serial'];
                                        }else{
                                          echo '-';
                                        } ?>
                                      
                                    </td>
                                    <td><?php
                                      if ($result['warranty_expire'] > 1971 ) {
                                        echo $help->formatDate($result['warranty_expire'],'d-m-Y');
                                      }else{
                                        echo '-';
                                      }
                                      ?>
                                       

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
