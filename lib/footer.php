 <footer class="main-footer">
    <div class="pull-right hidden-xs">
      
    </div>
    <strong>Copyright &copy; 2018 <a href="http://exploreit.com.bd/" target="_blank">explore-it</a>.</strong> All rights
    reserved.
  </footer>

  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>

<!-- AdminLTE App -->
<script src="assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="assets/dist/js/demo.js"></script>
<script src="assets/dist/js/custom.js"></script>
<script src="assets/dist/js/transactionandsuppliertransaction.js"></script>
<!-- page script -->
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false,
      "order": [[ 1, "desc" ]]
    })
  })
</script>

<!-- add new transaction(general account) modal -->
<div class="modal fade" id="add-new-transaction">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title "><i class="fa fa-plus"></i>&nbsp;Add New Transaction</h4>
      </div>
      <div class="modal-body">
        <form action="laserlist.php" method="post">
          <div class="col-md-7">
              <div class="form-group">
                  <select name="category" class="form-control" id="transcategory" tabindex="2">
                      <option disabled="" selected="" required>Select Category</option>
                      <?php
                          $status = $las->showCategory();
                         
                          if ($status) {
                              while ($result = $status->fetch_assoc()) { ?>
                               <option value="<?php echo $result['id']; ?>" type="<?php echo $result['category_type']; ?>"><?php echo $result['category_name']; ?></option>
                        <?php  } } ?>
                         
                  </select>
              </div>
          </div>
          <div class="col-md-5">
              <div class="form-group">
                  <input name="date" class="form-control" type="date" value="<?php echo date('m/d/Y'); ?>" required="" tabindex="1">
              </div>
          </div>
          <div class="col-md-12">
              <div class="form-group">
                  <input name="description" id="" class="form-control" placeholder="Description" tabindex="7">
              </div>
          </div>
          
          <div class="col-md-6">
              <div class="form-group">
                   <input name="debit" id="debit" class="form-control" type="number" placeholder="Debit/Cash Out" tabindex="5">
              </div>
          </div>
          <div class="col-md-6">
              <div class="form-group">
                  <input  name="credit" id="credit" class="form-control" type="number" placeholder="Credit/Cash In" tabindex="6">
              </div>
            </div>
          <div class="col-md-6 submit-buttom">
                        
              <input type="submit" value="Save" name="addlaser" class="btn btn-success" tabindex="8">
              <input type="reset" value="Reset" class="btn btn-warning">
          </div>


        </form>
      </div>
      <div class="modal-footer">
        
        
      </div>
   </div>
    <!-- /.modal-content -->
  </div>
          <!-- /.modal-dialog -->
</div> 
<!-- add new transaction(general account) modal end -->

<!-- add new transaction(general account) modal -->
<div class="modal fade" id="add-supplier-transaction">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title "><i class="fa fa-plus"></i>&nbsp;Add Supplier Transaction</h4>
      </div>
      <div class="modal-body">
        <form action="suppliertransaction.php" method="post">
          <div class="col-md-6">
              <div class="form-group">
                  <input name="date" class="form-control" type="date" value="<?php echo date('m/d/Y'); ?>" required="" tabindex="1">
              </div>
          </div>
          <div class="col-md-6">

            <div class="form-group">
              <select name="supplier_id"  id="supplier_dropdown"  class="form-control" >
                <option value="">Select Supplier</option>
                <?php
                $status = $sup->showSupplier();
                if ($status) {
                     while ($result = $status->fetch_assoc()) { ?>
                        <option value="<?php echo $result['supplier_id']; ?>"><?php echo ucfirst($result['supplier_name']); ?></option>
               
                  <?php   }  }  ?>
               
              </select>
            </div>
          </div>
          <div class="col-md-6">
              <div class="form-group">
                <input  name="purchase" id="purchase" class="form-control" type="number" placeholder="Purchase" tabindex="6">
              </div>
          </div>
          
          <div class="col-md-6">
            <div class="form-group">
              <input  name="payment" id="payment" class="form-control" type="number" placeholder="Payment" tabindex="6">
            </div>
          </div>
              
          <div class="col-md-12">
            <div class="form-group">
                <input name="description" id="" class="form-control" placeholder="Description" tabindex="7">
            </div>
          </div>
          <div class="col-md-6 submit-buttom">       
              <input type="submit" value="Save" name="addsuppliertransaction" class="btn btn-success" tabindex="8">
              <input type="reset" value="Reset" class="btn btn-warning">
          </div>

        </form>
      </div>
      <div class="modal-footer">
        
        
      </div>
   </div>
    <!-- /.modal-content -->
  </div>
          <!-- /.modal-dialog -->
</div> 
<!-- add new transaction(general account) modal end -->




</body>
</html>
