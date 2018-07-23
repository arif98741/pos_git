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
        if($stmt){
          $message['message'] = 'inserted';
        }else{

           $message['message'] = 'failed';
        }
            

    }
  } else {
      $message['message'] = 'failed to execute';
  }

  echo json_encode($message);
}


/*
!------------------------------------------------------------------------------------------
!           show temporary products in addpurchase.php
!------------------------------------------------------------------------------------------
*/
if (isset($_POST['showTemporaryProducts']) ) {

  $invoice_id = $help->validAndEscape($_POST['invoice_id']);
  
  $stmt = $db->link->query("SELECT tip.serial_no,tip.invoice_id, tip.carton, tip.piece, tip.purchase, tip.subtotal, tp.product_id,tp.product_name, ty.typename FROM tbl_invoice_products tip JOIN tbl_product tp ON tip.product_id = tp.product_id JOIN tbl_type ty ON tp.product_type = ty.typeid WHERE tip.invoice_id = '$invoice_id' AND tip.status = '0'")  or die($db->link->error). " error at line number ".__LINE__;
  $value = "";
  if ($stmt) {
    if ($stmt->num_rows > 0) {
      $subtotal = $i = 0;
      while ($row = $stmt->fetch_assoc()) {
        $subtotal += $row['subtotal'];
        $i++;

          $value .= '<tr style="text-align:center;">'
          //+ '<td width="10%">' '' + '</td>'
          //+ '<td width="10%">' + '<select class="form-control selectpicker"><option>Abc</option</select><option>Def</option</select>' + '</td>'
           .'<td width="10%">'.$row["product_id"]. '</td>'
           .'<td width="10%">'.$row["product_name"]. '</td>'
           .'<td width="10%">' . '<b class="product_type product_type">'.$row['typename'].'</b>' . '</td>'
           .'<td width="8%">' . '<input style="text-align: center;" type="number" name="carton[]" class="form-control carton carton'.$i.'" rowid="'.$i.'" value="'.$row['carton'].'" required >' . '</td>'
           .'<td width="8%">' . '<input style="text-align: center;" type="number" name="piece[]" class="form-control piece piece'.$i.'" rowid="'.$i.'" value="'.$row['piece'].'" required >' . '</td>'
           .'<td width="8%">' . '<input style="text-align: center;" type="text" name="purchase[]" class="form-control purchase  purchase'.$i.'" rowid="'.$i.'" value="'.$row['purchase'].'" required >' . '</td>'
           .'<td width="8%">' . '<input readonly="" type="text" name="subtotal[]" class="form-control subtotal  subtotal'.$i.'" value="'.$row['subtotal'].'" required >' . '</td>'
           
           .'<td dwidth="4%"><i class="fa fa-trash purchase_delete_btn deleterow" serial="'.$row['serial_no'].'" btnid="'.$i.'" style="cursor:pointer;"><i></td>'

           
           .'</tr>';
      }

      $value .="<tr>"
             ."<tr>"
              ."<td colspan='6' style='text-align:right; '><b>Invoice Total</b></td>"
              ."<td colspan='1' style='text-align: center;'><input type='hidden' name='addinvoice'><b class='wholetotal'>".$subtotal."</b></td>"
              ."<input type='hidden' name='addpurchase'>"
              ."</tr>";

    } 
  } 

  echo $value;
}

/*
!------------------------------------------------------------------------------------------
!          delete single row from tbl_invoice_products
!------------------------------------------------------------------------------------------
*/
if (isset($_POST['deleterowdata']) ) {
  $rowid        = $help->validAndEscape($_POST['rowid']);
   $stmt = $db->link->query("delete from tbl_invoice_products where serial_no='$rowid'")  or die($db->link->error). " error at line number ".__LINE__;
  if ($stmt) {
    echo 'yes';
  }else{
    echo 'no';
  }
}


?>



