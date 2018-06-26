<?php include 'lib/header.php'; ?>
<?php if (Session::get('status') !== 'admin') {
    header("Location: index.php");
}?>

<?php if (Session::get('status') !== 'admin') {
    header("Location: index.php");
} ?>
<!-- //header-ends -->
<div class="container">
    <div class="breadcrumb">
           <h3><i class="lnr lnr-chart-bars"></i> &nbsp;Add Transaction Category</h3>
    </div>
    <div class="bs-example4">
        
        <div class="row">
                <div class="col-md-12"> 
            <form action="transcategorylist.php" method="post">
                
                
                <div class="col-md-4">
                    <div class="form-group">
                        <input name="transactioncat" class="form-control" type="text" placeholder="Transaction Category Name" required="">
                    </div>

                </div>

                <div class="col-md-6 submit-button">
                    <input type="submit" value="Save" name="addtransactioncat" class="btn btn-success">
                        <input type="reset" value="Reset" class="btn btn-warning">
                </div>
                </div>
            </div>
        </div>
    </form>
</div>
</div>

<?php include 'lib/footer.php'; ?>