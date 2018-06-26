<?php include 'lib/header.php'; ?>
<?php

//update brand
if ( isset($_POST['updatebrand'])) {
    
    $brandid = mysqli_real_escape_string($db->link,$_POST['brandid']);
    $brandname = mysqli_real_escape_string($db->link,$_POST['brandname']);

    $stmt = $db->link->query("update tbl_brand set brandname ='$brandname' where brandid ='$brandid'");
    if ($stmt) {
        echo "<script>alert('Brand Updated Successfully');</script>";
    } else {
        echo "<script>alert('Brand Update Failed');</script>";
    }
}

//delete brand
if (isset($_GET['action']) && $_GET['action']=='delete') {
    $brandid = mysqli_real_escape_string($db->link, $_GET['brandid']);
    if($db->link->query("delete from tbl_brand where brandid='$brandid'")){
        echo "<script>alert('Brand Deleted Successfully');</script>";
    }else{
        echo "<script>alert('Brand Deleted Failed!');</script>";
    }
}
?>

<!-- //header-ends -->
<div id="page-wrapper">
    <div class="graphs">
        <div class="breadcrumb">
            <h3><i class="lnr lnr-list"></i> &nbsp;Brand List</h3>
        </div>

        <div class="xs tabls">
            <div class="bs-example4">
                <div class="table-responsive">
                    <table class="table table-bordered invoice_table" id="invoice_product_data_table">
                        <thead>
                        <tr>
                            <th>Serial</th>
                            <th>Brand Name</th>
                            <th>Brand No.</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $status = $pro->showBrand();
                        if ($status) {
                            $i = 0;
                            while ($result = $status->fetch_assoc()) {
                                $i++;
                                ?>
                                <tr style="text-align: center;">
                                    <td><?php echo $i; ?></td>
                                    <td style="text-align: left;"><?php echo $result['brandname']; ?></td>
                                    <td><?php echo $result['brandid']; ?></td>
                                    <td>
                                        <a href="editbrand.php?action=view&brandid=<?php echo $result['brandid'] ?>" style="border-radius: 3px;" title="click to view" ></a>
                                        <a href="editbrand.php?action=edit&brandid=<?php echo $result['brandid'] ?>" style="border-radius: 3px;" title="click to edit" ><i class="fa fa-pencil-square-o"></i>&nbsp;&nbsp;</a>
                                        <a href="?action=delete&brandid=<?php echo $result['brandid'] ?>" style="border-radius: 3px;" title="click to delete" onclick="return confirm('are you sure to delete?')" ><i class="lnr lnr-trash"></i></a>
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
