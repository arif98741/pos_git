<?php include 'lib/header.php'; ?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><i class="lnr lnr-plus-circle"></i>বিল/ইনভয়েচ</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> প্রচ্ছদ</a></li>
        <li class="active"><a href="<?php echo BASE_URL; ?>">ড্যাশবোর্ড</a></li>
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
                            
                            <select name="cus_id" class="form-control select2" id="cus_dropdown_addinvoice">
                                <option value="" >ক্রেতা নির্বাচন করুন</option>
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
                            <input type="" class="form-control" id="customer_id" placeholder="ক্রেতার আইডি"/> 
                        </div>  
                    </div>              
                    <div class="col-md-6"> 
                        <div class="form-group">
                            <input type="" class="form-control" id="customer_name" placeholder="ক্রেতার নাম"/> 
                        </div>  
                    </div>  
                    <div class="col-md-6"> 
                        <div class="form-group">
                            <input type="" class="form-control" id="address" placeholder="ঠিকানা"/> 
                            
                        </div>
                    </div>
                    <div class="col-md-6"> 
                        <div class="form-group">
                            <input type="" class="form-control" id="contact" placeholder="মোবাইল"/> 
                            
                        </div>
                    </div>
                </div>

                
                <div class="col-sm-6">
                    <div class="row">   
                
                    <div class="col-md-12">
                        
                        
                        <div class="col-md-3"> 
                            <div class="form-group">
                                <label> ব্যালেন্স: </label>
                                <input type="text"  readonly="" class="form-control text-right" id="totalbalance" name="balance"/>
                            </div>
                            <div class="form-group">
                                <label>সর্বমোট</label>
                                <input type="text" class="form-control text-right" id="subtotal" name="subtotal" readonly="" />
                            </div>
                        </div>
                        <div class="col-md-3"> 
                            <div class="form-group has-success" style="">
                                <label class="control-label" for="inputSuccess1" >ডিসকাউন্ট</label>
                                <input type="number" class="form-control text-right" style="text-align: center;" id="discount" name="discount"  tabindex="1" />
                                <!--Discount is grandtotal-->
                            </div>
                            
                            <div class="form-group">
                                <label>পরিশোধযোগ্য</label>
                                <input type="text" class="form-control text-right" id="payable" value="0" name="payable" readonly="" />
                                <input type="hidden" class="form-control text-right" id="grandtotal" value="0" name="grandtotal" />
                            </div>

                            </div>
                            <div class="col-md-3"> 
                                <div class="form-group has-success">
                                    <label class="control-label" for="inputSuccess1" >ডেলিভারি চার্জ</label>
                                    
                                    <input type="number" class="form-control text-right" style="text-align: center;" id="dlcharge" name="dlcharge" required=""  tabindex="2" />
                                </div>
                                <div class="form-group has-success">
                                    <label class="control-label" for="inputSuccess1" >পরিশোধ</label>
                                    
                                    <input type="number" class="form-control text-right" id="paid" name="paid" style="text-align: center;" required="" tabindex="4"/>
                                </div>
                        </div>
                        
                        <div class="col-md-3"> 
                            
                            <div class="form-group has-success">
                                <label class="control-label" for="inputSuccess1" >ভ্যাট</label>
                                <input type="number" class="form-control text-right" id="vat" name="vat" style="text-align: center;" required="" tabindex="3" />
                            </div>
                            <div class="form-group">
                                <label>বকেয়া</label>
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
                            <td width="20%">    <a class="btn btn-success btn-block" href="#" id="add_invo_pro_btn"><i class="lnr lnr-plus-circle"></i>&nbsp;নতুন সংযোজন</a></td>

                           

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
                                <input type="number" class="form-control" id="product_quantity" placeholder="পরিমাণ">
                                <input type="hidden" name="addpurchase" class="form-control" id="product_quantity" placeholder="পরিমাণ">
                            </td>


                            <td width="20%">
                                <input type="" class="form-control"  id="sale_price" placeholder="বিক্রয়মূল্য"/>
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