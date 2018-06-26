<?php
include_once 'classes/DB.php';
include_once 'classes/Supplier.php';
include_once 'classes/Invoice.php';
include_once 'classes/Extra.php';
include_once 'classes/Customer.php';
include_once 'helper/Helper.php';
$sup = new Supplier();
$db = new Database();
$in = new Invoice();
$ext = new Extra();
$cus = new Customer();
$help = new Helper();


//sale management
//insert selling products ony be one to tbl_sell_products table for per customer
if(isset($_POST['action']) && isset($_POST['target']) && $_POST['target'] =='singleproductsavebeforesale'){
    $sell_id = $help->validAndEscape($_POST['sell_id']);
    $cus_id = $help->validAndEscape($_POST['cus_id']);
    $pro_id = $help->validAndEscape($_POST['pro_id']);
    $quantity = $help->validAndEscape($_POST['quantity']);
    $sale_price = $help->validAndEscape($_POST['sale_price']);
    $purchase_price = $help->validAndEscape($_POST['purchase_price']);
    $sub_total = $quantity * $sale_price;
    $check = $db->select("select * from tbl_sell_products WHERE product_id ='$pro_id' and sell_id ='$sell_id' and customer_id ='$cus_id'");
    if($pro_id == '0' || $pro_id == null){
        echo "select product first";
    }elseif($check){
        echo "already added";
    }else{
        $stmt = $db->insert("insert into tbl_sell_products(sell_id, customer_id, product_id, quantity, unit_price,purchase_price,subtotal) VALUES ('$sell_id','$cus_id','$pro_id','$quantity','$sale_price','$purchase_price','$sub_total')");
        if ($stmt){
            echo "added";
        }else{
            echo "not".mysqli_error($db->link);
        }

    }
}


//show selling products before payment to webpage
if(isset($_POST['action']) && isset($_POST['target']) && $_POST['target'] =='showallsaleproductsbeforesave'){
    $sell_id = $help->validAndEscape($_POST['sell_id']);
    $cus_id = $help->validAndEscape($_POST['cus_id']);

    $check = $db->select("SELECT  * FROM  tbl_sell_products,tbl_product,tbl_customer WHERE
                          tbl_sell_products.customer_id = '$cus_id' AND
                           tbl_sell_products.sell_id ='$sell_id' AND 
                           tbl_sell_products.product_id = tbl_product.product_id AND 
                           tbl_sell_products.customer_id = tbl_customer.customer_id AND
                             status = '0' ORDER by tbl_sell_products.serial_no DESC ");
    $val = "<tr>
                <th width=\"10%\">SL</th>
                <th width=\"10%\">Product ID</th>
                <th width=\"30%\">Name</th>
                <th width=\"15%\">Price</th>
                <th width=\"10%\">Quantity</th>
                <th width=\"10%\">Subtotal</th>
                <th width=\"15%\">Action</th>
            </tr>";
    $i = $total = 0;
    if($check){
        while ($row = $check->fetch_assoc()){
            $total += $row['subtotal'];
            $val .= "<tr>
                        <td>".++$i."</td>
                        <td>".$row['product_id']."</td>
                        <td>".$row['product_name']."</td>
                        <td style='text-align:center;'>".$row['unit_price']."</td>
                        <td>".$row['quantity']." </td>
                        <td>".$row['subtotal']."</td>
                       <td>
                            <i class=\"fa fa-trash delete_sale_product\" title=\"click to remove from sales list\" style=\"cursor: pointer\" invoice_id='".$row['sell_id']."' cus_id='".$row['customer_id']."' product_id='".$row['product_id']."'></i>
                        </td> 
                    </tr>";
        }

    }
    echo $val;
}

//for showing sale products subtotal
if (isset($_POST['target']) && $_POST['target']=='showsalesubtotal'){
    $sell_id = $_POST['sell_id'];
    $cus_id = $_POST['cus_id'];
    $stmt = $db->select("select * from tbl_sell_products WHERE customer_id = '$cus_id' AND sell_id = '$sell_id' and status ='0'");
   if($stmt)
   {
       $count = 0;
       while ($row = $stmt->fetch_assoc())
       {
           $count += $row['subtotal'];
       }
       echo $count;
   }else{
       echo 0;
   }
}

//delete single sale product from addinvoice.php(sell)
if (isset($_POST['invoice_id']) && isset($_POST['target']) && $_POST['target']=='deletesaleproduct'){
    $sell_id = $_POST['invoice_id'];
    $cus_id = $_POST['cus_id'];
    $pro_id = $_POST['pro_id'];
    $stmt = $db->delete("delete from tbl_sell_products WHERE sell_id='$sell_id' AND product_id='$pro_id' AND customer_id='$cus_id'");
    if($stmt)
    {
        echo "success";
    }
}


if (isset($_POST['action']) && $_POST['action'] == 'paycustomerdue') {
  $cus_id = $help->validAndEscape($_POST['cus_id']);
  $paid_amount = $help->validAndEscape($_POST['paid_amount']);

  $message = array();

  $stmt = $db->link->query("select due from tbl_customer where customer_id='$cus_id'");
  if($stmt){
    $data = $stmt->fetch_assoc();
    $present = $data['due']- $paid_amount;
    $stmt = $db->link->query("update tbl_customer set due ='$present' where customer_id='$cus_id'");

    $message['message'] = "Payment Updated Successfully";
    $stmt1 = $db->link->query("select due from tbl_customer where customer_id='$cus_id'");

    if($stmt1){
      $data = $stmt1->fetch_assoc();
      $message['update_amount'] = round($data['due']);
      $message['cus_id'] = $cus_id;
      $message['status'] = 1;
      echo json_encode($message);
    }
  }else{
    $message['message'] = "Failed To Update Payment";
    json_encode($message);
  }
 
  
}
