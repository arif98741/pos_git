<?php include 'lib/header.php'; ?>

<?php


//add invoice

if (isset($_POST['addpurchase'])) {

    if($inv->saveInvoice($_POST)){

        echo "<script>alert('মেমো সফলভাবে যুক্ত হয়েছে');</script>";

    }else{

        echo "<script>alert('মেমো সংযোজন ব্যর্থ!');</script>";

    }

}



//update invoice

if ( isset($_POST['updateinvoice'])) {


    if($sel->updateInvoice($_POST)){
        echo "<script>alert('মেমো সফলভাবে সম্পাদন হয়েছে');</script>";

        //echo "<script>window.loction='';</script>";
    }else{

        echo "<script>alert('মেমো সম্পাদন ব্যর্থ!');</script>";
    }

}



//delete invoice

if (isset($_GET['action']) && $_GET['action'] == 'delete') {

    $serial = $_GET['serial'];

    if($sel->deleteSale($serial, $_GET['invoice_id'])){

         echo "<script>alert('মেমো সফলভাবে ডিলিট হয়েছে');</script>";

    }else{

        echo "<script>alert('মেমো ডিলিট ব্যর্থ!');</script>";
    }
}

?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>মেমো তালিকা</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> প্রচ্ছদ</a></li>
        <li class="active"><a href="<?php echo BASE_URL; ?>">ড্যাশবোর্ড</a></li>
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
                  <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" width="10%">তারিখ</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending"  width="10%">মেমো নাম্বার</th>
				  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending"  width="15%">ক্রেতা</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"  width="10%">সাব টোটাল</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"  width="5%">ডিসকাউন্ট</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"  width="10%">ডেলিভারি চার্জ</th>
                   <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"  width="10%">ভ্যাট</th>
                   <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"  width="10%">ব্যালেন্স</th>
                   <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"  width="10%">পরিশোধযোজ্য</th>
                   <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"  width="10%">পরিশোধ</th>
                   <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"  width="10%">বকেয়া</th>



                  
                   <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"  width="10%">Action</th>

                </tr>
                </thead>
                <tbody>

                        <?php

                        $status = $sel->showSellProducts();

                        if ($status) {

                            $i  = 0;

                            while ($result = $status->fetch_assoc()) {

                                $quantity = 0;

                                $i++;

                                ?>
                                <tr style="text-align: center;" id="rowid-<?php echo $result['serial']; ?>">

                                    <td><?php echo $help->formatDate($result['date'],'d-m-y'); ?></td>
                                    <td><?php echo $result['sell_id']; ?></td>
                                    <td  style="text-align: left;"><?php echo $result['customer_name']; ?></td>
                                    <td><?php echo round($result['sub_total']); ?></td>
                                    <td><?php echo round($result['discount']); ?></td>
                                    <td><?php echo round($result['dlcharge']); ?></td>
                                    <td><?php echo round($result['vat']); ?></td>
                                    <td><?php echo round($result['previous_balance']); ?></td>
                                    <td><?php echo round($result['payable']); ?></td>
                                    <td><?php echo round($result['paid']); ?></td>
                                    <td><?php echo round($result['due']); ?></td>
                                    
                                    <?php if(Session::get('status') == 'admin'): ?>
                                    <td>

                                        <a href="viewsales.php?action=view&serial=<?php echo $result['serial'] ?>&sell_id=<?php echo $result['sell_id']; ?>" style="border-radius: 3px;" title="click to view" ><i class="fa fa-eye"></i>&nbsp;&nbsp;</a>
                                        <a href="editsales.php?action=edit&serial=<?php echo $result['serial'] ?>&sell_id=<?php echo $result['sell_id']; ?>" style="border-radius: 3px;" title="click to edit" ><i class="fa fa-pencil-square-o"></i>&nbsp;&nbsp;</a>
                                        
                                        <a href="?action=delete&serial=<?php echo $result['serial'] ?>&invoice_id=<?php echo $result['sell_id']; ?>" style="border-radius: 3px;" title="click to delete" onclick="return confirm('are you sure to delete?')" id="rowdelete" delid="<?php echo $result['serial']; ?>"><i class="lnr lnr-trash"></i></a>

                                    </td>
                                <?php else: ?>
                                    <td>
                                        <a href="viewsales.php?action=view&serial=<?php echo $result['serial'] ?>&sell_id=<?php echo $result['sell_id']; ?>" style="border-radius: 3px;" title="click to view" ><i class="fa fa-eye"></i>&nbsp;&nbsp;</a>
                                        
                                    </td>
                                <?php endif; ?>

                                </tr>

                                <?php
                            }

                        } else {

                            ?>

                        <?php }

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