<?php include 'lib/header.php'; ?>
<?php if (Session::get('status') !== 'admin') {
    header("Location: index.php");
}?>
<?php
    if(isset($_POST['addgroup'])){
        $msg = "";
        $groupname = $help->validAndEscape($_POST['groupname']);
        $checkstmt = $db->select("select * from tbl_group WHERE  groupname ='$groupname'");
        if(!$checkstmt){
            $stmt = $db->insert("insert into tbl_group(groupname) VALUES ('$groupname')");
            if($stmt){
                $msg = "<script>alert('গ্রুপ সফল্ভাবে যুক্ত হয়েছে');</script>";
            }else{
                 $msg = "<script>alert('গ্রুপ সংযোজন ব্যর্থ');</script>";
            }
        }else{
             $msg = "<script>alert('গ্রুপ পূর্বে বিদ্যমান');</script>";
        }

        echo $msg;

    }
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><i class="lnr lnr-plus-circle"></i>&nbsp;গ্রউপ সংযোজন</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> প্রচ্ছদ</a></li>
        <li class="active">ড্যাশবোর্ড</li>
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
                            <input name="groupname" class="form-control" type="text" placeholder="গ্রুপের নাম" required="">
                        </div>

                    </div>

                    <div class="col-md-6 submit-button">
                        <input type="submit" value="সেভ" name="addgroup" class="btn btn-success">
                            <input type="reset" value="পুনরায়" class="btn btn-warning">
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