<?php include 'lib/header.php'; ?> 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><i class="lnr lnr-plus-circle"></i> &nbsp;PRODUCT PURCHASE</h1>
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
            <form  action="purchaselist.php" method="post" >
                <!-- invoice id hidden -->
                 <?php
                    $st = $db->select("select * from tbl_invoice ORDER  by serial DESC ");
                    $invoice = "";
                    if ($st){
                        if($st->num_rows > 0){
                            $data = $st->fetch_assoc();
                            $invoice =  $data['invoice_number' ] + 1;
                        }
                        
                        }else{
                        $invoice =  1;
                    }
                    
                ?>
                
                
                <input class="form-control btn-success" name="sell_id" id="purchase_invoice_id" type="hidden" value="<?php echo $invoice; ?>">

             <div class="row">
                <div class="row">
            <div class="col-md-12"> 

             <div class="col-md-3">
                    <div class="form-group">
                        <select name="supplier_id"  id="supplier_dropdown_menu"  class="form-control" >
                            <option value="">Select Supplier</option>
                            <?php
                            $status = $sup->showSupplier();
                            if ($status) {
                                 while ($result = $status->fetch_assoc()) { ?>
                                       <option value="<?php echo $result['supplier_id']; ?>"><?php echo ucfirst($result['supplier_name']); ?></option>
                           
                              <?php   }  }  ?>
                         
                        </select>
                    </div>

                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <input name="date" class="form-control" id="date_input" type="date" placeholder="Date" title="date"  required="">
                    </div>

                </div>


                <div class="col-md-2">
                    <div class="form-group">
                        <input name="invoice_no" class="form-control" placeholder="Chalan Number" required="">
                    </div>

                </div>
                
                <div class="col-md-2">
                    <div class="form-group">
                        <input id="vehicle_no" class="form-control" placeholder="Vehicle Number">
                    </div>

                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <input  name="driver_mobile" class="form-control" type="text" placeholder="Driver Mobile Number" required="">

                    </div>

                </div>

                <!-- <div class="col-md-6 submit-buttom">
                    <input type="submit" value="Save Product" name="addproduct" class="btn btn-success">
                    <input type="reset" value="Reset" class="btn btn-warning">
                </div> -->
                <br> <br><br> <br>
                <div class="row" style="margin-left: 1px; margin-top: 20px;">
                    <div class="col-md-3">
                        <input type="text" class="form-control" id="product_search_addpurchase" placeholder="Product Search">
                    </div>

                     <div class="col-md-2">
                        <input type="text" class="form-control" id="product_purchase_carton" placeholder="Carton">
                        <input type="hidden" class="form-control" id="product_purchase_piece_in_a_carton" placeholder="Piece in a carton">
                    </div>

                     <div class="col-md-2">
                        <input type="text" class="form-control" id="product_purchase_price"  placeholder="Price">
                    </div>

                    <div class="col-md-2">
                        <input type="button" class="btn btn-success add_new_invoice_table_row" id="" value="Add Product">
                    </div>




                </div>


                <div class="col-md-12" style="margin-top: 20px;">

                    <table id="invoice_form_table" class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="text-align: center;" width="20%">ID</th>
                                <th width="20%">Product Name</th>
                                <th width="10%">SQ</th>
                                <th width="15%">Carton</th>
                                <th width="15%">Piece</th>
                                <th width="10%">Purchase Price</th>
                                <th width="10%">Subtotal</th>
                                <th width="15%">Action</th>

                            </tr>
                        </thead>
                        <tbody id="inv_detail">
                            
                        </tbody>
                        <!-- <tfoot id="">
                            <tr>
                                <td colspan="5" style="text-align:right; "><b>Invoice Total</b></td>
                                <td colspan="1" style="text-align: center;"><input type="hidden" name="addinvoice"><b class="wholetotal"></b></td>
                                <input type="hidden" name="addpurchase">
                            </tr>

                        </tfoot> -->
                    </table>
                   <!--  <button class="btn btn-success " title="Click To Add Product in Purchase List" style="font-size: 17px;">+</button> -->
                </div>
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