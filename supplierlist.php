<?php include 'lib/header.php'; ?>
<?php
//add supplier
if (isset($_POST['addsupplier'])) {

    $result = $sup->addSupplier($_POST);
    if ($result) {
        echo $result;
    } 
}


//update supplier
if (isset($_POST['updatesupplier'])) {
    $update = $sup->updatesupplier($_POST);
    if ($update) {
        echo "<script>alert('Supplier Updated Successfully');</script>";
    } else {
        echo "<script>alert('Supplier Updated Failed');</script>";
    }
}

//delete supplier
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $sta = $sup->deletesupplier($_GET);
    if ($sta) {
        echo "<script>alert('Supplier Deleted Successful');</script>";
    } else {
        echo "<script>alert('Supplier to Deleted Product');</script>";
    }
}
?>

<!-- //header-ends -->
<div id="page-wrapper">
    <div class="graphs">
        <div class="breadcrumb">
            <h3><i class="lnr lnr-user"></i> &nbsp;Suppliers</h3>
        </div>

        <div class="xs tabls">
            <div class="bs-example4">
                <div class="table-responsive">
                    <table id="supplier_table" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Serial</th>
                                <th>Supplier ID</th>
                                <th>Supplier Name</th>
                                <th>Address</th>
                                <th>Contact No</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody style="text-align: center;">
                            <?php
                            $cust_stmt = $db->select("select * from tbl_supplier order by serial desc");
                            ?>
                            <?php
                            $i = 0;
                            if ($cust_stmt):
                                ?>
                                <?php while ($r = $cust_stmt->fetch_assoc()): ?>
                                    <tr>
                                        <td><?php echo ++$i; ?></td>
                                        <td><?php echo $r['supplier_id']; ?></td>
                                        <td style="text-align: left;"><?php echo $r['supplier_name']; ?></td>
                                        <td style="text-align: left;"><?php echo $r['address']; ?></td>
                                        <td style="text-align: left;"><?php echo $r['contact_no']; ?></td>
                                        <td style="text-align: left;"><?php echo $r['email']; ?></td>

                                        <?php if(Session::get('status') == 'admin'): ?>

                                        <td>
                                            <a href="viewsupplier.php?action=view&serial=<?php echo $r['serial']; ?>&supplier_id=<?php echo $r['supplier_id']; ?>"><i class="fa fa-ey" title="view supplier information"></i></a>&nbsp;
                                            <a href="editsupplier.php?action=edit&serial=<?php echo $r['serial']; ?>&supplier_id=<?php echo $r['supplier_id']; ?>"><i class="fa fa-pencil-square-o btn" title="click to edit"></i></a>
                                            <a href="?action=delete&serial=<?php echo $r['serial']; ?>&supplier_id=<?php echo $r['supplier_id']; ?>"><i id="deleterow"   class="lnr lnr-trash" style="color:red;" title="click to delete" onclick="return confirm('are you sure to delete?')" ></i></a>

                                        </td>
                                         <?php else: ?>

                                        <td><a href="viewsupplier.php?action=view&serial=<?php echo $r['serial']; ?>&supplier_id=<?php echo $r['supplier_id']; ?>"><i class="fa fa-eye" title="view supplier information"></i></a>&nbsp;</td>

                                      <?php endif; ?>

                                            </tr>
                                        <?php endwhile; ?>

                                    <?php else: ?>
                                        <tr>
                                            <td colspan="9" style="text-align: center;">No supplier Data Found</td>
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
