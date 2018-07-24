<?php include 'lib/header.php'; ?>


<?php
//add invoice

if (isset($_POST['addpurchase'])) {
    if($inv->saveInvoice($_POST)){
        echo "<script>alert('Purchase Added Successfully');</script>";
    }else{
        echo "<script>alert('Purchase Added Failed!');</script>";
    }
}



//update invoice
if ( isset($_POST['edit'])) {
    if($inv->updateInvoice($_POST)){
        echo "<script>alert('Purchase Updated Successfully');</script>";
        echo "<script>window.loction='';</script>";

    }else{
        echo "<script>alert('Purchase Updated Failed!');</script>";
    }

}

//delete invoice
if (isset($_GET['action']) && $_GET['action']=='delete') {
    $serial = $_GET['serial'];
    if($inv->deleteInvoice($serial, $_GET['invoice_id'])){
         echo "<script>alert('Purchase Deleted Successfully');</script>";
    }else{
        echo "<script>alert('Purchase Deleted Failed!');</script>";
    }
   
}
?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><i class="lnr lnr-list"></i> &nbsp;Purchase List</h1>
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
              <table id="purchaselist" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                <thead>
                <tr role="row">
                  <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" width="10%">Serial</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending"  width="10%">Invoice No</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending"  width="15%">Supplier</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"  width="10%">Quantity</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"  width="5%">Total</th>

                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"  width="10%">Date</th>

                  
                   <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"  width="10%">Action</th>

                </tr>
                </thead>
                <tbody>
                        <?php
                        $status = $inv->showInvoices();

                        if ($status) {
                            $i = 0;
                            while ($result = $status->fetch_assoc()) {
                                $i++;
                                ?>
                                <tr style="text-align: center;" id="rowid-<?php echo $result['serial']; ?>">
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $result['invoice_number']; ?></td>
                                    <td style="text-align: left;"><?php echo $result['supplier_name']; ?></td>
                                    <td><?php echo $result['quantity']; ?></td>
                                    <td><?php echo $result['total']; ?></td>
                                    <td><?php echo $help->formatDate($result['date'],'d-m-Y'); ?></td>

                                    <?php if(Session::get('status') == 'admin'): ?>

                                    <td>
                                        <a href="viewpurchase.php?action=view&serial=<?php echo $result['serial'] ?>&invoice_id=<?php echo $result['invoice_number']; ?>" style="border-radius: 3px;" title="click to view" ><i class="fa fa-eye"></i>&nbsp;&nbsp;</a>
                                        <a href="editpurchase.php?action=edit&serial=<?php echo $result['serial'] ?>&invoice_id=<?php echo $result['invoice_number']; ?>" style="border-radius: 3px;" title="click to edit" ><i class="fa fa-pencil-square-o"></i>&nbsp;&nbsp;</a>

                                        <a href="printfiles/purchase/printpurchase.php?serial=<?php echo $result['serial'] ?>&invoice_id=<?php echo $result['invoice_number']; ?>" style="border-radius: 3px;" title="click to print" ><i class="fa fa-print"></i></a>

                                        <a href="?action=delete&serial=<?php echo $result['serial'] ?>&invoice_id=<?php echo $result['invoice_number']; ?>" style="border-radius: 3px;" title="click to delete" onclick="return confirm('are you sure to delete?')" id="rowdelete" delid="<?php echo $result['serial']; ?>"><i class="lnr lnr-trash"></i></a>
                                    </td>

                                    <?php else:  ?>

                                    <td>
                                         <a href="viewpurchase.php?action=view&serial=<?php echo $result['serial'] ?>&invoice_id=<?php echo $result['invoice_number']; ?>" style="border-radius: 3px;" title="click to view" ><i class="fa fa-eye"></i>&nbsp;&nbsp;</a>
                                    </td>
                                   <?php endif; ?> 
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