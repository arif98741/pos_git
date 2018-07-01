<?php include 'lib/header.php'; ?>
<?php if (Session::get('status') !== 'admin') {
    header("Location: index.php");
}?>
    <!-- //header-ends -->
    <div id="page-wrapper">
        <div class="graphs">
            <div class="breadcrumb">
                <h3><i class="lnr lnr-plus-circle"></i> &nbsp;Edit Product Type</h3>
            </div>
            <br/>
            <div class="tab-content">


                <?php
                    
                    //get typedata

                    if (isset($_GET['action']) && isset($_GET['typeid'])) {
                       
                        $typeid = mysqli_real_escape_string($db->link,$_GET['typeid']);
                        $stmt = $db->link->query("select * from tbl_type where typeid ='$typeid'");
                        $typedata = $stmt->fetch_assoc();
                    }
                ?>
                <form action="typelist.php" method="post">
                    <div class="col-md-4">
                        <div class="form-group">
                            <input name="typename" class="form-control" type="text" value="<?php echo $typedata['typename']; ?>" required="">
                        </div>
                    </div>

                    <div class="col-md-6 submit-buttom">
                        
                        <input type="submit" name="updatetype" value="Save Type" class="btn btn-success">
                        <input type="hidden" name="typeid" value="<?php echo $typedata['typeid']; ?>"  class="btn btn-success">
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