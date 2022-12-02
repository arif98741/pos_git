<?php include 'lib/header.php'; ?>

<?php

if (isset($_GET['action'])) {

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

            <h1><i class="lnr lnr-plus-circle"></i> &nbsp;PAYMENT</h1>

            <ol class="breadcrumb">

                <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>

                <li class="active"><a href="billpay.php">Dashboard</a></li>

            </ol>

        </section>


        <!-- Main content -->

        <section class="content">

            <div class="col-sm-12">

                <div class="box">

                    <div class="box-body">


                        <div class="row">

                            <div class="col-md-12">

                                <form action="billpay.php" method="post">


                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label for="">Customer ID</label>

                                            <input name="customer_id" class="form-control" type="text"
                                                   placeholder="Customer ID"
                                                   value="<?php echo $customer_data['customer_id']; ?>" readonly="">

                                        </div>


                                    </div>


                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label for="">Customer Name</label>

                                            <input name="customer_name" class="form-control" type="text"
                                                   placeholder="Customer Name"
                                                   value="<?php echo $customer_data['customer_name']; ?>" readonly="">

                                        </div>


                                    </div>


                                    <div class="col-md-4">

                                        <div class="form-group">

                                            <label for="">Previous Due</label>

                                            <input name="previous" class="form-control" type="text"
                                                   value="<?php echo round($customer_data['balance']); ?>"
                                                   placeholder="Previous Balance" required="">

                                        </div>


                                    </div>


                                    <div class="col-md-4">

                                        <div class="form-group">

                                            <label for="">Paid Amount</label>

                                            <input name="amount" class="form-control" type="text" placeholder="Amount"
                                                   required="">

                                        </div>


                                    </div>


                                    <div class="col-md-4">

                                        <div class="form-group">

                                            <label for="">Payment Method</label>

                                            <input type="text" name="method" class="form-control" value=""
                                                   placeholder="">


                                        </div>


                                    </div>


                                    <div class="col-md-offset-4 col-md-6 submit-button">

                                        <input type="submit" value="Pay Now" name="payamount" class="btn btn-success">

                                        <input type="reset" value="Reset" class="btn btn-warning">

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