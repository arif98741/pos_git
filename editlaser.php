<?php include 'lib/header.php'; ?> 
<?php if (Session::get('status') !== 'admin') {
    header("Location: index.php");
}?>
<?php 
  if (isset($_GET['action']) && isset($_GET['serial'])) {
    $serial = $_GET['serial'];
    $status = $db->link->query("SELECT * from tbl_laser tl join tbl_transactioncat tt on tl.category = tt.id where tl.serial='$serial'") or die($db->link->error . __LINE__);
    if ($status) {
      $transdata = $status->fetch_assoc();
    }
  }

?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><i class="fa fa-pencil"></i> EDIT TRANSACTION</h1>
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
            <form action="laserlist.php" method="post">
            <div class="row">
                <div class="col-md-12"> 
                    <div class="col-md-4">
                        <div class="form-group">
                            <input name="date" class="form-control" type="date" tabindex="1" value="<?php echo $help->formatDate($transdata['date'],'Y-m-d'); ?>">
                            <input name="laserid" class="form-control" type="hidden"  value="<?php echo $transdata['serial']; ?>">

                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-group">
                             <input name="debit" id="debit" class="form-control" type="number" value="<?php echo $transdata['debit']; ?>" placeholder="Debit/Cash Out"  tabindex="5">
                        </div>
                    </div>
                    
                    
                    
                   <div class="col-md-4">
                        <div class="form-group">
                            <input  name="credit" id="credit" class="form-control" type="number" value="<?php echo $transdata['credit']; ?>"  placeholder="Credit/Cash In" tabindex="6">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <select name="category" class="form-control" id="transcategory" tabindex="2">
                                <option disabled="" selected="" required>Select Category</option>
                                <?php
                                    $status = $las->showCategory();
                                   
                                    if ($status) {
                                        while ($result = $status->fetch_assoc()) { ?>

                                        <?php if($result['id'] == $transdata['category']): ?>
                                         <option value="<?php echo $result['id']; ?>" type="<?php echo $result['category_type']; ?>" selected=""><?php echo $result['category_name']; ?></option>

                                         <?php else: ?>
                                          <option value="<?php echo $result['id']; ?>" type="<?php echo $result['category_type']; ?>" ><?php echo $result['category_name']; ?></option>

                                         <?php endif; ?>


                                  <?php  } } ?>
                                   
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-8">
                        <div class="form-group">
                            <input name="description" id="" class="form-control" value="<?php echo $transdata['description']; ?>" placeholder="Description" tabindex="7">
                        </div>
                    </div>
                    <div class="col-md-6 submit-buttom">
                        
                        <input type="submit" value="Update" name="updatelaser" class="btn btn-success" tabindex="8">
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