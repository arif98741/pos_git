<?php include 'lib/header.php'; ?>
<?php
//update Color
if ( isset($_POST['updatecolor'])) {
    
    $colorid = mysqli_real_escape_string($db->link,$_POST['colorid']);
    $colorname = mysqli_real_escape_string($db->link,$_POST['colorname']);

    $stmt = $db->link->query("update tbl_color set colorname ='$colorname' where colorid ='$colorid'");
    if ($stmt) {
        echo "<script>alert('Color Updated Successfully');</script>";
    } else {
        echo "<script>alert('Color Update Failed');</script>";
    }
}

//delete Color
if (isset($_GET['action']) && $_GET['action']=='delete') {
    $colorid = mysqli_real_escape_string($db->link, $_GET['colorid']);
    if($db->link->query("delete from tbl_color where colorid='$colorid'")){
        echo "<script>alert('Color Deleted Successfully');</script>";
    }else{
        echo "<script>alert('Color Deleted Failed!');</script>";
    }
}
?>

<!-- //header-ends -->
<div id="page-wrapper">
    <div class="graphs">
        <div class="breadcrumb">
            <h3><i class="lnr lnr-list"></i> &nbsp;Color List</h3>
        </div>

        <div class="xs tabls">
            <div class="bs-example4">
                <div class="table-responsive">
                    <table class="table table-bordered invoice_table" id="invoice_product_data_table">
                        <thead>
                        <tr>
                            <th>Serial</th>
                            <th>Color Name</th>
                            <th>Color No.</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $status = $pro->showColor();
                        if ($status) {
                            $i = 0;
                            while ($result = $status->fetch_assoc()) {
                                $i++;
                                ?>
                                <tr style="text-align: center;" id="rowid-<?php echo $result['colorid']; ?>">
                                    <td><?php echo $i; ?></td>
                                    <td style="text-align: left;"><?php echo ucfirst($result['colorname']); ?></td>
                                    <td><?php echo $result['colorid']; ?></td>
                                    
                                    <td>
                                        <a href="editcolor.php?action=view&colorid=<?php echo $result['colorid'] ?>" style="border-radius: 3px;" title="click to view" ></a>
                                        <a href="editcolor.php?action=edit&colorid=<?php echo $result['colorid'] ?>" style="border-radius: 3px;" title="click to edit" ><i class="fa fa-pencil-square-o"></i>&nbsp;&nbsp;</a>
                                        <a href="?action=delete&colorid=<?php echo $result['colorid'] ?>" style="border-radius: 3px;" title="click to delete" onclick="return confirm('are you sure to delete?')" ><i class="lnr lnr-trash"></i></a>
                                    </td>
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
