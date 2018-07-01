<?php include 'lib/header.php'; ?>
<?php if (Session::get('status') !== 'admin') {
    header("Location: index.php");
}?>
<?php
//add laser
if (isset($_POST['addlaser'])) {
    
    $add = $las->addLaser($_POST);
    if ($add) {
        echo "<script>alert('Transaction Added Successfully');</script>";
    } else {
        echo "<script>alert('Transaction Added Failed');</script>";
    }
}


//update laser
if (isset($_POST['updatelaser'])) {
    $update = $las->updateLaser($_POST);
    if ($update) {
        echo "<script>alert('Transaction Updated Successfully');</script>";
    } else {
        echo "<script>alert('Transaction Update Failed');</script>";
    }
}


//delete laser
if (isset($_GET['action']) && $_GET['action'] ='del') {
    $sta = $las->deleteLaser($_GET['serial']);
    if ($sta) {
        echo "<script>alert('Transaction Deleted Successful');</script>";
    } else {
        echo "<script>alert('Failed to Delete Transaction');</script>";
    }
}
?>

<!-- //header-ends -->
<div id="page-wrapper">
 
        <div class="breadcrumb">
            <h3><i class="lnr lnr-list"></i> &nbsp;Transaction List</h3>
        </div>

        <div class="xs tabls">
            <div class="bs-example4">
                <div class="table-responsive ">

                    <table class="table table-striped table-bordered table-hover" cellspacing="4" id="product_table" class="order-column" width="100%">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Date</th>
                                <th>Category</th>
                                <th>Payar</th>
                                <th>Receiver</th>
                                <th>Description</th>
                                <th>Debit</th>
                                <th>Credit</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $status = $las->showLaser();

                            if ($status) {
                                $i = 0;
                                while ($result = $status->fetch_assoc()) { $i++;
                                    ?>
                            <tr style="text-align: center;" id="rowid-<?php echo $result['serial']; ?>">
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $help->formatDate($result['date'], 'd-m-Y h:iA'); ?></td>
                                        <td style="text-align: left;"><?php echo $result['category_name']; ?></td>
                                        <td><?php echo $result['donor']; ?></td>
                                        <td><?php echo $result['receiver']; ?></td>
                                         <td><?php echo substr($result['description'], 0,20); ?></td>
                                        <td><?php echo round($result['debit']); ?></td>
                                        <td><?php echo round($result['credit']); ?></td>
                                       
                                        
                                        <td>
                                             <?php if(Session::get('status') == 'admin'): ?>

                                            <a href="<?php echo BASE_URL; ?>editlaser.php?action=edit&serial=<?php echo $result['serial']; ?>" style="border-radius: 3px;" title="click to edit" ><i class="fa fa-pencil-square-o btn"></i></a>
                                            <a href="?action=del&serial=<?php echo $result['serial']; ?>"  title="click to delete" onclick="return confirm('are you sure to delete?')" ><i class="fa fa-trash-o btn"></i></a>
                                             <?php else: ?>
                                                -

                                             <?php endif; ?>

                                                </td>

                                            </tr>

                                            <?php } } else { ?>

                                    <?php } ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
 
</div>
<?php include 'lib/footer.php'; ?>
