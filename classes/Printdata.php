<?php

$path = realpath(dirname(__DIR__));
include_once "DB.php";
include_once $path . '/helper/Helper.php';

class Printdata
{

    private $helpObj;
    private $dbObj;
    private $table_content;

    function __construct()
    {
        $this->helpObj = new Helper();
        $this->dbObj = new Database();
    }

    /*
     * Total Products Function
     * */

    public function TotalProducts($query)
    {
        $st = $this->dbObj->select($query);
        if ($st) {
            if ($st->num_rows > 0) {
                return $st->num_rows;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

    /*
     * Conditional Query For Page Print page
     */

    public function PageTitleByCondition($query)
    {

        $st = $this->dbObj->select($query);
        if ($st) {
            if ($st->num_rows > 0) {
                return $st->fetch_assoc();
            } else {
                return false;
            }
        }
    }

    /*
     * All Products report in printfiles/product/print.php
     */

    public function ProductReportbyAll()
    {

        $this->table_content = "
            <tbody style='text-align:center;'>
             <tr>
                  <th>Serial</th>  
                  <th>Product ID</th>  
                  <th>Group</th>  
                  <th>Product Name</th>  
                  <th>Supplier</th>  
                  <th>Unit</th>  
                  <th>Purchase Price</th>   
                  <th>Sales Price</th>   
            </tr>
            </tbody>";

        $q = "SELECT
                    *
                FROM
                    tbl_product tp
                JOIN tbl_group tg ON
                    tp.product_group = tg.groupid
                JOIN tbl_type tt ON
                    tp.product_type = tt.typeid
                JOIN tbl_supplier ts ON
                    tp.product_brand = ts.supplier_id
                    ORDER by tp.product_name ASC";

        $stmt = $this->dbObj->select($q);
        if ($stmt) {
            $i = 0;
            while ($row = $stmt->fetch_assoc()) {
                $i++;
                $this->table_content .= "<tr>"
                    . "<td style='text-align:center;'>" . $i . "</td>"
                    . "<td>" . $row['product_id'] . "</td>"
                    . "<td>" . $row['groupname'] . "</td>"
                    . "<td>" . $row['product_name'] . "</td>"
                    . "<td>" . $row['supplier_name'] . "</td>"
                    . "<td>" . $row['typename'] . "</td>"
                    . "<td  style='text-align:center;'>" . $row['purchase_price'] . "</td>"
                    . "<td  style='text-align:center;'>" . $row['sale_price'] . "</td>";
            }
            return $this->table_content;

        }
    }

    /**
     * Products report by Group
     */
    public function ProductReportbyGroup($data)
    {
        $group = $data['product_group'];


        $this->table_content = "
            <tbody>
            <tr>
                  <th>Serial</th>  
                  <th>Product ID</th> 
                  <th>Product Name</th>  
                  <th>Supplier</th>  
                  <th>Unit</th>  
                  <th>Purchase Price</th>   
                  <th>Sales Price</th>   
            </tr>
            </tbody> ";
        $q = "SELECT
            *
        FROM
            tbl_product tp
        JOIN tbl_group tg ON
            tp.product_group = tg.groupid
        JOIN tbl_type tt ON
            tp.product_type = tt.typeid
        JOIN tbl_supplier ts ON
            tp.product_brand = ts.supplier_id
            WHERE tg.groupid ='$group'
            ORDER by tp.product_name ASC";
        $stmt = $this->dbObj->select($q);
        if ($stmt) {
            $i = 0;
            while ($row = $stmt->fetch_assoc()) {
                $i++;
                $this->table_content .= "<tr>"
                    . "<td style='text-align:center;'>" . $i . "</td>"
                    . "<td>" . $row['product_id'] . "</td>"
                    . "<td>" . $row['product_name'] . "</td>"
                    . "<td>" . $row['supplier_name'] . "</td>"
                    . "<td>" . $row['typename'] . "</td>"
                    . "<td  style='text-align:center;'>" . $row['purchase_price'] . "</td>"
                    . "<td  style='text-align:center;'>" . $row['sale_price'] . "</td>";
            }
            return $this->table_content;
        } else {
            return false;
        }
    }

    /*
     * Product Report by Type
     * */

    public function ProductReportbyType($data)
    {
        $type = $data['product_type'];

        $this->table_content = "
            <tbody>
             <tr>
                  <th>Serial</th>  
                  <th>Product ID</th>  
                  <th>Group</th>  
                  <th>Product Name</th>  
                  <th>Supplier</th>  
                  <th>Unit</th>  
                  <th>Purchase Price</th>   
                  <th>Sales Price</th>   
            </tr>
            </tbody> ";

        $q = "SELECT
                *
            FROM
                tbl_product tp
            JOIN tbl_group tg ON
                tp.product_group = tg.groupid
            JOIN tbl_type tt ON
                tp.product_type = tt.typeid
            JOIN tbl_supplier ts ON
                tp.product_brand = ts.supplier_id
            WHERE
                tt.typeid = '$type'
            ORDER BY
                tp.product_name ASC";
        $stmt = $this->dbObj->select($q);
        if ($stmt) {
            $i = 0;
            while ($row = $stmt->fetch_assoc()) {
                $i++;
                $this->table_content .= "<tr>"
                    . "<td style='text-align:center;'>" . $i . "</td>"
                    . "<td>" . $row['product_id'] . "</td>"
                    . "<td>" . $row['groupname'] . "</td>"
                    . "<td>" . $row['product_name'] . "</td>"
                    . "<td>" . $row['supplier_name'] . "</td>"
                    . "<td>" . $row['typename'] . "</td>"
                    . "<td  style='text-align:center;'>" . $row['purchase_price'] . "</td>"
                    . "<td  style='text-align:center;'>" . $row['sale_price'] . "</td>";
            }
            return $this->table_content;
        } else {
            return false;
        }
    }

    /**
     * Product Report by Brand
     */
    public function ProductReportbyBrand($data)
    {
        $supplier = $data['supplier_id'];

        $this->table_content = "
            <tbody>
             <tr>
                  <th>Serial</th>  
                  <th>Product ID</th>  
                  <th>Group</th>  
                  <th>Product Name</th>  
                  <th>Unit</th>  
                  <th>Purchase Price</th>   
                  <th>Sales Price</th>    
            </tr>
            </tbody> ";
        $q = "SELECT
                *
            FROM
                tbl_product tp
            JOIN tbl_group tg ON
                tp.product_group = tg.groupid
            JOIN tbl_type tt ON
                tp.product_type = tt.typeid
            JOIN tbl_supplier ts ON
                tp.product_brand = ts.supplier_id
            WHERE
                ts.supplier_id = '$supplier'
            ORDER BY
                tp.product_name ASC";
        $stmt = $this->dbObj->select($q);
        if ($stmt) {
            $i = 0;
            while ($row = $stmt->fetch_assoc()) {
                $i++;
                $this->table_content .= "<tr>"
                    . "<td style='text-align:center;'>" . $i . "</td>"
                    . "<td>" . $row['product_id'] . "</td>"
                    . "<td>" . $row['groupname'] . "</td>"
                    . "<td>" . $row['product_name'] . "</td>"
                    . "<td>" . $row['typename'] . "</td>"
                    . "<td  style='text-align:center;'>" . $row['purchase_price'] . "</td>"
                    . "<td  style='text-align:center;'>" . $row['sale_price'] . "</td>";
            }
            return $this->table_content;
        }
    }


    /*
     * Supplier List Report by ALl
     */

    public function SupplierReportByAll()
    {
        $stmt = $this->dbObj->select("select * from tbl_supplier ORDER  by tbl_supplier.supplier_name ASC ");
        if ($stmt) {
            if ($stmt->num_rows > 0) {
                return $stmt;
            } else {
                return false;
            }
        }
    }

    /*
     * Customer List Report By All
     * */

    public function CustomerReportByAll()
    {
        $stmt = $this->dbObj->select("SELECT * FROM tbl_customer tc JOIN customer_balance cb ON tc.customer_id = cb.customer_id ORDER BY tc.customer_name ASC");
        if ($stmt) {
            if ($stmt->num_rows > 0) {
                return $stmt;
            } else {
                return false;
            }
        }
    }

    /*
     * All Sells Report For Invoice in invoice_report.php 
     * */

    public function SellReportForinvoice($starting, $ending)
    {

        $starting = $starting . " 00:00:00";
        $ending = $ending . " 23:59:59";

        $stmt = $this->dbObj->select("select distinct ts.*, tc.customer_name,tc.customer_id from tbl_sell ts join tbl_customer  tc on ts.customer_id = tc.customer_id where ts.date between  '$starting' and '$ending' order by ts.serial desc
            ");

        if ($stmt) {
            $i = 0;
            $sub_total = $previous_balance = $discount = $dlcharge = $vat = $payable = $paid = $due = 0;

            while ($row = $stmt->fetch_assoc()) {
                $i++;
                $payable += round($row['payable']);
                $sub_total += round($row['sub_total']);
                $paid += round($row['paid']);
                $dlcharge += round($row['dlcharge']);
                $vat += round($row['vat']);
                $previous_balance += round($row['previous_balance']);
                $discount += round($row['discount']);
                $due += round($row['due']);
                $this->table_content .= "<tr>"
                    . "<td >" . $this->helpObj->formatDate($row['date'], 'd-m-Y')
                    . "<td>" . $row['sell_id'] . "</td>"
                    . "<td style='text-align:left;'>" . $row['customer_name'] . "</td>"
                    . "<td>" . round($row['sub_total']) . "</td>"
                    . "<td>" . round($row['discount']) . "</td>"
                    . "<td>" . round($row['dlcharge']) . "</td>"
                    . "<td>" . round($row['vat']) . "</td>"
                    . "<td>" . round($row['previous_balance']) . "</td>"
                    . "<td>" . round($row['payable']) . "</td>"
                    . "<td>" . round($row['paid']) . "</td>"
                    . "<td>" . round($row['due']) . "</td>";
            }

            $this->table_content .= "<tr>"
                . "<td colspan=''></td>"
                . "<td colspan='2'><strong>Total Amount</strong></td>"
                . "<td><strong>" . $sub_total . "</strong></td>"
                . "<td><strong>" . $discount . "</strong></td>"
                . "<td ><strong>" . $dlcharge . "</strong></td>"
                . "<td ><strong>" . $vat . "</strong></td>"
                . "<td ><strong>" . $previous_balance . "</strong></td>"
                . "<td ><strong>" . $payable . "</strong></td>"
                . "<td ><strong>" . $paid . "</strong></td>"
                . "<td ><strong>" . round($due) . "</strong></td>";

            return $this->table_content;

        }

    }


    /*
     * Sells Report For Invoice in invoice_report.php by Customer
     * */

    public function SellReportForinvoiceByCustomer($starting, $ending, $customer_id)
    {

        $starting = $starting . " 00:00:00";
        $ending = $ending . " 23:59:59";

        $stmt = $this->dbObj->select("select ts.*, tc.customer_name,tc.customer_id from tbl_sell ts join tbl_customer  tc on ts.customer_id = tc.customer_id where ts.customer_id ='$customer_id' and ts.date between  '$starting' and '$ending' order by ts.serial desc
            ");

        if ($stmt) {
            $i = 0;
            $sub_total = $previous_balance = $discount = $dlcharge = $vat = $payable = $paid = $due = 0;

            while ($row = $stmt->fetch_assoc()) {
                $i++;
                $payable += round($row['payable']);
                $sub_total += round($row['sub_total']);
                $paid += round($row['paid']);
                $dlcharge += round($row['dlcharge']);
                $vat += round($row['vat']);
                $previous_balance += round($row['previous_balance']);
                $discount += round($row['discount']);
                $due += round($row['due']);
                $this->table_content .= "<tr>"
                    . "<td >" . $this->helpObj->formatDate($row['date'], 'd-m-Y')
                    . "<td>" . $row['sell_id'] . "</td>"
                    . "<td>" . round($row['sub_total']) . "</td>"
                    . "<td>" . round($row['discount']) . "</td>"
                    . "<td>" . round($row['dlcharge']) . "</td>"
                    . "<td>" . round($row['vat']) . "</td>"

                    . "<td>" . round($row['previous_balance']) . "</td>"
                    . "<td>" . round($row['payable']) . "</td>"
                    . "<td>" . round($row['paid']) . "</td>"
                    . "<td>" . round($row['due']) . "</td>";
            }

            $this->table_content .= "<tr>"
                . "<td></td>"
                . "<td colspan='1'><strong>Total Amount</strong></td>"
                . "<td><strong>" . $sub_total . "</strong></td>"
                . "<td ><strong>" . $discount . "</strong></td>"
                . "<td ><strong>" . $dlcharge . "</strong></td>"
                . "<td ><strong>" . $vat . "</strong></td>"
                . "<td ><strong>" . $previous_balance . "</strong></td>"
                . "<td ><strong>" . $payable . "</strong></td>"
                . "<td ><strong>" . $paid . "</strong></td>"
                . "<td colspan=''><strong>" . round($due) . "</strong></td>";

            return $this->table_content;

        }

    }


    /*
     * All Purchase Report For Invoice in purchasereport.php 
     * */

    public function ShowAllPurchase($starting, $ending)
    {

        $starting = $starting . " 00:00:00";
        $ending = $ending . " 23:59:59";

        //$stmt = $this->dbObj->select("SELECT ti.invoice_number, tg.groupname, tp.product_name, tss.supplier_name, tp.purchase_price, ti.quantity, ti.subtotal, ti.date FROM tbl_invoice ti JOIN tbl_invoice_products tip ON ti.invoice_number = tip.invoice_id JOIN tbl_product tp ON tip.product_id = tp.product_id JOIN tbl_supplier tss ON tp.product_brand = tss.supplier_id JOIN tbl_group tg ON tp.product_group = tg.groupid WHERE ti.date BETWEEN '$starting' AND '$ending' GROUP BY (ti.serial) order by ti.date asc");

        $stmt = $this->dbObj->select("SELECT ti.invoice_number, tip.product_id, tg.groupname, tp.product_name, tu.supplier_name, tip.purchase as 'purchase_price', tip.quantity, tip.subtotal, ti.date FROM tbl_invoice_products tip JOIN tbl_invoice ti ON tip.invoice_id = ti.invoice_number JOIN tbl_product tp ON tip.product_id = tp.product_id JOIN tbl_group tg ON tp.product_group = tg.groupid JOIN tbl_supplier tu ON tp.product_brand = tu.supplier_id WHERE ti.date BETWEEN '$starting' AND '$ending' GROUP BY tip.product_id ORDER BY ti.date asc");


        $total = 0;
        if ($stmt) {
            $i = 0;

            while ($row = $stmt->fetch_assoc()) {
                $i++;
                $total += $row['subtotal'];
                $this->table_content .= "<tr>"
                    . "<td style='text-align: center;'>" . $i . "</td>"
                    . "<td style='text-align: center;'>" . $row['invoice_number'] . "</td>"
                    . "<td>" . $row['groupname'] . "</td>"
                    . "<td>" . $row['product_name'] . "</td>"
                    . "<td>" . $row['supplier_name'] . "</td>"
                    . "<td style='text-align: center;'>" . $row['purchase_price'] . "</td>"
                    . "<td style='text-align: center;'>" . $row['quantity'] . "</td>"
                    . "<td style='text-align: center;'>" . $row['subtotal'] . "</td>"
                    . "<td style='text-align: center;'>" . $this->helpObj->formatDate($row['date'], 'd-m-Y') . "</td>";
            }

            $this->table_content .= "<tr>"
                . "<td colspan='5' style='text-align: center;'><strong>Total Amount</strong></td>"

                . "<td></td>"

                . "<td colspan='3' style='text-align: center;'><strong>" . $total . "</strong></td>";

            return $this->table_content;
            //return $stmt;                    

        }


    }


    /*
     * All purchase by group
     * */

    public function ShowPurchaseByGroup($starting, $ending, $groupid)
    {

        $starting = $starting . " 00:00:00";
        $ending = $ending . " 23:59:59";

        /*$stmt = $this->dbObj->select("SELECT DISTINCT ti.invoice_number, tg.groupname, tp.product_name, tss.supplier_name, ti.quantity, ti.subtotal, ti.date FROM tbl_invoice ti JOIN tbl_invoice_products tip ON ti.invoice_number = tip.invoice_id JOIN tbl_product tp ON tip.product_id = tp.product_id JOIN tbl_supplier tss ON tp.product_brand = tss.supplier_id JOIN tbl_group tg ON tp.product_group = tg.groupid WHERE tg.groupid = '$groupid' and
                     ti.date BETWEEN '$starting' AND '$ending' GROUP BY (ti.serial) order by ti.date asc");*/


        $stmt = $this->dbObj->select("SELECT ti.invoice_number, tip.product_id, tg.groupname, tp.product_name, tu.supplier_name, tip.purchase as 'purchase_price', tip.quantity, tip.subtotal, ti.date FROM tbl_invoice_products tip JOIN tbl_invoice ti ON tip.invoice_id = ti.invoice_number JOIN tbl_product tp ON tip.product_id = tp.product_id JOIN tbl_group tg ON tp.product_group = tg.groupid JOIN tbl_supplier tu ON tp.product_brand = tu.supplier_id WHERE tg.groupid = '$groupid' and ti.date BETWEEN '$starting' AND '$ending' GROUP BY tip.product_id ORDER BY ti.date asc");


        $total = 0;
        if ($stmt) {
            $i = 0;

            while ($row = $stmt->fetch_assoc()) {
                $i++;
                $total += $row['subtotal'];
                $this->table_content .= "<tr>"
                    . "<td  style='text-align:center;'>" . $i . "</td>"
                    . "<td style='text-align:center;'>" . $row['invoice_number'] . "</td>"
                    . "<td >" . $row['product_name'] . "</td>"
                    . "<td>" . $row['supplier_name'] . "</td>"
                    . "<td style='text-align:center;'>" . $row['quantity'] . "</td>"
                    . "<td style='text-align:center;'>" . $row['subtotal'] . "</td>"
                    . "<td style='text-align:center;'>" . $this->helpObj->formatDate($row['date'], 'd-m-Y') . "</td>";
            }

            $this->table_content .= "<tr>"
                . "<td colspan='4' style='text-align:center;'><strong>Total Amount</strong></td>"

                . "<td></td>"
                . "<td style='text-align:center;'><strong>" . $total . "</strong></td>"


                . "<td ></td>";

            return $this->table_content;
            //return $stmt;                    

        }


    }


    /*
     * All purchase by Brand
     * */

    public function ShowPurchaseByBrand($starting, $ending, $supplier_id)
    {

        $starting = $starting . " 00:00:00";
        $ending = $ending . " 23:59:59";

        /*$stmt = $this->dbObj->select("SELECT DISTINCT ti.invoice_number, tg.groupname, tp.product_name, tss.supplier_name, ti.quantity, ti.subtotal, ti.date FROM tbl_invoice ti JOIN tbl_invoice_products tip ON ti.invoice_number = tip.invoice_id JOIN tbl_product tp ON tip.product_id = tp.product_id JOIN tbl_supplier tss ON tp.product_brand = tss.supplier_id JOIN tbl_group tg ON tp.product_group = tg.groupid WHERE tss.supplier_id = '$supplier_id' and
                     ti.date BETWEEN '$starting' AND '$ending' GROUP BY (ti.serial) order by ti.date asc");*/

        $stmt = $this->dbObj->select("SELECT ti.invoice_number, tip.product_id, tg.groupname, tp.product_name, tu.supplier_name, tip.purchase as 'purchase_price', tip.quantity, tip.subtotal, ti.date FROM tbl_invoice_products tip JOIN tbl_invoice ti ON tip.invoice_id = ti.invoice_number JOIN tbl_product tp ON tip.product_id = tp.product_id JOIN tbl_group tg ON tp.product_group = tg.groupid JOIN tbl_supplier tu ON tp.product_brand = tu.supplier_id WHERE tu.supplier_id = '$supplier_id' and ti.date BETWEEN '$starting' AND '$ending' GROUP BY tip.product_id ORDER BY ti.date asc");


        $total = 0;
        if ($stmt) {
            $i = 0;

            while ($row = $stmt->fetch_assoc()) {
                $i++;
                $total += $row['subtotal'];
                $this->table_content .= "<tr>"
                    . "<td style='text-align:center'>" . $i . "</td>"
                    . "<td style='text-align:center'>" . $row['invoice_number'] . "</td>"
                    . "<td>" . $row['groupname'] . "</td>"
                    . "<td>" . $row['product_name'] . "</td>"
                    . "<td style='text-align:center'>" . $row['quantity'] . "</td>"
                    . "<td style='text-align:center'>" . $row['subtotal'] . "</td>"
                    . "<td style='text-align:center'>" . $this->helpObj->formatDate($row['date'], 'd-m-Y') . "</td>";
            }

            $this->table_content .= "<tr>"
                . "<td colspan='3' style='text-align:center'><strong>Total Amount</strong></td>"

                . "<td></td>"

                . "<td colspan='3' style='text-align:center'><strong>" . $total . "</strong></td>";

            return $this->table_content;
            //return $stmt;                    

        }


    }


    /*
    * All Sells Report For Sale in sale_report.php
    * */

    public function SellReportForsales($starting, $ending)
    {
        $stmt = $this->dbObj->select("SELECT ts.date,ts.sell_id,tp.product_id,tp.product_name,tsp.unit_price as 'sale_price',tsp.quantity FROM tbl_sell ts join tbl_sell_products tsp on ts.sell_id = tsp.sell_id JOIN tbl_product tp on tsp.product_id = tp.product_id where ts.date between '$starting' and '$ending' order by ts.date asc");
        $total = 0;
        if ($stmt) {
            $i = 0;

            while ($row = $stmt->fetch_assoc()) {
                $i++;
                $total += $row['quantity'] * $row['sale_price'];
                $this->table_content .= "<tr>"
                    . "<td >" . $this->helpObj->formatDate($row['date'], 'd/m/Y') . "</td>"
                    . "<td>" . $row['sell_id'] . "</td>"
                    . "<td>" . $row['product_id'] . "</td>"
                    . "<td style='text-align : left;'>" . $row['product_name'] . "</td>"
                    . "<td>" . $row['quantity'] . "</td>"
                    . "<td>" . number_format((float)$row['sale_price'], 2, '.', '') . "</td>"
                    . "<td>" . number_format((float)($row['quantity'] * $row['sale_price']), 2, '.', '') . "</td>";

            }

            $this->table_content .= "<tr>"
                . "<td colspan='6'><strong>Total Amount</strong></td>"

                . "<td colspan='1'><strong>" . round($total) . "</strong></td>";

            return $this->table_content;
            //return $stmt;                    

        }


    }


    /*
    * All Sells Report For Sale by Group in sale_report.php
    * */

    public function SellReportByGroup($starting, $ending, $groupid)
    {

        $starting = $starting . " 00:00:00";
        $ending = $ending . " 23:59:59";


        $stmt = $this->dbObj->select("SELECT ts.date,ts.sell_id,tp.product_id,tp.product_name,tsp.unit_price as 'sale_price',tsp.quantity FROM tbl_sell ts join tbl_sell_products tsp on ts.sell_id = tsp.sell_id JOIN tbl_product tp on tsp.product_id = tp.product_id where tp.product_group='$groupid' and ts.date between '$starting' and '$ending' order by ts.date asc");

        if ($stmt) {
            $i = $total = 0;

            while ($row = $stmt->fetch_assoc()) {
                $i++;
                $total += $row['quantity'] * $row['sale_price'];
                $this->table_content .= "<tr>"
                    . "<td >" . $this->helpObj->formatDate($row['date'], 'd/m/Y') . "</td>"
                    . "<td>" . $row['sell_id'] . "</td>"
                    . "<td>" . $row['product_id'] . "</td>"
                    . "<td style='text-align: left;'>" . $row['product_name'] . "</td>"
                    . "<td>" . $row['quantity'] . "</td>"
                    . "<td>" . $row['sale_price'] . "</td>"
                    . "<td>" . $row['quantity'] * $row['sale_price'] . "</td>";
            }

            $this->table_content .= "<tr>"
                . "<td colspan='6'><strong>Total Amount</strong></td>"

                . "<td colspan='1'><strong>" . round($total) . "</strong></td>";

            return $this->table_content;


        }


    }


    /*
     * All Sells Report For Sale by Brand in sale_report.php
     * */

    public function SellReportByBrand($starting, $ending, $brandid)
    {

        $starting = $starting . " 00:00:00";
        $ending = $ending . " 23:59:59";

        $stmt = $this->dbObj->select("SELECT ts.date,ts.sell_id,tp.product_id,tp.product_name,tsp.unit_price as 'sale_price',tsp.quantity FROM tbl_sell ts join tbl_sell_products tsp on ts.sell_id = tsp.sell_id JOIN tbl_product tp on tsp.product_id = tp.product_id where tp.product_brand='$brandid' and ts.date between '$starting' and '$ending' order by ts.date asc");

        if ($stmt) {
            $i = $total = 0;

            while ($row = $stmt->fetch_assoc()) {
                $i++;
                $total += $row['quantity'] * $row['sale_price'];
                $this->table_content .= "<tr>"
                    . "<td >" . $this->helpObj->formatDate($row['date'], 'd/m/Y') . "</td>"
                    . "<td>" . $row['sell_id'] . "</td>"
                    . "<td>" . $row['product_id'] . "</td>"
                    . "<td  style='text-align: left;'>" . $row['product_name'] . "</td>"
                    . "<td>" . $row['quantity'] . "</td>"
                    . "<td>" . $row['sale_price'] . "</td>"
                    . "<td>" . $row['quantity'] * $row['sale_price'] . "</td>";
            }

            $this->table_content .= "<tr>"
                . "<td colspan='6'><strong>Total Amount</strong></td>"

                . "<td colspan='1'><strong>" . round($total) . "</strong></td>";

            return $this->table_content;


        }


    }


    /*
    * All Sells Report For Sale by Customer in sale_report.php
    * */

    public function SellReportByCustomer($starting, $ending, $customer_id)
    {

        $starting = $starting . " 00:00:00";
        $ending = $ending . " 23:59:59";
        $customer_id = $_POST['customer_id'];

        $stmt = $this->dbObj->select("SELECT ts.date,ts.sell_id,tp.product_id,tp.product_name,tsp.unit_price as 'sale_price',tsp.quantity FROM tbl_sell ts join tbl_sell_products tsp on ts.sell_id = tsp.sell_id JOIN tbl_product tp on tsp.product_id = tp.product_id where ts.customer_id='$customer_id' and ts.date between '$starting' and '$ending' order by ts.date asc");

        if ($stmt) {
            $i = $total = 0;

            while ($row = $stmt->fetch_assoc()) {
                $i++;
                $total += $row['quantity'] * $row['sale_price'];
                $this->table_content .= "<tr>"
                    . "<td >" . $this->helpObj->formatDate($row['date'], 'd/m/Y') . "</td>"
                    . "<td>" . $row['sell_id'] . "</td>"
                    . "<td>" . $row['product_id'] . "</td>"
                    . "<td  style='text-align: left;'>" . $row['product_name'] . "</td>"
                    . "<td>" . $row['quantity'] . "</td>"
                    . "<td>" . $row['sale_price'] . "</td>"
                    . "<td>" . $row['quantity'] * $row['sale_price'] . "</td>";
            }

            $this->table_content .= "<tr>"
                . "<td colspan='6'><strong>Total Amount</strong></td>"

                . "<td colspan='1'><strong>" . round($total) . "</strong></td>";

            return $this->table_content;


        }


    }


    /*
     * All Sells Report For Sale by Product name in sale_report.php
     * */

    public function SellReportByProductName($starting, $ending, $product_id)
    {

        $starting = $starting . " 00:00:00";
        $ending = $ending . " 23:59:59";

        $stmt = $this->dbObj->select("SELECT
                        ts.date,
                        ts.sell_id,
                        tc.customer_name,
                        tsp.unit_price,
                        tsp.quantity,
                        (tsp.quantity * tsp.unit_price) AS 'subtotal'
                    FROM
                        tbl_sell ts
                    JOIN tbl_sell_products tsp ON
                        ts.sell_id = tsp.sell_id
                    JOIN tbl_product tp ON
                        tsp.product_id = tp.product_id
                    JOIN tbl_customer tc ON
                        ts.customer_id = tc.customer_id
                    WHERE tsp.product_id = '$product_id' and 
                        ts.date BETWEEN '$starting' AND '$ending'");

        $stmt = $this->dbObj->select("SELECT ts.date,ts.sell_id,tp.product_id,tp.product_name,tsp.unit_price as 'sale_price',tsp.quantity,tc.customer_name FROM tbl_sell ts join tbl_sell_products tsp on ts.sell_id = tsp.sell_id JOIN tbl_product tp on tsp.product_id = tp.product_id join tbl_customer tc on tsp.customer_id = tc.customer_id where tsp.product_id='$product_id' and ts.date between '$starting' and '$ending' order by ts.date asc");

        if ($stmt) {
            $i = $quantity = $total = 0;

            while ($row = $stmt->fetch_assoc()) {
                $i++;
                $total += $row['sale_price'] * $row['quantity'];
                $quantity += $row['quantity'];
                $this->table_content .= "<tr>"
                    . "<td >" . $this->helpObj->formatDate($row['date'], 'd/m/Y') . "</td>"
                    . "<td>" . $row['sell_id'] . "</td>"
                    . "<td  style='text-align: left;'>" . $row['customer_name'] . "</td>"
                    . "<td>" . $row['sale_price'] . "</td>"
                    . "<td>" . $row['quantity'] . "</td>"
                    . "<td>" . $row['sale_price'] * $row['quantity'] . "</td>";
            }

            $this->table_content .= "<tr>"
                . "<td colspan='4'><strong>Total Amount</strong></td>"
                . "<td colspan=''><strong>" . $quantity . "</strong></td>"
                . "<td colspan='1'><strong>" . round($total) . "</strong></td>";

            return $this->table_content;


        }


    }


    /*
     * All Sells Report For Sale by Brand in sale_report.php
     * */

    public function StockReportall()
    {


        $stmt = $this->dbObj->select("SELECT * from stock LEFT JOIN tbl_product ON stock.product_id = tbl_product.product_id INNER JOIN tbl_group ON tbl_product.product_group = tbl_group.groupid  JOIN tbl_supplier on tbl_product.product_brand = tbl_supplier.supplier_id");
        $sell_value = $stock_value = 0;
        if ($stmt) {
            $i = 0;

            while ($row = $stmt->fetch_assoc()) {
                $i++;
                $sell_value += $row['stock'] * $row['sale_price'];
                $stock_value += $row['stock'] * $row['purchase_price'];
                $this->table_content .= "<tr>"
                    . "<td >" . $i . "</td>"
                    . "<td>" . $row['product_id'] . "</td>"
                    . "<td>" . $row['groupname'] . "</td>"
                    . "<td>" . $row['product_name'] . "</td>"

                    . "<td>" . $row['supplier_name'] . "</td>"
                    . "<td>" . $row['sale_price'] . "</td>"
                    . "<td>" . $row['purchase_price'] . "</td>"
                    . "<td>" . $row['sale_price'] * $row['stock'] . "</td>"
                    . "<td>" . $row['purchase_price'] * $row['stock'] . "</td>";
            }

            $this->table_content .= "<tr>"
                . "<td colspan='7'><strong>Total Stock</strong></td>"

                . "<td colspan='1'><strong>" . $sell_value . "</strong></td>"
                . "<td colspan='1'><strong>" . $stock_value . "</strong></td>";

            return $this->table_content;


        }


    }


    /*
     * All Ledgers Report For ledger in laserreport.php
     * @return table data with html
     * */

    public function ShowAllLedgerReport($starting, $ending)
    {

        $starting = $starting . " 00:00:00";
        $ending = $ending . " 23:59:59";

        $stmt = $this->dbObj->select("SELECT * FROM tbl_laser tl join tbl_transactioncat ttc on tl.category = ttc.id where tl.date between '$starting' and '$ending' order by tl.serial asc");

        if ($stmt) {
            $i = 0;
            $debit = $credit = 0;

            while ($row = $stmt->fetch_assoc()) {
                $i++;
                $debit += round($row['debit']);
                $credit += round($row['credit']);

                $this->table_content .= "<tr>"
                    . "<td >" . $this->helpObj->formatDate($row['date'], 'd-m-Y')
                    . "<td>" . $row['category_name'] . "</td>"
                    . "<td>" . round($row['debit']) . "</td>"
                    . "<td>" . round($row['credit']) . "</td>";
            }

            $this->table_content .= "<tr>"
                . "<td colspan='2'><strong></td>"
                . "<td ><strong>" . $debit . "</strong></td>"
                . "<td ><strong>" . $credit . "</strong></td>";

            return $this->table_content;

        }

    }


    /*
     * Ledgers Report by Category For ledger in laserreport.php
     * @return table data with html
     * */

    public function ledgerReportbyCategory($starting, $ending, $category)
    {

        $starting = $starting . " 00:00:00";
        $ending = $ending . " 23:59:59";
        $category = $this->helpObj->validAndEscape($category);

        $stmt = $this->dbObj->select("SELECT * FROM tbl_laser tl join tbl_transactioncat ttc on tl.category = ttc.id where ttc.id ='$category' and tl.date between '$starting' and '$ending' order by tl.serial asc");

        if ($stmt) {
            $i = 0;
            $debit = $credit = 0;

            while ($row = $stmt->fetch_assoc()) {
                $i++;
                $debit += round($row['debit']);
                $credit += round($row['credit']);

                $this->table_content .= "<tr>"
                    . "<td >" . $this->helpObj->formatDate($row['date'], 'd-m-Y')
                    . "<td>" . round($row['debit']) . "</td>"
                    . "<td>" . round($row['credit']) . "</td>";
            }

            $this->table_content .= "<tr>"
                . "<td colspan='1'><strong>Total</strong></td>"
                . "<td ><strong>" . $debit . "</strong></td>"
                . "<td ><strong>" . $credit . "</strong></td>";

            return $this->table_content;

        }

    }


    /*
     * Ledgers Report by Payer For ledger in laserreport.php
     * @return table data with html
     * */

    public function ledgerReportbyPayar($starting, $ending, $payar)
    {

        $starting = $starting . " 00:00:00";
        $ending = $ending . " 23:59:59";
        $payar = $this->helpObj->validAndEscape($payar);

        $stmt = $this->dbObj->select("select * from tbl_laser where donor = '$payar' and date  BETWEEN '$starting' AND '$ending'  order by serial asc
            ");

        if ($stmt) {
            $i = 0;
            $debit = $credit = 0;

            while ($row = $stmt->fetch_assoc()) {
                $i++;
                $debit += round($row['debit']);
                $credit += round($row['credit']);

                $this->table_content .= "<tr>"
                    . "<td >" . $this->helpObj->formatDate($row['date'], 'd-m-Y')
                    . "<td>" . $row['category'] . "</td>"
                    . "<td>" . $row['receiver'] . "</td>"
                    . "<td>" . round($row['debit']) . "</td>"
                    . "<td>" . round($row['credit']) . "</td>";
            }

            $this->table_content .= "<tr>"
                . "<td colspan='3'><strong>Total</strong></td>"
                . "<td ><strong>" . $debit . "</strong></td>"
                . "<td ><strong>" . $credit . "</strong></td>";

            return $this->table_content;

        }

    }


    /*
     * Ledgers Report by Receiver For ledger in laserreport.php
     * @return table data with html
     * */

    public function ledgerReportbyReceiver($starting, $ending, $receiver)
    {

        $starting = $this->helpObj->validAndEscape($starting . " 23:59:59");
        $ending = $this->helpObj->validAndEscape($ending . " 23:59:59");
        $receiver = $this->helpObj->validAndEscape($receiver);

        $stmt = $this->dbObj->select("select * from tbl_laser where receiver = '$receiver' and date  BETWEEN '$starting' AND '$ending'  order by serial asc
            ");

        if ($stmt) {
            $i = 0;
            $debit = $credit = 0;

            while ($row = $stmt->fetch_assoc()) {
                $i++;
                $debit += round($row['debit']);
                $credit += round($row['credit']);

                $this->table_content .= "<tr>"
                    . "<td >" . $this->helpObj->formatDate($row['date'], 'd-m-Y')
                    . "<td>" . $row['category'] . "</td>"
                    . "<td>" . $row['receiver'] . "</td>"
                    . "<td>" . round($row['debit']) . "</td>"
                    . "<td>" . round($row['credit']) . "</td>";
            }

            $this->table_content .= "<tr>"
                . "<td colspan='3'><strong>Total</strong></td>"
                . "<td ><strong>" . $debit . "</strong></td>"
                . "<td ><strong>" . $credit . "</strong></td>";

            return $this->table_content;

        }

    }


    /*
     * Supplier Transaction Report from date to date
     * @return table data with html
     * */

    public function ShowAllSupplierTransaction($starting, $ending)
    {

        $starting = $this->helpObj->validAndEscape($starting . " 23:59:59");
        $ending = $this->helpObj->validAndEscape($ending . " 23:59:59");

        $stmt = $this->dbObj->select("SELECT tst.*,ts.supplier_name from tbl_supplier_transaction tst join tbl_supplier ts on tst.supplier = ts.supplier_id where tst.date BETWEEN '$starting' and '$ending' order by date asc");

        if ($stmt) {
            $i = 0;
            $purchase = $payment = 0;

            while ($row = $stmt->fetch_assoc()) {
                $i++;
                $purchase += round($row['purchase']);
                $payment += round($row['payment']);

                $this->table_content .= "<tr>"
                    . "<td >" . $this->helpObj->formatDate($row['date'], 'd-m-Y')
                    . "<td style='text-align: left;'>" . $row['supplier_name'] . "</td>"
                    . "<td style='text-align: left;'>" . substr($row['description'], 0, 45) . "</td>"
                    . "<td>" . round($row['purchase']) . "</td>"
                    . "<td>" . round($row['payment']) . "</td>";
            }

            $this->table_content .= "<tr>"
                . "<td colspan='3'><strong>Total</strong></td>"
                . "<td ><strong>" . $purchase . "</strong></td>"
                . "<td ><strong>" . $payment . "</strong></td>";

            return $this->table_content;

        }

    }


    /*
     * Supplier Transaction Report from date to date
     * @return table data with html
     * */

    public function ShowAllSupplierTransactionByCat($starting, $ending, $supplier)
    {


        $starting = $this->helpObj->validAndEscape($starting . " 23:59:59");
        $ending = $this->helpObj->validAndEscape($ending . " 23:59:59");


        $stmt = $this->dbObj->select("SELECT tst.*,ts.supplier_name from tbl_supplier_transaction tst join tbl_supplier ts on tst.supplier = ts.supplier_id where tst.supplier='$supplier' and tst.date BETWEEN '$starting' and '$ending'");

        if ($stmt) {
            $i = 0;
            $purchase = $payment = 0;

            while ($row = $stmt->fetch_assoc()) {
                $i++;
                $purchase += round($row['purchase']);
                $payment += round($row['payment']);

                $this->table_content .= "<tr>"
                    . "<td >" . $this->helpObj->formatDate($row['date'], 'd-m-Y')
                    . "<td style='text-align: left;'>" . substr($row['description'], 0, 45) . "</td>"
                    . "<td>" . round($row['purchase']) . "</td>"
                    . "<td>" . round($row['payment']) . "</td>";
            }

            $this->table_content .= "<tr>"
                . "<td colspan='2'><strong>Total</strong></td>"
                . "<td ><strong>" . $purchase . "</strong></td>"
                . "<td ><strong>" . $payment . "</strong></td>";

            return $this->table_content;

        }

    }


    /*
     * Supplier Transaction Report from date to date
     * @return table data with html
     * */

    public function ShowSupplierStatement($starting, $ending, $supplier)
    {

        $supplier_id = $this->helpObj->validAndEscape($_POST["supplier_id"]);
        $starting = $this->helpObj->validAndEscape($starting . " 23:59:59");
        $ending = $this->helpObj->validAndEscape($ending . " 23:59:59");


        $stmt = $this->dbObj->select("SELECT * FROM `supplier_statement` where supplier='$supplier_id' and date BETWEEN '$starting' and '$ending'");

        if ($stmt) {
            $i = 0;
            $debit = $credit = $balance = 0;

            while ($row = $stmt->fetch_assoc()) {
                $i++;
                $debit += round($row['Debit']);
                $credit += round($row['Credit']);
                $balance += round($row['Balance']);

                $this->table_content .= "<tr>"
                    . "<td >" . $this->helpObj->formatDate($row['date'], 'd-m-Y')
                    . "<td style='text-align: left;'>" . substr($row['Drescription'], 0, 45) . "</td>"
                    . "<td>" . round($row['Debit']) . "</td>"
                    . "<td>" . round($row['Credit']) . "</td>"
                    . "<td>" . round($row['Balance']) . "</td>";
            }

            $this->table_content .= "<tr>"
                . "<td colspan='2'><strong>Total</strong></td>"
                . "<td ><strong>" . $debit . "</strong></td>"
                . "<td ><strong>" . $credit . "</strong></td>"
                . "<td ></td>";

            return $this->table_content;

        }

    }


}
