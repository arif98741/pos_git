<?php include 'lib/header.php'; ?>
<?php if (Session::get('status') !== 'admin') {
    header("Location: index.php");
}?>
 <?php
    if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['supplier_id'])) {

        $st = $sup->singleSupplier($_GET['supplier_id']);
        if ($st) {
            $result = $st->fetch_assoc();
        }
    }
?>
<!-- //header-ends --><div class="container">
    <div class="breadcrumb">
           <h3><i class="lnr lnr-chart-bars"></i> &nbsp;Edit Supplier</h3>
    </div>
    <div class="bs-example4">
        
        <div class="row">
                <div class="col-md-12"> 
            <form action="supplierlist.php" method="post">

                <div class="col-md-4">
                    <div class="form-group">
                        <input name="supplier_id" class="form-control" type="text" value="<?php echo $result['supplier_id']; ?>" required="">
                        <input name="serial" type="hidden" value="<?php echo $result['serial']; ?>" >
                    </div>

                </div>

                <div class="col-md-4">
                    <div class="form-group">
                       <input name="supplier_name" class="form-control" type="text"  value="<?php echo $result['supplier_name']; ?>" required="">


                    </div>

                </div>

                <div class="col-md-4">
                    <div class="form-group">
                       <input name="address" class="form-control" type="text"  value="<?php echo $result['address']; ?>"  required="">
                    </div>

                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <input name="contact_no" class="form-control" type="text"  value="<?php echo $result['contact_no']; ?>"  required="">
                    </div>

                </div>
                <div class="col-md-4">
                    <div class="form-group">
                         <input name="contact_person" class="form-control" type="text"  value="<?php echo $result['contact_person']; ?>" required="">
                    </div>

                </div>


               
                <div class="col-md-4">
                    <div class="form-group">
                       <input  name="email" class="form-control" type="text"  value="<?php echo $result['email']; ?>" required="">


                    </div>

                </div>
                
                <div class="col-md-4">
                    <input  name="remark" class="form-control" type="text"  value="<?php echo $result['remark']; ?>"  required="">

                </div>

                <div class="col-md-6 submit-buttom">
                   <input type="submit" value="Update supplier" name="updatesupplier" class="btn btn-success">
                    <input type="reset" value="Reset" class="btn btn-warning">
                </div>

            </form>

        </div>
    </div>
</div>
<?php include 'lib/footer.php'; ?>