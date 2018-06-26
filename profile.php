<?php include 'lib/header.php'; ?>

<?php 
       
        if (isset($_POST['uploadfile'])) {
            
            $permited = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_temp = $_FILES['image']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            //$unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
            $unique_image = "logo_".$userid.".".$file_ext;
            
            $uploaded_image = "uploads/" . $unique_image;

            if (empty($file_name)) {
                echo "<script>alert('You Must Chose A File'); </script>";
            } elseif ($file_size > 2097134) {
                echo "<script>alert('Image Size is not valid'); </script>";
            } elseif (in_array($file_ext, $permited) === false) {
                echo "<script>alert('You can upload only image files'); </script>";
            } else {
              $userid = Session::get('userid');
              $userstmt = "select logo from tbl_user where userid='$userid'";
              

              //if(file_exists($customer_data['logo'])){
                unlink($customer_data['logo']);
            //  }
                
                move_uploaded_file($file_temp, $uploaded_image);
                $query = "update tbl_user set logo = '$uploaded_image' where userid ='$userid'";
                $updated_rows = $db->link->query($query);
                if ($updated_rows) {
                    echo "Logo Updated Successfully";
                    header("Location: profile.php?id=".$userid);
                } else {
                    echo "<span class='error'>Error! Logo Not Updated</span>";
                }
            }
        }

        if (isset($_POST['updateprofile'])) {

          $name = $help->validAndEscape($_POST['name']);
          $company_name = $help->validAndEscape($_POST['company_name']);
          $address = $help->validAndEscape($_POST['address']);
          $email = $help->validAndEscape($_POST['email']);
          $password = md5($help->validAndEscape($_POST['password']));
          $status = $help->validAndEscape($_POST['status']);
          $userid = Session::get('userid');

          if (!empty($_POST['password'])) {
            $query = "update tbl_user set name = '$name', email = '$email',
                        password = '$password', company_name = '$company_name',
                        address = '$address', status = '$status'
                        where userid = '$userid'";

             $stmt =  $db->link->query($query);
             if($stmt){
                echo "<script>alert('Profile Updated Successfully');</script>";
                
             }else{

                echo "<script>alert('Profile Updated Failed');</script>";
             }
          }else if (empty($name) || empty($company_name) || empty($address) || empty($email) || empty($status)) {
              echo "<script>alert('Field Must not be Empty');</script>";
          }else{
              $query = "update tbl_user set name = '$name', email = '$email',
                        company_name = '$company_name',
                        address = '$address', status = '$status'
                        where userid = '$userid'";

             $stmt =  $db->link->query($query);
             if($stmt){
                echo "<script>alert('Profile Updated Successfully');</script>";
                

             }else{

                echo "<script>alert('Profile Updated Failed');</script>";
                
             }
          }
        }

?>

<?php

  if(isset($_GET['id']))
  {

    $userid = Session::get('userid');
    $stmt = $db->link->query("select * from tbl_user where userid='$userid'");
    if($stmt)
    {
      $customer_data = $stmt->fetch_assoc();
    }

  }     
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
     
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
            <div class="profile_section ">
              <div class="col-md-2 ">
                <div class="pro_pic ">
                  <img src="<?php echo $customer_data['logo']; ?>" alt="" width="200px" height="200px;">
                </div>
                <?php if(Session::get('status') == 'admin'): ?>
                <div class="pro_details">
                  <div class="form-group">
                   
                    <form action="" method="post" enctype="multipart/form-data">
                         <input type="file" name="image"><br/>
                         <input type="hidden" name="uploadfile"><br/>
                        <input type="submit" class="btn btn-primary form-control">
                    </form>
                  
                  </div> 
                 
                </div>
              <?php endif; ?>
              </div>
            </div>


            <div class="profile_content">
              <div class="col-md-9 col-md-offset-1">
                <div id="page-wrapper">
           <div class="graphs">
           <ul class="nav nav-tabs">
              <li class="active"><a data-toggle="tab" href="#home">Details</a></li>
              <li><a data-toggle="tab" href="#menu1">Login and Activity</a></li>
          </ul>

        <div class="tab-content">
          <div id="home" class="tab-pane fade in active">
            <h3>Company Details</h3>
            <div class="well">

              <form action="" method="post">
                <div class="form-group">
                  <label for="">Name</label>
                  <input type="text" name="name" value="<?php echo $customer_data['name']; ?>" class="form-control">
                </div>

                <div class="form-group">
                  <label for="">Username</label>
                  <input type="text"  value="<?php echo $customer_data['username']; ?>"" class="form-control" readonly="">
                </div>

                <div class="form-group">
                  <label for="">Comany Name</label>
                  <input type="text"  name="company_name" value="<?php echo $customer_data['company_name']; ?>" class="form-control" 
                  >
                </div>


                <div class="form-group">
                  <label for="">Address</label>
                  <input type="text" name="address" value="<?php echo $customer_data['address']; ?>" class="form-control">
                </div>

                <div class="form-group">
                  <label for="">Email</label>
                  <input type="text" name="email" value="<?php echo $customer_data['email']; ?>" class="form-control">
                </div>

                <div class="form-group">
                  <label for="">Password</label>
                  <input type="password" name="password" value="" class="form-control">
                </div>



                <div class="form-group">
                  <label for="">Status</label>
                  <input type="text" name="status" value="<?php echo $customer_data['status']; ?>" class="form-control" readonly="">
                </div>

                <div class="form-group">
                  <input type="submit" class="form-control btn btn-primary" value="Update" style="max-width: 100px;">
                  <input type="hidden" name="updateprofile" >
                 </div>


              </form>
              
            </div>
          </div>
          <div id="menu1" class="tab-pane fade">
            <h3>Login Attempts To Site</h3>
            <table class="table table-bordered" id="use_pro_invoice_table">
              <thead>
                <tr>
                  <th>Date</th>
                  <th>IP</th>
                  <th>City</th>
                  <th>ISP</th>
                </tr>
              </thead>
              
            </table>
          </div>
          
          </div>
       </div>
   </div>
              </div>
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