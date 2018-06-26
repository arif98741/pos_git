<?php include 'lib/header.php'; ?>
<?php include_once 'classes/Dashboard.php'; ?>
<?php
   $dash = new Dashboard();
 ?>
<!-- //header-ends -->

      
         <div class="graphs">
            <ul class="nav nav-tabs">
               <li class="active"><a data-toggle="tab" href="#home">Home</a></li>
               <li><a data-toggle="tab" href="#menu1">Recent Sales</a></li>
               <li><a data-toggle="tab" href="#menu2">Recent Payements</a></li>
               <li><a data-toggle="tab" href="#menu3">Add Payment</a></li>
               
            </ul>
            <div class="tab-content">
               <div id="home" class="tab-pane fade in active">
                  <div class="bs-example4">
                  <div class="col_3">
                     <div class="col-md-3 widget widget1">
                        <div class="r3_counter_box">
                           <i class="fa fa-usd"></i>
                           <div class="stats">
                              <h5><?php echo $dash->TodaySale(); ?> <span></span></h5>
                              <div class="grow">
                                Today Sale
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-3 widget widget1">
                        <div class="r3_counter_box">
                           <i class="fa fa-users"></i>
                           <div class="stats">
                              <h5><?php echo $dash->TodayMemo(); ?> <span></span></h5>
                              <div class="grow grow1">
                                Today Memo
                              </div>
                           </div>
                        </div>
                     </div>



                     <div class="col-md-3 widget widget1">
                        <div class="r3_counter_box">
                           <i class="fa fa-users"></i>
                           <div class="stats">
                              <h5><?php echo $dash->TotalMemo(); ?> <span></span></h5>
                              <div class="grow grow1">
                                Total Memo
                              </div>
                           </div>
                        </div>
                     </div>



                     <div class="col-md-3 widget widget1">
                        <div class="r3_counter_box">
                           <i class="fa fa-eye"></i>
                           <div class="stats">
                            
                              <h5><?php echo $dash->TotalDue(); ?></h5>
                              
                            
                              <div class="grow grow3">
                                 Total Due
                              </div>
                           </div>
                        </div>
                     </div>
                    
                     <div class="clearfix"> </div>
                  </div>
                  </div>

               
               </div>
               <div id="menu1" class="tab-pane fade">
                <div class="bs-example4">
                  
                      <table class="table table-bordered invoice_table" id="invoice_product_data_table">
                        <thead>
                        <tr>
                            <th width="8%">Date</th>
                            <th width="9%">Inv No</th>
                            <th width="12%">Customer</th>
                            <th width="9%">Subtotal</th>
                            <th width="7%">Discount</th>
                            <th width="7%">DL.</th>
                            <th width="7%">Vat</th>
                            <th width="10%">Pre-Balance</th>
                            <th width="7%">Payable</th>
                            <th width="8%">Paid</th>
                            <th width="6%">Due</th>
                            <th width="10%">Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php
                        $status = $db->link->query("select ts.date,ts.customer_id,ts.previous_balance,ts.sell_id,ts.serial,ts.due,ts.sub_total,ts.dlcharge,ts.discount,ts.vat,ts.payable,ts.paid,ts.due,tc.customer_name from tbl_sell ts JOIN tbl_customer tc on
                        ts.customer_id = tc.customer_id order by ts.serial desc limit 10");
                        if ($status) {
                            $i  = 0;
                            while ($result = $status->fetch_assoc()) {
                                $quantity = 0;
                                $i++;
                                ?>
                                <tr style="text-align: center;" id="rowid-<?php echo $result['serial']; ?>">
                                    <td><?php echo $help->formatDate($result['date'],'d-m-Y'); ?></td>
                                    <td><?php echo $result['sell_id']; ?></td>
                                    <td  style="text-align: left;"><?php echo $result['customer_name']; ?></td>
                                    <td><?php echo round($result['sub_total']); ?></td>
                                    <td><?php echo round($result['discount']); ?></td>
                                    <td><?php echo round($result['dlcharge']); ?></td>
                                    <td><?php echo round($result['vat']); ?></td>
                                    
                                    <td><?php echo round($result['previous_balance']); ?></td>
                                    <td><?php echo round($result['payable']); ?></td>
                                    <td><?php echo round($result['paid']); ?></td>
                                    <td><?php echo round($result['due']); ?></td>

                                    <?php if(Session::get('status') == 'admin'): ?>

                                    <td>
                                        <a href="viewsales.php?action=view&serial=<?php echo $result['serial'] ?>&sell_id=<?php echo $result['sell_id']; ?>" style="border-radius: 3px;" title="click to view" ><i class="fa fa-eye"></i>&nbsp;&nbsp;</a>
                                        <a href="editsales.php?action=edit&serial=<?php echo $result['serial'] ?>&sell_id=<?php echo $result['sell_id']; ?>" style="border-radius: 3px;" title="click to edit" ><i class="fa fa-pencil-square-o"></i>&nbsp;&nbsp;</a>
                                        <a href="editsales.php?action=edit&serial=<?php echo $result['serial'] ?>&sell_id=<?php echo $result['sell_id']; ?>" style="border-radius: 3px;" title="click to edit" ><i class="lnr lnr-save"></i>&nbsp;&nbsp;</a>
                                        
                                        <a href="?action=delete&serial=<?php echo $result['serial'] ?>&invoice_id=<?php echo $result['sell_id']; ?>" style="border-radius: 3px;" title="click to delete" onclick="return confirm('are you sure to delete?')" id="rowdelete" delid="<?php echo $result['serial']; ?>"><i class="lnr lnr-trash"></i></a>
                                    </td>
                                  <?php else: ?>
                                         <td><a href="viewsales.php?action=view&serial=<?php echo $result['serial'] ?>&sell_id=<?php echo $result['sell_id']; ?>" style="border-radius: 3px;" title="click to view" ><i class="fa fa-eye"></i>&nbsp;&nbsp;</a>  </td>     
                                  <?php endif; ?>  
                                </tr>

                                <?php
                            }
                        } else {
                            ?>

                        <?php }
                        ?>
                        </tbody>

                    </table>
                  </div>
               
               </div>
               <div id="menu2" class="tab-pane fade">
                 <div class="bs-example4">
                     <table class="table table-striped table-bordered table-hover" cellspacing="4" id="product_table" class="order-column" width="100%">
                        <thead>
                           <tr>
                              <th>Date</th>
                              <th>Customer ID</th>
                              <th>Customer Name</th>
                              <th>Amount</th>
                              <th>Receiver</th>
                           </tr>
                        </thead>
                        <tbody style="text-align: center">
                           <?php
                              $stmt = $db->link->query("SELECT pa.*,tc.customer_name FROM payment pa join tbl_customer tc on pa.customer_id = tc.customer_id order by pa.serial desc limit 10");
                              
                              if($stmt){
                                  $i= 0;
                                       while ($row = $stmt->fetch_assoc()) {  $i++;?>
                           <tr>
                              <td> <?php echo $help->formatDate($row['date'],"d-m-Y h:iA");   ?></td>
                              <td> <?php echo $row['customer_id']  ?></td>
                              <td style="text-align: left;"> <?php echo $row['customer_name']  ?></td>
                              <td> <?php echo round($row['amount']);  ?></td>
                              <td> <?php echo $db->link->query("select name from tbl_user where userid='{$row['receiver']}'")->fetch_object()->name; ?></td>
                           </tr>
                           <?php   } }else{
                              }
                              ?>
                        </tbody>
                     </table>
                   </div>
               </div>
               <div id="menu3" class="tab-pane fade">
                 <div class="bs-example4">
                  <table class="table table-striped table-bordered table-hover" cellspacing="4" id="product_table" class="order-column" width="100%">
                     <thead>
                        <tr>
                           <th>Serial</th>
                           <th>Customer ID</th>
                           <th>Customer Name</th>
                           <th>Email</th>
                           <th>Address</th>
                           <th>Contact no</th>
                           <th>Balance</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody style="text-align: center">
                        <?php
                           $stmt = $db->link->query("select * from tbl_customer tc join customer_balance cb on tc.customer_id = cb.customer_id  order by customer_name asc");
                           
                           if($stmt){
                               $i= 0;
                                    while ($row = $stmt->fetch_assoc()) {  $i++;?>
                        <tr>
                           <td> <?php echo $i;   ?></td>
                           <td> <?php echo $row['customer_id']  ?></td>
                           <td> <?php echo $row['customer_name']  ?></td>
                           <td> <?php echo $row['email']  ?></td>
                           <td> <?php echo $row['address'] ?> </td>
                           <td> <?php echo $row['contact_no'] ?> </td>
                           <td> <?php echo round( $row['balance']); ?> </td>
                           <td><a href="payment.php?action=pay&customer_id=<?php echo $row['customer_id']; ?>" class="">Pay</a></td>
                        </tr>
                        <?php   } }else{
                           }
                           ?>
                     </tbody>
                  </table>
                
                </div>
               </div>

              
            </div>
         </div>

<!--body wrapper end-->
<?php include 'lib/footer.php'; ?>