<?php include 'lib/header.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>স্টক</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> প্রচ্ছদ</a></li>
        <li class="active">ড্যাশবোর্ড</li>
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
                  <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" width="5%">ক্রমিক</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending"  width="10%">পণ্যের আইডি</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending"  width="10%">গ্রুপ</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"  width="20%">নাম </th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"  width="10%">বিক্রয়মূল্য</th>

                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"  width="10%">ক্রয়মূল্য</th>

                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"  width="15%">বর্তমান স্টক</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"  width="10%">বিক্রয় পরিমাণ/মূল্য</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"  width="10%">স্টক পরিমাণ/মূল্য</th>

                </tr>
                </thead>
                <tbody style="text-align: center;">
                            <?php
                            $stock_stmt = $sto->getstocklist();
                            
                            ?>
                            <?php
                            $i = 0;
                            if ($stock_stmt):
                                ?>
                                <?php while ($r = $stock_stmt->fetch_assoc()): ?>
                                    <?php $stockamount = 0; ?>
                                    <tr>
                                        <td><?php echo ++$i; ?></td>
                                        <td><?php echo $r['product_id']; ?></td>
                                        <td style="text-align: left;"><?php echo $r['groupname']; ?></td>
                                        <td style="text-align: left;"><?php echo $r['product_name']; ?></td>
                                        
                                        <td><?php echo $r['sale_price']; ?></td>
                                        <td><?php echo $r['purchase_price']; ?></td>
                                        <td>
                                            <?php if($r['stock'] == null) {
                                                echo '0';
                                            }else{
                                                echo $r['stock'];
                                                $stockamount = $r['stock'];
                                            } ?>
                                                
                                            </td>
                                        <td><?php echo $r['sale_price'] * $stockamount; ?></td>    
                                        <td><?php echo $r['purchase_price'] * $stockamount; ?></td>    
                                        
                                       

                                            </tr>
                                        <?php endwhile; ?>


                                    <?php else: ?>
                                        <tr>
                                            <td colspan="9" style="text-align: center;">No Stock Data Found</td>
                                        </tr>
                                    <?php endif; ?>
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