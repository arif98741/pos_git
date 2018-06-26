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
                $msg = "<script>alert('Group Added Successully');</script>";
            }else{
                 $msg = "<script>alert('Group Added Failed');</script>";
            }
        }else{
             $msg = "<script>alert('Group Already Exist');</script>";
        }

        echo $msg;

    }
?>
<!-- //header-ends -->
<div class="container">
    <div class="breadcrumb">
           <h3><i class="lnr lnr-chart-bars"></i> &nbsp;Add Product Group</h3>
    </div>
    <div class="bs-example4">
        
        <div class="row">
            <div class="col-md-12"> 
                <form action="" method="post">
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <input name="groupname" class="form-control" type="text" placeholder="Group Name" required="">
                        </div>

                    </div>

                    <div class="col-md-6 submit-button">
                        <input type="submit" value="Save Group" name="addgroup" class="btn btn-success">
                            <input type="reset" value="Reset" class="btn btn-warning">
                    </div>
            </div>
            </div>
        </div>
    </form>
</div>
</div>

<?php include 'lib/footer.php'; ?>