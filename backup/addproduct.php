<?php include 'lib/header.php'; ?>
<?php if (Session::get('status') !== 'admin') {
    header("Location: index.php");
}?>
<!-- //header-ends -->
<div class="container">
    <div class="breadcrumb">
        <h3><i class="lnr lnr-plus-circle"></i> &nbsp;Add Product</h3>
    </div>
    <div class="bs-example4">
        <form action="products.php" method="post">
            <div class="row">
                <div class="col-md-12"> 
                    <div class="col-md-4">
                        <div class="form-group">
                            <input name="product_id" class="form-control" type="text" placeholder="Product ID" required="">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <select name="product_type" class="form-control">
                                <option>Select Unit</option>
                                 
                                 <?php 
                                    if ($stmt = $db->link->query("select * from tbl_type order by typename asc");) {
                                        
                                    } else {
                                        
                                    }
                                 ?>
                                                                     
                                
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <select name="product_group" class="form-control">
                                <option>Select Group</option>
                                 <option value="10">Baby nate book</option>
                                         <option value="3">Bound</option>
                                         <option value="6">Coil</option>
                                         <option value="4">Dista</option>
                                         <option value="1">Khata</option>
                                         <option value="5">Note book</option>
                                         <option value="9">Paper</option>
                                         <option value="7">Printing</option>
                                         <option value="8">Printing Paper</option>
                                         <option value="2">Ring</option>
                        </select>
					</div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input name="product_name" class="form-control" type="text" placeholder="Product Name" required="">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <select name="product_brand" class="form-control">
                                <option>Select Supplier</option>
                                  <option value="300">Happy Product</option>
                                        
                            </select>  
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input name="sale_price" class="form-control" type="text" placeholder="Sale Price" required="">
                        </div>
                    </div>
                    
                   
                    
                   <div class="col-md-4">
                        <div class="form-group">
                            <input name="purchase_price" class="form-control" type="text" placeholder="Purchase Price" required="">
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" name="piece_in_a_carton" class="form-control" placeholder="Piece in Carton">
                        </div>
                    </div>
                    <div class="col-md-6 submit-buttom">
                        <hr>
                        <input type="submit" value="Save Product" name="addproduct" class="btn btn-success">
                        <input type="reset" value="Reset" class="btn btn-warning">
                    </div>
                </div>
            </div>
        </form> 
    </div>
    
</div>
</div>
<?php include 'lib/footer.php'; ?>                      