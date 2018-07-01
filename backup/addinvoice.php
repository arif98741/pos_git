<?php include 'lib/header.php'; ?>
<!-- //header-ends -->

<style>
	.form-control {
    display: block;
    width: 100%;
    height: 34px;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857143;
    color: #555;
    background-color: #fff;
    background-image: none;
    border: 1px solid #E0E0E0;
    border-radius: 3px;
    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
    box-shadow: none;
    -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
    -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
    transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
	}
</style>


<form action="printfiles/sale/printinvoice.php" method="post">
	<div class="container">	<div class="breadcrumb">
		
		<div class="row">
		<div style="padding:6px"
			<div class="col-sm-5">
				<h3><i class="lnr lnr-plus-circle"></i> &nbsp;BILL-INVOICE</h3>
				
			</div>
			<div class="col-sm-5">
				
				
			</div>
			<div class="col-sm-2">
				<input type="submit" class="btn btn-success" value="Save Invoice" >
			</div>
			
		</div>
	</div>
	<div class="bs-example4">
		
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
		
		<div class="row">
			<div class="col-sm-6">
				
				<div class="row">	
					
					<div class="col-md-12"> 
						<div class="form-group">
							
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
			<div class="col-sm-12">
				
				<div class="row"><hr>
					
				</div>
			</div>
			<div class="col-sm-12">
				
				<div class="row">	
					<div class="col-md-12"> 
						<div class="alert alert-warning">
							<table class="table table-bordered">
								
								
								<tbody>
									<tr>
										<td>	<a class="btn btn-success" href="#" id="add_invo_pro_btn"><i class="lnr lnr-plus-circle"></i>&nbsp;Add New</a></td>
										<td><input type="text" class="form-control" id="product_id" placeholder="Product ID"  tabindex="2"></td>
										<td>
											<select class="form-control" id="product_group_dropdown_add_sale" >
												<option id="reset_inv_product_group" value="">Select Group</option>
												<?php
													$grstmt = $db->select("select * from tbl_group order by groupname asc");
													if($grstmt){
														while ($row = $grstmt->fetch_assoc()) { ?>
														<option value="<?php echo ucfirst($row['groupid']); ?>"><?php echo $row['groupname']; ?></option>
														
														<?php  }
													}
												?>
											</select>
										</td>
										<td>
											
											<select class="form-control" id="product_group_list_dropdown_add_sale">
												<option value="">Select Product</option>
											</select>
											
										</td>
										<td>
											<input type="" class="form-control"  id="sale_price" placeholder="Sale Price"/>
											<input type="hidden" class="form-control"  id="purchase_price" placeholder="Sale Price"/>
										</td>
										
										<td>
											<input type="number" class="form-control" id="product_quantity" placeholder="Quantity"/>
										</td>
										
										
									</tr>
								</tbody>
							</table>
							
							
							
							
							
							
						</form>
						<div class="bs-example4">
							<table class="table table-striped">
								<tbody id="inv_product_table">
									
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			
			</div>
		</div>
		
		
	
	</div>
	
<?php include 'lib/footer.php'; ?>