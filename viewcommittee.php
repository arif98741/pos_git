<?php include 'lib/header.php'; ?> 
<?php 

  if(isset($_GET['action'] ) && $_GET['action'] ='delete'){
    $id = $help->validAndEscape($_GET['id']);
    $stmt = $db->link->query("delete from committee where id='$id'");
    if ($stmt) {
      header('Location: viewcommittee.php');
    }
  }

  if(isset($_POST['addmember'])){
    
    echo $stmt = $man->addCommittee($_POST);
  }

  
  if(isset($_POST['updatemember'])){
    
    echo $stmt = $man->updateCommittee($_POST);
  }





?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Commitee </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
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
                  <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Serial</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Name</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Designation</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Address</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Contact</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Photo</th>
                  
                   <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Action</th>

                </tr>
                </thead>
                <tbody>

                  <?php
                     $status = $man->showCommittee();
                     if ($status) { $i = 0;

                       while ($row = $status->fetch_object()) { $i++; ?>
                
                  <tr role="row" class="odd">
                    <td class="sorting_1"><?php echo $i; ?></td>
                    <td><?php echo $row->name; ?></td>
                    <td><?php echo $row->designation; ?></td>
                    <td><?php echo $row->address; ?></td>
                    <td><?php echo $row->contact; ?></td>

                    <td>
                      <?php if($row->photo == '' || $row->photo == null): ?>
                          <img src="../photo/committee/default.png" alt="" width="80px" height="80px">
                      <?php else: ?>
                          <img src="../photo/committee/<?php echo $row->photo; ?>" alt="" width="80px" height="80px">
                       <?php endif; ?>
                    </td>
                    <td>
                      <a href="editmember.php?duty=view&id=<?php  echo $row->id; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                      <a href="?action=delete&id=<?php  echo $row->id; ?>" class="btn btn-danger" onclick="return confirm('are you sure to activate?')" ><i class="fa fa-trash"></i></a>
                    </td>

                  </tr>
                    <?php } }  ?>
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