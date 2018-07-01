<?php include 'lib/header.php'; ?>
<?php if (Session::get('status') !== 'admin') {
    header("Location: index.php");
}?>
    <?php
    //get branddata

    if (isset($_GET['action']) && $_GET['action'] == 'edit') {
             
        $id = mysqli_real_escape_string($db->link,$_GET['id']);
        $stmt = $db->link->query("select * from tbl_transactioncat where id ='$id'");
        $result = $stmt->fetch_assoc();
    }
                ?>
<!-- //header-ends -->
<div class="container">
    <div class="breadcrumb">
           <h3><i class="lnr lnr-chart-bars"></i> &nbsp;Edit Transaction Category</h3>
    </div>
    <div class="bs-example4">
        
        <div class="row">
                <div class="col-md-12"> 
            <form action="transcategorylist.php" method="post">
                
                
                <div class="col-md-4">
                    <div class="form-group">
                        <input name="transactioncatname" class="form-control" type="text" value="<?php echo $result['category_name']; ?>" placeholder="Transaction Category Name" required="">
                        <input name="trans_category_id" type="hidden" value="<?php echo $result['id']; ?>"  required="">
                    </div>

                </div>

                <div class="col-md-6 submit-button">
                    <input type="submit" value="Update" name="updatetransactioncat" class="btn btn-success">
                        <input type="reset" value="Reset" class="btn btn-warning">
                </div>
                </div>
            </div>
        </div>
    </form>
</div>
</div>

<?php include 'lib/footer.php'; ?>