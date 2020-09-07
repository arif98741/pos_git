<?php
$path = realpath(dirname(__DIR__));

include_once 'Database.php';
include_once $path . '/helper/Helper.php';

class Dashboard
{

    private $dbObj;
    private $helpObj;

    public function __construct()
    {

        $this->dbObj = new Database();
        $this->helpObj = new Helper();

    }


    /*
    !--------------------------------------
    !               Today's Sale
    !-------------------------------------
    */
    public function TodaySale()
    {
        date_default_timezone_set('Asia/Dhaka');
        $starting = date('Y-m-d') . " 00:00:00";
        $ending = date('Y-m-d') . " 23:59:59";

        $query = "SELECT sum(sub_total) as 'subtotal' from tbl_sell ts where ts.date between '$starting' and '$ending'";
        $st = $this->dbObj->select($query);
        if ($st) {
            $subtotal = $st->fetch_object()->subtotal;
            if ($subtotal > 0) {

                return number_format((float)$subtotal, 2, '.', '');
            } else {
                return 0;
            }
        }
    }


    /*
    !--------------------------------------
    !               Today Sales Amout
    !-------------------------------------
    */
    public function TodayMemo()
    {
        $starting = date('Y-m-d') . " 00:00:00";
        $ending = date('Y-m-d') . " 23:59:59";

        $query = "SELECT count(sell_id) as 'totalsell' from tbl_sell where date between '$starting' and '$ending'";
        $st = $this->dbObj->select($query);
        if ($st) {
            return $st->fetch_object()->totalsell;
        } else {
            return 0;
        }
    }

    /*
    !----------------------------------
    !           Total Sales Amout
    !----------------------------------
    */
    public function TotalMemo()
    {
        $query = "SELECT count(sell_id) as 'totalsell' from tbl_sell";
        $st = $this->dbObj->select($query);
        if ($st) {
            return $st->fetch_object()->totalsell;
        } else {
            return 0;
        }
    }


    /*
    !----------------------------------
    !         Total Purchase
    !----------------------------------
    */
    public function totalPurchase()
    {
        $query = "SELECT count(serial) as 'totalinvoice' from tbl_invoice";
        $st = $this->dbObj->select($query);
        if ($st) {
            return $st->fetch_object()->totalinvoice;
        } else {
            return 0;
        }
    }


    // Total Customer
    public function TodayCustomer()
    {
        $starting = date('Y-m-d') . " 00:00:00";
        $ending = date('Y-m-d') . " 23:59:59";
        $query = "SELECT count(serial) as 'totalcustomer' from tbl_customer";
        $st = $this->dbObj->select($query);
        if ($st) {
            return $st->fetch_object()->totalcustomer;
        } else {
            return 0;
        }

    }


    // Total Profit
    public function TodayProfit()
    {
        $starting = date('Y-m-d') . " 00:00:00";
        $ending = date('Y-m-d') . " 23:59:59";
        $query = "select sum(profit) as 'profit' from profit where profit.date between '$starting' and '$ending'";

        $stmt = $this->dbObj->link->query($query);
        $profit = 0;
        if ($stmt) {
            $data = $stmt->fetch_assoc();
            $profit = $data['profit'];
            if ($profit > 0) {
                return number_format((float)$profit, 2, '.', '');
            } else {
                return 0;
            }
        }


    }

    // Total Due
    public function TotalDue()
    {

        $query = "select sum(balance) as 'totaldue' from customer_balance";
        $st = $this->dbObj->link->query($query);
        if ($st) {
            $totaldue = $st->fetch_object()->totaldue;
            if ($totaldue > 0 || $totaldue < 0) {

                return number_format((float)$totaldue, 2, '.', '');
            } else {
                return 0;
            }
        }

    }

    // Total Products
    public function totalProducts()
    {

        $query = "select count(product_id) as 'total' from tbl_product";
        $st = $this->dbObj->link->query($query);
        if ($st) {
            $total = $st->fetch_object()->total;
            if ($total > 0 || $total < 0) {

                return $total;
            } else {
                return 0;
            }
        }

    }


    // Total Customer
    public function totalCustomers()
    {

        $query = "select count(customer_id) as 'total' from tbl_customer";
        $st = $this->dbObj->link->query($query);
        if ($st) {
            $total = $st->fetch_object()->total;
            if ($total > 0 || $total < 0) {

                return $total;
            } else {
                return 0;
            }
        }

    }


    // Total Supplier
    public function totalSuppliers()
    {

        $query = "select count(supplier_id) as 'total' from tbl_supplier";
        $st = $this->dbObj->link->query($query);
        if ($st) {
            $total = $st->fetch_object()->total;
            if ($total > 0 || $total < 0) {

                return $total;
            } else {
                return 0;
            }
        }

    }


}