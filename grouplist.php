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



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>GROUPS</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="<?php echo BASE_URL; ?>">Dashboard</a></li>
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
              <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                <thead>
                <tr role="row">
                  <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" width="20">Serial</th>
                  <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" width="30%">Group Name</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending"  width="20%">Group Number</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"  width="10%">Action</th>

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