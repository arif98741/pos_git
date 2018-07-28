<?php include 'lib/header.php'; ?>
<?php if (Session::get('status') !== 'admin') {
    header("Location: index.php");
}?>
<?php
//add transaction
if (isset($_POST['addsuppliertransaction'])) {
    
    $status = $sup->addSupplierTransaction($_POST);
    if ($status) {
        echo "<script>alert('লেনদেন সফলভাবে সংযোজন হয়েছে');</script>";
    } else {
        echo "<script>alert('লেনদেন সংযোজন ব্যর্থ');</script>";
    }
}


//update transaction
if (isset($_POST['updatesuppliersransaction'])) {
    $update = $sup->updateSupplierTransaction($_POST);
    if ($update) {
        echo "<script>alert('লেনদেন সফলভাবে সম্পাদন হয়েছে');</script>";
    } else {
        echo "<script>alert('লেনদেন সম্পাদন ব্যর্থ');</script>";
    }
}


//delete transaction
if (isset($_GET['action']) && $_GET['action'] ='del') {
    $sta = $sup->deleteSupplierTransaction($_GET['id']);
    if ($sta) {
        echo "<script>alert('লেনদেন সফলভাবে ডিলিট হয়েছ');</script>";
    } else {
        echo "<script>alert('লেনদেন ডিলিট ব্যর্থ');</script>";
    }
}
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>সরবরাহকারী লেনদেন তালিকা</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> প্রচ্ছদ</a></li>
        <li><a href="index.php">ড্যাশবোর্ড</a></li>
        <!-- <li><a href="addsuppliertransaction.php">Add New Transaction</a></li> -->
        <li><a type="button" href="#" class="" data-toggle="modal" data-target="#add-supplier-transaction">নতুন লেনদেন সংযোজন</a></li>
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

                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending"  width="10%">তারিখ</th>

                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending"  width="20%">সরবরাহকারী</th>
                  

                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"  width="20%">বিস্তারিত</th>

                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"  width="15%">ক্রয়মূল্য</th>

                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"  width="15%">পেমেন্ট</th>
                  
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"  width="10%">-</th>

                </tr>
                </thead>
                <tbody>
                            <?php
                           $status = $db->link->query($query = "SELECT * from tbl_supplier_transaction tst join tbl_supplier ts on tst.supplier = ts.supplier_id ORDER by tst.date DESC") or die($this->dbObj->link->error);

                            if ($status) {
                                $i = 0;
                                while ($result = $status->fetch_assoc()) { $i++;
                                    ?>
                            <tr style="text-align: center;" id="rowid-<?php echo $result['id']; ?>">
                                        <td><?php echo $help->formatDate($result['date'], 'd-m-Y'); ?></td>
                                        <td><?php echo $result['supplier_name']; ?></td>
                                         <td><?php echo substr($result['description'], 0,20); ?></td>
                                        <td><?php echo number_format((float)$result['purchase'], 2, '.', ''); ?></td>
                                        <td><?php echo number_format((float)$result['payment'], 2, '.', ''); ?></td>

                                        <td>

                                            <a href="<?php echo BASE_URL; ?>editsuppliertransaction.php?action=edit&id=<?php echo $result['id']; ?>" style="border-radius: 3px;" title="click to edit" ><i class="fa fa-pencil-square-o btn"></i></a>
                                            <a href="?action=del&id=<?php echo $result['id']; ?>"  title="click to delete" onclick="return confirm('are you sure to delete?')" ><i class="fa fa-trash-o btn"></i></a>
                                             

                                          </td>

                                            </tr>

                                            <?php } } else { ?>

                                    <?php } ?>
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