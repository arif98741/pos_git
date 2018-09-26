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
        echo "<script>alert('Transaction Category Updated Successfully');</script>";
    } else {
        echo "<script>alert('Transaction Category Updated Failed');</script>";
    }
}

//delete supplier
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $sta = $las->deletetranscat($_GET['id']);
    if ($sta) {
        echo "<script>alert('Transaction Category Deleted Successful');</script>";
    } else {
        echo "<script>alert('Transaction Category to Deleted Product');</script>";
    }
}
?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>TRANSACTION CATEGORIES</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li ><a href="index.php">Dashboard</a></li>
        
        <?php if(Session::get('status') == 'admin'): ?>
        
        <li class="active"><a type="button" href="#" class="" data-toggle="modal" data-target="#add_new_trans_category">Add New Transaction Category</a></li>
      
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
                  
                  <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" width="20%">Serial</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending"  width="30%">Transaction Category Name</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending"  width="20%">Type</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"  width="30%">Action</th>

                </tr>
                </thead>
                <tbody style="text-align: center;">
                            <?php
                            $cust_stmt = $db->select("select * from tbl_transactioncat where updateby='$userid' order by category_name desc");
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
                                            <a href="<?php echo BASE_URL; ?>edittranscat.php?action=edit&id=<?php echo $r['id']; ?>"><i class="fa fa-pencil-square-o btn" title="click to edit"></i></a>
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



 <!-- add transaction category modal -->
 <!-- add new transaction(general account) modal -->
<div class="modal fade" id="add_new_trans_category">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title "><i class="fa fa-plus"></i>&nbsp;Add New Transaction Category</h4>
      </div>
      <div class="modal-body">
         <form action="transcategorylist.php" method="post">
          <div class="col-md-6">
              <div class="form-group">
                  <input name="transactioncat" class="form-control" type="text" placeholder="Transaction Category Name" required="">
              </div>

          </div>
          <div class="col-md-6">
            <div class="form-group">
                <select name="type" id="" class="form-control" required="">
                  <option value="" disabled="" selected="">Select Transaction Type</option>
                  <option value="Debit" >Debit</option>
                  <option value="Credit" >Credit</option>
                </select>
            </div>

        </div>

        <div class="col-md-4 submit-button">
            <input type="submit" value="Save" name="addtransactioncat" class="btn btn-success">
                <input type="reset" value="Reset" class="btn btn-warning">
        </div>


        </form>
      </div>
      <div class="modal-footer">
        
        
      </div>
   </div>
    <!-- /.modal-content -->
  </div>
          <!-- /.modal-dialog -->
</div> 

 <?php include 'lib/footer.php'; ?>