<?php include 'lib/header.php'; ?>
<?php 

  if(isset($_GET['customer_id']))
  {
    $customer_id = $_GET['customer_id'];
    $stmt = $db->link->query("select * from tbl_customer join customer_balance on tbl_customer.customer_id = customer_balance.customer_id where customer_id='$customer_id'");
    $stmt = $db->link->query("select * from tbl_customer join customer_balance on tbl_customer.customer_id = customer_balance.customer_id where tbl_customer.customer_id='$customer_id'");
    if($stmt)
    {
      $customer_data = $stmt->fetch_assoc();
    }

  }
            
?>

<!-- //header-ends -->
<div id="page-wrapper">
    <div class="graphs">
           <ul class="nav nav-tabs">
              <li class="active"><a data-toggle="tab" href="#home">Profile</a></li>
              <li><a data-toggle="tab" href="#menu1">Invoice</a></li>
              <li><a data-toggle="tab" href="#menu2">Payments</a></li>
          </ul>

        <div class="tab-content">
          <div id="home" class="tab-pane fade in active">
            <h3>User Profile</h3>
            <div class="well">
              <ul >
                <li>Name: <?php echo $customer_data['customer_name']; ?></li>
                <li>ID: <?php echo $customer_data['customer_id']; ?></li>
                <li>Address: <?php echo $customer_data['address']; ?></li>
                <li>Contact No: <?php echo $customer_data['contact_no']; ?></li>
                <li>Email: <?php echo $customer_data['email']; ?></li>
                <li><strong>Current Balance: <?php echo round($customer_data['balance'])." tk"; ?></strong></li>
              </ul>
            </div>
          </div>
          <div id="menu1" class="tab-pane fade">
            <h3>Invoice</h3>
            <table class="table table-bordered" id="use_pro_invoice_table">
              <thead>
                <tr>
                  <th>Serial</th>
                  <th>Invoice No</th>
                  <th>Sub Total</th>
                  <th>Discount</th>
                  <th>DL.</th>
                  <th>Vat</th>
                  <th>Pre. Balance</th>
                  <th>Paid</th>
                  <th>Due</th>
                  <th>Date</th>
                </tr>
              </thead>
              <tbody style="text-align:center;">
                <?php 

                  $st = $db->link->query("select ts.sub_total,ts.date,ts.sell_id,ts.grand_total,ts.paid,ts.dlcharge,ts.vat,ts.previous_balance,ts.discount,ts.due from tbl_sell ts JOIN tbl_customer tc on
                    ts.customer_id = tc.customer_id where tc.customer_id='$customer_id' order by ts.serial desc");
                  if ($st) {
                    $i =0;
                    while ($row = $st->fetch_assoc()) { $i ++;
                        ?>
                        <tr>
                          <td><?php echo $i; ?></td>
                          <td><?php echo round($row['sell_id']); ?></td>
                          <td><?php echo round($row['sub_total']); ?></td>
                          <td><?php echo round($row['discount']); ?></td>
                          <td><?php echo round($row['dlcharge']); ?></td>
                          <td><?php echo round($row['vat']); ?></td>
                          <td><?php echo round($row['previous_balance']); ?></td>
                          <td><?php echo round($row['paid']); ?></td>
                          <td><?php echo round($row['due']); ?></td>
                          <td><?php echo $help->formatDate($row['date'],'d-m-Y h:iA'); ?></td>
                        </tr>

                        <?php
                    }
                  }
                ?>
              </tbody>
            </table>
          </div>
          <div id="menu2" class="tab-pane fade">
            <h2>Payments</h2>


            <table class="table table-bordered" id="customer_payment_table">
              <thead>
                <tr>
                  <th>Serial</th>
                  <th>Date</th>
                  <th>Amount</th>
                  <th>Reciever</th>
                </tr>
              </thead>
              <tbody style="text-align:center;">
                <?php 

                  $st = $db->link->query("select * from payment join tbl_user on payment.receiver = tbl_user.userid where customer_id = '$customer_id' order by date desc");
                  if ($st) {
                    $i = $total = 0;
                    while ($row = $st->fetch_assoc()) { $i ++; $total += $row['amount'];
                        ?>
                        <tr>
                          <td><?php echo $i; ?></td>
                          <td><?php echo $help->formatDate($row['date'],'d-m-Y h:iA'); ?></td>
                          <td><?php echo round($row['amount']); ?></td>
                          <td><?php echo $row['name']; ?></td>
                          
                        </tr>

                        <?php }  } ?>
              </tbody>
            </table>

          </div>
          <div id="menu3" class="tab-pane fade">
            <h3>Menu 4</h3>
            <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
          </div>
        </div>
    </div>
</div>
<!--body wrapper end-->

<!--Bootstrap Modal-->


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Customer Payment</h4>
      </div>
      <div class="modal-body">
       
          <div class="form-group">
            <label for="recipient-name" class="control-label">Previous Due</label>
            <input type="text" id="previous_due_amount" class="form-control" value="<?php echo round($customer_data['due']);?>" style="text-align: right;" readonly>
          </div>
          <div class="form-group">
            <label for="message-text" class="control-label">Payment Amount</label>
            <input type="number" id="paid_amount" style="text-align: right;" class="form-control">
            <input type="hidden" id="cus_account_id" value="<?php echo $customer_data['customer_id']; ?>" class="form-control"  style="text-align: right;">
          </div>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-warning" data-dismiss="modal">&times;</button>
        <button type="button" id="paid_action_btn" class="btn btn-primary">Pay Now</button>
      </div>
    </div>
  </div>
</div>
<?php include 'lib/footer.php'; ?>