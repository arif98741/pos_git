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
            <h3><i class="lnr lnr-users"></i> &nbsp;Customers</h3>
        </div>

        <div class="xs tabls">
            <div class="bs-example4">
                <div class="table-responsive">
                    <table id="customer_table" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Cus. ID</th>
                                <th>Cus. Name</th>
                                <th>Address</th>
                                <th>Contact No</th>
                                <th>Email</th>
                                <th>Balance</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody style="text-align: center;">
                            <?php
                            $cust_stmt = $db->select("SELECT * FROM tbl_customer tc JOIN customer_balance cb ON tc.customer_id = cb.customer_id ORDER BY tc.customer_name ASC");
                            ?>
                            <?php
                            if ($cust_stmt):
                                ?>
                                <?php while ($r = $cust_stmt->fetch_assoc()): ?>
                                    <tr>
                                        <td ><?php echo $r['customer_id']; ?></td>
                                        <td style="text-align: left;"><?php echo $r['customer_name']; ?></td>
                                        <td style="text-align: left;"><?php echo $r['address']; ?></td>
                                        <td style="text-align: left;"><?php echo $r['contact_no']; ?></td>
                                        <td style="text-align: left;"><?php echo $r['email']; ?></td>
                                        <td>
                                            <?php echo round($r['balance']);   ?>
                                              
                                        </td>
                                        <?php if(Session::get('status') == 'admin'): ?>
                                        <td>
                                            <a href="<?php echo BASE_URL; ?>viewcustomer.php?action=view&serial=<?php echo $r['serial']; ?>&customer_id=<?php echo $r['customer_id']; ?>"><i class="fa fa-eye" title="view customer information"></i></a>&nbsp;
                                            <a href="<?php echo BASE_URL; ?>editcustomer.php?action=edit&serial=<?php echo $r['serial']; ?>&customer_id=<?php echo $r['customer_id']; ?>"><i class="fa fa-pencil-square-o btn" title="click to edit"></i></a>
                                           

                                        </td>
                                         <?php else: ?>
                                            <td>
                                                <a href="<?php echo BASE_URL; ?>viewcustomer.php?action=view&serial=<?php echo $r['serial']; ?>&customer_id=<?php echo $r['customer_id']; ?>"><i class="fa fa-eye" title="view customer information"></i></a>&nbsp;
                                            </td>
                                         <?php endif; ?>

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
