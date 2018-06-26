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

if ( isset($_POST['updateinvoice'])) {


    if($sel->updateInvoice($_POST)){
        echo "<script>alert('Invoice Updated Successfully');</script>";

        //echo "<script>window.loction='';</script>";
    }else{

        echo "<script>alert('Purchase Updated Failed!');</script>";
    }

}



//delete invoice

if (isset($_GET['action']) && $_GET['action'] == 'delete') {

    $serial = $_GET['serial'];

    if($sel->deleteSale($serial, $_GET['invoice_id'])){

         echo "<script>alert('Invoice Deleted Successfully');</script>";

    }else{

        echo "<script>alert('Invoice Deleted Failed!');</script>";
    }
}

?>

<!-- //header-ends -->

<div id="page-wrapper">

    <div class="graphs">

        <div class="breadcrumb">

            <h3><i class="lnr lnr-list"></i> &nbsp;Sales/Invoice List</h3>

        </div>


        <div class="xs tabls">
            <div class="bs-example4">
                <div class="table-responsive">
                    <table class="table table-bordered invoice_table" id="invoice_product_data_table">
                        <thead>
                        <tr>

                            <th width="8%">Date</th>
                            <th width="9%">Inv. No</th>
                            <th width="18%">Customer</th>
                            <th width="7%">Subtotal</th>
                            <th width="6%">Discount</th>
                            <th width="7%">DL.</th>
                            <th width="7%">Vat</th>
                            <th width="10%">Pre-Balance</th>
                            <th width="4%">Payable</th>
                            <th width="7%">Paid</th>
                            <th width="6%">Due</th>
                            <th width="11%">Action</th>

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
            </div>
        </div>
    </div>
</div>

<?php include 'lib/footer.php'; ?>

