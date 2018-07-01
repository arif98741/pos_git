<?php include 'lib/header.php'; ?>
<?php if (Session::get('status') !== 'admin') {
    header("Location: index.php");
}?>
    <!-- //header-ends -->
    <div id="page-wrapper">
        <div class="graphs">
            <div class="breadcrumb">
                <h3><i class="lnr lnr-plus-circle"></i> &nbsp;Add Product Brand</h3>
            </div>
            <br/>
            <div class="tab-content">


                <?php
                    
                    //get branddata

                    if (isset($_GET['action']) && isset($_GET['brandid'])) {
                       
                        $brandid = mysqli_real_escape_string($db->link,$_GET['brandid']);
                        $stmt = $db->link->query("select * from tbl_brand where brandid ='$brandid'");
                        $branddata = $stmt->fetch_assoc();
                    }
                ?>
                <form action="brandlist.php" method="post">
                    <div class="col-md-4">
                        <div class="form-group">
                            <input name="brandname" class="form-control" type="text" value="<?php echo $branddata['brandname']; ?>" required="">
                        </div>
                    </div>

                    <div class="col-md-6 submit-buttom">
                        
                        <input type="submit" name="updatebrand" value="Save Brand" class="btn btn-success">
                        <input type="hidden" name="brandid" value="<?php echo $branddata['brandid']; ?>"  class="btn btn-success">
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


<?php include 'lib/footer.php'; ?>