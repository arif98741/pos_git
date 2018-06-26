<?php
$path = realpath(dirname(__DIR__));
include_once $path .'../../classes/Session.php';
include_once $path."../../classes/DB.php";
include_once $path."../../helper/Helper.php";
Session::checkSession();
$db = new Database();
$help = new Helper();
date_default_timezone_set('Asia/Dhaka');

?>
<?php if (Session::get('status') !== 'admin') {
    header("Location: ../../index.php");
}?>

<!DOCTYPE html>
<html>
    <head>
        <script>
            function goBack() {
                window.history.back();
            }
        </script>
        <meta charset="utf-8">
        <title>Student Report - <?php echo date('Y-m-d h:i:sA'); ?></title>
        <link rel="stylesheet" href="../../assets/dist/css/print/print.css" type="text/css" media="screen">
        <link rel="stylesheet " href="../../assets/dist/css/print/print.css">
    </head>

    <body>
        <div class="bt-div">
            <INPUT TYPE="button" class="button blue" title="Print" onClick="window.print()" value="Print">
            <button class="button blue" onclick="goBack()">Back</button>
        </div>

        <div class="wraper">
             
                <table width="100%" border="0" class="header">
                    <tr>
                        <td width="8%" align="left" valign="top"><a href="dashboard.php"></a></td>
                        <td width="68%" height="67" align="left" valign="middle">
                                    
                                <div class="title-3">
                                      <h2 style="margin:0px;">75 Years Celebration - CGSA College</h2>  
                                    Registant Report - All Students<br/></div></td>
                            
                        </tr>
                </table>
                    
                <table class="TFtable" id="datatable" >
                      <thead style="text-align: center;">
                            <tr>
                                <th>Serial</th>
                                <th>Name</th>
                                <th>Gender</th>
                                <th>Batch</th>
                                <th>Contact</th>
                                <th>Email</th>
                                <th>Date</th>
                            </tr>
                      </thead>
                      <tbody>
                          <?php 

                        $stmt = $db->link->query("select * from registration where status='approved'");
                            if ($stmt) { $i = 0;
                                
                               while ($row = $stmt->fetch_assoc()) { $i++;
                                  
                                 ?>
                            <tr>
                                
                                <td style="text-align: center;"><?php echo $i; ?></td>
                                
                                <td style="text-align: left;"><?php echo $row['fullname']; ?></td>
                                <td style="text-align: left;"><?php echo strtoupper($row['gender']); ?></td>
                                <td style="text-align: center;"><?php echo $row['batchyear']; ?></td>
                                <td style="text-align: left;"><?php echo $row['contact']; ?></td>
                                <td style="text-align: left;"><?php echo $row['email']; ?></td>
                                <td style="text-align: center;"><?php echo $help->formatDate($row['date']); ?></td>
                                
                            </tr>

                        <?php } } ?>
                            
                </tbody>
            </table>

        </div>

    </body>






</html>