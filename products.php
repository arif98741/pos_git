<?php include 'lib/header.php'; ?>
<?php
//addproduct product
if (isset($_POST['addproduct'])) {
    $add = $pro->addProduct($_POST);
    if ($add) {
        echo "<script>alert('Product Added Successfully');</script>";
    } else {
        echo "<script>alert('Product Added Failed');</script>";
    }
}


//update product
if (isset($_POST['updateproduct'])) {
    $update = $pro->updateProduct($_POST);
    if ($update) {
        echo "<script>alert('Product Updated Successfully');</script>";
    } else {
        echo "<script>alert('Product Update Failed');</script>";
    }
}
//delete products

if (isset($_GET['product_id'])) {
    $sta = $pro->deleteProduct($_GET['product_id']);
    if ($sta) {
        echo "<script>alert('Product Deleted Successful');</script>";
    } else {
        echo "<script>alert('Failed to Delete Product');</script>";
    }
}
?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1><i class="lnr lnr-list"></i> &nbsp;PRODUCTS</h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active"><a href="<?php echo BASE_URL; ?>">Dashboard</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">

                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title"></h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example2" class="table table-bordered table-hover dataTable" role="grid"
                                   aria-describedby="example2_info">
                                <thead>
                                <tr role="row">
                                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1"
                                        colspan="1" aria-sort="ascending"
                                        aria-label="Rendering engine: activate to sort column descending" width="10%">
                                        Product ID
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                        aria-label="Browser: activate to sort column ascending" width="10%">Group
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                        aria-label="Platform(s): activate to sort column ascending" width="15%">Product
                                        Name
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                        aria-label="CSS grade: activate to sort column ascending" width="10%">Supplier
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                        aria-label="CSS grade: activate to sort column ascending" width="5%">Unit
                                    </th>

                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                        aria-label="CSS grade: activate to sort column ascending" width="10%">Purchase
                                        Price
                                    </th>

                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                        aria-label="CSS grade: activate to sort column ascending" width="10%">Last
                                        Update
                                    </th>


                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                        aria-label="CSS grade: activate to sort column ascending" width="10%">Action
                                    </th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $status = $pro->showProduct();

                                if ($status) {

                                    while ($result = $status->fetch_assoc()) {
                                        ?>
                                        <tr style="text-align: center;" id="rowid-<?php echo $result['serial']; ?>">
                                            <td><?php echo $result['product_id']; ?></td>
                                            <td style="text-align: left;"><?php echo $result['groupname']; ?></td>
                                            <td style="text-align: left;"><?php echo $result['product_name']; ?></td>
                                            <td style="text-align: left;"><?php echo $result['supplier_name']; ?></td>
                                            <td style="text-align: left;"><?php echo $result['typename']; ?></td>
                                            <td><?php echo $result['purchase_price']; ?></td>
                                            <td><?php echo $help->formatDate($result['last_update'], 'd-m-Y'); ?></td>


                                            <td>
                                                <?php if (Session::get('status') == 'admin'): ?>

                                                    <a href="<?php echo BASE_URL; ?>editproduct.php?product_id=<?php echo $result['product_id']; ?>"
                                                       style="border-radius: 3px;" title="click to edit"><i
                                                                class="fa fa-pencil-square-o btn"></i></a>
                                                    <a href="?action=del&serial=<?php echo $result['serial']; ?>&product_id=<?php echo $result['product_id']; ?>"
                                                       title="click to delete"
                                                       onclick="return confirm('are you sure to delete?')"><i
                                                                class="fa fa-trash-o btn"></i></a>
                                                <?php else: ?>
                                                    -
                                                <?php endif; ?>

                                            </td>

                                        </tr>

                                        <?php
                                    }
                                } else {
                                    ?>

                                <?php }
                                ?>
                                </tbody>

                            </table>
                        </div>

                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            </div>


        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <!-- footer -->

<?php include 'lib/footer.php'; ?>