<?php include 'lib/header.php'; ?>
<?php if (Session::get('status') !== 'admin') {
    header("Location: index.php");
}?>
<?php
if(isset($_POST['addtype'])){
    $msg = "";
    $typename = $help->validAndEscape($_POST['typename']);
    $checkstmt = $db->select("select * from tbl_type WHERE  typename ='$typename'");
    if(!$checkstmt){
        $stmt = $db->insert("insert into tbl_type(typename) VALUES ('$typename')");
        if($stmt){
            $msg = "<script>alert('Unit Added Successully');</script>";
        }else{
            $msg = "<script>alert('Unit Added Successully');</script>";
        }
    }else{
        $msg = "<script>alert('Unit Already Exist');</script>";
    }

    echo $msg;


}
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><i class="lnr lnr-plus-circle"></i>&nbsp;ADD PRODUCT UNIT</h1>
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
            <div class="row">
                <div class="col-md-12"> 
                <form action="" method="post">
                  
                  <div class="col-md-4">
                      <div class="form-group">
                          <input name="typename"  class="form-control" type="text" placeholder="Unit"  required="">
                      </div>

                  </div>

                  <div class="col-md-6 submit-button">
                      <input type="submit" value="Save Unit" name="addtype" class="btn btn-success">
                      <input type="reset" value="Reset" class="btn btn-warning">
                  </div>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
      
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 <!-- footer -->
 <?php include 'lib/footer.php'; ?>