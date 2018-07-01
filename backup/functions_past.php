<?php

include_once 'classes/DB.php';
include_once 'classes/Supplier.php';
include_once 'classes/Invoice.php';
include_once 'classes/Extra.php';
include_once 'classes/Customer.php';
include_once 'helper/Helper.php';
$sup = new Supplier();
$db = new DB();
$in = new Invoice();
$ext = new Extra();
$cus = new Customer();
$help = new Helper();

//get data for selecting supplier from dropdown in addpurchase.php
if (isset($_POST['page']) && $_POST['page'] == 'supplier' && $_POST['supplier_id']) {
    $stmt = $sup->showSingleSupplier($_POST['supplier_id']);
    $data = $stmt->fetch_assoc();
    if ($data) {
        $arr = array(
            $data['supplier_id'],
            $data['supplier_name'],
            $data['address'],
            $data['contact_no']
        );
        echo json_encode($arr);
    } else {
        $arr = array(
            "No Supplier Found"
        );
        echo json_encode($arr);
    }
}

//get invoiceProducts in addinvoice.php during page load
if (isset($_GET['page']) && $_GET['action'] == 'showInvoiceList') {
    echo $in->showInvoices();
}

//showing productById
if (isset($_GET['page']) && $_GET['page'] = 'page' && $_GET['action'] == 'showproductbyid') {
    $stmt = $in->showProductByID($_GET['product_id']);
    echo json_encode($stmt);
}

//showing groups in addinvoice form
if (isset($_GET['page']) && $_GET['page'] = 'addinvoice' && $_GET['action'] == 'getgroups') {
    echo $ext->showGroup();
}

//showing product name list in addinvoice form by select group
if (isset($_POST['page']) && $_POST['page'] = 'addinvoice' && $_POST['action'] == 'productnamelist' && isset($_POST['group_id'])) {
    echo $ext->showProductNameList($_POST['group_id']);
}

//showing single product details in addinvoice form by selecting product list dropdown
if (isset($_POST['page']) && $_POST['page'] = 'addinvoice' && $_POST['action'] == 'getprodetails' && isset($_POST['pro_id'])) {
    echo json_encode($ext->showSingleProDetails($_POST['pro_id']));
}


//get data for selecting dropdown in addinvoice.php
if ($_POST['action'] =='getcustomers' && isset($_POST['action'])) {
  $cus_id = $_POST['customer_id'] ;
  $cus_stmt = $cus->singleCustomer($cus_id);
  $cus_data = $cus_stmt->fetch_assoc();
  $arr = array(
    "customer_id"=>$cus_data['customer_id'],
    "address" =>$cus_data["address"],
    "contact_no"=>$cus_data["contact_no"]
  );
  echo json_encode($arr);
}

//get products by selecting group in addinvoice.php
if ($_POST['action'] =='getproductsbygroup' && isset($_POST['action'])) {
    $groupid = $help->validAndEscape($_POST['groupid']);
    if(!empty($groupid)){
        $stmt = $db->select("select * from tbl_product where product_group = '$groupid'");
        if ($stmt){
            if($stmt->num_rows>0){
                $val = "<option value=''>Select Product</option>";
                while ($row = $stmt->fetch_assoc()){
                    $val .= "<option value='".$row['product_id']."'>".$row['product_name']."</option>";
                }
                echo $val;
            }

        }
    }

}

//get single product details by  product id
if ($_POST['action'] =='getproduct_details_id' && isset($_POST['action'])) {
    $product_id = $help->validAndEscape($_POST['product_id']);
    if(!empty($product_id)){
        $stmt = $db->select("select * from tbl_product WHERE  product_id ='$product_id'");
        if ($stmt){
            if($stmt->num_rows>0){
                $val = $stmt->fetch_array();
                echo json_encode($val);
            }
        }
    }
}