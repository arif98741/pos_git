<?php

include_once 'DB.php';
include_once 'Session.php';
include_once 'helper/Helper.php';

class Stock
{

    private $loginObj;
    private $dbObj;
    private $helpObj;

    public function __construct()
    {
        $this->loginObj = new Helper();
        $this->dbObj = new Database();
        $this->helpObj = new Helper();
    }


    public function getstocklist()
    {
        $query = "SELECT * from stock LEFT JOIN tbl_product ON stock.product_id = tbl_product.product_id INNER JOIN tbl_group ON tbl_product.product_group = tbl_group.groupid";
        $stmt = $this->dbObj->select($query);
        return $stmt;
    }


    public function tempstock()
    {
        $query = "SELECT * from stock LEFT JOIN tbl_product ON stock.product_id = tbl_product.product_id  JOIN tbl_group ON tbl_product.product_group = tbl_group.groupid";
        $stmt = $this->dbObj->select($query);
        return $stmt;
    }


    public function instock($product_id)
    {

        $q1 = "SELECT sum(tip.quantity) as 'totalpurchaseproduct' from tbl_invoice_products tip WHERE product_id ='$product_id' ";
        $q2 = "SELECT sum(tsp.quantity) as 'totalsoldproduct' from tbl_sell_products tsp WHERE product_id ='$product_id' where tis.status='1'";
        $purchase_stmt = $this->dbObj->select($q1);
        if ($purchase_stmt) {
            $sell_stmt = $this->dbObj->select($q2);
            if ($sell_stmt) {
                return 'hi';
            } else {
                return '0';
            }
            //return $purchase_stmt->fetch_assoc()['totalpurchaseproduct'];
            // return $sell_stmt;
        }


    }


    public function lastsell($product_id)
    {
        $query = "SELECT quantity FROM tbl_sell_products where product_id ='$product_id' order by serial_no DESC LIMIT 1";
        $stmt = $this->dbObj->select($query);
        if ($stmt) {
            return $stmt->fetch_assoc()['quantity'];
        } else {
            return 0;
        }

    }


}
