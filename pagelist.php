<?php include 'lib/header.php'; ?> 
<?php 

  if(isset($_GET['action'] ) && $_GET['action'] ='delete'){
    $id = $help->validAndEscape($_GET['id']);
    $stmt = $db->link->query("delete from committee where id='$id'");
    if ($stmt) {
      header('Location: viewcommittee.php');
    }
  }

  if(isset($_POST['addnews'])){
    
    echo $stmt = $pag->addPage($_POST);
  }

  if(isset($_POST['updatepage'])){
    
    echo $stmt = $pag->updatePage($_POST);
  }




?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Page List </h1>
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
                  <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" width="10%">Serial</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending"  width="20%">Title</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending"  width="30%">Description</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"  width="10%">Date</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"  width="20%">Photo</th>
                  
                   <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"  width="10%">Action</th>

                </tr>
                </thead>
                <tbody>

                  <?php
                     $status = $pag->showPage();
                     if ($status) { $i = 0;

                       while ($row = $status->fetch_object()) { $i++; ?>
                
                  <tr role="row" class="odd">
                    <td class="sorting_1" style="text-align: center;"><?php echo $i; ?></td>
                    <td><strong><?php echo $row->title; ?></strong></td>
                    <td><?php echo html_entity_decode(substr($row->description, 0,150))?> </td>
                    <td><?php echo $help->formatDate($row->date); ?></td>

                    <td>
                      <?php if($row->photo == '' || $row->photo == null): ?>
                          <img src="../photo/committee/default.png" alt="" width="80px" height="80px">
                      <?php else: ?>
                          <img src="../photo/page/<?php echo $row->photo; ?>" alt="" width="150px" height="100px">
                       <?php endif; ?>
                    </td>
                    <td>
                      <a href="editpage.php?duty=edit&id=<?php  echo $row->id; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                      
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