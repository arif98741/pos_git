<?php include 'lib/header.php'; ?>
<?php if (Session::get('status') !== 'admin') {
    header("Location: index.php");
}?>
    <!-- //header-ends -->
    <div id="page-wrapper">
        <div class="graphs">
            <div class="breadcrumb">
                <h3><i class="lnr lnr-plus-circle"></i> &nbsp;Edit Product Group</h3>
            </div>
            <br/>
            <div class="tab-content">


                <?php
                    
                    //get groupdata

                    if (isset($_GET['action']) && isset($_GET['groupid'])) {
                       
                        $groupid = mysqli_real_escape_string($db->link,$_GET['groupid']);
                        $stmt = $db->link->query("select * from tbl_group where groupid ='$groupid'");
                        $groupdata = $stmt->fetch_assoc();
                    }
                ?>
                <form action="grouplist.php" method="post">
                    <div class="col-md-4">
                        <div class="form-group">
                            <input name="groupname" class="form-control" type="text" value="<?php echo ucfirst($groupdata['groupname']); ?>" required="">
                        </div>
                    </div>

                    <div class="col-md-6 submit-buttom">
                        
                        <input type="submit" name="updategroup" value="Save Group" class="btn btn-success">
                        <input type="hidden" name="groupid" value="<?php echo $groupdata['groupid']; ?>"  class="btn btn-success">
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