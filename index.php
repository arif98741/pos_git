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
                        <h3><?php echo $dash->TodaySale(); ?></h3>

                        <p>Today Sale</p>
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
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3><?php echo $dash->TodayMemo(); ?></h3>

                        <p>Today Memo</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-handshake-o"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3><?php echo $dash->TotalMemo(); ?> </h3>

                        <p> Total Memo</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-handshake-o"></i>
                    </div>
                    <a href="#" class="small-box-footer"><i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

    </div>
    <!-- /.content-wrapper -->
    <!-- footer -->
<?php include 'lib/footer.php'; ?>