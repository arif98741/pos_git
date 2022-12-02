<?php include 'lib/header.php'; ?>


<?php
//updsate user
//add customer
if (isset($_POST['updateuser'])) {
    $result = $log->updateUser($_POST);
    echo $result;
}


//add customer
if (isset($_POST['adduser'])) {
    $result = $log->addUser($_POST);
    echo $result;
}


//delete customer
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $userid = $help->validAndEscape($_GET['serial']);
    $status = $db->link->query("delete from tbl_user where userid ='$userid'");
    if ($status) {
        echo "<script>alert('Stuff deleted Successfully');</script>";
    } else {
        echo "<script>alert('Stuff deleted failed');</script>";
    }
}
?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>USERS</h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active"><a href="index.php">Dashboard</a></li>
                <!-- <li class="active"><a href="addlaser.php">Add New Transaction</a></li> -->
                <?php if (Session::get('status') == 'admin'): ?>
                    <li class="active"><a type="button" href="#" class="" data-toggle="modal"
                                          data-target="#add-new-user">Add New User</a></li>
                <?php endif; ?>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">

                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title"></h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example2" class="table table-bordered table-hover dataTable" role="grid"
                                   aria-describedby="example2_info">
                                <thead>
                                <tr role="row">
                                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1"
                                        colspan="1" aria-sort="ascending"
                                        aria-label="Rendering engine: activate to sort column descending" width="10%">
                                        Serial
                                    </th>

                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                        aria-label="Browser: activate to sort column ascending" width="10%">Name
                                    </th>

                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                        aria-label="Platform(s): activate to sort column ascending" width="20%">Username
                                    </th>


                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                        aria-label="CSS grade: activate to sort column ascending" width="20%">Email
                                    </th>

                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                        aria-label="CSS grade: activate to sort column ascending" width="10%">Action
                                    </th>

                                </tr>
                                </thead>
                                <tbody style="text-align: center">
                                <?php
                                $stmt = $db->link->query("select * from tbl_user where status='stuff'");

                                if ($stmt) {
                                    $i = 0;
                                    while ($row = $stmt->fetch_assoc()) {
                                        $i++; ?>
                                        <tr>
                                            <td> <?php echo $i; ?></td>
                                            <td> <?php echo $row['name'] ?></td>
                                            <td style="text-align: left;"> <?php echo $row['username'] ?></td>
                                            <td style="text-align: left;"> <?php echo $row['email']; ?></td>

                                            <?php if (Session::get('status') == 'admin'): ?>

                                                <td>
                                                    <a href="edituser.php?action=edit&userid=<?php echo $row['userid']; ?>"
                                                       style="border-radius: 3px;" title="click to delete"><i
                                                                class="fa fa-pencil-square-o btn"></i></a>&nbsp;&nbsp;

                                                    <a href="?action=delete&serial=<?php echo $row['userid']; ?>"
                                                       style="border-radius: 3px;" title="click to delete"
                                                       onclick="return confirm('are you sure to delete?')"><i
                                                                class="fa fa-trash"></i></a>

                                                </td>

                                            <?php else: ?>
                                                <td>-</td>
                                            <?php endif; ?>

                                        </tr>
                                    <?php }
                                } else {
                                }
                                ?>
                                </tbody>


                            </table>
                        </div>

                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            </div>


        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <!-- footer -->

<?php include 'lib/footer.php'; ?>