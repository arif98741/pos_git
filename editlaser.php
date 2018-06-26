<?php include 'lib/header.php'; ?>
<?php if (Session::get('status') !== 'admin') {
    header("Location: index.php");
}?>
<?php 

    if (isset($_GET['action']) && $_GET['action'] =='edit') {
    $sta = $las->getSingleLaserdetails($_GET['serial']);
    if($sta)
    {
         $data = $sta->fetch_assoc();

    }
   
    
    } else {
        echo "<script>window.location = 'laserlist.php';</script>";
    }
?>
<!-- //header-ends -->
<div class="container">
    <div class="breadcrumb">
        <h3><i class="lnr lnr-plus-circle"></i> &nbsp;Edit Transaction</h3>
    </div>
    <div class="bs-example4">
        <form action="laserlist.php" method="post">
            <div class="row">
                <div class="col-md-12"> 
                    <div class="col-md-4">
                        <div class="form-group">
                            <input name="category" class="form-control" type="text" value="<?php echo $help->formatDate($data['date']); ?>" required="" tabindex="1">
                            <input name="laserid" class="form-control" type="hidden" value="<?php echo $data['serial']; ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                             <input name="donor" class="form-control" type="text" value="<?php echo $data['donor']; ?>" required="" tabindex="3">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                             <input name="debit" class="form-control" type="number" value="<?php echo $data['debit']; ?>"  required="" tabindex="5">
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

                                        <?php if($result['id'] == $data['category']): ?>
                                            <option value="<?php echo $result['id']; ?>" selected=""><?php echo $result['category_name']; ?></option>
                                        <?php else: ?>
                                             <option value="<?php echo $result['id']; ?>"><?php echo $result['category_name']; ?></option>
                                        <?php endif; ?>

                                        
                                  <?php  } } ?>
                                   
                                
                            </select>
                    </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <input  name="receiver" class="form-control" type="text" value="<?php echo $data['receiver']; ?>"  required="" tabindex="4">
                        </div>
                    </div>
                    
                   
                    
                   <div class="col-md-4">
                        <div class="form-group">
                            <input  name="credit" class="form-control" type="number" value="<?php echo $data['credit']; ?>"  required="" tabindex="6">
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <div class="form-group">
                            <textarea name="description" id="" cols="30" rows="10" class="form-control" style="text-align: left;" tabindex="7"><?php echo $data['description']; ?></textarea>
                        </div>
                    </div>
                    <div class="col-md-6 submit-buttom">
                        <hr>
                        <input type="submit" value="Update" name="updatelaser" class="btn btn-success" tabindex="8">
                        <input type="reset" value="Reset" class="btn btn-warning">
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
</div>
<?php include 'lib/footer.php'; ?>                      