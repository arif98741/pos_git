<?php include 'lib/header.php'; ?>
<?php if (Session::get('status') !== 'admin') {
    header("Location: index.php");
} ?>

<?php
if (isset($_POST['updpateproduct'])) {
    $pro->updateProduct($_POST);

}


if (isset($_GET['product_id'])) {

    $sta = $pro->getsingleProduct($_GET['product_id']);
    $data = $sta->fetch_assoc();
} else {
    echo "<script>window.location = 'products.php';</script>";
}
?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>EDIT PRODUCT</h1>
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
                        <form action="editproduct.php" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Product Name</label>
                                            <input name="product_name" value="<?php echo $data['product_name']; ?>"
                                                   class="form-control" type="text"
                                                   placeholder="Product Name" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Sku</label>
                                            <input name="sku" value="<?php echo $data['sku']; ?>" class="form-control"
                                                   type="text" placeholder="Sku">
                                        </div>
                                    </div>

                                    <div class=" col-md-4">
                                        <div class="form-group">
                                            <label for="">Retail Price</label>
                                            <input name="retail_price" value="<?php echo $data['retail_price']; ?>"
                                                   class="form-control" type="text"
                                                   placeholder="Retail Price">
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Sale Price</label>
                                            <input name="sale_price" value="<?php echo $data['sale_price']; ?>"
                                                   class="form-control" type="text"
                                                   placeholder="Sale Price">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Whole Price</label>
                                            <input type="text" value="<?php echo $data['whole_price']; ?>"
                                                   name="whole_price" class="form-control"
                                                   placeholder="Whole Price">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Brand Name</label>
                                            <input type="text" value="<?php echo $data['brand_name']; ?>"
                                                   name="brand_name" class="form-control"
                                                   placeholder="Brand Name">
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Category Name</label>
                                            <input type="text" value="<?php echo $data['category_name']; ?>"
                                                   name="category_name" class="form-control"
                                                   placeholder="Category Name">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Stock</label>
                                            <input type="text" value="<?php echo $data['stock']; ?>" name="stock"
                                                   class="form-control" placeholder="Stock">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Size</label>
                                            <input type="text" value="<?php echo $data['size']; ?>" name="size"
                                                   class="form-control" placeholder="Size">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-offset-4 col-md-4 submit-buttom">
                                    <input type="hidden" name="serial" value="<?php echo $data['serial']; ?>">
                                    <input type="reset" value="Back" class="btn btn-info"> &nbsp;&nbsp;
                                    <input type="submit" value="Update Product" name="updpateproduct"
                                           class="btn btn-success">
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