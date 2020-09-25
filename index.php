<?php include 'lib/header.php'; ?>
<?php
$dash = new Dashboard();

?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Dashboard

            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->


            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3><?php echo $dash->totalWholeSale(); ?></h3>
                        <p>Stock Wholesale</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-money"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i
                                class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3><?php echo $dash->totalRetailStockPrice(); ?></h3>
                        <p>Stock Retail</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-money"></i>
                    </div>
                    <a href="invoicelist.php" class="small-box-footer">More info <i
                                class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3><?php echo $dash->totalSaleStockPrice(); ?></h3>
                        <p>Stock Sale</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-money"></i>
                    </div>
                    <a href="invoicelist.php" class="small-box-footer">More info <i
                                class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-gray">
                    <div class="inner">
                        <h3><?php echo $dash->totalProducts(); ?></h3>

                        <p>Total Products</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-list"></i>
                    </div>
                    <a href="export-as-all-products.php" class="small-box-footer">Download Now&nbsp;&nbsp;<i
                                class="fa fa-download"></i></a>
                </div>
            </div>


            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3><?php echo $dash->outOfStockProductTotal(); ?></h3>

                        <p>Out of stock Products</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-university"></i>
                    </div>
                    <a href="export-as-csv-out-of-stock.php" class="small-box-footer">Download Now&nbsp;&nbsp;<i
                                class="fa fa-download"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3><?php echo $dash->lowStockProductTotal(); ?></h3>

                        <p>Low stock Products</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-university"></i>
                    </div>
                    <a href="export-as-csv-low-stock.php" class="small-box-footer">Download Now&nbsp;&nbsp;<i
                                class="fa fa-download"></i></a>
                </div>
            </div>

    </div>
    <!-- /.content-wrapper -->
    <!-- footer -->
<?php include 'lib/footer.php'; ?>