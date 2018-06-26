<?php include 'lib/header.php'; ?>
<?php
    if(isset($_POST['addtransactioncat'])){
        $msg = "";
        $transactioncat = $help->validAndEscape($_POST['transactioncat']);
        $checkstmt = $db->select("select * from  tbl_transactioncat WHERE  category_name ='$transactioncat'");
        if(!$checkstmt){
            $stmt = $db->insert("insert into  tbl_transactioncat(category_name) VALUES ('$transactioncat')");
            if($stmt){
                $msg = "<script>alert('Transaction Category Added Successully');</script>";
            }else{
                 $msg = "<script>alert('Transaction Category Added Failed');</script>";
            }
        }else{
             $msg = "<script>alert('Transaction Category Already Exist');</script>";
        }
        echo $msg;
    }

//update group
if ( isset($_POST['updatetransactioncat'])) {
    $transactioncatname = mysqli_real_escape_string($db->link,$_POST['transactioncatname']);
    $trans_category_id = mysqli_real_escape_string($db->link,$_POST['trans_category_id']);

    $stmt = $db->link->query("update tbl_transactioncat set category_name ='$transactioncatname' where id ='$trans_category_id'");
    if ($stmt) {
        echo "<script>alert('Transaction Category Updated Successfully');</script>";
    } else {
        echo "<script>alert('Transaction Category Update Failed');</script>";
    }
}

//delete type
if (isset($_GET['action']) && $_GET['action']=='delete') {
    $id = mysqli_real_escape_string($db->link, $_GET['id']);
    if($db->link->query("delete from tbl_transactioncat where id='$id'")){
        echo "<script>alert('Transaction Category Deleted Successfully');</script>";
    }else{
        echo "<script>alert('Transaction Category Deleted Failed!');</script>";
    }
}
?>

<!-- //header-ends -->
<div id="page-wrapper">
    <div class="graphs">
        <div class="breadcrumb">
            <h3><i class="lnr lnr-list"></i> &nbsp;Transaction Category List</h3>
        </div>

        <div class="xs tabls">
            <div class="bs-example4">
                <div class="table-responsive">
                    <table class="table table-bordered invoice_table" id="invoice_product_data_table">
                        <thead>
                        <tr>
                            <th>Serial</th>
                            <th>Transaction Category Name</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $status = $db->link->query("select * from tbl_transactioncat order by category_name asc");
                        if ($status) {
                            $i = 0;
                            while ($result = $status->fetch_assoc()) {
                                $i++;
                                ?>
                                <tr style="text-align: center;" id="rowid-<?php echo $result['groupid']; ?>">
                                    <td><?php echo $i; ?></td>
                                    <td style="text-align: left;"><?php echo $result['category_name']; ?></td>
                                     <?php if(Session::get('status') == 'admin'): ?>
                                      <td>
                                        
                                        <a href="edittranscategory.php?action=edit&id=<?php echo $result['id'] ?>" style="border-radius: 3px;" title="click to edit" ><i class="fa fa-pencil-square-o"></i>&nbsp;&nbsp;</a>
                                        <a href="?action=delete&id=<?php echo $result['id'] ?>" style="border-radius: 3px;" title="click to delete" onclick="return confirm('are you sure to delete?')" ><i class="lnr lnr-trash"></i></a>
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
