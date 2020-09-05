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
                                            <input name="product_id" class="form-control" type="text"
                                                   placeholder="Product ID" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <select name="product_type" class="form-control">
                                                <option>Select Unit</option>
                                                <?php
                                                if ($stmt = $db->link->query("select * from tbl_type order by typename asc")) {
                                                    while ($row = $stmt->fetch_assoc()) { ?>
                                                        <option value="<?php echo $row['typeid']; ?>"><?php echo $row['typename']; ?></option>
                                                    <?php }
                                                }
                                                ?>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <select name="product_group" class="form-control">
                                                <option>Select Group</option>
                                                <?php
                                                if ($stmt = $db->link->query("select * from tbl_group order by groupname asc")) {
                                                    while ($row = $stmt->fetch_assoc()) { ?>
                                                        <option value="<?php echo $row['groupid']; ?>"><?php echo $row['groupname']; ?></option>
                                                    <?php }
                                                }
                                                ?>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input name="product_name" class="form-control" type="text"
                                                   placeholder="Product Name" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <select name="product_brand" class="form-control">
                                                <option>Select Supplier</option>
                                                <?php
                                                if ($stmt = $db->link->query("select * from tbl_supplier order by supplier_name asc")) {
                                                    while ($row = $stmt->fetch_assoc()) { ?>
                                                        <option value="<?php echo $row['supplier_id']; ?>"><?php echo $row['supplier_name']; ?></option>
                                                    <?php }
                                                }
                                                ?>


                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input name="sale_price" class="form-control" type="text"
                                                   placeholder="Sale Price" required="">
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input name="purchase_price" class="form-control" type="text"
                                                   placeholder="Purchase Price" required="">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" name="piece_in_a_carton" class="form-control"
                                                   placeholder="Piece in Carton">
                                        </div>
                                    </div>
                                    <div class="col-md-6 submit-buttom">

                                        <input type="submit" value="Save Product" name="addproduct"
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