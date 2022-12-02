<?php
$path = realpath(dirname(__DIR__));
include_once $path . '/product/print.php';
include_once "../../classes/Printdata.php";
include_once "../../classes/Session.php";
$pri = new Printdata();
if (isset($_SESSION['status']) && $_SESSION['status'] !== 'admin') {
    header("location: ../../index.php");
}
?>


<!DOCTYPE html>
<html>
<head>
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
    <meta charset="utf-8">
    <title>::: Report of Supplier:::</title>
    <link rel="stylesheet" href="../../assets/css/print.css" type="text/css" media="screen">
    <link rel="stylesheet " href="../../assets/css/print.css">
</head>

<body>
<div class="bt-div">
    <INPUT TYPE="button" class="button blue" title="Print" onClick="window.print()" value="Print">
    <a class="button blue" href="../../supplierlist.php">Back</a>
</div>
<?php
?>

<div class="wraper">

    <table width="100%" border="0" class="header">
        <tr>
            <td width="8%" align="left" valign="top"><a href="dashboard.php"><span class="user_panel "><img
                                src="../../<?php echo Session::get('logo') ?>" class="img_div" width="60" height="60"
                                alt=""/></span></a></td>
            <td width="68%" height="67" align="left" valign="middle">
                <div class="title-1"><?php echo Session::get('company_name'); ?></div>


                <div class="title-3">Supplier List Report</div>
            </td>
            <td width="24%" align="right" valign="middle" nowrap="nowrap">
                <div class="title-2">Total Suppliers:
                    (<?php echo $pri->TotalProducts("select * from tbl_supplier ORDER  by supplier_name ASC "); ?>)
                </div>
            </td>
        </tr>
    </table>
    <div class="line-4"></div>
    <div class="line-3"></div>

    <table class="TFtable" id="datatable">
        <thead>
        <tr>
            <th>Serial</th>
            <th>Supplier ID</th>
            <th>Supplier Name</th>
            <th>Email</th>
            <th>Adress</th>
            <th>Contact</th>


        </tr>
        </thead>
        <tbody style="text-align: center">
        <?php
        if ($stmt = $pri->SupplierReportByAll()){
        $i = 0;
        while ($row = $stmt->fetch_assoc()) {
        $i++; ?>

        <tr>
            <td> <?php echo $i ?></td>
            <td> <?php echo $row['supplier_id'] ?></td>
            <td> <?php echo $row['supplier_name'] ?></td>
            <td> <?php echo $row['email'] ?></td>
            <td> <?php echo $row['address'] ?> </td>
            <td> <?php echo $row['contact_no'] ?> </td>
            <?php }
            } else {

            }
            ?>
        </tbody>

    </table>

</div>

</body>
</html>