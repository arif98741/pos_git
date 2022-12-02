<?php include 'lib/header.php'; ?>
<?php if (Session::get('status') !== 'admin') {
    header("Location: index.php");
} ?>
    <!-- //header-ends -->
    <div class="container">
        <div class="breadcrumb">
            <h3><i class="lnr lnr-chart-bars"></i> &nbsp;Profit Report</h3>
        </div>
        <div class="bs-example4">

            <div class="row">
                <div class="col-md-12">

                    <form action="printfiles/sale/printprofit.php" method="POST">
                        <div class="col-md-6 col-md-offset-3">
                            <div class="form-group">
                                <label for=""><strong>From</strong></label>
                                <input type="date" name="starting" id="startdate" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for=""><strong>To</strong></label>
                                <input type="date" name="ending" id="enddate" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-offset-6 col-md-6">
                            <div class="form-group">
                                <input type="submit" name="showprofit" class="btn btn-primary" value="Preview">

                            </div>
                        </div>

                </div>
            </div>
            </form>
        </div>
    </div>

<?php include 'lib/footer.php'; ?>