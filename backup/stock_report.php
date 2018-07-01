<?php include 'lib/header.php'; ?>
<!-- //header-ends -->
<div class="container">
    <div class="breadcrumb">
           <h3><i class="lnr lnr-chart-bars"></i> &nbsp;Stock Report</h3>
    </div>
    <div class="bs-example4">
        
        <div class="row">
                <div class="col-md-12"> 
       
        <form action="printfiles/stock/stockreport.php" method="POST">
            <!-- <div class="col-md-6">
                <div class="form-group">
                  <label for=""><strong>From</strong></label>
                  <input type="date" name="starting" id="startdate" class="form-control">
               </div>  
                <div class="form-group">
                  <label for=""><strong>To</strong></label>
                  <input type="date" name="ending" id="enddate" class="form-control">
               </div>
            </div> -->

            <br/>



          <div class="col-md-6">
            <label for="">Supplier</label>
            <select name="supplier_id" id="" class="customer form-control">
              <option value="">Select Supplier</option>
              <?php 
                  $stmt = $db->select("select * from tbl_supplier order by supplier_name asc");
                  if($stmt){
                    while ($row = $stmt->fetch_assoc()) { ?>
                    <option value="<?php echo ucfirst($row['supplier_id']); ?>"><?php echo $row['supplier_name']; ?></option>
                    <?php  } } ?>
            </select>
            <br/>
          </div>
          <div class="col-md-6">
            <label for="">Group</label>
            <select name="groupid" id="" class="customer form-control">
              <option value="">Select Group</option>
              <?php 
                  $grstmt = $db->select("select * from tbl_group order by groupname asc");
                  if($grstmt){
                    while ($row = $grstmt->fetch_assoc()) { ?>
                    <option value="<?php echo ucfirst($row['groupid']); ?>"><?php echo $row['groupname']; ?></option>
                    <?php  }
                  }
                ?>
            </select>


          </div>

          <div class="col-md-offset-3 col-md-6">
             <div class="form-group">
                <input type="submit" name="allstock" class="btn btn-success" value="All Stock">
                <input type="submit" name="stockbysupplier" class="btn btn-primary" value="Supplier Wise">
                <input type="submit" name="stockbygroup" class="btn btn-warning" value="Group Wise">
            </div>
          </div>

            </div>
        </div>
    </form>
</div>
</div>

<?php include 'lib/footer.php'; ?>