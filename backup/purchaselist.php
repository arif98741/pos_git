<?php include 'lib/header.php'; ?>

<?php
//add invoice

if (isset($_POST['addpurchase'])) {
    if($inv->saveInvoice($_POST)){
        echo "<script>alert('Purchase Added Successfully');</script>";
    }else{
        echo "<script>alert('Purchase Added Failed!');</script>";
    }
}



//update invoice
if ( isset($_POST['edit'])) {
    if($inv->updateInvoice($_POST)){
        echo "<script>alert('Purchase Updated Successfully');</script>";
        echo "<script>window.loction='';</script>";

    }else{
        echo "<script>alert('Purchase Updated Failed!');</script>";
    }

}

//delete invoice
if (isset($_GET['action']) && $_GET['action']=='delete') {
    $serial = $_GET['serial'];
    if($inv->deleteInvoice($serial, $_GET['invoice_id'])){
         echo "<script>alert('Purchase Deleted Successfully');</script>";
    }else{
        echo "<script>alert('Purchase Deleted Failed!');</script>";
    }
   
}
?>

<!-- //header-ends -->
<div id="page-wrapper">
    <div class="graphs">
        <div class="breadcrumb">
            <h3><i class="lnr lnr-list"></i> &nbsp;Purchase List</h3>
        </div>

        <div class="xs tabls">
            <div class="bs-example4">
                <div class="table-responsive">
                    <table class="table table-bordered invoice_table" id="invoice_product_data_table">
                        <thead>
                        <tr>
                            <th>Serial</th>
                            <th>Invoice No.</th>
                            <th>Supplier</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $status = $inv->showInvoices();

                        if ($status) {
                            $i = 0;
                            while ($result = $status->fetch_assoc()) {
                                $i++;
                                ?>
                                <tr style="text-align: center;" id="rowid-<?php echo $result['serial']; ?>">
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $result['invoice_number']; ?></td>
                                    <td style="text-align: left;"><?php echo $result['supplier_name']; ?></td>
                                    <td><?php echo $result['quantity']; ?></td>
                                    <td><?php echo $result['total']; ?></td>
                                    <td><?php echo $help->formatDate($result['date'],'d-m-Y'); ?></td>

                                    <?php if(Session::get('status') == 'admin'): ?>

                                    <td>
                                        <a href="viewpurchase.php?action=view&serial=<?php echo $result['serial'] ?>&invoice_id=<?php echo $result['invoice_number']; ?>" style="border-radius: 3px;" title="click to view" ><i class="fa fa-eye"></i>&nbsp;&nbsp;</a>
                                        <a href="editpurchase.php?action=edit&serial=<?php echo $result['serial'] ?>&invoice_id=<?php echo $result['invoice_number']; ?>" style="border-radius: 3px;" title="click to edit" ><i class="fa fa-pencil-square-o"></i>&nbsp;&nbsp;</a>

                                        <a href="printfiles/purchase/printpurchase.php?serial=<?php echo $result['serial'] ?>&invoice_id=<?php echo $result['invoice_number']; ?>" style="border-radius: 3px;" title="click to print" ><i class="fa fa-print"></i></a>

                                        <a href="?action=delete&serial=<?php echo $result['serial'] ?>&invoice_id=<?php echo $result['invoice_number']; ?>" style="border-radius: 3px;" title="click to delete" onclick="return confirm('are you sure to delete?')" id="rowdelete" delid="<?php echo $result['serial']; ?>"><i class="lnr lnr-trash"></i></a>
                                    </td>

                                    <?php else:  ?>

                                    <td>
                                         <a href="viewpurchase.php?action=view&serial=<?php echo $result['serial'] ?>&invoice_id=<?php echo $result['invoice_number']; ?>" style="border-radius: 3px;" title="click to view" ><i class="fa fa-eye"></i>&nbsp;&nbsp;</a>
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
            </div>
        </div>
    </div>
</div>
<?php include 'lib/footer.php'; ?>
