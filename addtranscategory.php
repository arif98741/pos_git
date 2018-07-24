<?php include 'lib/header.php'; ?> 
<?php if (Session::get('status') !== 'admin') {
    header("Location: index.php");
}?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><i class="fa fa-plus"></i> ADD TRANSACTION CATEGORY</h1>
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
                        <input name="transactioncat" class="form-control" type="text" placeholder="Transaction Category Name" required="">
                    </div>

                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <select name="type" id="" class="form-control" required="">
                          <option value="" disabled="" selected="">Select Transaction Type</option>
                          <option value="Debit" >Debit</option>
                          <option value="Credit" >Credit</option>
                        </select>
                    </div>

                </div>

                <div class="col-md-6 submit-button">
                    <input type="submit" value="Save" name="addtransactioncat" class="btn btn-success">
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