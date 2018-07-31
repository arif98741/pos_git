<?php include 'lib/header.php'; ?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><i class="lnr lnr-plus-circle"></i>BILL-INVOICE</h1>
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
            <form  action="printfiles/sale/printinvoice.php" method="post"  enctype="multipart/form-data">
             <div class="row">
                <div style="padding:6px">
                    <div class="col-md-offset-10 col-sm-2">
                        <input type="submit" class="btn btn-success" value="Save Invoice" >
                    </div>
                 </div>
             </div>
             <div class="row">
                 <div class="col-md-6"> 
                    <div class="col-md-12"> 
                        <div class="form-group">

                           
                                <input class="form-control btn-success" name="sell_id" id="sell_id" type="hidden" value="<?php echo $ext->generateInvoiceID(); ?>">
                            
                            <select name="cus_id" class="form-control select2" id="cus_dropdown_addinvoice">
                                <option value="" >Select Customer </option>
                                <?php 
                                    $cusst = $db->select("select * from tbl_customer order by customer_name asc");
                                    if($cusst){
                                        while ($row = $cusst->fetch_assoc()) { ?>
                                        <option value="<?php echo ucfirst($row['customer_id']); ?>"><?php echo $row['customer_name']; ?></option>
                                        
                                        <?php  }
                                    }
                                ?>
                            </select>
                            
                            
                        </div>
                    </div>
                    
                    
                    <div class="col-md-6"> 

                        <div class="form-group">
                            <input type="" class="form-control" id="customer_id" placeholder="Customer ID"/> 
                        </div>  
                    </div>              
                    <div class="col-md-6"> 
                        <div class="form-group">
                            <input type="" class="form-control" id="customer_name" placeholder="Customer Name"/> 
                        </div>  
                    </div>  
                    <div class="col-md-6"> 
                        <div class="form-group">
                            <input type="" class="form-control" id="address" placeholder="Address"/> 
                            
                        </div>
                    </div>
                    <div class="col-md-6"> 
                        <div class="form-group">
                            <input type="" class="form-control" id="contact" placeholder="Contact"/> 
                            
                        </div>
                    </div>
                </div>

                
                <div class="col-sm-6">
                    <div class="row">   
                
                    <div class="col-md-12">
                        
                        
                        <div class="col-md-3"> 
                            <div class="form-group">
                                <label> Balance: </label>
                                <input type="text"  readonly="" class="form-control text-right" id="totalbalance" name="balance"/>
                            </div>
                            <div class="form-group">
                                <label>Sub Total</label>
                                <input type="text" class="form-control text-right" id="subtotal" name="subtotal" readonly="" />
                            </div>
                        </div>
                        <div class="col-md-3"> 
                            <div class="form-group has-success" style="">
                                <label class="control-label" for="inputSuccess1" >Discount</label>
                                <input type="number" class="form-control text-right" style="text-align: center;" id="discount" name="discount"  tabindex="1" />
                                <!--Discount is grandtotal-->
                            </div>
                            
                            
                            <div class="form-group">
                                <label>Payable</label>
                                <input type="text" class="form-control text-right" id="payable" value="0" name="payable" readonly="" />

                                <input type="hidden" class="form-control text-right" id="grandtotal" value="0" name="grandtotal" />
                                
                            </div>



                            </div>
                            <div class="col-md-3"> 
                                <div class="form-group has-success">
                                    <label class="control-label" for="inputSuccess1" >DL</label>
                                    
                                    <input type="number" class="form-control text-right" style="text-align: center;" id="dlcharge" name="dlcharge" required=""  tabindex="2" />
                                </div>
                                <div class="form-group has-success">
                                    <label class="control-label" for="inputSuccess1" >PAID</label>
                                    
                                    <input type="number" class="form-control text-right" id="paid" name="paid" style="text-align: center;" required="" tabindex="4"/>
                                </div>
                        </div>
                        
                        <div class="col-md-3"> 
                            
                            <div class="form-group has-success">
                                <label class="control-label" for="inputSuccess1" >Vat</label>
                                <input type="number" class="form-control text-right" id="vat" name="vat" style="text-align: center;" required="" tabindex="3" />
                            </div>
                            <div class="form-group">
                                <label>Due</label>
                                <input type="number" class="form-control text-right" id="due" name="due" readonly="" value="0" />
                                
                            </div>
                        </div>
                    </div>
                
                </div>

                </div>
             </div>
            
           
          </div>
        </div>
        <div class="box">
            <div class="box-body">
                <table class="table table-bordered">
                                
                                
                    <tbody>
                        <tr>
                            <td width="20%">    <a class="btn btn-success btn-block" href="#" id="add_invo_pro_btn"><i class="lnr lnr-plus-circle"></i>&nbsp;Add New</a></td>

                           

                            <td width="40%">
                                <select id="product_id" class="form-control select2 select2_dropdown select2-hidden-accessible" style="width: 100%;" aria-hidden="true">
                                    <?php
                                    $q = "SELECT * FROM tbl_product tp
                                    JOIN tbl_supplier ts ON
                                        tp.product_brand = ts.supplier_id
                                    JOIN tbl_group tg ON
                                        tp.product_group = tg.groupid
                                    JOIN tbl_type tt ON
                                        tp.product_type = tt.typeid
                                    ORDER BY tp.product_name ASC";
                                    $status = $db->link->query($q) or die($db->link->error). " error at line number ".__LINE__;

                                    if ($status) {

                                        while ($result = $status->fetch_assoc()) {
                                            ?>
                                      <option productsearhkey="" productgroupid="<?php echo $result['product_group']; ?>" value="<?php echo $result['product_id']; ?>"><?php echo $result['product_name']; ?></option>
                                      

                                  <?php  }} ?>
                                    </select>
                            </td>
                            <td width="20%">
                                <input type="number" class="form-control" id="product_quantity" placeholder="Quantity">
                                <input type="hidden" name="addpurchase" class="form-control" id="product_quantity" placeholder="Quantity">
                            </td>


                            <td width="20%">
                                <input type="" class="form-control"  id="sale_price" placeholder="Sale Price"/>
                                <input type="hidden" class="form-control"  id="purchase_price" placeholder="Sale Price"/>
                            </td>
                            
                            
                            
                            
                        </tr>
                    </tbody>
                            </table>
                             </form>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tbody id="inv_product_table">
                        
                    </tbody>
                </table>

            </div>
        </div>
      </div>
      
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 <!-- footer -->

 <?php include 'lib/footer.php'; ?>