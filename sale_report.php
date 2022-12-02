<?php include 'lib/header.php'; ?>
<?php if (Session::get('status') !== 'admin') {
    header("Location: index.php");
} ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1><i class="lnr lnr-chart-bars"></i> &nbsp; SALE REPORT</h1>
            <ol class="breadcrumb">
                <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active"><a href="<?php echo BASE_URL; ?>">Dashboard</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="col-sm-12">
                <div class="box">
                    <div class="box-body">

                        <div class="row">
                            <form action="printfiles/sale/sellreport.php" method="POST">
                                <div class="col-md-12">
                                    <div class="col-md-6">


                                        <div class="form-group">
                                            <label for=""><strong>From</strong></label>
                                            <input type="date" name="starting" id="startdate" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for=""><strong>To</strong></label>
                                            <input type="date" name="ending" id="enddate" class="form-control">
                                        </div>
                                        <div class="form-group">

                                        </div>
                                    </div>


                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label for=""><strong>Group</strong></label>
                                            <select name="groupid" id="" class="form-control">
                                                <option value="">Select Group</option>
                                                <?php
                                                $status = $pro->showGroup();
                                                if ($status) {
                                                    while ($result = $status->fetch_assoc()) { ?>
                                                        <option value="<?php echo $result['groupid']; ?>"><?php echo $result['groupname']; ?></option>
                                                    <?php }
                                                } ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for=""><strong>Supplier</strong></label>
                                            <select name="brandid" id="" class="form-control">
                                                <option value="">Select Supplier</option>
                                                <?php
                                                $status = $sup->showSupplier();
                                                if ($status) {
                                                    while ($result = $status->fetch_assoc()) { ?>
                                                        <option value="<?php echo $result['supplier_id']; ?>"><?php echo $result['supplier_name']; ?></option>
                                                    <?php }
                                                } ?>
                                            </select>
                                        </div>


                                        <div class="form-group">
                                            <label for=""><strong>Customer</strong></label>
                                            <select name="customer_id" id=""
                                                    class="customer form-control universal_select2_dropdown">
                                                <option value="">Select Customer</option>
                                                <?php
                                                $cusst = $db->select("select * from tbl_customer order by customer_name asc");
                                                if ($cusst) {
                                                    while ($row = $cusst->fetch_assoc()) { ?>
                                                        <option value="<?php echo ucfirst($row['customer_id']); ?>"><?php echo $row['customer_name']; ?></option>

                                                    <?php }
                                                }
                                                ?>
                                            </select>
                                        </div>


                                        <div class="form-group">
                                            <label for=""><strong>Product Name Wise</strong></label>
                                            <select name="product_id" id=""
                                                    class="form-control universal_select2_dropdown">
                                                <option value="">Select Product</option>
                                                <?php
                                                $status = $db->link->query("select * from tbl_product order by product_name asc");
                                                if ($status) {
                                                    while ($result = $status->fetch_assoc()) { ?>
                                                        <option value="<?php echo $result['product_id']; ?>"><?php echo $result['product_name']; ?></option>
                                                    <?php }
                                                } ?>
                                            </select>
                                        </div>


                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">

                                            <input type="submit" class="btn btn-success " name="showsellreport"
                                                   value="All Sales">
                                            <input type="submit" class="btn btn-warning" name="sellreportbygroup"
                                                   value="Group Wise">
                                            <input type="submit" class="btn btn-info " name="sellreportbybrand"
                                                   value="Supplier Wise">
                                            <input type="submit" class="btn btn-danger " name="sellreportbycustomer"
                                                   value="Customer Wise">
                                            <input type="submit" class="btn btn-warning " name="sellreportbyname"
                                                   value="Product Name Wise">
                                        </div>
                                    </div>
                                </div>
                            </form>
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