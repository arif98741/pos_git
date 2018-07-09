<?php include 'lib/header.php'; ?>
<?php if (Session::get('status') !== 'admin') {
    header("Location: index.php");
}?>
<?php
  if(isset($_GET['action']) && isset($_GET['userid'])){
    $userid = $help->validAndEscape($_GET['userid']);
    $status = $db->select("select * from tbl_user where userid='$userid'");
    if ($status) {
      $userdata = $status->fetch_assoc();
    }


  } else {
    header("Location: users.php");
  }
 ?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>EDIT USER</h1>
      <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="<?php echo BASE_URL; ?>">Dashboard</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="col-sm-12">
        <div class="box">
          <div class="box-body">
            <form action="users.php" method="post">
          
          <div class="col-md-6">
              <div class="form-group">
                  <input name="usernamename" value="<?php echo $userdata['username']; ?>" class="form-control" type="text" placeholder="Name" required="" readonly>
                  <input name="userid" type="hidden" value="<?php echo $userdata['userid']; ?>">
              </div>

          </div>



          <div class="col-md-6">
              <div class="form-group">
                  <input name="name" class="form-control" value="<?php echo $userdata['name']; ?>" type="text" placeholder="Username" required="">

              </div>

          </div>

          <div class="col-md-6">
              <div class="form-group">
                  <input name="password" class="form-control" type="password" placeholder="Password" >
              </div>
          </div>


          <div class="col-md-6">
              <div class="form-group">
                  <input name="email" class="form-control" value="<?php echo $userdata['email']; ?>"  type="email" placeholder="Email" required="">

              </div>

          </div>
                

          <div class="col-md-offset-4 col-md-6 submit-buttom">
              <input type="submit" value="Update User" name="updateuser" class="btn btn-success">
              <input type="reset" value="Reset" class="btn btn-warning">

          </div>

        </form>
          </div>
        </div>
      </div>
      
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 <!-- footer -->

 <?php include 'lib/footer.php'; ?>





