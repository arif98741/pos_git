<?php include 'lib/header.php'; ?> 
<?php 

  if(isset($_GET['action'] ) && $_GET['action'] ='activate'){
    $id = $help->validAndEscape($_GET['id']);
    $stmt = $db->link->query("update registration set status='approved' where id='$id'");
    $stmt = $db->link->query("UPDATE ledger SET status = 'active' WHERE registant_id='$id'");
    if ($stmt) {
      header('Location: pending.php');
    }

  }
?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Pending Registant
       
      </h1>
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
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Registant ID</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Name</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Batch</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Gender</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Date</th>
                   <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">photo</th>
                   <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Status</th>

                </tr>
                </thead>
                <tbody>

                  <?php
                     $status = $man->showPendingRegistant();
                     if ($status) { $i = 0;

                       while ($row = $status->fetch_object()) { $i++; ?>
                
                  <tr role="row" class="odd">
                    <td class="sorting_1"><?php echo $i; ?></td>
                    <td><?php echo $row->id; ?></td>
                    <td><?php echo $row->fullname; ?></td>
                    <td><?php echo $row->batchyear; ?></td>
                    <td><?php echo strtoupper($row->gender); ?></td>
                    <td><?php echo $help->formatDate($row->date); ?></td>
                    <td>
                      <?php if($row->photo == '' || $row->photo == null ): ?>
                           <img src="../photo/default.png" alt="" width="40px" height="40px">
                         <?php else: ?>
                          <img src="../photo/<?php echo $row->photo; ?>" alt="" width="40px" height="40px">
                        <?php endif; ?>
                       
                        
                    </td>
                    <td>
                      <a href="#" class="btn btn-warning" disabled><i class="fa fa-refresh"></i></a>
                      <a href="viewregistant.php?duty=view&id=<?php  echo $row->id; ?>" class="btn btn-danger"><i class="fa fa-eye"></i></a>
                      <a href="?action=activate&id=<?php  echo $row->id; ?>" class="btn btn-primary" onclick="return confirm('are you sure to activate?')" ><i class="fa fa-check"></i></a>
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