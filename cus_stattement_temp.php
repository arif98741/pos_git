<?php include 'lib/header.php'; ?>
<?php
//add customer
if (isset($_POST['addcustomer'])) {
    $result = $cus->insertCustomer($_POST);
    if ($result) {
        echo $result;
    }
}


//update customer
if (isset($_POST['updatecustomer'])) {
    $update = $cus->updateCustomer($_POST);
    if ($update) {
        echo "<script>alert('Customer Updated Successfully');</script>";
    } else {
        echo "<script>alert('Customer Updated Failed');</script>";
    }
}

//delete customer
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $sta = $cus->deleteCustomer($_GET);
    if ($sta) {
        echo "<script>alert('Customer Deleted Successful');</script>";
    } else {
        echo "<script>alert('Customer to Deleted Product');</script>";
    }
}
?>

<!-- //header-ends -->
<div id="page-wrapper">
    <div class="graphs">
        <div class="breadcrumb">
            <h3><i class="lnr lnr-users"></i> &nbsp;Statement List</h3>
        </div>

        <div class="xs tabls">
            <div class="bs-example4">
                <div class="table-responsive">
                    <table id="customer_statement_table" class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Invoie ID</th>
                            <th>Customer ID</th>
                            <th>Customer Name</th>
                            <th>Payable</th>
                            <th>Paid</th>
                            <th>Description</th>
                        </tr>
                        </thead>
                        <tbody style="text-align: center;">
                        <?php
                        $cust_stmt = $db->select("SELECT * from customer_statement JOIN tbl_customer on customer_statement.customer_id  = tbl_customer.customer_id order by customer_statement.date DESC");
                        ?>
                        <?php
                        if ($cust_stmt):
                            ?>
                            <?php while ($r = $cust_stmt->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $help->formatDate($r['date']); ?></td>
                                <td
                                "><?php echo $r['sell_id']; ?></td>
                                <td style="text-align: left;"><?php echo $r['customer_id']; ?></td>
                                <td style="text-align: left;"><?php echo $r['customer_name']; ?></td>
                                <td style="text-align: left;"><?php echo $r['payable']; ?></td>
                                <td style="text-align: left;"><?php echo $r['paid']; ?></td>
                                <td style="text-align: left;"><?php echo $r['Products Sales']; ?></td>


                            </tr>
                        <?php endwhile; ?>

                        <?php else: ?>
                            <tr>
                                <td colspan="9" style="text-align: center;">No Customer Data Found</td>
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
