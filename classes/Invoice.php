<?php

$path = realpath(dirname(__DIR__));
include_once 'DB.php';
include_once 'Session.php';
include_once $path . '/helper/Helper.php';

class Invoice
{

    private $dbObj;
    private $helpObj;

    /*
    !-----------------------------------------------------
    !      initial load at the time of creating object
    !      no return job
    !----------------------------------------------------
    */
    public function __construct()
    {

        $this->dbObj = new Database();
        $this->helpObj = new Helper();
    }


    /*
    !-------------------------------------------------
    !           showing invoice list in the table     
    !-------------------------------------------------
    */
    public function showInvoices()
    {
        $query = "select * from tbl_invoice ti JOIN tbl_supplier ts on ti.supplier_id = ts.supplier_id order by ti.serial desc ";
        $st = $this->dbObj->select($query);
        if ($st) {
            return $st;
        } else {
            return false;
        }
    }


    /*
    !--------------------------------------------------------------------
    !           show product in invoice form by specific product id     
    !-------------------------------------------------------------------
    */
    public function showProductByID($product_id)
    {
        $query = "select * from tbl_product where product_id='$product_id'";
        $st = $this->dbObj->select($query);
        if ($st) {
            if ($st->num_rows > 0) {
                return $st->fetch_assoc();
            } else {
                return "No Product Found";
            }
        } else {
            return NULL;
        }
    }


    /*
    !----------------------------------------------------------
    !       save invoice data from purchase
    !       used table tbl_invoice, tbl_invoice_products     
    !---------------------------------------------------------
    */
    public function saveInvoice($data)
    {


        $inv_no1 = $this->helpObj->validAndEscape($data['invoice_no']);
        $supplier_id = $this->helpObj->validAndEscape($data['supplier_id']);
        $date = $this->helpObj->validAndEscape($data['date']);

        $quantity = $purchase = $subtotal = $total = 0;
        //for counting total data from a invoice form
        for ($i = 0; $i < count($data['quantity']); $i++) {
            $quantity += $data['quantity'][$i];
            $purchase += $data['purchase'][$i];
            $subtotal += $data['subtotalforsave'][$i];
            $total = $total + $data['subtotalforsave'][$i];
        }

        $check_query = "select * from tbl_invoice where invoice_number='$inv_no1'";
        $check_availibility = $this->dbObj->select($check_query);
        if ($check_availibility) {
            return "<p class='alert alert-warning fadeout'>Invoice Already Exist<p>";
        } else {

            //insert product is tbl_invoice_products
            for ($j = 0; $j < count($data['quantity']); $j++) {

                $pid = $data['product_id'][$j];
                $q = $data['quantity'][$j];
                $pur = $data['purchase'][$j];
                $subt = $data['subtotalforsave'][$j];
                $invoice_products_q = "insert into tbl_invoice_products(invoice_id,product_id,quantity,purchase,subtotal) values
                ('$inv_no1','$pid','$q','$pur','$subt')";
                $st = $this->dbObj->insert($invoice_products_q);
            }

            $totalInvoice_query = "insert into tbl_invoice(invoice_number,supplier_id,quantity,purchase,subtotal,total,date)"
                . "values('$inv_no1','$supplier_id','$quantity','$purchase','$subtotal','$total','$date')";
            $stmt = $this->dbObj->insert($totalInvoice_query);
            if ($stmt) {
                return "<p class='alert alert-success fadeout'>Data Insert Successful<p>";
            } else {
                return "<p class='alert alert-danger fadeout'>Data Insert Failed<p>";
            }
        }
    }


    /*
    !----------------------------------------------------------
    !                Update Invoice Data from 
    !                   editvoice.php     
    !---------------------------------------------------------
    */
    public function updateInvoice($data)
    {

        $inv_no = $this->helpObj->validAndEscape($data['invoice_number']);
        $supplier_id = $this->helpObj->validAndEscape($data['supplier_id']);
        $date = $this->helpObj->validAndEscape($data['date']);
        $inv_q = "select * from tbl_invoice where invoice_number='$inv_no'";
        $inv_stmt = $this->dbObj->select($inv_q);

        if (!$inv_stmt) {
            return "<p class='alert alert-danger fadeout'>Invoice Not Found<p>";
        } else {
            $quantity = $carton = $piece = $purchase = $subtotal = $total = 0;
            //for counting total data from a invoice form
            for ($i = 0; $i < count($data['quantity']); $i++) {
                $quantity += $data['quantity'][$i];

                $purchase += $data['purchase'][$i];
                $subtotal += $data['subtotalforsave'][$i];
                $total = $total + $data['subtotalforsave'][$i];
            }
            $inv_data = $inv_stmt->fetch_assoc();
            $inv_serial = $inv_data['serial'];
            $update_by = Session::get('userid');
            $updateInvoice_query = "update tbl_invoice set invoice_number='$inv_no',"
                . "supplier_id='$supplier_id',quantity='$quantity',"
                . "purchase='$purchase',"
                . "total='$total',date='$date',updateby='$update_by'"
                . "where serial = '$inv_serial'";
            $stmt = $this->dbObj->update($updateInvoice_query);
            if ($stmt) {
                for ($j = 0; $j <= count($data['quantity']) - 1; $j++) {
                    $serial_no = $data['serial_no'][$j];
                    $pid = $data['product_id'][$j];
                    $q = $data['quantity'][$j];
                    $pur = $data['purchase'][$j];
                    $subt = $data['subtotalforsave'][$j];

                    $query = "update tbl_invoice_products set product_id='$pid', quantity = '$q',purchase='$pur',subtotal='$subt' where serial_no='$serial_no'";

                    $stmt1 = $this->dbObj->link->query($query) or die($this->dbObj->link->error) . " at line no " . __LINE__;
                }
                if ($stmt1) {
                    return "<p class='alert alert-success fadeout'>Invoice Updated Successful<p>";
                } else {
                    return "<p class='alert alert-danger fadeout'>Invoice Updated Fail<p>";
                }
            }
        }
    }

    /*
    !----------------------------------------------------------
    !        get single invoice data for editpurchase.php  
    !---------------------------------------------------------
    */
    public function singleInvoice($inv_no)
    {
        $inv_no = $this->helpObj->validAndEscape($inv_no);
        $q = "select * from tbl_invoice where invoice_number ='$inv_no'";
        $st = $this->dbObj->select($q);
        if ($st) {
            return $st->fetch_assoc();
        }
    }

    /*
    !----------------------------------------------------------
    !        get all products for an invoice  
    !---------------------------------------------------------
    */
    public function getInvoiceProducts($inv_no)
    {
        $inv_no = $this->helpObj->validAndEscape($inv_no);
        $q = "select * from tbl_invoice_products tip ,tbl_product tp where tip.invoice_id ='$inv_no' and tp.product_id = tip.product_id order by tip.product_id";
        $st = $this->dbObj->select($q);
        if ($st) {
            return $st;
        } else {
            return false;
        }
    }

    /*
    !----------------------------------------------------------
    !        delete invoice and invoice products  
    !---------------------------------------------------------
    */
    public function deleteInvoice($serial, $invoice_id)
    {
        $serial = $this->helpObj->validAndEscape($serial);
        $invoice_id = $this->helpObj->validAndEscape($invoice_id);

        $delquery = "delete from tbl_invoice where invoice_number='$invoice_id'";
        $st = $this->dbObj->delete($delquery); //delete invoice 
        if ($st) {

            $in_pro_query = "delete from tbl_invoice_products where invoice_id='$invoice_id'";
            $in_pro_st = $this->dbObj->delete($in_pro_query); //delete invoice products
            if ($in_pro_st) {
                return true;
            } else {
                return false;
            }

        } else {
            return false;
        }

    }
}