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


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><i class="lnr lnr-eye"></i> ক্রেতা প্রোফাইল</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> প্রচ্ছদ</a></li>
        <li class="active">ড্যাশবোর্ড</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="col-sm-12">
        <div class="box">
          <div class="box-body">
            <div class="row">
                <ul class="nav nav-tabs">
                  <li class="active"><a data-toggle="tab" href="#home">প্রোফাইল</a></li>
                  <li><a data-toggle="tab" href="#menu1">ইনভয়েন্ট</a></li>
                  <li><a data-toggle="tab" href="#menu2">পেমেন্টসমূহ</a></li>
                </ul>
            </div>
            <div class="row">
                <div class="tab-content">
          <div id="home" class="tab-pane fade-in active">
            <h3>ক্রেতা প্রোফাইল</h3>
            
              <ul >
                <li>নাম: <?php echo $customer_data['customer_name']; ?></li>
                <li>আইডি: <?php echo $customer_data['customer_id']; ?></li>
                <li>ঠিকানা: <?php echo $customer_data['address']; ?></li>
                <li>মোবাইল: <?php echo $customer_data['contact_no']; ?></li>
                <li>ইমেইল: <?php echo $customer_data['email']; ?></li>
                <li><strong>বর্তমান ব্যালেন্স: <?php echo round($customer_data['balance'])." tk"; ?></strong></li>
              </ul>
           
          </div>
          <div id="menu1" class="tab-pane fade">
            <h3> ইনভয়েচ </h3>
            <table class="table table-bordered" id="use_pro_invoice_table">
              <thead>
                <tr>
                  <th>ক্রমিক</th>
                  <th>ইনভয়েচ নাম্বার</th>
                  <th>সর্বমোট</th>
                  <th>ডিসকাউন্ট</th>
                  <th>ডেলিভারি চার্জ</th>
                  <th>ভ্যাট</th>
                  <th>পূর্ববর্তী ব্যালেন্স</th>
                  <th>পরিশোধ</th>
                  <th>বাকি</th>
                  <th>তারিখ</th>
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
            <h2>পেমেন্টসমূহ</h2>


            <table class="table table-bordered" id="customer_payment_table">
              <thead>
                <tr>
                  <th>ক্রমিক</th>
                  <th>তারিখ</th>
                  <th>পরিমাণ</th>
                  <th>গ্রহণকারী</th>
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
        </div>
      </div>
      
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 <!-- footer -->
 <?php include 'lib/footer.php'; ?>