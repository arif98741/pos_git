<?php include 'lib/header.php'; ?>
<?php if (Session::get('status') !== 'admin') {
    header("Location: index.php");
}?>

<?php
//add customer
if (isset($_POST['adduser'])) {
    $result = $log->addUser($_POST);
    echo $result ;
}


/*update customer
if (isset($_POST['updatecustomer'])) {
    $update = $cus->updateCustomer($_POST);
    if ($update) {
        echo "<script>alert('Customer Updated Successfully');</script>";
    } else {
        echo "<script>alert('Customer Updated Failed');</script>";
    }
}*/

//delete customer
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
   $userid = $help->validAndEscape($_GET['serial']);
   $status = $db->link->query("delete from tbl_user where userid ='$userid'");
   if ($status) {
       echo "<script>alert('Stuff deleted Successfully');</script>";
   }else {
       echo "<script>alert('Stuff deleted failed');</script>";
   }
}
?>

<!-- //header-ends -->
<div id="page-wrapper">

       
 
        <div class="breadcrumb">
            <h3 class=""><i class="lnr lnr-list"></i> &nbsp;Users</h3>
       
        </div>

        <div class="xs tabls">
            <div class="bs-example4">
                <div class="table-responsive ">

                    <table class="table table-striped table-bordered table-hover" cellspacing="4" id="product_table" class="order-column" width="100%">
                        <thead>
                            <tr>
                                <th>Serial</th>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody style="text-align: center">
                            <?php
                            $stmt = $db->link->query("select * from tbl_user where status='stuff'");

                            if($stmt){
                                $i= 0;
                                     while ($row = $stmt->fetch_assoc()) {  $i++;?>
                                     <tr>
                                        <td> <?php echo $i;   ?></td>
                                        <td> <?php echo $row['name']  ?></td>
                                        <td style="text-align: left;"> <?php echo $row['username']  ?></td>
                                        <td style="text-align: left;"> <?php echo $row['email'];  ?></td>

                                        <td>
                                             <a href="?action=delete&serial=<?php echo $row['userid']; ?>" style="border-radius: 3px;" title="click to delete" onclick="return confirm('are you sure to delete?')" id="rowdelete" delid="<?php echo $result['serial']; ?>"><i class="lnr lnr-trash"></i></a>

                                        </td>
                                        
                                     </tr>
                                   <?php   } }else{
                            }
                            ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
 
</div>
<?php include 'lib/footer.php'; ?>
