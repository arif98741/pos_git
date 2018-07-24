<?php include 'lib/header.php'; ?> 
<?php if (Session::get('status') !== 'admin') {
    header("Location: index.php");
}?>

 <?php
    if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])) {
      $id = $help->validAndEscape($_GET['id']);
      $stmt = $db->link->query("select * from tbl_transactioncat where id='$id'");
      if ($stmt) {
        $transactdata = $stmt->fetch_assoc();

      }
    }
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><i class="fa fa-pencil"></i> Edit TRANSACTION CATEGORY</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="col-sm-12">
        <div class="box">
          <div class="box-body">
            <form action="transcategorylist.php" method="post">
             <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <input name="transactioncat" class="form-control" value="<?php echo $transactdata['category_name']; ?>" type="text" placeholder="Transaction Category Name" required="">

                        <input name="transactioncatid" class="form-control" value="<?php echo $transactdata['id']; ?>" type="hidden" >
                    </div>

                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <select name="type" id="" class="form-control" required="">

                          <option value="" disabled="" selected="">Select Transaction Type</option>
                          <option value="Debit" <?php if($transactdata['category_type'] == 'Debit') echo "selected" ?>>Debit</option>
                          <option value="Credit" <?php if($transactdata['category_type'] == 'Credit') echo "selected" ?>>Credit</option>
                        </select>
                    </div>

                </div>

                <div class="col-md-6 submit-button">
                    <input type="submit" value="Update" name="updatetransactioncat" class="btn btn-success">
                        <input type="reset" value="Reset" class="btn btn-warning">
                </div>
              
            </div>
          </form>
        </div>
      </div>
      
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 <!-- footer -->
 <?php include 'lib/footer.php'; ?>