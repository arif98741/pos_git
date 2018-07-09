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
                            <?php
                                    $st = $db->select("select * from tbl_sell ORDER  by sell_id DESC ");
                                    $invoice = "";
                                    if ($st){
                                        if($st->num_rows > 0){
                                            $data = $st->fetch_assoc();
                                            $invoice =  $data['sell_id' ] + 1;
                                        }
                                        
                                        }else{
                                        $invoice =  date("ymd")."0001";
                                    }
                                    
                                ?>
                                
                                
                                <input class="form-control btn-success" name="sell_id" id="sell_id" type="hidden" value="<?php echo $invoice; ?>">
                            
                            <select name="cus_id" class="form-control" id="cus_dropdown_addinvoice">
                                <option value="" tabindex="1">Select Customer </option>
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
                                <input type="number" class="form-control text-right" style="text-align: center;" id="discount" name="discount"  tabindex="3" />
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
                                    <label class="control-label" for="inputSuccess1" tabindex="4" >DL</label>
                                    
                                    <input type="number" class="form-control text-right" style="text-align: center;" id="dlcharge" name="dlcharge" required="" />
                                </div>
                                <div class="form-group has-success">
                                    <label class="control-label" for="inputSuccess1" tabindex="6" >PAID</label>
                                    
                                    <input type="number" class="form-control text-right" id="paid" name="paid" style="text-align: center;" required="" />
                                </div>
                        </div>
                        
                        <div class="col-md-3"> 
                            
                            <div class="form-group has-success">
                                <label class="control-label" for="inputSuccess1" tabindex="5" >Vat</label>
                                <input type="number" class="form-control text-right" id="vat" name="vat" style="text-align: center;" required="" />
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
                                        <td>  <a class="btn btn-success" href="#" id="add_invo_pro_btn"><i class="lnr lnr-plus-circle"></i>&nbsp;Add New</a></td>

                                        <td><input type="text" class="form-control autocomplete" id="product_id" placeholder="Product ID"   tabindex="2"></td>
                                        
                                        <td>
                                            <input type="" class="form-control"  id="sale_price" placeholder="Sale Price"/>
                                            <input type="hidden" class="form-control"  id="purchase_price" placeholder="Sale Price"/>
                                        </td>
                                        
                                        <td>
                                            <input type="number" class="form-control" id="product_quantity" placeholder="Quantity"/>
                                            <input type="hidden" name="addpurchase" class="form-control" id="product_quantity" placeholder="Quantity"/>
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
 <!-- footer -->>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script src="assets/dist/js/jquery.autocomplete.js"></script>
<script>
    $(document).ready(function(){
        // Initialize ajax autocomplete:
        
        $('#autocomplete-ajax').autocomplete({
            // serviceUrl: '/autosuggest/service/url',
            lookup: countriesArray,
            lookupFilter: function(suggestion, originalQuery, queryLowerCase) {
                var re = new RegExp('\\b' + $.Autocomplete.utils.escapeRegExChars(queryLowerCase), 'gi');
                return re.test(suggestion.value);
            },
            onSelect: function(suggestion) {
                $('#selction-ajax').html('You selected: ' + suggestion.value + ', ' + suggestion.data);
            },
            onHint: function (hint) {
                $('#autocomplete-ajax-x').val(hint);
            },
            onInvalidateSelection: function() {
                $('#selction-ajax').html('You selected: none');
            }
        });
    });
</script>
 <?php include 'lib/footer.php'; ?>