<?php
include_once 'classes/DB.php';
include_once 'classes/Supplier.php';
include_once 'classes/Invoice.php';
include_once 'classes/Product.php';
include_once 'classes/Extra.php';
include_once 'classes/Customer.php';
include_once 'helper/Helper.php';
$sup = new Supplier();
$db = new Database();
$in = new Invoice();
$pro = new Product();
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

//showing productById with unit(type) 
if (isset($_GET['page']) && $_GET['page'] = 'page' && $_GET['action'] == 'showproductbyid') {
   // $stmt = $in->showProductByID($_GET['product_id']);
   $pro_id = $help->validAndEscape($_GET['product_id']);
   $stmt = $db->link->query("select * from tbl_product,tbl_group,tbl_type where tbl_product.product_type = tbl_type.typeid and tbl_product.product_group = tbl_group.groupid and tbl_product.product_id ='$pro_id'");
   if($stmt){
        echo json_encode($stmt->fetch_assoc());
   }

    
}

//showing groups in addinvoice form
if (isset($_GET['page']) && $_GET['page'] = 'addinvoice' && $_GET['action'] == 'getgroups') {
    echo $ext->showGroup();
}

//showing products list in dropdown list in addpurchase.php
if (isset($_GET['page']) && $_GET['page'] = 'addpurchase' && $_GET['action'] == 'getproducts') {   
    echo $ext->showProductNameList();
}

//showing product name list in addinvoice form by select group
if (isset($_POST['page']) && $_POST['page'] = 'addinvoice' && $_POST['action'] == 'productnamelist' && isset($_POST['group_id'])) {
    echo $ext->showProductNameList($_POST['group_id']);
}

//showing single product details in addinvoice form by selecting product list dropdown
if (isset($_POST['page']) && $_POST['page'] = 'addinvoice' && $_POST['action'] == 'getprodetails' && isset($_POST['pro_id'])) {
    echo json_encode($ext->showSingleProDetails($_POST['pro_id']));
}


// for getting single customer details in addinvoice.php (sale page)
if(isset($_POST['action']) && $_POST['action']=='getCustomerInformation' && isset($_POST['target']) &&  $_POST['target']=='sale'){
    $stmt = $cus->singleCustomer( $help->validAndEscape($_POST['cid']));
    if($stmt)
    {
        $data = $stmt->fetch_assoc();
        $customer_id = $data['customer_id'];
        $stmt = $db->link->query("select * from tbl_sell_products where customer_id = '$customer_id' and status = '0'");
        if($stmt)
        {
            if($stmt->num_rows > 0)
            {
                $stmt = $db->link->query("delete from tbl_sell_products where customer_id='$customer_id' and status = '0'");
            }
        }

        
        $query = "select balance as 'current_balance' from customer_balance where customer_id='$customer_id'";
        $due_from_profile_stmt = $db->link->query($query);
        if ($due_from_profile_stmt) {
            $result = $due_from_profile_stmt->fetch_assoc();
            $result['customer_due'] = round($result['current_balance']);
        }
        $result['customer_id'] = $data['customer_id'];
        $result['address'] = $data['address'];
        $result['contact_no'] = $data['contact_no'];
        $result['customer_name'] = $data['customer_name'];

        //$balance = $balancestmt['customer_due'];

        //$result['customer_due'] = round($balance);
        //here  may have some issue in future. need to solve properly.
    
        echo json_encode($result);

    }
}

//for getting group products for particular group in addinvoice.php(sale)
if(isset($_POST['action']) && $_POST['action']=='getallproductsbygroup' && isset($_POST['target']) &&  $_POST['target']=='getgroupproducts'){
    $gid = $help->validAndEscape($_POST['gid']);
    $stmt = $db->select("select * from tbl_product WHERE  product_group ='$gid'");
    if($stmt) {
        $val = "<option value=''>Select Product</option>";
        if($stmt->num_rows>0) {
            while ($row = $stmt->fetch_assoc()){
                $val .= "<option value='".$row['product_id']."'>".$row['product_name']."</option>";
            }
            echo $val;
        }
    }else{
        echo $val = "<option value=''>Select Product</option>";
    }

}

//for getting single product details in addinvoice.php by selecting product from dropdown
if(isset($_POST['action']) && isset($_POST['target']) && $_POST['target'] == 'getsingleproductdetails'){
    $pid = $help->validAndEscape($_POST['pid']);
    $stmt =  $db->select("select * from tbl_product WHERE  product_id = '$pid'");
    if($stmt){
        echo json_encode($stmt->fetch_assoc());
        //echo json_encode(array('fuck'));
    }
}


//get single product details in addinvoice.php
if (isset($_POST['aim']) && $_POST['aim'] == 'getsingleprodetails') {

    $product_id = $help->validAndEscape($_POST['product_id']);
    if ($product_id == null || $product_id == "") {
        return false;
    }else{
        $stmt = $db->link->query("select * from tbl_product where product_id ='$product_id'");
        if ($stmt) {
            echo json_encode($stmt->fetch_assoc());
        }else{
            echo "";
        }
    }
}


//get transaction type for single transaction category
if (isset($_POST['gettranscattype']) && $_POST['gettranscattype'] == 'gettranscattype') {

    $catid = $help->validAndEscape($_POST['catid']);
    if ($catid == null || $catid == "") {
        return false;
    }else{
        $stmt = $db->link->query("select * from tbl_transactioncat where id ='$catid'");
        if ($stmt) {
            echo json_encode($stmt->fetch_assoc());
        }
    }
}




