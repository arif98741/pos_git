<?php include 'lib/header.php'; ?>
<?php

//update group
if ( isset($_POST['updategroup'])) {


    $groupid = mysqli_real_escape_string($db->link,$_POST['groupid']);
    $groupname = mysqli_real_escape_string($db->link,$_POST['groupname']);

    $stmt = $db->link->query("update tbl_group set groupname ='$groupname' where groupid ='$groupid'");
    if ($stmt) {
        echo "<script>alert('Group Updated Successfully');</script>";
    } else {
        echo "<script>alert('Group Update Failed');</script>";
    }
}

//delete type
if (isset($_GET['action']) && $_GET['action']=='delete') {
    $groupid = mysqli_real_escape_string($db->link, $_GET['groupid']);
    if($db->link->query("delete from tbl_group where groupid='$groupid'")){
        echo "<script>alert('Group Deleted Successfully');</script>";
    }else{
        echo "<script>alert('Group Deleted Failed!');</script>";
    }
}
?>

<!-- //header-ends -->
<div id="page-wrapper">
    <div class="graphs">
        <div class="breadcrumb">
            <h3><i class="lnr lnr-list"></i> &nbsp;Group List</h3>
        </div>

        <div class="xs tabls">
            <div class="bs-example4">
                <div class="table-responsive">
                    <table class="table table-bordered invoice_table" id="invoice_product_data_table">
                        <thead>
                        <tr>
                            <th>Serial</th>
                            <th>Group Name</th>
                            <th>Group Number</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $status = $pro->showGroup();
                        if ($status) {
                            $i = 0;
                            while ($result = $status->fetch_assoc()) {
                                $i++;
                                ?>
                                <tr style="text-align: center;" id="rowid-<?php echo $result['groupid']; ?>">
                                    <td><?php echo $i; ?></td>
                                    <td style="text-align: left;"><?php echo $result['groupname']; ?></td>
                                    <td><?php echo $result['groupid']; ?></td>
                                    
                                    <?php if(Session::get('status') == 'admin'): ?>
                                    
                                    <td>

                                        <a href="editgroup.php?action=edit&groupid=<?php echo $result['groupid'] ?>" style="border-radius: 3px;" title="click to edit" ><i class="fa fa-pencil-square-o"></i>&nbsp;&nbsp;</a>
                                        <a href="?action=delete&groupid=<?php echo $result['groupid'] ?>" style="border-radius: 3px;" title="click to delete" onclick="return confirm('are you sure to delete?')" ><i class="lnr lnr-trash"></i></a>
                                    </td>

                                <?php else: ?>
                                    <td>
                                        -
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
