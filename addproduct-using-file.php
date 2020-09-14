<?php include 'lib/header.php'; ?>
<?php
if (isset($_POST['bulkupload'])) {
    $pro->bulkProductUpload($_REQUEST);
}
if (Session::get('status') !== 'admin') {
    header("Location: index.php");
} ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1><i class="lnr lnr-plus-circle"></i> &nbsp;Upload Bulk PRODUCT</h1>
            <ol class="breadcrumb">
                <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active"><a href="<?php echo BASE_URL; ?>">Dashboard</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="col-sm-12">
                <div class="box">
                    <div class="box-body">
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input name="file" class="form-control" type="file" required="">
                                        </div>
                                    </div>


                                    <div class="col-md-12 submit-buttom">

                                        <input type="submit" value="Save Product" name="bulkupload"
                                               class="btn btn-success">
                                        <input type="reset" value="Reset" class="btn btn-warning">
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <!-- footer -->

<?php include 'lib/footer.php'; ?>