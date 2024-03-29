<?php include 'lib/header.php'; ?>
<?php
//add stock
if (isset($_POST['addsupplier'])) {

    $add = $sup->addSupplier($_POST);
    if ($add) {
        echo "<script>alert('Supplier Added Successfully');</script>";
    } else {
        echo "<script>alert('Supplier Added Failed');</script>";
    }
}


//update stock
if (isset($_POST['updatesupplier'])) {
    $update = $sup->updatesupplier($_POST);
    if ($update) {
        echo "<script>alert('Supplier Updated Successfully');</script>";
    } else {
        echo "<script>alert('Supplier Updated Failed');</script>";
    }
}

//delete stock
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $sta = $sup->deletesupplier($_GET);
    if ($sta) {
        echo "<script>alert('Supplier Deleted Successful');</script>";
    } else {
        echo "<script>alert('Supplier to Deleted Product');</script>";
    }
}
?>

<!-- //header-ends -->
<div id="page-wrapper">
    <div class="graphs">
        <div class="breadcrumb">
            <h3><i class="lnr lnr-user"></i> &nbsp;Stock</h3>
        </div>

        <div class="xs tabls">
            <div class="bs-example4">
                <div class="table-responsive">
                    <table id="supplier_table" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Serial</th>
                                <th>Product ID</th>
                                <th>Product Name</th>
                                <th>Group</th>
                                <th>Purchase Price</th>
                                <th>Current Stock</th>
                                <th>Value</th>
                            </tr>
                        </thead>
                        



                        <tbody style="text-align: center;">
                            <?php
                            $stock_stmt = $sto->tempstock();
                            
                            ?>
                            <?php
                            $i = 0;
                            if ($stock_stmt):
                                ?>
                                <?php while ($r = $stock_stmt->fetch_assoc()): ?>
                                    <?php $stockamount = 0; ?>
                                    <tr>
                                        <td><?php echo ++$i; ?></td>
                                        <td><?php echo $r['product_id']; ?></td>
                                        <td><?php echo $r['product_name']; ?></td>
                                        <td><?php echo $r['groupname']; ?></td>
                                        <td><?php echo $r['sale_price']; ?></td>
                                        <td>
                                            <?php if($r['stock'] == null) {
                                                echo '0';
                                            }else{
                                                echo $r['stock'];
                                                $stockamount = $r['stock'];
                                            } ?>
                                                
                                            </td>
                                        <td><?php echo $r['sale_price'] * $stockamount; ?></td>    
                                        
                                       

                                            </tr>
                                        <?php endwhile; ?>


                                    <?php else: ?>
                                        <tr>
                                            <td colspan="9" style="text-align: center;">No supplier Data Found</td>
                                        </tr>
                                    <?php endif; ?>
                        </tbody>



                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'lib/footer.php'; ?>
