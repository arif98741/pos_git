<?php include 'lib/header.php'; ?>
<?php

//update type
if ( isset($_POST['updatetype'])) {
    
    $typeid = mysqli_real_escape_string($db->link,$_POST['typeid']);
    $typename = mysqli_real_escape_string($db->link,$_POST['typename']);

    $stmt = $db->link->query("update tbl_type set typename ='$typename' where typeid ='$typeid'");
    if ($stmt) {
        echo "<script>alert('Unit Updated Successfully');</script>";
    } else {
        echo "<script>alert('Unit Update Failed');</script>";
    }
}

//delete type
if (isset($_GET['action']) && $_GET['action']=='delete') {
    $typeid = mysqli_real_escape_string($db->link, $_GET['typeid']);
    if($db->link->query("delete from tbl_type where typeid='$typeid'")){
        echo "<script>alert('Unit Deleted Successfully');</script>";
    }else{
        echo "<script>alert('Unit Deleted Failed!');</script>";
    }
}
?>
<!-- //header-ends -->
<div id="page-wrapper">
    <div class="graphs">
        <div class="breadcrumb">
            <h3><i class="lnr lnr-list"></i> &nbsp;Unit List</h3>
        </div>

        <div class="xs tabls">
            <div class="bs-example4">
                <div class="table-responsive">
                    <table class="table table-bordered invoice_table" id="invoice_product_data_table">
                        <thead >
                        <tr>
                            <th>Serial</th>
                            <th>Unit Name</th>
                            <th>Unit No</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $status = $pro->showType();
                        if ($status) {
                            $i = 0;
                            while ($result = $status->fetch_assoc()) {
                                $i++;
                                ?>
                                <tr style="text-align: center;">
                                    <td><?php echo $i; ?></td>
                                    <td style="text-align: left;"><?php echo $result['typename']; ?></td>
                                    <td><?php echo $result['typeid']; ?></td>
                                    <?php if(Session::get('status') == 'admin'): ?>
                                    <td>
                                        <a href="edittype.php?action=view&typeid=<?php echo $result['typeid'] ?>" style="border-radius: 3px;" title="click to view" ></a>
                                        <a href="edittype.php?action=edit&typeid=<?php echo $result['typeid'] ?>" style="border-radius: 3px;" title="click to edit" ><i class="fa fa-pencil-square-o"></i>&nbsp;&nbsp;</a>
                                        <a href="?action=delete&typeid=<?php echo $result['typeid'] ?>" style="border-radius: 3px;" title="click to delete" onclick="return confirm('are you sure to delete?')" ><i class="lnr lnr-trash"></i></a>
                                    </td>

                                <?php else: ?>

                                    <td>-</td>
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
