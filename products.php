<?php include 'lib/header.php'; ?>
<?php
//addproduct product
if (isset($_POST['addproduct'])) {
    $add = $pro->addProduct($_POST);

}

//update product
if (isset($_POST['updateproduct'])) {
    $update = $pro->updateProduct($_POST);
}

//delete product
if (isset($_GET['product_id'], $_GET['action']) && $_GET['action'] == 'del') {
    $pro->deleteProduct($_GET['serial']);
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
            <?php

            if (Session::keyExist('success')) {
                echo Session::get('success');
            }
            if (Session::keyExist('error')) {
                echo Session::get('error');
            }


            ?>
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
                                    <th width="25%">Product Name
                                    </th>
                                    <th class="sorting" width="10%">SKU
                                    </th>

                                    <th class="sorting" width="10%">Retail Price
                                    </th>
                                    <th class="sorting" width="25%">Sale Price
                                    </th>

                                    <th class="sorting" width="40%">Category
                                    </th>

                                    <th class="sorting" width="10%">Stock
                                    </th>
                                    <th class="sorting" width="20%">Action
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $status = $pro->showProduct('desc', 'product_name');

                                if ($status) {

                                    while ($result = $status->fetch_assoc()) {
                                        ?>
                                        <tr>
                                            <td><?php echo $result['product_name']; ?></td>
                                            <td style="text-align: left;"><?php echo $result['sku']; ?></td>
                                            <td style="text-align: left;"><?php echo $result['retail_price']; ?></td>
                                            <td style="text-align: left;"><?php echo $result['sale_price']; ?></td>
                                            <td style="text-align: left;"><?php echo $result['category_name']; ?></td>
                                            <td><?php echo $result['stock']; ?></td>

                                            <td>


                                                <a href="<?php echo BASE_URL; ?>editproduct.php?product_id=<?php echo $result['serial']; ?>&action=edit"
                                                   style="border-radius: 3px;" title="click to edit"><i
                                                            class="fa fa-pencil-square-o btn"></i></a>
                                                <a href="?action=del&serial=<?php echo $result['serial']; ?>&product_id=<?php echo $result['product_id']; ?>"
                                                   title="click to delete"
                                                   onclick="return confirm('are you sure to delete?')"><i
                                                            class="fa fa-trash-o btn"></i></a>


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
<?php
//unset session

Session::unsetSession('success');
Session::unsetSession('error');
?>
<?php include 'lib/footer.php'; ?>