<?php include 'lib/header.php'; ?>
<?php

//update type
if ( isset($_POST['updatetype'])) {
    
    $typeid = mysqli_real_escape_string($db->link,$_POST['typeid']);
    $typename = mysqli_real_escape_string($db->link,$_POST['typename']);

    $stmt = $db->link->query("update tbl_type set typename ='$typename' where typeid ='$typeid'");
    if ($stmt) {
        echo "<script>alert('Type Updated Successfully');</script>";
    } else {
        echo "<script>alert('Type Update Failed');</script>";
    }
}

//delete type
if (isset($_GET['action']) && $_GET['action']=='delete') {
    $typeid = mysqli_real_escape_string($db->link, $_GET['typeid']);
    if($db->link->query("delete from tbl_type where typeid='$typeid'")){
        echo "<script>alert('Type Deleted Successfully');</script>";
    }else{
        echo "<script>alert('Type Deleted Failed!');</script>";
    }
}
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>UNIT LIST</h1>
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
                  <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" width="30%">Unit Name</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending"  width="20%">Unit No</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"  width="10%">Action</th>

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