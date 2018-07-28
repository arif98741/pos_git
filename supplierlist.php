<?php include 'lib/header.php'; ?>
<?php
//add supplier
if (isset($_POST['addsupplier'])) {

    $result = $sup->addSupplier($_POST);
    if ($result) {
        echo $result;
    } 
}


//update supplier
if (isset($_POST['updatesupplier'])) {
    $update = $sup->updatesupplier($_POST);
    if ($update) {
        echo "<script>alert('সরবরাহকারী সফলভাবে সম্পাদন হয়েছে');</script>";
    } else {
        echo "<script>alert('সরবরাহকারী সম্পাদন ব্যর্থ');</script>";
    }
}

//delete supplier
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $sta = $sup->deletesupplier($_GET);
    if ($sta) {
        echo "<script>alert('সরবরাহকারী সফলভাবে ডিলিট হয়েছে');</script>";
    } else {
        echo "<script>alert('সরবরাহকারী  ডিলিট ব্যর্থ');</script>";
    }
}
?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>সরবরাহকারী তালিকা</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> প্রচ্ছদ</a></li>
        <li class="active"><a href="<?php echo BASE_URL; ?>">ড্যাশবোর্ড</a></li>
        <?php if(Session::get('status') == 'admin'): ?>
        <li class="active"><a href="addsupplier.php">নতুন সরবরাহকারী সংযোজন</a></li>
      <?php endif; ?>
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
                  <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" width="10%">ক্রমিক</th>
                  <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" width="10%">সরবরাহকারী  আইডি</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending"  width="20%">সরবরাহকারী নাম</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending"  width="10%">ঠিকানা</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"  width="20%">মোবাইল</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"  width="20%">ইমেইল</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"  width="10%">-</th>

                </tr>
                </thead>
                <tbody style="text-align: center;">
                            <?php
                            $cust_stmt = $db->select("select * from tbl_supplier order by serial desc");
                            ?>
                            <?php
                            $i = 0;
                            if ($cust_stmt):
                                ?>
                                <?php while ($r = $cust_stmt->fetch_assoc()): ?>
                                    <tr>
                                        <td><?php echo ++$i; ?></td>
                                        <td><?php echo $r['supplier_id']; ?></td>
                                        <td style="text-align: left;"><?php echo $r['supplier_name']; ?></td>
                                        <td style="text-align: left;"><?php echo $r['address']; ?></td>
                                        <td style="text-align: left;"><?php echo $r['contact_no']; ?></td>
                                        <td style="text-align: left;"><?php echo $r['email']; ?></td>

                                       

                                        <td>
                                            <?php if(Session::get('status') == 'admin'): ?>
                                            <a href="editsupplier.php?action=edit&serial=<?php echo $r['serial']; ?>&supplier_id=<?php echo $r['supplier_id']; ?>"><i class="fa fa-pencil-square-o btn" title="click to edit"></i></a>
                                            <a href="?action=delete&serial=<?php echo $r['serial']; ?>&supplier_id=<?php echo $r['supplier_id']; ?>"><i id="deleterow"   class="fa fa-trash" style="color:red;" title="click to delete" onclick="return confirm('are you sure to delete?')" ></i></a>
                                          <?php else:  ?>
                                          -  
                                          <?php endif; ?>

                                        </td>
                                        
                                    
                                     

                                            </tr>
                                        <?php endwhile; ?>

                                    <?php else: ?>
                                        <tr>
                                            <td colspan="9" style="text-align: center;">No supplier Data Found</td>
                                        </tr>
                                    <?php endif; ?>
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