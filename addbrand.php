<?php include 'lib/header.php'; ?>
<?php if (Session::get('status') !== 'admin') {
    header("Location: index.php");
} ?>
    <!-- //header-ends -->
    <div id="page-wrapper">
    <div class="graphs">
        <div class="breadcrumb">
            <h3><i class="lnr lnr-plus-circle"></i> &nbsp;Add Product Brand</h3>
        </div>
        <br/>
        <div class="tab-content">

            <?php
            if (isset($_POST['addbrand'])) {
                $msg = "";
                $brandname = $help->validAndEscape($_POST['brandname']);
                $checkstmt = $db->select("select * from tbl_brand WHERE  brandname ='$brandname'");
                if (!$checkstmt) {
                    $stmt = $db->insert("insert into tbl_brand(brandname) VALUES ('$brandname')");
                    if ($stmt) {
                        $msg = "<p class='alert alert-success'>Brand Added Successfully</p>";
                    } else {
                        $msg = "<p class='alert alert-warning'>Brand Added Failed</p>";
                    }
                } else {
                    $msg = "<p class='alert alert-warning'>Brand Already Exist</p>";
                }

            }
            ?>
            <form action="" method="post">
                <div class="col-md-4">
                    <div class="form-group">
                        <input name="brandname" class="form-control" type="text" placeholder="Brand Name" required="">
                    </div>
                </div>

                <div class="col-md-6 submit-buttom">
                    <input type="submit" value="Save Brand" name="addbrand" class="btn btn-success">
                    <input type="reset" value="Reset" class="btn btn-warning">
                </div>

                <div class="col-md-8">
                    <?php if (!empty($msg)): ?>
                        <br/> <br/>
                        <div class="col-md-12">
                            <?php echo $msg; ?>
                        </div>
                    <?php endif; ?>

                </div>


            </form>
        </div>
    </div>


<?php include 'lib/footer.php'; ?>