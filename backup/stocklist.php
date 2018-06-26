<?php include 'lib/header.php'; ?>
<?php

?>

<!-- //header-ends -->
<div id="page-wrapper">
    <div class="graphs">
        <div class="breadcrumb">
            <h3><i class="lnr lnr-user"></i> &nbsp;Stock</h3>
        </div>

        <div class="xs tabls">
            <div class="bs-example4">
                <div class="table-responsive">
                    <table id="stock_table" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Serial</th>
                                <th>Product ID</th>
                                <th>Group</th>
                                <th>Product Name</th>
                                <th>Sale Price</th>
                                <th>Purchase Price</th>
                                <th>Current Stock</th>
                                <th>Sell Value</th>
                                <th>Stock Value</th>
                            </tr>
                        </thead>
                        <tbody style="text-align: center;">
                            <?php
                            $stock_stmt = $sto->getstocklist();
                            
                            ?>
                            <?php
                            $i = 0;
                            if ($stock_stmt):
                                ?>
                                <?php while ($r = $stock_stmt->fetch_assoc()): ?>
                                    <?php $stockamount = 0; ?>
                                    <tr>
                                        <td><?php echo ++$i; ?></td>
                                        <td><?php echo $r['product_id']; ?></td>
                                        <td style="text-align: left;"><?php echo $r['groupname']; ?></td>
                                        <td style="text-align: left;"><?php echo $r['product_name']; ?></td>
                                        
                                        <td><?php echo $r['sale_price']; ?></td>
                                        <td><?php echo $r['purchase_price']; ?></td>
                                        <td>
                                            <?php if($r['stock'] == null) {
                                                echo '0';
                                            }else{
                                                echo $r['stock'];
                                                $stockamount = $r['stock'];
                                            } ?>
                                                
                                            </td>
                                        <td><?php echo $r['sale_price'] * $stockamount; ?></td>    
                                        <td><?php echo $r['purchase_price'] * $stockamount; ?></td>    
                                        
                                       

                                            </tr>
                                        <?php endwhile; ?>


                                    <?php else: ?>
                                        <tr>
                                            <td colspan="9" style="text-align: center;">No Stock Data Found</td>
                                        </tr>
                                    <?php endif; ?>
                        </tbody>



                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'lib/footer.php'; ?>
