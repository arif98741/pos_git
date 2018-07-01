<?php include 'lib/header.php'; ?>
<?php
  if (isset($_GET['invoice_id'])) {
    $invoice_id = $help->validAndEscape($_GET['invoice_id']);
  }else{
    header("Location: purchaselist.php");
    
  }
?>
<div class="container">
	<div class="breadcrumb">
           <h3><i class="lnr lnr-chart-bars"></i> &nbsp;View Purchase</h3>
	</div>
	<div class="bs-example4">
		
		<div class="row">
				<div class="col-md-12"> 
               <p><strong>Invoice Number</strong>- <?php if(isset($_GET['invoice_id'])): ?> <?php echo $_GET['invoice_id']; ?><?php endif;?></p>
               <p><strong>Total Products </strong>- <?php
                  // $invoice_id = $help->validAndEscape($_GET['invoice_id']);
                   $query = "select * from tbl_invoice ti join tbl_invoice_products tip on 
                              ti.invoice_number = tip.invoice_id JOIN tbl_supplier ts on 
                              ti.supplier_id = ts.supplier_id JOIN tbl_product tp on 
                              tip.product_id = tp.product_id JOIN tbl_group tg on 
                              tp.product_group = tg.groupid
                               where ti.invoice_number = '$invoice_id' ";
                   $status = $db->select($query); 
                   $purchase_data = $status->fetch_assoc();            
                   $row = $db->rowCount("SELECT * FROM `tbl_invoice_products` WHERE invoice_id='$invoice_id'");
                   if($row){
                       echo $row;
                   }else{
                       echo "0";
                   }
                   ?>
               </p>
               <p><strong>Date </strong>: <?php echo $purchase_data['date']; ?></p>
               <p><strong>Supplier </strong>: <?php echo $purchase_data['supplier_name']; ?></p>


            </div>
        </div>
    </div>
 

       
          	<div class="bs-example4">
		
		          <div class="row">
                <div class="table-responsive">
                    <table class="table table-bordered invoice_table" id="invoice_product_data_table">
                        <thead>
                        <tr class="bg-warning">
                            <th>Serial</th>
                            <th>Product ID</th>
                            <th>Group</th>
                            <th>Product Name</th>
                            <th>Purchase</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php
                         
                        $q = "select tp.product_id,tg.groupname,tp.product_name,tip.quantity,tip.purchase from tbl_invoice_products tip join tbl_invoice ti on ti.invoice_number = tip.invoice_id join tbl_product tp on tip.product_id = tp.product_id join tbl_group tg on tp.product_group = tg.groupid where ti.invoice_number = '$invoice_id'";
                        $stmt = $db->link->query($q);  

                        if ($stmt) {
                         
                            $total = $i = 0;
                            while ($result = $stmt->fetch_assoc()) {
                                $i++;
                                $total = ($result['quantity'] * $result['purchase']) + $total; 
                                ?>
                                <tr style="text-align: center;" id="rowid-<?php echo $result['serial']; ?>">
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $result['product_id']; ?></td>
                                    <td><?php echo $result['groupname']; ?></td>
                                    <td><?php echo $result['product_name']; ?></td>
                                    <td><?php echo $result['quantity']; ?></td>
                                    <td><?php echo $result['purchase']; ?></td>
                                    <td><?php echo $result['quantity'] * $result['purchase']; ?></td>
                                </tr>

                                <?php } } else { ?>

                        <?php }  ?>
                           <tr class="bg-warning">
                             <td colspan="5"></td>
                             <td><strong>Total</strong></td>
                             <td style="text-align: center;"><strong><?php echo $total; ?></strong></td>
                           </tr>
                        </tbody>

                    </table>
              </div>
				</div>
			</div>
		</div>
 
</div>
</div>
<?php include 'lib/footer.php'; ?>
