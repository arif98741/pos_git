<?php include 'lib/header.php'; ?>
<?php if (Session::get('status') !== 'admin') {
    header("Location: index.php");
}?>

<?php

?>

<!-- //header-ends -->
<div id="page-wrapper">
    <div class="graphs">
        <div class="breadcrumb">
            <h3><i class="lnr lnr-list"></i> &nbsp;User Balance List</h3>
        </div>

        <div class="xs tabls">
            <div class="bs-example4">
                <div class="table-responsive">
                    <table class="table table-bordered" cellspacing="4" id="product_table" class="order-column" width="100%">
                        <thead>
                            <tr>
                                <th>#SL</th>
                                <th>Invoice</th>
                                <th>Customer ID</th>
                                <th>Customer Name</th>
                                <th>Grand Total</th>
                                <th>Paid</th>
                                <th>Balance</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $status = $sel->showbalancelist();
                            
                           
                            if ($status) {
                            	$i  = 0;
                                while ($result = $status->fetch_assoc()) { $i++;
                                    ?>
                            <tr style="text-align: center;" id="rowid-<?php echo $result['serial']; ?>">
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $result['sell_id']; ?></td>
                                        <td><?php echo $result['customer_id']; ?></td>
                                        <td><?php echo $result['customer_name']; ?></td>
                                        <td><?php echo $result['grand_total']; ?></td>
                                        <td><?php echo $result['paid']; ?></td>
                            			<td><?php echo $result['grand_total']-$result['paid'] ?></td>
                                        <td><?php echo $help->formatDate($result['date'], 'd-m-Y'); ?></td>
                                        

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
