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
            <form  action="purchaselist.php" method="post"  enctype="multipart/form-data">
             <div class="row">
                <div class="row">
        <div class="col-md-12"> 
                <div class="col-md-4">
                    <div class="form-group">
                        <input name="invoice_no" value="<?php echo $ext->generatePurchaseID();  ?>" class="form-control" placeholder="Purchase Number" required="" readonly="">
                    </div>

                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <select name="supplier_id"  id="supplier_dropdown"  class="form-control" >
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
                <div class="col-md-4">
                    <div class="form-group">
                        <input id="supplier_id" class="form-control" placeholder="Supplier ID">
                    </div>

                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <input  name="address" id="address" class="form-control" type="text" placeholder="Address" required="">

                    </div>

                </div>


                <div class="col-md-4">
                    <div class="form-group">
                        <input name="contact" id="contact" class="form-control" type="text" placeholder="Contact" required="">
                    </div>

                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <input name="date" class="form-control" id="date_input" type="date" placeholder="Date"  required="">
                    </div>

                </div>


                <div class="col-md-6 submit-buttom">
                    <input type="submit" value="Save Product" name="addproduct" class="btn btn-success">
                    <input type="reset" value="Reset" class="btn btn-warning">
                </div>


                <div class="col-md-12" style="margin-top: 20px;">

                    <table id="invoice_form_table" class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="30%">Product Name</th>
                                <th width="10%">Unit</th>
                                <th width="15%">Quantity</th>
                                <th width="15%">Purchase Price</th>
                                <th width="15%">Subtotal</th>
                                <th width="15%">Action</th>

                            </tr>
                        </thead>
                        <tbody id="inv_detail">
                            
                        </tbody>
                        <tfoot id="">
                            <tr>
                                <td colspan="5" style="text-align:right; "><b>Invoice Total</b></td>
                                <td colspan="1" style="text-align: center;"><input type="hidden" name="addinvoice"><b class="wholetotal"></b></td>
                                <input type="hidden" name="addpurchase">
                            </tr>

                        </tfoot>
                    </table>
                    <button class="btn btn-success add_new_invoice_table_row" title="Click To Add Product in Purchase List" style="font-size: 17px;">+</button>
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