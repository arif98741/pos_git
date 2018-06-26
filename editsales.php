<?php include 'lib/header.php'; ?>
<?php if (Session::get('status') !== 'admin') {
    header("Location: index.php");
}?>
<?php 
  if (isset($_GET['action']) && $_GET['action'] == 'edit') {
    $sell_id = $_GET['sell_id'];
    $status = $db->link->query("select ts.* from tbl_sell ts join tbl_customer tc on ts.customer_id = tc.customer_id where ts.sell_id='$sell_id'") or die($db->link->error . __LINE__);
    if ($status) {
      $data = $status->fetch_assoc();
      $customer_id = $data['customer_id'];

      
      
    }
  }

?>
<!-- //header-ends -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><i class="lnr lnr-pencil"></i>&nbsp;EDIT-INVOICE</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      
      <div class="col-sm-12">
        <div class="box">
          <form action="invoicelist.php" method="post">
            <input class="form-control btn-success" name="sell_id" id="sell_id" type="hidden" value="<?php echo $data['sell_id']; ?>">
          
          <div class="box-body">
            <div class="row">
              <div class="col-sm-6">
        
        <div class="row"> 

          
          <div class="col-md-12"> 
            <div class="form-group">
              
              <select name="cus_id" class="form-control" id="cus_dropdown_addinvoice"">
                <option value="">Select Customer </option>
                <?php 
                  $cusst = $db->select("select * from tbl_customer order by customer_name asc") or die($db->link->error . __LINE__);

                  $singlecust = $db->select("select * from tbl_customer where customer_id='$customer_id'") or die($db->link->error . __LINE__);
                  if ($singlecust) {
                    $cdata = $singlecust->fetch_assoc();
                  }
                  
                  if($cusst){
                    while ($row = $cusst->fetch_assoc()) { ?>

                    <?php if($row['customer_id'] == $data['customer_id']): ?>
                      <option value="<?php echo $row['customer_id']; ?>" selected><?php echo $row['customer_name']; ?></option>
                    <?php else: ?>  
                    <option value="<?php echo $row['customer_id']; ?>"><?php echo $row['customer_name']; ?></option>

                    <?php endif; ?>
                    
                    <?php  }
                  }
                ?>
                
              </select>
              
              
            </div>
          </div>
          
          
          <div class="col-md-6"> 
            <div class="form-group">
              <input type="" class="form-control" id="customer_id" value="<?php echo $cdata['customer_id']; ?>" placeholder="Customer ID"/> 
            </div>  
          </div>        
          <div class="col-md-6"> 
            <div class="form-group">
              <input type="" class="form-control" id="customer_name" value="<?php echo $cdata['customer_name']; ?>" placeholder="Customer Name"/> 
            </div>  
          </div>  
          <div class="col-md-6"> 
            <div class="form-group">
              
              
              <input type="" class="form-control" id="address" value="<?php echo $cdata['address']; ?>" placeholder="Address"/> 
              
            </div>
          </div>
          <div class="col-md-6"> 
            <div class="form-group">
              <input type="" class="form-control" id="contact" value="<?php echo $cdata['contact_no']; ?>" placeholder="Contact"/> 
              
            </div>
          </div>
        </div>
      </div>
      
      
      
      <div class="col-sm-6">
                <div class="row"> 

        
          <div class="col-md-12">
            
            
            <div class="col-md-3"> 

              <div class="form-group">
                <label> Balance: </label>
                <input type="text"  readonly="" class="form-control text-right" id="totalbalance" name="balance"  value="<?php echo $data['previous_balance']; ?>" />
              </div>
              <div class="form-group">
                <label>Sub Total</label>
                <input type="text" class="form-control wholetotal text-right" id="subtotal" name=""  value="<?php echo $data['sub_total']; ?>" />
              </div>
            </div>
            <div class="col-md-3"> 
              <div class="form-group has-success">
                <label class="control-label" for="inputSuccess1">Discount</label>
                <input type="text" class="form-control text-right"  id="discount" name="discount" value="<?php echo $data['discount']; ?>" />
              </div>
              
              
              
              
              <div class="form-group">
                <label>Grand Total</label>
                <input type="text" class="form-control text-right" id="grandtotal" name="payable" value="<?php echo $data['grand_total']; ?>" />
                
              </div>
            </div>
            <div class="col-md-3"> 
              <div class="form-group has-success">
                <label class="control-label" for="inputSuccess1">DL</label>
                
                <input type="text" class="form-control text-right" id="dlcharge" name="dlcharge"  value="<?php echo $data['dlcharge']; ?>" />
              </div>
              <div class="form-group has-success">
                <label class="control-label" for="inputSuccess1">PAID</label>
                
                <input type="text" class="form-control text-right" id="paid" name="paid"  value="<?php echo $data['paid']; ?>" />
              </div>
            </div>
            
            <div class="col-md-3"> 

              
              <div class="form-group has-success">
                <label class="control-label" for="inputSuccess1">Vat</label>
                <input type="text" class="form-control text-right" id="vat" name="vat"  value="<?php echo $data['vat']; ?>" />
                
              </div>
              <div class="form-group">
                <label>Due</label>
                <input type="text" class="form-control text-right" id="due" name="due"  value="<?php echo $data['due']; ?>" />
                
              </div>

            </div>
          </div>
        </div>
        
        
      </div>
      <div class="col-sm-12">
        
        <div class="row"><hr>
          
        </div>
      </div>
      <div class="col-sm-12">
        
        <div class="row"> 
          <div class="col-md-12">
            <input type="submit" class="btn btn-success pull-right" value="Update Invoice">
          </div>
          <div class="col-md-12"> 
            
              
              
            
            <div class="bs-example4">
              <table class="table table-striped">
                <tbody id="inv_detail">
                  <tr>
                    <th width="5%">Serial</th>
                    <th width="15%">Product ID</th>
                    <th width="15%">Product Group</th>
                    <th width="20%">Product Name</th>
                    <th width="15%">Price</th>
                    <th width="15%">Quantity</th>
                    <th width="15%">Subtotal</th>
                    
                  </tr>
                  <?php
                      $status = $db->link->query("SELECT * from tbl_sell_products tsp join tbl_product tp on tsp.product_id = tp.product_id join tbl_group tg on tp.product_group = tg.groupid WHERE tsp.sell_id ='$sell_id' and tsp.status='1'") or die($db->link->error . __LINE__);

                      if ($status) {

                        $i = 0;
                        while ($row = $status->fetch_assoc()) { $i++; ?>
                            <tr>
                              <td><?php echo $i; ?></td>
                              <td><input type="number" name="" class="form-control product_id " value="<?php echo $row['product_id']; ?>" readonly></td>
                              <td >
                                <select name="" class="form-control product_group">
                                  <option value="">Select Group</option>
                                <?php 
                                  $gru_sta = $db->link->query("SELECT * from tbl_group order by groupname asc") or die($db->link->error . __LINE__);
                                  if ($gru_sta) {
                                    while ($gru_row = $gru_sta->fetch_assoc()) { ?>


                                      <?php if($gru_row['groupid'] == $row['product_group']): ?>
                                        <option value="<?php echo $gru_row['groupid']; ?>" selected><?php echo $gru_row['groupname']; ?></option>
                                      <?php else: ?>  
                                      <option value="<?php echo $gru_row['groupid']; ?>"><?php echo $gru_row['groupname']; ?></option>
                                      <?php endif; ?> 
                                        
                                  <?php }} ?>

                                  
                                </select>
                              </td>
                              <td >
                                <b class="product_name">
                                <select name="product_id[]" class="form-control product_list">
                                  <option value="">Select Product</option>
                                <?php 
                                  $pro_sta = $db->link->query("SELECT * from tbl_product order by product_name asc") or die($db->link->error . __LINE__);
                                  if ($pro_sta) {
                                    while ($pro_row = $pro_sta->fetch_assoc()) { ?>

                                      <?php if($pro_row['product_id'] == $row['product_id']): ?>
                                        <option value="<?php echo $pro_row['product_id']; ?>" selected><?php echo $pro_row['product_name']; ?></option>
                                      <?php else: ?>  
                                      <option value="<?php echo $pro_row['product_id']; ?>"><?php echo $pro_row['product_name']; ?></option>

                                      <?php endif; ?> 


                                    

                                  <?php }} ?>

                                  
                                </select>
                                </b>
                              </td>
                              <td><input type="text" name="price[]" class="form-control sale_price purchase text-center" value="<?php echo $row['unit_price']; ?>"></td>
                              <td><input type="text" name="quantity[]" class="form-control quantity text-center" value="<?php echo $row['quantity']; ?>"></td>
                              <td>
                                <b class="subtotal"><?php echo $row['subtotal']; ?></b>
                                <input type="hidden" name="subtotal[]" class="form-control subtotalforsave text-right" value="<?php echo $row['subtotal']; ?>" readonly>
                              </td>
                              

                              <!-- to save data according to serial in table -->
                              <input type="hidden" name="serial_no[]" class="form-control" value="<?php echo $row['serial_no']; ?>" >
                              
                            </tr>
                      <?php }}  ?>
                </tbody>
              </table>
            </div>
         
        </div>
      </div>
      
      </div>
    </div>
        </div>
        <input type="hidden"  name="updateinvoice">
        </form>
      </div>

      </div>
      
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 <!-- footer -->
 <?php include 'lib/footer.php'; ?>