<?php
include_once '../../classes/DB.php';
include_once '../../classes/Supplier.php';
include_once '../../classes/Invoice.php';
include_once '../../classes/Product.php';
include_once '../../classes/Extra.php';
include_once '../../classes/Customer.php';
include_once '../../helper/Helper.php';
$sup  = new Supplier();
$db   = new Database();
$in   = new Invoice();
$pro  = new Product();
$ext  = new Extra();
$cus  = new Customer();
$help = new Helper();

/*
!------------------------------------------------------------------------------------------
!           insert temporary products to tbl_invoice_products
!------------------------------------------------------------------------------------------
*/
if (isset($_POST['addTempProducts']) ) {
  $invoice_id        = $help->validAndEscape($_POST['invoice_id']);
  $product_id        = $help->validAndEscape($_POST['product_id']);
  $carton            = $help->validAndEscape($_POST['carton']);
  $piece_in_a_carton = $help->validAndEscape($_POST['piece_in_a_carton']);
  $piece             = $carton * $piece_in_a_carton;
  $price             = $help->validAndEscape($_POST['price']); //purchase price
  $subtotal          = $price * $piece;

  $stmt = $db->link->query("select * from tbl_invoice_products where product_id='$product_id' and invoice_id='$invoice_id'")  or die($db->link->error). " error at line number ".__LINE__;
  $message = [];
  if ($stmt) {
    if ($stmt->num_rows > 0) {

      $message['message'] = 'existed';

    } else {
        $stmt = $db->link->query("insert into tbl_invoice_products (invoice_id,product_id,carton,piece,purchase,subtotal) values('$invoice_id','$product_id','$carton','$piece','$price','$subtotal')")  or die($db->link->error). " error at line number ".__LINE__;
        if($stmt)
            $message['message'] = 'inserted';
        else
           $message['message'] = 'failed'; 

    }
  } else {
      echo json_encode($message['message'] = 'failed to execute');
  }

  echo json_encode($message);
}




?>



