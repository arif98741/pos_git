<?php include 'lib/header.php'; ?>
<?php
//addproduct product
if (isset($_POST['payamount'])) {
    $customer_id = $_POST['customer_id'];
    $amount = $_POST['amount'];
    $updateby = Session::get('userid');
    $method = $_POST['method'];
    $previous = $_POST['previous'];
    $discount = $_POST['discount'];
    $date = date('Y-m-d H:i:s');
    $after_pay = $previous - $amount;
    $stmt = $db->link->query("insert into payment(
      customer_id,amount,current_bal,method,date,discount_amount,updateby) values(
      '$customer_id','$amount','$after_pay','$method','$date','$discount','$updateby')");

    if ($stmt) {
        $cus->sendMessage($customer_id,$amount,$method);
        echo "<script>alert('Paid Successfully');</script>";
    } else {
        echo "<script>alert('Paid Failed);</script>";
    }
}

if (isset($_POST['updatepayment'])) {
    $serial = $_POST['serial'];
    $customer_id = $_POST['customer_id'];
    $amount = $_POST['amount'];
    $discount = $_POST['discount'];
    $method = $_POST['method'];
    $date = date('Y-m-d h:i:s');

    $stmt = $db->link->query("update payment set amount='$amount',discount_amount='$discount',method='$method' where serial='$serial'") or die($db->link->error).__LINE__;

    $stmt1 = $db->link->query("select balance from customer_balance where customer_id='$customer_id'") or die($db->link->error).__LINE__;
    if ($stmt1) {
        $current_bal = $stmt1->fetch_assoc()['balance'];
        $stmt = $db->link->query("update payment set current_bal='$current_bal' where serial='$serial'") or die($db->link->error).__LINE__;

    }
}
?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>BILL PAY</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="<?php echo BASE_URL; ?>">Dashboard</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
     <div class="row">
       <div class="col-xs-12">
         
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                <thead>
                <tr role="row">
                  <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" width="10%">Seial</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending"  width="10%">Customer ID</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending"  width="15%">Customer Name</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"  width="10%">Email</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"  width="5%">Address</th>

                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"  width="10%">Contact No.</th>

                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"  width="10%">Balance</th>


                  
                   <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"  width="10%">Action</th>

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
                                <td><a type="button" href="#" class="" data-toggle="modal" data-target="#billpay<?php echo $i; ?>">Pay</a></td>
                             </tr>

                             <div class="modal fade" id="billpay<?php echo $i; ?>">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header bg-primary">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title "><i class="fa fa-money"></i>&nbsp;Bill Payment</h4>
                                      </div>
                                      <div class="modal-body">
                                         <form action="customerlist.php" method="post">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Customer ID</label>

                                                    <input name="customer_id"  class="form-control" type="text" placeholder="Customer ID"  value="<?php echo $row['customer_id']; ?>"   readonly="">
                                                </div>

                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Customer Name</label>

                                                 <input name="customer_name"  class="form-control" type="text" placeholder="Customer Name" value="<?php echo $row['customer_name']; ?>" readonly="">

                                                </div>

                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Previous Due</label>
                                                    <input name="previous"  class="form-control" type="text" value="<?php echo round($row['balance']); ?>" placeholder="Previous Balance"  required="">

                                                </div>

                                            </div>
                                            <div class="col-md-6">
                                              <div class="form-group">
                                                <label for="">Paid Amount</label>
                                                <input name="amount"  class="form-control" type="text" placeholder="Amount"  required="">

                                              </div>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                  <label for="">Discount</label>
                                                  <input type="text" name="discount" class="form-control" value="" placeholder="">
                                              </div>

                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                   <label for="">Payment Method</label>
                                                   <input type="text" name="method" class="form-control" value="" placeholder="">
                                                </div>

                                            </div>


                                            <div class="col-md-6 submit-button">
                                              <input type="submit" value="Pay Now" name="payamount" class="btn btn-success">
                                              <input type="reset" value="Reset" class="btn btn-warning">

                                            </div>
                                          </form> 
                                      </div>
                                      <div class="modal-footer">
                                        
                                        
                                      </div>
                                   </div>
                                    <!-- /.modal-content -->
                                  </div>
                                          <!-- /.modal-dialog -->
                                </div> 


                 <?php   } }else{ }?>
               </tbody>

              
              </table>
            </div>

            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>

      
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 <!-- footer -->

 <?php include 'lib/footer.php'; ?>