<?php include 'lib/header.php'; ?>
<?php
//add customer
if (isset($_POST['addcustomer'])) {
    $result = $cus->insertCustomer($_POST);
    if ($result) {
        echo $result;
    }
}


//update customer
if (isset($_POST['updatecustomer'])) {
    $update = $cus->updateCustomer($_POST);
    if ($update) {
        echo "<script>alert('Customer Updated Successfully');</script>";
    } else {
        echo "<script>alert('Customer Updated Failed');</script>";
    }
}

//delete customer
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $sta = $cus->deleteCustomer($_GET);
    if ($sta) {
        echo "<script>alert('Customer Deleted Successful');</script>";
    } else {
        echo "<script>alert('Customer to Deleted Product');</script>";
    }
}
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>CUSTOMERS</h1>
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
                  <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" width="10%">Customer ID</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending"  width="20%">Customer Name</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending"  width="10%">Address</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"  width="20%">Contact No.</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"  width="20%">Email</th>

                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"  width="10%">Balance</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"  width="10%">Action</th>

                </tr>
                </thead>
               <tbody style="text-align: center;">
                            <?php
                            $cust_stmt = $db->select("SELECT * FROM tbl_customer tc JOIN customer_balance cb ON tc.customer_id = cb.customer_id ORDER BY tc.customer_name ASC");
                            ?>
                            <?php
                            if ($cust_stmt):
                                ?>
                                <?php while ($r = $cust_stmt->fetch_assoc()): ?>
                                    <tr>
                                        <td ><?php echo $r['customer_id']; ?></td>
                                        <td style="text-align: left;"><?php echo $r['customer_name']; ?></td>
                                        <td style="text-align: left;"><?php echo $r['address']; ?></td>
                                        <td style="text-align: left;"><?php echo $r['contact_no']; ?></td>
                                        <td style="text-align: left;"><?php echo $r['email']; ?></td>
                                        <td>
                                            <?php echo round($r['balance']);   ?>
                                              
                                        </td>
                                        <?php if(Session::get('status') == 'admin'): ?>
                                        <td>
                                            <a href="<?php echo BASE_URL; ?>viewcustomer.php?action=view&serial=<?php echo $r['serial']; ?>&customer_id=<?php echo $r['customer_id']; ?>"><i class="fa fa-eye" title="view customer information"></i></a>&nbsp;
                                            <a href="editcustomer.php?action=edit&serial=<?php echo $r['serial']; ?>&customer_id=<?php echo $r['customer_id']; ?>"><i class="fa fa-pencil-square-o btn" title="click to edit"></i></a>
                                           

                                        </td>
                                         <?php else: ?>
                                            <td>
                                                -
                                            </td>
                                         <?php endif; ?>

                                            </tr>
                                        <?php endwhile; ?>

                                    <?php else: ?>
                                        <tr>
                                            <td colspan="9" style="text-align: center;">No Customer Data Found</td>
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