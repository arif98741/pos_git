<?php include 'lib/header.php'; ?>
    <!-- //header-ends -->
    <div id="page-wrapper">
        <div class="graphs">
            <div class="breadcrumb">
                <h3><i class="lnr lnr-chart-bars"></i> &nbsp;Sale Report</h3>
            </div>


            <form action="printfiles/sale/sellreport.php" method="POST">


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
                            while ($result = $status->fetch_assoc()) {
                                ?>
                                <option value="<?php echo $result['groupid']; ?>"><?php echo $result['groupname']; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for=""><strong>Brand</strong></label>
                        <select name="brandid" id="" class="form-control">
                            <option value="">Select Brand</option>
                            <?php
                            $status = $pro->showBrand();
                            while ($result = $status->fetch_assoc()) {
                                ?>
                                <option value="<?php echo $result['brandid']; ?>"><?php echo $result['brandname']; ?></option>
                            <?php } ?>
                        </select>
                    </div>


                    <div class="form-group">
                        <label for=""><strong>Product Name</strong></label>
                        <select name="product_id" id="" class="form-control">
                            <option value="">Select Product</option>
                            <?php
                            $status = $pro->showallproducts();
                            while ($result = $status->fetch_assoc()) {
                                ?>
                                <option value="<?php echo $result['product_id']; ?>"><?php echo $result['product_name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>


                </div>

                <div class="col-md-12">
                    <div class="form-group">

                        <input type="submit" class="btn btn-success " name="showsellreport" value="All Sales">
                        <input type="submit" class="btn btn-info " name="sellreportbyname" value="Name Wise">
                        <input type="submit" class="btn btn-warning" name="sellreportbygroup" value="Group Wise">
                        <input type="submit" class="btn btn-info " name="sellreportbybrand" value="Brand Wise">

                    </div>
                </div>

            </form>

        </div>
    </div>

<?php include 'lib/footer.php'; ?>