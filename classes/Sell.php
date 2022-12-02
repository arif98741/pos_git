<?php
$path = realpath(dirname(__DIR__));
include_once 'DB.php';
include_once 'Session.php';
include_once $path . '/helper/Helper.php';

class Sell
{

    /**
     * @var
     */
    private $loginObj;
    /**
     * @var Database
     */
    private $dbObj;
    /**
     * @var Helper
     */
    private $helpObj;

    /**
     *
     */
    public function __construct()
    {
        $this->dbObj = new Database();
        $this->helpObj = new Helper();
    }

    /**
     * @param $data
     * @return string|void
     */
    public function storeSellProducts($data)
    {
        $sell_id = $this->helpObj->validAndEscape($data['sell_id']);
        $customer_id = $this->helpObj->validAndEscape($data['customer_id']);
        $pro_id = $this->helpObj->validAndEscape($data['product_id']);
        $pro_quantity = $this->helpObj->validAndEscape($data['product_quantity']);
        $pro_piece = $this->helpObj->validAndEscape($data['product_piece']);
        $unit_price = $this->helpObj->validAndEscape($data['unit_price']);
        $sub_total = $this->helpObj->validAndEscape($data['sub_total']);
        $check_q = "select * from tbl_sell_products where sell_id='$sell_id' and product_id='$pro_id' and customer_id='$customer_id' and status ='0'";
        $check_st = $this->dbObj->select($check_q);
        if ($check_st->num_rows < 1) {
            $store_pro_q = "INSERT INTO `tbl_sell_products` (sell_id,customer_id,product_id, quantity, product_piece, unit_price,subtotal) VALUES ('$sell_id','$customer_id','$pro_id', '$pro_quantity', '$pro_piece', '$unit_price','$sub_total')";
            $insert_st = $this->dbObj->insert($store_pro_q);
            if ($insert_st) {
                return '0';
            } else {
                return "1";
            }
        }
    }

    /**
     * @return bool|mysqli_result|null
     */
    public function showSellProducts()
    {
        $query = "select ts.date,ts.customer_id,ts.previous_balance,ts.sell_id,ts.serial,ts.due,ts.sub_total,ts.dlcharge,ts.discount,ts.vat,ts.payable,ts.paid,ts.due,tc.customer_name from tbl_sell ts JOIN tbl_customer tc on
        ts.customer_id = tc.customer_id order by ts.serial desc";

        $st = $this->dbObj->select($query);
        if ($st) {
            return $st;
        } else {
            return null;
        }
    }

    /**
     * @param $pro_id
     * @param $sell_id
     * @return bool
     */
    public function deleteSingleProduct($pro_id, $sell_id)
    {
        $del_query = "delete from tbl_sell_products where product_id='$pro_id' and sell_id='$sell_id' and status='0'";
        $del_st = $this->dbObj->delete($del_query);
        if ($del_st) {
            return true;
        } else {
            return false;
        }
    }

    //for calculation and getting total amount of sell products for a specific customer

    /**
     * @param $data
     * @return int|mixed|void
     */
    public function getTotal($data)
    {
        $customer_id = $this->helpObj->validAndEscape($data['customer_id']);
        $sell_id = $this->helpObj->validAndEscape($data['sell_id']);
        $tq = "select * from tbl_sell_products where status='0' and customer_id='$customer_id' && sell_id='$sell_id'";
        $stmt = $this->dbObj->select($tq);
        if ($stmt) {
            $total = 0;
            while ($r = $stmt->fetch_assoc()) {
                $total += $r['subtotal'];
            }
            return $total;
        }
    }


    /**
     * @param $data
     * @return string|void
     */
    public function saveSaleInvoice($data)
    {
        $customer_balance = $this->helpObj->validAndEscape($data['balance']);
        $sell_subtotal = $this->helpObj->validAndEscape($data['sell_subtotal']);
        //$sell_discount = $this->helpObj->validAndEscape($data['sell_discount']);
        $sell_grandtotal = $this->helpObj->validAndEscape($data['sell_grand_total']);
        $sell_paid = $this->helpObj->validAndEscape($data['sell_paid']);
        $sell_due = $this->helpObj->validAndEscape($data['sell_due']);
        $sell_id = $this->helpObj->validAndEscape($data['sell_id']);
        $customer_id = $this->helpObj->validAndEscape($data['customer_id']);
        $seller = Session::get('userid');

        $check_sell_q = "select * from tbl_sell where sell_id='$sell_id'";
        $check_sell_st = $this->dbObj->select($check_sell_q);
        if ($check_sell_st) {
            if ($check_sell_st->num_rows > 0) {
                return '<p class="alert alert-danger fadeout">There is a invoice with same id. Please give another invoice id</p>';
            }
        } else {
            $tbl_sell_insert_q = "insert into tbl_sell(sell_id,customer_id,seller,sub_total,grand_total,paid,due,updateby) values('$sell_id','$customer_id','$seller','$sell_subtotal','$sell_grandtotal','$sell_paid','$sell_due','$seller')";
            $tbl_sell_insert_st = $this->dbObj->insert($tbl_sell_insert_q);
            if ($tbl_sell_insert_st) {
                return '<p class="alert alert-success fadeout">Products Added</p>';
            } else {
                return '<p class="alert alert-danger fadeout">Products Not Added</p>';
            }
        }
    }

    //show sales list in viewsales.php

    /**
     * @return bool|mysqli_result
     */
    public function showSalesList()
    {
        $st = $this->dbObj->select("SELECT * FROM tbl_sell,tbl_customer WHERE tbl_sell.customer_id = tbl_customer.customer_id order by tbl_sell.serial DESC");
        if ($st) {
            return $st;
        } else {
            return false;
        }
    }

    //delelte sales

    /**
     * @param $serial
     * @param $sell_id
     * @return bool|void
     */
    public function deleteSale($serial, $sell_id)
    {
        $serial = $this->helpObj->validAndEscape($serial);
        $sell_id = $this->helpObj->validAndEscape($sell_id);

        $deleteQuery = "delete from tbl_sell where sell_id='$sell_id'";
        $st = $this->dbObj->delete($deleteQuery);
        if ($st) {
            $in_pro_query = "select * from tbl_sell_products where sell_id='$sell_id' and status = '1'";
            $in_pro_st = $this->dbObj->select($in_pro_query); //delete invoice 
            if ($in_pro_st) {
                $in_pro_del_q = "delete from tbl_sell_products where sell_id='$sell_id'";
                $sell_products_st = $this->dbObj->delete($in_pro_del_q);
                if ($sell_products_st) {
                    return true;
                }
            }
            return false;
        }
    }

    /**
     * @param $sell_id
     * @return bool|mysqli_result
     */
    public function showSoldProduct($sell_id)
    {
        $sell_id = $this->helpObj->validAndEscape($sell_id);
        $query = "SELECT * FROM tbl_sell_products,tbl_sell,tbl_product where tbl_sell_products.sell_id = tbl_sell.sell_id and tbl_sell_products.product_id = tbl_product.product_id AND tbl_sell.sell_id ='$sell_id' and tbl_sell_products.status = '0'  ORDER by tbl_sell_products.serial_no DESC";
        $stmt = $this->dbObj->select($query);
        if ($stmt) {
            $update_q = "UPDATE tbl_sell_products SET status = '0' WHERE tbl_sell_products.sell_id = '$sell_id'";
            $this->dbObj->update($update_q);
            return $stmt;
        } else {
            return false;
        }
    }

    /**
     * @param $product_id
     * @return bool|mysqli_result|null
     */
    public function getsingleProduct($product_id)
    {
        $product_id = $this->helpObj->validAndEscape($product_id);
        $query = "select * from tbl_product where serial='$product_id'";
        return $this->dbObj->select($query);
    }

    /**
     * @param $sell_id
     * @return array|false|null
     */
    public function singleSale($sell_id)
    {
        $sell_id = $this->helpObj->validAndEscape($sell_id);
        $query = "select * from tbl_sell where sell_id='$sell_id'";
        $st = $this->dbObj->select($query);
        if ($st) {
            return $st->fetch_assoc();
        } else {
            return false;
        }
    }

    //get sold products for showing in editing table in editsale.php

    /**
     * @param $sell_id
     * @return bool|mysqli_result
     */
    public function getSellProducts($sell_id)
    {
        $query = "SELECT * from tbl_sell,tbl_sell_products,tbl_customer,tbl_group,tbl_product,tbl_type WHERE 
                    tbl_sell.sell_id = tbl_sell_products.sell_id and
                    tbl_sell.customer_id = tbl_customer.customer_id AND
                    tbl_sell_products.product_id = tbl_product.product_id AND
                    tbl_product.product_type = tbl_type.typeid AND
                    tbl_product.product_group = tbl_group.groupid  AND
                    tbl_sell.sell_id='$sell_id'    AND tbl_sell_products.status='1'";

        $st = $this->dbObj->select($query);
        if ($st) {
            return $st;
        } else {
            return false;
        }
    }

    /**
     * @param $sell_id
     * @return void
     */
    public function showtotalprobysellid($sell_id)
    {
        $sell_id = $this->helpObj->validAndEscape($sell_id);
        $row = $db->link->query("SELECT sum(quantity) as 'totalproduct',tbl_sell.date from tbl_sell_products tsp JOIN tbl_sell ON
              tsp.sell_id = tbl_sell.sell_id WHERE
              tsp.sell_id ='$sell_id' and tsp.status='1'")->fetch_assoc();
        echo $row['totalproduct'];
    }


    /*
    * show user balance list from tbl_sell, tbl_customer in balancelist.php
    */
    /**
     * @return bool|mysqli_result
     */
    public function showbalancelist()
    {

        $stmt = $this->dbObj->link->query("select distinct ts.sell_id,ts.customer_id,ts.grand_total,ts.paid,tc.customer_name,ts.date from tbl_sell ts join tbl_customer tc on 
            ts.customer_id = tc.customer_id order by ts.serial desc limit 1");
        if ($stmt) {
            return $stmt;
        } else {
            return false;
        }
    }


    /**
     * @return bool|mysqli_result
     */
    public function showduelist()
    {

        $stmt = $this->dbObj->link->query("select ts.sell_id,ts.customer_id,ts.grand_total,ts.paid,tc.customer_name,ts.due,tc.contact_no,ts.date,tc.address from tbl_sell ts join tbl_customer tc on 
            ts.customer_id = tc.customer_id order by ts.serial desc limit 1");
        if ($stmt) {
            return $stmt;
        } else {
            return false;
        }
    }


    /**
     * @return bool|mysqli_result
     */
    public function showProfitlist()
    {
        $stmt = $this->dbObj->link->query("select distinct * from tbl_sell");
        if ($stmt) {
            return $stmt;
        } else {
            return false;
        }
    }


    /**
     * @param $invoice_id
     * @return float|int|void
     */
    public function profit($invoice_id)
    {
        $query = "select tsp.quantity, sum( tsp.unit_price) as 'sale', sum(tsp.purchase_price) as 'purchase' from tbl_sell_products tsp WHERE sell_id='$invoice_id' and status ='1' GROUP by sell_id";

        $stmt = $this->dbObj->link->query($query);
        if ($stmt) {
            $data = $stmt->fetch_assoc();
            $profit = $data['sale'] * $data['quantity'] - $data['purchase'] * $data['quantity'];
            return $profit;
        }

    }


    //show profit by product id

    /**
     * @param $invoice_id
     * @param $product_id
     * @return float|int|void
     */
    public function profitByProduct($invoice_id, $product_id)
    {
        $query = "SELECT
                    tsp.quantity,
                    SUM(tsp.unit_price) AS 'sale',
                    SUM(tsp.purchase_price) AS 'purchase'
                FROM tbl_sell_products tsp WHERE
                    sell_id = '$invoice_id' AND product_id = '$product_id' AND
                STATUS = '1' GROUP BY sell_id";

        $stmt = $this->dbObj->link->query($query);
        if ($stmt) {
            $data = $stmt->fetch_assoc();
            return $data['sale'] * $data['quantity'] - $data['purchase'] * $data['quantity'];
        }


    }


    //update sales in editsales.php

    /**
     * @param $data
     * @return bool|void
     */
    public function updateInvoice($data)
    {
        $sell_id = $this->helpObj->validAndEscape($data['sell_id']);
        $cus_id = $this->helpObj->validAndEscape($data['cus_id']);
        $discount = $this->helpObj->validAndEscape($data['discount']);
        $payable = $this->helpObj->validAndEscape($data['payable']);
        $sub_total = $this->helpObj->validAndEscape($data['payable']);

        $updateby = Session::get('userid');

        $dlcharge = $this->helpObj->validAndEscape($data['dlcharge']);
        $vat = $this->helpObj->validAndEscape($data['vat']);
        $paid = $this->helpObj->validAndEscape($data['paid']);
        $due = $this->helpObj->validAndEscape($data['due']);


        $q = "update tbl_sell set customer_id='$cus_id',sub_total='$sub_total',dlcharge='$dlcharge',discount='$discount',vat='$vat',paid='$paid',payable='$payable',due='$due',updateby='$updateby' where sell_id='$sell_id'";

        $stmt = $this->dbObj->link->query($q) or die($this->dbObj->link->error);
        if ($stmt) {

            for ($i = 0; $i < count($data['product_id']); $i++) {

                $serial = $data['serial_no'][$i];
                $pro_id = $data['product_id'][$i];
                $unit_price = $data['price'][$i];
                $quantity = $data['quantity'][$i];
                $subtotal = $data['subtotal'][$i];
                $query = "update tbl_sell_products set customer_id='$cus_id',product_id='$pro_id',quantity='$quantity',unit_price='$unit_price',subtotal='$subtotal' where serial_no ='$serial'";
                $this->dbObj->link->query($query) or die($this->dbObj->link->error);
            }

            return true;
        }
    }


}
