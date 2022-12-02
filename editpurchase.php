<?php include 'lib/header.php'; ?>
<?php if (Session::get('status') !== 'admin') {
    header("Location: index.php");
} ?>
<?php


//get purchase data from server to assign in editing form
if (isset($_GET['action']) && isset($_GET['invoice_id']) && $_GET['action'] == 'edit') {
    $inv_data = $inv->singleInvoice($_GET['invoice_id']); //return as array
    $supplier_st = $sup->showSingleSupplier($inv_data['supplier_id']); //statement
    if ($supplier_st) {
        $supplier_data = $supplier_st->fetch_assoc(); //array result
    }
}
?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1><i class="lnr lnr-pencil"></i> &nbsp;EDIT PURCHASE</h1>
            <ol class="breadcrumb">
                <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active"><a href="<?php echo BASE_URL; ?>">Dashboard</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="col-sm-12">
                <div class="box">
                    <div class="box-body">
                        <form action="purchaselist.php" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input name="invoice_number" class="form-control"
                                                   value="<?php echo $inv_data['invoice_number']; ?>" readonly>
                                            <input name="edit" class="form-control" type="hidden">
                                        </div>

                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <select name="supplier_id" id="supplier_dropdown" class="form-control">
                                                <option value="">Select Supplier</option>
                                                <?php
                                                $stmt = $sup->showSupplierForDropdown();
                                                while ($result = $stmt->fetch_assoc()) {
                                                    ?>
                                                    <option <?php if ($result['supplier_id'] == $inv_data['supplier_id']): ?> selected="" <?php endif; ?>
                                                            value="<?php echo $result['supplier_id']; ?>">
                                                        <?php echo $result['supplier_name']; ?>
                                                    </option>

                                                <?php } ?>
                                            </select>
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input id="supplier_id" class="form-control"
                                                   value="<?php echo $supplier_data['supplier_id']; ?>">
                                        </div>

                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input name="address" id="address" class="form-control" type="text"
                                                   value="<?php echo $supplier_data['address']; ?>" required="">

                                        </div>

                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input name="contact" id="contact" class="form-control" type="text"
                                                   value="<?php echo $supplier_data['contact_no']; ?>" required="">
                                        </div>

                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input name="date" class="form-control" id="date_input" type="date"
                                                   value="<?php echo $inv_data['date']; ?>" required="">
                                        </div>

                                    </div>


                                    <div class="col-md-6 submit-buttom">
                                        <input type="submit" value="Update Purchase" name="addproduct"
                                               class="btn btn-success">
                                        <input type="reset" value="Reset" class="btn btn-warning">
                                    </div>


                                    <div class="col-md-12" style="margin-top: 20px;">

                                        <table id="invoice_form_table" class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Group</th>
                                                <th>Name</th>
                                                <th>Unit</th>
                                                <th>Quantity</th>
                                                <th>Purchase</th>
                                                <th>Subtotal</th>

                                            </tr>
                                            </thead>
                                            <tbody id="inv_detail">
                                            <?php
                                            //get invoice products for a single invoice id
                                            $allinProQuery = $inv->getInvoiceProducts($inv_data['invoice_number']);
                                            ?>
                                            <?php if ($allinProQuery): ?>
                                                <?php $invoice_total = 0; ?>
                                                <?php while ($getData = $allinProQuery->fetch_assoc()): ?>
                                                    <?php $invoice_total += $getData['subtotal']; ?>
                                                    <input name="serial_no[]" type="hidden" class="form-control"
                                                           value="<?php echo $getData['serial_no']; ?>">

                                                    <tr style="text-align:center;">

                                                        <td width="10%">
                                                            <input name="product_id[]" type="text"
                                                                   class="form-control product_id"
                                                                   value="<?php echo $getData['product_id']; ?>"
                                                                   required>
                                                        </td>
                                                        <td width="10%">
                                                            <select class="form-control product_group">
                                                                <?php $groupstmt = $pro->showGroup(); ?>
                                                                <?php if ($stmt->num_rows > 0): ?>
                                                                    <?php while ($allgroups = $groupstmt->fetch_assoc()): ?>
                                                                        <option value="<?php echo $allgroups['groupid']; ?>" <?php if ($allgroups['groupid'] == $getData['product_group']): ?> selected="" <?php endif; ?> ><?php echo $allgroups['groupname']; ?></option>
                                                                    <?php endwhile; ?>
                                                                <?php endif; ?>

                                                            </select>
                                                        </td>
                                                        <td width="10%"><b
                                                                    class="product_name"><?php echo $getData['product_name']; ?></b>
                                                        </td>
                                                        <td width="10%">
                                                            <b class="product_type">
                                                                <?php
                                                                $typeid = $getData['product_type'];
                                                                $typeq = "select * from tbl_type where typeid='$typeid'";
                                                                if ($typestmt = $db->link->query($typeq)) {
                                                                    $typedata = $typestmt->fetch_assoc();
                                                                    echo $typedata['typename'];
                                                                }
                                                                ?>

                                                            </b>
                                                        </td>

                                                        <td width="8%">
                                                            <input type="text" name="quantity[]"
                                                                   class="form-control quantity"
                                                                   value="<?php echo $getData['quantity']; ?>" required>
                                                        </td>

                                                        <td width="8%">
                                                            <input type="text" name="purchase[]"
                                                                   class="form-control purchase"
                                                                   value="<?php echo $getData['purchase']; ?>" required>
                                                        </td>
                                                        <td width="8%">
                                                            <input type="hidden" name="subtotalforsave[]"
                                                                   class="form-control subtotalforsave"
                                                                   value="<?php echo $getData['subtotal']; ?>"><b
                                                                    class="subtotal"><?php echo $getData['subtotal']; ?></b>
                                                            <input type="hidden" name="update">
                                                        </td>
                                                    </tr>

                                                <?php endwhile; ?>
                                            <?php endif; ?>
                                            </tbody>
                                            <tfoot id="">
                                            <tr>
                                                <td colspan="6" style="text-align:right;"><b>Invoice Total</b></td>
                                                <td colspan="1"><b class="wholetotal"><?php echo $invoice_total; ?></b>
                                                </td>
                                            </tr>

                                            </tfoot>
                                        </table>
                                        <button class="btn btn-success add_new_invoice_table_row"
                                                title="Click To Add Product in Purchase List" style="font-size: 17px;">+
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <!-- footer -->

<?php include 'lib/footer.php'; ?>