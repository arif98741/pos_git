<?php include 'lib/header.php'; ?>
<?php if (Session::get('status') !== 'admin') {
    header("Location: index.php");
}?>
<?php
//add laser
if (isset($_POST['addlaser'])) {
    
    $add = $las->addLaser($_POST);
    if ($add) {
        echo "<script>alert('Transaction Added Successfully');</script>";
    } else {
        echo "<script>alert('Transaction Added Failed');</script>";
    }
}


//update laser
if (isset($_POST['updatelaser'])) {
    $update = $las->updateLaser($_POST);
    if ($update) {
        echo "<script>alert('Transaction Updated Successfully');</script>";
    } else {
        echo "<script>alert('Transaction Update Failed');</script>";
    }
}


//delete laser
if (isset($_GET['action']) && $_GET['action'] ='del') {
    $sta = $las->deleteLaser($_GET['serial']);
    if ($sta) {
        echo "<script>alert('Transaction Deleted Successful');</script>";
    } else {
        echo "<script>alert('Failed to Delete Transaction');</script>";
    }
}
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>TRANSACTION LIST</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="index.php">Dashboard</a></li>
       <!-- <li class="active"><a href="addlaser.php">Add New Transaction</a></li> --> 
        <li class="active"><a type="button" href="#" class="" data-toggle="modal" data-target="#add-new-transaction">Add New Transaction</a></li>
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
                  <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" width="10%">SL</th>

                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending"  width="10%">Date</th>

                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending"  width="20%">Category</th>
                  

                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"  width="20%">Description</th>

                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"  width="15%">Credit/Cash In</th>

                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"  width="15%">Debit/Cash Out</th>
                  
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"  width="10%">Action</th>

                </tr>
                </thead>
                <tbody>
                            <?php
                            $status = $las->showLaser();

                            if ($status) {
                                $i = 0;
                                while ($result = $status->fetch_assoc()) { $i++;
                                    ?>
                            <tr style="text-align: center;" id="rowid-<?php echo $result['serial']; ?>">
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $help->formatDate($result['date'], 'd-m-Y'); ?></td>
                                        <td style="text-align: left;"><?php echo $result['category_name']; ?></td>
                                        
                                         <td><?php echo substr($result['description'], 0,20); ?></td>
                                         <td><?php echo round($result['credit']); ?></td>
                                        <td><?php echo round($result['debit']); ?></td>
                                        
                                       
                                        
                                        <td>
                                             <?php if(Session::get('status') == 'admin'): ?>

                                            <a href="<?php echo BASE_URL; ?>editlaser.php?action=edit&serial=<?php echo $result['serial']; ?>" style="border-radius: 3px;" title="click to edit" ><i class="fa fa-pencil-square-o btn"></i></a>
                                            <a href="?action=del&serial=<?php echo $result['serial']; ?>"  title="click to delete" onclick="return confirm('are you sure to delete?')" ><i class="fa fa-trash-o btn"></i></a>
                                             <?php else: ?>
                                                -

                                             <?php endif; ?>

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