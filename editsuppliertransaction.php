<?php include 'lib/header.php'; ?> 
<?php if (Session::get('status') !== 'admin') {
    header("Location: index.php");
}?>
<?php 
  if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = $help->validAndEscape($_GET['id']);

    $sta = $db->link->query("select * from tbl_supplier_transaction where id = '$id'") or die( $db->link->error) .". at line number ".__LINE__;
    if ($sta) {
        $transdata = $sta->fetch_assoc();
    } 

  } else {
    header("location: suppliertransaction.php");
  }
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><i class="fa fa-pencil"></i> Edit SUPPLIER TRANSACTION</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="col-sm-12">
        <div class="box">
          <div class="box-body">
            <form action="suppliertransaction.php" method="post">
            <div class="row">
                <div class="col-md-12"> 
                    <div class="col-md-4">
                        <div class="form-group">
                            <input name="date" class="form-control" type="date" value="<?php echo $help->formatDate($transdata['date'],'Y-m-d') ?>" required="" tabindex="1">

                            <input name="suppliertransid" class="form-control" type="hidden" value="<?php echo $transdata['id'] ;?>" required="" tabindex="1">


                        </div>
                    </div>
                    
                    <div class="col-md-4">


                    <div class="form-group">
                        <select name="supplier_id"  id="supplier_dropdown"  class="form-control" >
                            <option value="">Select Supplier</option>
                            <?php
                            $status = $sup->showSupplier();
                            if ($status) {
                                 while ($result = $status->fetch_assoc()) { ?>
                                      <?php if($result['supplier_id'] == $transdata['supplier']): ?>

                                       <option value="<?php echo $result['supplier_id']; ?>" selected=""><?php echo ucfirst($result['supplier_name']); ?></option>

                                       <?php else: ?>

                                        <option value="<?php echo $result['supplier_id']; ?>"><?php echo ucfirst($result['supplier_name']); ?></option>

                                       <?php endif; ?>
                           
                              <?php   }  }  ?>
                         
                        </select>
                    </div>

                </div>
                                        
               <div class="col-md-4">
                    <div class="form-group">
                        <input  name="purchase" id="purchase" class="form-control" value="<?php echo $transdata['purchase']; ?>" type="number" placeholder="Purchase" tabindex="6">
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="form-group">
                        <input  name="payment" id="payment" class="form-control" type="number" value="<?php echo $transdata['payment']; ?>"  placeholder="Payment" tabindex="6">
                    </div>
                </div>
                    
                    <div class="col-md-8">
                        <div class="form-group">
                            <input name="description" id="" class="form-control" value="<?php echo $transdata['description']; ?>"  placeholder="Description" tabindex="7">
                        </div>
                    </div>
                    <div class="col-md-6 submit-buttom">
                        
                        <input type="submit" value="Save" name="updatesuppliersransaction" class="btn btn-success" tabindex="8">
                        <input type="reset" value="Reset" class="btn btn-warning">
                    </div>
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
<script src="assets/bower_components/jquery/dist/jquery.min.js"></script>
<script>
  $(document).ready(function(){
    $('#transcategory').change(function(){
        var catid = $(this).val();
        $.ajax({
          url: 'functions.php',
          type: 'POST',
          data: {
              gettranscattype : 'gettranscattype',
              catid : catid
          },
          dataType: 'json',
          success: function (response) {
              if (response.category_type == 'Debit') {

                $('#credit').attr({
                  readonly: ''
                });

                $('#debit').attr({
                  required: ''
                });
                

                $('#debit').removeAttr('readonly');
                $('#credit').removeAttr('required');


              }else if(response.category_type == 'Credit'){
                $('#debit').attr({
                  readonly: ''
                });

                $('#credit').attr({
                  required: ''
                });

                $('#credit').removeAttr('readonly');
                $('#debit').removeAttr('required');
              }
          }, error: function (error_data) {
             // console.log(error_data);
          }
      });

    });
  });
</script>
 <?php include 'lib/footer.php'; ?>