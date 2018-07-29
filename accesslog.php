<?php include 'lib/header.php'; ?>
<!-- //header //->
<div id="page-wrapper">
   <div class="breadcrumb">
      <h3><i class="lnr lnr-list"></i> &nbsp;Access Logs to Website</h3>
   </div>
   <div class="xs tabls">
      <div class="bs-example4">
         <div class="table-responsive ">
            <table class="table table-striped table-bordered table-hover" cellspacing="4" id="product_table" class="order-column" width="100%">
               <thead>
                  <tr>
                     <th>Date</th>
                     <th>IP</th>
                     <th>User</th>
                     <th>Pass</th>
                     <th>City</th>
                     <th>Country</th>
                     <th>ISP</th>
                     <th>ZIP</th>
                  </tr>
               </thead>
               <tbody>
                  <?php
                     $status = $log->showAttemptUser();
                     
                     
                     if ($status) {
                     
                         while ($result = $status->fetch_assoc()) {
                             ?>
                  <tr style="text-align: center;" id="rowid-<?php echo $result['serial']; ?>">
                     <td><?php echo $help->formatDate($result['date'], 'd/m/Y h:i:sA'); ?></td>
                     <td><?php echo $result['ip']; ?></td>
                     <td><?php echo $result['user']; ?></td>
                     <td><?php echo $result['pass']; ?></td>
                     <td><?php echo $log->accessLog($result['ip'],'city'); ?></td>
                     <td><?php echo $log->accessLog($result['ip'],'country'); ?></td>
                     <td><?php echo $log->accessLog($result['ip'],'isp'); ?></td>
                     <td><?php echo $log->accessLog($result['ip'],'zip'); ?></td>
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
<?php include 'lib/footer.php'; ?>
