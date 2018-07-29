<?php include 'lib/header.php'; ?>

<?php

    if(isset($_GET['action'])){

        $id = $help->validAndEscape($_GET['customer_id']);

        $stmt = $db->link->query("select * from tbl_customer join customer_balance on tbl_customer.customer_id = customer_balance.customer_id where tbl_customer.customer_id ='$id'");

        if ($stmt) {

            $customer_data = $stmt->fetch_assoc();

        }

    }

 ?>



  <!-- Content Wrapper. Contains page content -->

  <div class="content-wrapper">

    <!-- Content Header (Page header) -->

    <section class="content-header">
      <h1><i class="lnr lnr-plus-circle"></i> &nbsp;পেমেন্ট</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> প্রচ্ছদ</a></li>
        <li class="active"><a href="<?php echo BASE_URL; ?>">ড্যাশবোর্ড</a></li>

      </ol>

    </section>



    <!-- Main content -->

    <section class="content">
      <div class="col-sm-12">
        <div class="box"
          <div class="box-body">

             <div class="row">

                <div class="col-md-12"> 

            <form action="billpay.php" method="post">

                <div class="col-md-6">
                    <div class="form-group">
                          <label for="">ক্রেতার আইডি</label>
                        <input name="customer_id"  class="form-control" type="text" placeholder="ক্রেতার আইডি"  value="<?php echo $customer_data['customer_id']; ?>"   readonly="">

                    </div>

                </div>


                  <div class="col-md-6">
                    <div class="form-group">

                        <label for="">ক্রেতার নাম</label>

                        <input name="customer_name"  class="form-control" type="text" placeholder="ক্রেতার নাম" value="<?php echo $customer_data['customer_name']; ?>" readonly="">

                    </div>

                </div>

                
                <div class="col-md-4">

                    <div class="form-group">

                        <label for="">পূর্ববর্তী বকেয়া</label>

                        <input name="previous"  class="form-control" type="text" value="<?php echo round($customer_data['balance']); ?>" placeholder="পূর্ববর্তী বকেয়া"  required="">

                    </div>



                </div>

                

                

                <div class="col-md-4">

                    <div class="form-group">

                        <label for="">পরিমাণ</label>

                        <input name="amount"  class="form-control" type="text" placeholder="পরিমাণ"  required="">

                    </div>

                </div>


                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">পেমেন্ট পদ্ধতি</label>
                        <input type="text" name="method" class="form-control" value="" placeholder="">

                    </div>

                </div>


                <div class="col-md-offset-4 col-md-6 submit-button">

                    <input type="submit" value="পরিশোধ করুন" name="payamount" class="btn btn-success">

                    <input type="reset" value="পুনরায়" class="btn btn-warning">

                </div>

                </div>

            </div>

            

            </form>

          </div>

        </div>

      </div>

      

    </section>

    <!-- /.content -->

  </div>

  <!-- /.content-wrapper -->

 <!-- footer -->



 <?php include 'lib/footer.php'; ?>