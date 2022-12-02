<!-- add new transaction(general account) modal -->
<div class="modal fade" id="add-new-transaction">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title "><i class="fa fa-plus"></i>&nbsp;Add New Transaction</h4>
            </div>
            <div class="modal-body">
                <form action="laserlist.php" method="post">
                    <div class="col-md-7">
                        <div class="form-group">
                            <select name="category" class="form-control" id="transcategory" tabindex="2">
                                <option disabled="" selected="" required>Select Category</option>
                                <?php
                                $status = $las->showCategory();

                                if ($status) {
                                    while ($result = $status->fetch_assoc()) { ?>
                                        <option value="<?php echo $result['id']; ?>"
                                                type="<?php echo $result['category_type']; ?>"><?php echo $result['category_name']; ?></option>
                                    <?php }
                                } ?>

                            </select>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <input name="date" class="form-control" type="date" value="<?php echo date('m/d/Y'); ?>"
                                   required="" tabindex="1">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <input name="description" class="form-control" placeholder="Description" tabindex="7">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <input name="debit" id="debit" class="form-control" type="number"
                                   placeholder="Debit/Cash Out" tabindex="5">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input name="credit" id="credit" class="form-control" type="number"
                                   placeholder="Credit/Cash In" tabindex="6">
                        </div>
                    </div>
                    <div class="col-md-6 submit-buttom">

                        <input type="submit" value="Save" name="addlaser" class="btn btn-success" tabindex="8">
                        <input type="reset" value="Reset" class="btn btn-warning">
                    </div>


                </form>
            </div>
            <div class="modal-footer">


            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- add new transaction(general account) modal end -->

<!-- add new transaction(general account) modal -->
<div class="modal fade" id="add-supplier-transaction">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title "><i class="fa fa-plus"></i>&nbsp;Add Supplier Transaction</h4>
            </div>
            <div class="modal-body">
                <form action="suppliertransaction.php" method="post">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input name="date" class="form-control" type="date" value="<?php echo date('m/d/Y'); ?>"
                                   required="" tabindex="1">
                        </div>
                    </div>
                    <div class="col-md-6">

                        <div class="form-group">
                            <select name="supplier_id" id="supplier_dropdown" class="form-control">
                                <option value="">Select Supplier</option>
                                <?php
                                $status = $sup->showSupplier();
                                if ($status) {
                                    while ($result = $status->fetch_assoc()) { ?>
                                        <option value="<?php echo $result['supplier_id']; ?>"><?php echo ucfirst($result['supplier_name']); ?></option>

                                    <?php }
                                } ?>

                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input name="purchase" id="purchase" class="form-control" type="number"
                                   placeholder="Purchase" tabindex="6">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <input name="payment" id="payment" class="form-control" type="number" placeholder="Payment"
                                   tabindex="6">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <input name="description" class="form-control" placeholder="Description" tabindex="7">
                        </div>
                    </div>
                    <div class="col-md-6 submit-buttom">
                        <input type="submit" value="Save" name="addsuppliertransaction" class="btn btn-success"
                               tabindex="8">
                        <input type="reset" value="Reset" class="btn btn-warning">
                    </div>

                </form>
            </div>
            <div class="modal-footer">


            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- add new transaction(general account) modal end -->


<!-- add new user modal -->
<div class="modal fade" id="add-new-user">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title "><i class="fa fa-plus"></i>&nbsp;Add New User</h4>
            </div>
            <div class="modal-body">
                <form action="users.php" method="post">

                    <div class="col-md-6">
                        <div class="form-group">
                            <input name="name" class="form-control" type="text" placeholder="Name" required="">
                        </div>

                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <input name="username" class="form-control" type="text" placeholder="Username" required="">

                        </div>

                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <input name="password" class="form-control" type="password" placeholder="Password"
                                   required="">

                        </div>

                    </div>


                    <div class="col-md-6">
                        <div class="form-group">
                            <input name="email" class="form-control" type="email" placeholder="Email" required="">

                        </div>

                    </div>


                    <div class="col-md-offset-4 col-md-6 submit-buttom">
                        <input type="submit" value="Save User" name="adduser" class="btn btn-success">
                        <input type="reset" value="Reset" class="btn btn-warning">

                    </div>

                </form>
            </div>
            <div class="modal-footer">


            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- add new user modal end -->





