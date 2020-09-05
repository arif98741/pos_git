<?php include 'lib/header.php'; ?>
    <!-- //header-ends -->
    <div id="page-wrapper">
    <div class="graphs">
        <div class="breadcrumb">
            <h3><i class="lnr lnr-plus-circle"></i> &nbsp;Add Product Color</h3>
        </div>
        <br/>
        <div class="tab-content">

            <?php
            if (isset($_POST['addcolor'])) {
                $msg = "";
                $colorname = $help->validAndEscape($_POST['colorname']);
                $checkstmt = $db->select("select * from tbl_color WHERE  colorname ='$colorname'");
                if (!$checkstmt) {
                    $stmt = $db->insert("insert into tbl_color(colorname) VALUES ('$colorname')");
                    if ($stmt) {
                        $msg = "<p class='alert alert-success'>Color Added Successfully</p>";
                    } else {
                        $msg = "<p class='alert alert-warning'>Color Added Failed</p>";
                    }
                } else {
                    $msg = "<p class='alert alert-warning'>Color Already Exist</p>";
                }

            }
            ?>
            <form action="" method="post">
                <div class="col-md-4">
                    <div class="form-group">
                        <input name="colorname" class="form-control" type="text" placeholder="Color Name" required="">
                    </div>
                </div>

                <div class="col-md-6 submit-buttom">
                    <input type="submit" value="Save Color" name="addcolor" class="btn btn-success">
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