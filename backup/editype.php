<?php include 'lib/header.php'; ?>
<?php if (Session::get('status') !== 'admin') {
    header("Location: index.php");
}?>
<?php


//add invoice

if (isset($_GET['action']) && isset($_GET['typeid'])) {

    $typeid = mysqli_real_escape_string($db->link,$_GET['typeid']);

    $stmt = $db->link->query("select * from tbl_type where typeid ='$typeid'");
    $typedata = $stmt->fetch_assoc();

}
?>

    <!-- //header-ends -->
    <div id="page-wrapper">
        <div class="graphs">
            <div class="breadcrumb">
                <h3><i class="lnr lnr-plus-circle"></i> &nbsp;Update Type</h3>
            </div>

            <div class="tab-content">

                <form action="typelist.php" method="post">
                    <div class="col-md-4">
                        <div class="form-group">
                            <input name="typename" class="form-control" type="text" value="<?php echo $typedata['typename']; ?>" required="">
                        </div>
                    </div>

                    <div class="col-md-6 submit-buttom">
                        <input type="submit" value="Save Type" name="updatetype" class="btn btn-success">
                        <input type="hidden" value="<?php echo $typedata['typeid']; ?>" name="typeid">
                    </div>

                    <?php if(!empty($msg)): ?>
                        <br/>
                        <div class="col-md-12">
                           <?php echo $msg; ?>
                        </div>
                    <?php endif; ?>

                </form>
            </div>
        </div>


<?php include 'lib/footer.php'; ?>