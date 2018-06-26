<?php include 'lib/header.php'; ?>
<?php if (Session::get('status') !== 'admin') {
    header("Location: index.php");
}?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><i class="lnr lnr-pencil"></i>&nbsp;UPDATE PRODUCT UNIT</h1>
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
                  <?php
                    
                    //get typedata

                    if (isset($_GET['action']) && isset($_GET['typeid'])) {
                       
                        $typeid = mysqli_real_escape_string($db->link,$_GET['typeid']);
                        $stmt = $db->link->query("select * from tbl_type where typeid ='$typeid'");
                        $typedata = $stmt->fetch_assoc();
                    }
                ?>
                <form action="typelist.php" method="post">
                  
                  <div class="col-md-4">
                        <div class="form-group">
                            <input name="typename" class="form-control" type="text" value="<?php echo $typedata['typename']; ?>" required="">
                        </div>
                    </div>

                    <div class="col-md-6 submit-buttom">
                        
                        <input type="submit" name="updatetype" value="Save Type" class="btn btn-success">
                        <input type="hidden" name="typeid" value="<?php echo $typedata['typeid']; ?>"  class="btn btn-success">
                        <input type="reset" value="Reset" class="btn btn-warning">
                    </div>

                    <div class="col-md-8">
                        <?php if(!empty($msg)): ?>
                        <br/> <br/>
                        <div class="col-md-12">
                           <?php echo $msg; ?>
                        </div>
                    <?php endif; ?>

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