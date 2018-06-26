<?php include 'lib/header.php'; ?> 
<?php 

  if(isset($_GET['duty'] ) && $_GET['duty'] ='delete'){
    $id = $help->validAndEscape($_GET['id']);
    $stmt = $db->link->query("SELECT * FROM `committee` where id='$id'");
    if ($stmt) {
      $member_data = $stmt->fetch_assoc();
    }
  }

?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Edit Committe Member</h1>
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
            <form  action="viewcommittee.php" method="post"  enctype="multipart/form-data">
             <div class="col-md-4">
                <div class="form-group">
                  <input type="text" class="form-control" name="name" value="<?php echo $member_data['name']; ?>" placeholder="Enter Name" required="">
                  <input type="hidden" name="member_id" value="<?php echo $member_data['id']; ?>">
              </div>
             </div>

             <div class="col-md-4">
                <div class="form-group">
                  <input type="text" class="form-control" name="designation"  value="<?php echo $member_data['designation']; ?>"  placeholder="Enter Designation" required="">
              </div>
             </div>

              <div class="col-md-4">
                <div class="form-group">
                  <input type="text" class="form-control" name="address"  value="<?php echo $member_data['address']; ?>"  placeholder="Enter Address">
              </div>
             </div>

              <div class="col-md-4">
                <div class="form-group">
                  <input type="text" class="form-control" name="contact"  value="<?php echo $member_data['contact']; ?>"  placeholder="Enter Contact">
              </div>
             </div>

              <div class="col-md-8">
                <div class="form-group">
                  <input type="file" class="form-control" name="photo" >
              </div>
             </div>
             <div class="col-md-4">
              <input type="submit" name="updatemember" class="btn btn-primary">
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