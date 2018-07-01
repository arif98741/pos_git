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

<!-- //header-ends -->
<div id="page-wrapper">
 
        <div class="breadcrumb">
            <h3><i class="lnr lnr-list"></i> &nbsp;Products</h3>
        </div>

        <div class="xs tabls">
            <div class="bs-example4">
                <div class="table-responsive ">

                    <table class="table table-striped table-bordered table-hover" cellspacing="4" id="product_table" class="order-column" width="100%">
                        <thead>
                            <tr>
                                <th>Product ID</th>
                                <th>Group</th>
                                <th>Product Name</th>
                                <th>Supplier</th>
                                <th>Unit</th>
                                <th>Purchase Price</th>
                                <th>Last Update</th>
                                <th>Action</th>
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
                                        <td  style="text-align: left;"><?php echo $result['supplier_name']; ?></td>
                                        <td style="text-align: left;"><?php echo $result['typename']; ?></td>
                                        <td><?php echo $result['purchase_price']; ?></td>
                                        <td><?php echo $help->formatDate($result['last_update'], 'd-m-Y'); ?></td>


                                        <td>
                                            <?php if(Session::get('status') == 'admin'): ?>

                                            <a href="<?php echo BASE_URL; ?>editproduct.php?product_id=<?php echo $result['product_id']; ?>" style="border-radius: 3px;" title="click to edit" ><i class="fa fa-pencil-square-o btn"></i></a>
                                            <a href="?action=del&serial=<?php echo $result['serial']; ?>&product_id=<?php echo $result['product_id']; ?>"  title="click to delete" onclick="return confirm('are you sure to delete?')" ><i class="fa fa-trash-o btn"></i></a>
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
            </div>
        </div>
 
</div>
<?php include 'lib/footer.php'; ?>
