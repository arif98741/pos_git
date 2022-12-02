<?php include 'lib/header.php'; ?>
<?php if (Session::get('status') !== 'admin') {
    header("Location: index.php");
}?>
<?php
//addproduct product
if (isset($_POST['payamount'])) {
    $customer_id = $_POST['customer_id'];
    $amount = $_POST['amount'];
    $previous = $_POST['previous'];
    $date = date('Y-m-d h:i:s');
    $after_pay = $previous- $amount;
    $stmt = $db->link->query("insert into payment(customer_id,amount,date) values('$customer_id','$amount','$date')") or die($db->link->error).__LINE__;
    $stmt = $db->link->query("update tbl_customer set due ='$after_pay' where customer_id ='$customer_id'") or die($db->link->error).__LINE__;

    
    if ($stmt) {
        echo "<script>alert('Paid Successfully');</script>";
    } else {
        echo "<script>alert('Paid Failed);</script>";
    }
}


?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>PAYMENT RECORD</h1>
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
                  <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" width="10%">Date</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending"  width="10%">Customer ID</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending"  width="15%">Customer Name</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"  width="10%">Amount</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"  width="5%">Method</th>

                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"  width="10%">Receiver</th>

                 
                   <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"  width="10%">Action</th>

                </tr>
                </thead>
                <tbody style="text-align: center">
                            <?php
                            $stmt = $db->link->query("select p.*,tc.customer_name from payment p join tbl_customer tc on p.customer_id = tc.customer_id");

                            if($stmt){
                                $i= 0;
                                     while ($row = $stmt->fetch_assoc()) {  $i++;?>
                                     <tr>
                                        <td> <?php echo $help->formatDate($row['date'],'d-m-Y');   ?></td>
                                        <td> <?php echo $row['customer_id']  ?></td>
                                        <td style="text-align: left;"> <?php echo $row['customer_name']  ?></td>
                                        <td> <?php echo round($row['amount']);  ?></td>
                                         <td> <?php echo ucfirst($row['method']);  ?></td>
                                        <td> <?php echo $db->link->query("select name from tbl_user where userid='{$row['receiver']}'")->fetch_object()->name; ?></td>
                                        <td>
                                        <a href="editpayment.php?action=edit&serial=<?php echo $row['serial'] ?>" style="border-radius: 3px;" title="click to view" ><i class="fa fa-pencil-square-o"></i>&nbsp;&nbsp;</a>
                                        
                                    </td>
                                        
                                     </tr>
                                   <?php   } }else{

                            }
                            ?>
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