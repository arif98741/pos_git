<?php include 'lib/header.php'; ?>
<?php if (Session::get('status') !== 'admin') {
    header("Location: index.php");
} ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><i class="lnr lnr-plus-circle"></i> &nbsp;ADD PRODUCT</h1>
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
                    <form action="products.php" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12">


                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input name="product_name" class="form-control" type="text"
                                            placeholder="Product Name" required="">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input name="sku" class="form-control" type="text" placeholder="Sku">
                                    </div>
                                </div>

                                <div class=" col-md-4">
                                    <div class="form-group">
                                        <input name="retail_price" class="form-control" type="text"
                                            placeholder="Retail Price">
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input name="sale_price" class="form-control" type="text"
                                            placeholder="Sale Price">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" name="whole_price" class="form-control"
                                            placeholder="Whole Price">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" name="brand_name" class="form-control"
                                            placeholder="Brand Name">
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" name="category_name" class="form-control"
                                            placeholder="Category Name">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" name="stock" class="form-control" placeholder="Stock">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" name="size" class="form-control" placeholder="Size">
                                    </div>
                                </div>



                                <div class="col-md-4 submit-buttom">

                                    <input type="submit" value="Save Product" name="addproduct" class="btn btn-success">
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