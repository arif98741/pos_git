<?php include 'lib/header.php'; ?>
<?php if (Session::get('status') !== 'admin') {
    header("Location: index.php");
}?>
<!-- //header-ends -->
<div class="container">
    <div class="breadcrumb">
        <h3><i class="lnr lnr-plus-circle"></i> &nbsp;Add Transaction</h3>
    </div>
    <div class="bs-example4">
        <form action="laserlist.php" method="post">
            <div class="row">
                <div class="col-md-12"> 
                    <div class="col-md-4">
                        <div class="form-group">
                            <input name="date" class="form-control" type="date" value="<?php echo date('m/d/Y'); ?>" required="" tabindex="1">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                             <input name="donor" class="form-control" type="text" placeholder="Payar" required="" tabindex="3">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                             <input name="debit" class="form-control" type="number" placeholder="Debit" required="" tabindex="5">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <select name="category" class="form-control" tabindex="2">
                                <option>Select Category</option>
                                <?php
                                    $status = $las->showCategory();
                                   
                                    if ($status) {
                                        while ($result = $status->fetch_assoc()) { ?>
                                         <option value="<?php echo $result['id']; ?>"><?php echo $result['category_name']; ?></option>
                                  <?php  } } ?>
                                   
                                
                            </select>
                    </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <input  name="receiver" class="form-control" type="text" placeholder="Reciever" required="" tabindex="4">
                        </div>
                    </div>
                    
                   
                    
                   <div class="col-md-4">
                        <div class="form-group">
                            <input  name="credit" class="form-control" type="number" placeholder="Credit" required="" tabindex="6">
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <div class="form-group">
                            <textarea name="description" id="" cols="30" rows="6" class="form-control" placeholder="Description" tabindex="7"></textarea>
                        </div>
                    </div>
                    <div class="col-md-6 submit-buttom">
                        <hr>
                        <input type="submit" value="Save" name="addlaser" class="btn btn-success" tabindex="8">
                        <input type="reset" value="Reset" class="btn btn-warning">
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
</div>
<?php include 'lib/footer.php'; ?>                      