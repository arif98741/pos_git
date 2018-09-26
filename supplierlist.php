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
        echo "<script>alert('Supplier Updated Successfully');</script>";
    } else {
        echo "<script>alert('Supplier Updated Failed');</script>";
    }
}

//delete supplier
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $sta = $sup->deletesupplier($_GET);
    if ($sta) {
        echo "<script>alert('Supplier Deleted Successful');</script>";
    } else {
        echo "<script>alert('Supplier to Deleted Product');</script>";
    }
}
?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>SUPPLIERS</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="index.php">Dashboard</a></li>
        <?php if(Session::get('status') == 'admin'): ?>
        <li class="active"><a type="button" href="#" class="" data-toggle="modal" data-target="#add_new_supplier">Add New Supplier</a></li>
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
                  <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" width="10%">Seial</th>
                  <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" width="10%">Supplier ID</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending"  width="20%">Supplier Name</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending"  width="10%">Address</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"  width="20%">Contact No.</th>

                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"  width="20%">Email</th>

                   <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"  width="20%">Balance</th>


                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"  width="10%">Action</th>

                </tr>
                </thead>
                <tbody style="text-align: center;">
                            <?php
                            $cust_stmt = $db->select("SELECT ts.*, sum(tst.purchase) as 'purchase' , sum(tst.payment) as 'payment' from tbl_supplier_transaction tst join tbl_supplier ts group by ts.supplier_id");

                            
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
                                        <td style="text-align: center;"><?php echo $r['purchase'] - $r['payment']; ?></td>


                                        <td>
                                            <?php if(Session::get('status') == 'admin'): ?>
                                            <a href="<?php echo BASE_URL; ?>editsupplier.php?action=edit&serial=<?php echo $r['serial']; ?>&supplier_id=<?php echo $r['supplier_id']; ?>"><i class="fa fa-pencil-square-o btn" title="click to edit"></i></a>
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
   <!-- add new customer modal -->
<div class="modal fade" id="add_new_supplier">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title "><i class="fa fa-user"></i>&nbsp;Add New Supplier</h4>
      </div>
      <div class="modal-body">
         <form action="supplierlist.php" method="post">

          <div class="col-md-6">
              <div class="form-group">
                  <input name="supplier_id" class="form-control" type="text" placeholder="Supplier ID" required="">
              </div>

          </div>

          <div class="col-md-6">
              <div class="form-group">
                  <input name="supplier_name" class="form-control" type="text" placeholder="Supplier Name" required="">

              </div>

          </div>

          <div class="col-md-6">
              <div class="form-group">
                  <input name="address" class="form-control" type="text" placeholder="Address" required="">

              </div>

          </div>
          <div class="col-md-6">
              <div class="form-group">
                  <input name="contact_no" class="form-control" type="text" placeholder="Contact No"  required="">
              </div>

          </div>
          <div class="col-md-6">
              <div class="form-group">
                  <input name="contact_person" class="form-control" type="text" placeholder="Contact Person"  required="">
              </div>

          </div>


         
          <div class="col-md-6">
              <div class="form-group">
                  <input  name="email" class="form-control" type="email" placeholder="Email" required="">

              </div>

          </div>
          
          <div class="col-md-6">
              <div class="form-group">
                  <input  name="remark" class="form-control" type="text" placeholder="Remark"  required="">
              </div>

          </div>

          <div class="col-md-offset-4 col-md-6 submit-buttom">
              <input type="submit" value="Save supplier" name="addsupplier" class="btn btn-success">
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