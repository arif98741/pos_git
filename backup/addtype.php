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
<!-- //header-ends -->
<div class="container">
    <div class="breadcrumb">
           <h3><i class="lnr lnr-chart-bars"></i> &nbsp;Add Product Unit</h3>
    </div>
    <div class="bs-example4">
        
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
                </div>
            </div>
        </div>
    </form>
</div>
</div>

<?php include 'lib/footer.php'; ?>