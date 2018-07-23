<?php include 'lib/header.php'; ?> 
<?php


//get purchase data from server to assign in editing form
if (isset($_GET['action']) && isset($_GET['invoice_id']) && $_GET['action'] == 'edit') {
    $inv_data = $inv->singleInvoice($_GET['invoice_id']); //return as array


    $supplier_st = $sup->showSingleSupplier($inv_data['supplier_id']); //statement
    if ($supplier_st) {
        $supplier_data = $supplier_st->fetch_assoc(); //array result
    }
}
?>


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
                
                <input class="form-control btn-success" name="invoice_number" id="purchase_invoice_id" type="hidden" value="<?php echo $inv_data['invoice_number']; ?>">

             <div class="row">
                <div class="row">
            <div class="col-md-12"> 

             <div class="col-md-4">
                    <div class="form-group">
                        <select name="supplier_id"  id="supplier_dropdown_menu"  class="form-control" >
                            <option value="">Select Supplier</option>
                           <?php
                                $stmt = $sup->showSupplierForDropdown();
                                while ($result = $stmt->fetch_assoc()) {
                                    ?>
                                    <option <?php if ($result['supplier_id'] == $inv_data['supplier_id']): ?> selected="" <?php endif; ?> value="<?php echo $result['supplier_id']; ?>">
                                        <?php echo $result['supplier_name']; ?>
                                    </option>

                                <?php } ?>
                        </select>
                    </div>

                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <input name="date" class="form-control" id="date_input" type="date" value="<?php echo $inv_data['date']; ?>"  required="">
                    </div>

                </div>


                <div class="col-md-2">
                    <div class="form-group">
                        <input name="invoice_no" class="form-control" value="<?php echo $inv_data['invoice_number']; ?>" placeholder="Chalan Number" required="">
                    </div>

                </div>
                
                <div class="col-md-2">
                    <div class="form-group">
                        <input id="vehicle_no" name="vehicle_no"  value="<?php echo $inv_data['vehicle_no']; ?>"  class="form-control" placeholder="Vehicle Number">
                    </div>

                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <input  name="driver_mobile" class="form-control"  value="<?php echo $inv_data['driver_mobile']; ?>"  type="text" placeholder="Driver Mobile Number" >

                    </div>

                </div>

                <!-- <div class="col-md-6 submit-buttom">
                    <input type="submit" value="Save Product" name="addproduct" class="btn btn-success">
                    <input type="reset" value="Reset" class="btn btn-warning">
                </div> -->
                <br> <br><br> <br>
              


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

                            </tr>
                        </thead>
                        <tbody id="inv_detail">
                            <tbody id="inv_detail">
                                <?php
                                //get invoice products for a single invoice id
                                $allinProQuery = $inv->getInvoiceProducts($inv_data['invoice_number']);

                                ?>
                                <?php if ($allinProQuery): ?>
                                    <?php $invoice_total = $i = 0; ?>
                                    <?php while ($getData = $allinProQuery->fetch_assoc()): ?>
                                        <?php $invoice_total += $getData['subtotal']; $i++; ?>
                                        <input name="serial_no[]" type="hidden" class="form-control" value="<?php echo $getData['serial_no']; ?>" >

                                        <tr style="text-align:center;">

                                            <td width="10%">
                                                <input name="product_id[]" type="text" class="form-control product_id" rowid="<?php echo $i; ?>" value="<?php echo $getData['product_id']; ?>" required >
                                            </td>
                                            <td width="10%">
                                               <b class="product_name<?php echo $i;?>"><?php echo $getData['product_name']; ?></b>
                                            </td>
                                            
                                            <td width="10%">
                                                <b class="product_type">
                                                    <?php
                                                    $typeid = $getData['product_type'];
                                                    $typeq = "select * from tbl_type where typeid='$typeid'";
                                                    if ($typestmt = $db->link->query($typeq)) {
                                                        $typedata = $typestmt->fetch_assoc();
                                                        echo $typedata['typename'];
                                                    }
                                                    ?>

                                                </b>
                                            </td>
                                            
                                            <td width="8%">
                                                <input type="text" name="carton[]" class="form-control carton carton<?php echo $i;?>" rowid="<?php echo $i; ?>"  value="<?php echo $getData['carton']; ?>"  required >

                                                 <input type="hidden" name="piece_in_a_carton" class="form-control piece_in_a_carton<?php echo $i;?>" rowid="<?php echo $i; ?>"  value="<?php echo $getData['carton']; ?>"  required >


                                            </td>

                                            
                                            <td width="8%">
                                                <input type="text" name="piece[]" class="form-control piece piece<?php echo $i;?>" rowid="<?php echo $i; ?>"  value="<?php echo $getData['piece']; ?>"  required >
                                            </td>


                                            
                                            <td width="8%">
                                                <input type="text" name="purchase[]" class="form-control purchase purchase<?php echo $i;?>" rowid="<?php echo $i; ?>"  value="<?php echo $getData['purchase']; ?>"  required >
                                            </td>
                                            <td width="8%">
                                                <input type="hidden" name="subtotal[]" class="form-control subtotal<?php echo $i;?>" rowid="<?php echo $i; ?>"  value="<?php echo $getData['subtotal']; ?>" ><b class="subtotal subtotal<?php echo $i; ?>"><?php echo $getData['subtotal']; ?></b>
                                                <input type="hidden" name="update">
                                            </td>

                                        </tr>

                                    <?php endwhile; ?>
                                <?php endif; ?>
                            </tbody>
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
             
            
          </div>

        </div>
             <div class="button-div" style="width: 50%; margin: 0 auto;">
                 <input type="submit" class="btn btn-primary" name="edit" value="Update">
                <!-- <input type="reset" class="btn btn-danger" value="Reset"> -->
             </div>
        </form>
      </div>
      
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 <!-- footer -->

 <?php include 'lib/footer.php'; ?>