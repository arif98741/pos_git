<?php include 'lib/header.php'; ?>
<?php if (Session::get('status') !== 'admin') {
    header("Location: index.php");
}?>
    <!-- //header-ends -->
    <div id="page-wrapper">
        <div class="graphs">
            <div class="breadcrumb">
                <h3><i class="lnr lnr-plus-circle"></i> &nbsp;Edit Product Color</h3>
            </div>
            <br/>
            <div class="tab-content">


                <?php
                    
                    //get colordata

                    if (isset($_GET['action']) && isset($_GET['colorid'])) {
                       
                        $colorid = mysqli_real_escape_string($db->link,$_GET['colorid']);
                        $stmt = $db->link->query("select * from tbl_color where colorid ='$colorid'");
                        $colordata = $stmt->fetch_assoc();
                    }
                ?>
                <form action="colorlist.php" method="post">
                    <div class="col-md-4">
                        <div class="form-group">
                            <input name="colorname" class="form-control" type="text" value="<?php echo ucfirst($colordata['colorname']); ?>" required="">
                        </div>
                    </div>

                    <div class="col-md-6 submit-buttom">
                        
                        <input type="submit" name="updatecolor" value="Save Color" class="btn btn-success">
                        <input type="hidden" name="colorid" value="<?php echo $colordata['colorid']; ?>"  class="btn btn-success">
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