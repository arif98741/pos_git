<?php include 'lib/header.php'; ?>
<?php if (Session::get('status') !== 'admin') {
    header("Location: index.php");
}?>

<?php
if (isset($_GET['product_id'])) {
    $sta = $pro->getsingleProduct($_GET['product_id']);
    $data = $sta->fetch_assoc();
    
} else {
    echo "<script>window.location = 'products.php';</script>";
}
?>
<!-- //header-ends -->
<div class="container">
    <div class="breadcrumb">
        <h3><i class="lnr lnr-plus-circle"></i> &nbsp;Edit Product</h3>
    </div>
    <div class="bs-example4">
        <form action="products.php" method="post">
            <div class="row">
                <div class="col-md-12"> 
                    <div class="col-md-4">
                        <div class="form-group">
                            <input name="product_id" class="form-control" type="text" value="<?php echo $data['product_id']; ?>" placeholder="Purchase ID"  required="">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <select name="product_type" class="form-control">
                                <option>Select Unit</option>
                                <?php
                                $status = $pro->showType();
                                while ($result = $status->fetch_assoc()) {
                                    ?>
                                <option <?php if ($data['product_type'] == $result['typeid']): ?> selected="selected" <?php endif; ?> value="<?php echo $result['typeid']; ?>"><?php echo $result['typename']; ?></option>
                            <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <select name="product_group" class="form-control">
                                <option>Select Group</option>
                                
                            <?php
                            $status = $pro->showGroup();
                            while ($result = $status->fetch_assoc()) {
                                ?>
                            <option <?php if ($data['product_group'] == $result['groupid']): ?> selected="selected" <?php endif; ?>  value="<?php echo $result['groupid']; ?>"><?php echo $result['groupname']; ?></option>
                            <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input name="product_name" class="form-control" type="text"  value="<?php echo $data['product_name']; ?>" placeholder="Product Name Price"   required="">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <select name="product_brand" class="form-control">
                                <option>Select Supplier</option>
                                <?php
                                    $status = $sup->showSupplier();
                                    while ($result = $status->fetch_assoc()) {
                                        ?>
                                    <option <?php if ($data['product_brand'] == $result['supplier_id']): ?> selected="selected" <?php endif; ?>  value="<?php echo $result['supplier_id']; ?>"><?php echo $result['supplier_name']; ?></option>
                                    <?php } ?>
                            </select>  
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input name="sale_price" class="form-control" type="text" value="<?php echo $data['sale_price']; ?>" placeholder="Sale Price"  required="">
                        </div>
                    </div>
                    
                    
                   <div class="col-md-4">
                        <div class="form-group">
                            <input  name="purchase_price" class="form-control" type="number"  value="<?php echo $data['purchase_price']; ?>" placeholder="Purchase Price" required="">
                        </div>
                    </div>
                   
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" name="piece_in_a_carton" placeholder="Piece in a Carton"  class="form-control"  value="<?php echo $data['piece_in_a_carton']; ?>" />
                        </div>
                    </div>
                    <div class="col-md-6 submit-buttom">
                        <hr>
                        <input type="submit" value="Update Product"  name="updateproduct" class="btn btn-success">
                    <input type="reset" value="Reset" class="btn btn-warning" disabled="">
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
</div>
<?php include 'lib/footer.php'; ?>       
