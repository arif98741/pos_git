<?php include 'lib/header.php'; ?>
<?php
//add supplier
if (isset($_POST['addtransactioncat'])) {

    $result = $las->addtranscat($_POST);
    if ($result) {
        echo $result;
    } 
}


//update supplier
if (isset($_POST['updatetransactioncat'])) {
    $update = $las->updatetranscat($_POST);
    if ($update) {
        echo "<script>alert('ট্রানসেকশন ক্যাটাগরি সফলভাবে আপডেট হয়েছে');</script>";
    } else {
        echo "<script>alert('ট্রানসেকশন ক্যাটাগরি সফলভাবে আপডেট ব্যর্থ');</script>";
    }
}

//delete supplier
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $sta = $las->deletetranscat($_GET['id']);
    if ($sta) {
        echo "<script>alert('ট্রানসেকশন ক্যাটাগরি সফলভাবে ডিলিট হয়েছে');</script>";
    } else {
        echo "<script>alert('ট্রানসেকশন ক্যাটাগরি ডিলিট ব্যর্থ');</script>";
    }
}
?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>ট্রানসেকশন ক্যাটাগরি তালিকা</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> প্রচ্ছদ</a></li>
        <li ><a href="index.php">ড্যাশবোর্ড</a></li>
        
        <?php if(Session::get('status') == 'admin'): ?>
        
        <li ><a href="addtranscategory.php">ট্রানসেকশন ক্যাটাগরি যুক্ত করুন</a></li>
      
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
                  
                  <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" width="20%">ক্রমিক</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending"  width="30%"> ট্রানসেকশন ক্যাটাগরি নাম </th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending"  width="20%">ধরণ</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"  width="30%">-</th>

                </tr>
                </thead>
                <tbody style="text-align: center;">
                            <?php
                            $cust_stmt = $db->select("select * from tbl_transactioncat order by category_name desc");
                            ?>
                            <?php
                            $i = 0;
                            if ($cust_stmt):
                                ?>
                                <?php while ($r = $cust_stmt->fetch_assoc()): ?>
                                    <tr>
                                        <td><?php echo ++$i; ?></td>
                                        <td style="text-align: left;"><?php echo $r['category_name']; ?></td>
                                        <td style="text-align: left;"><?php echo $r['category_type']; ?></td>

                                        

                                        <td>
                                            <?php if(Session::get('status') == 'admin'): ?>
                                            <a href="edittranscat.php?action=edit&id=<?php echo $r['id']; ?>"><i class="fa fa-pencil-square-o btn" title="click to edit"></i></a>
                                            <a href="?action=delete&id=<?php echo $r['id']; ?>"><i id="deleterow"   class="fa fa-trash" style="color:red;" title="click to delete" onclick="return confirm('are you sure to delete?')" ></i></a>
                                            <?php else: ?>
                                              -
                                            <?php endif; ?>
                                        </td>
                                        

                                            </tr>
                                        <?php endwhile; ?>

                                    <?php else: ?>
                                        <tr>
                                            <td colspan="9" style="text-align: center;">No Data Found</td>
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