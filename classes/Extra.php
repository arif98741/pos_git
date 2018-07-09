<?php
$path = realpath(dirname(__DIR__));
include_once 'DB.php';
include_once $path.'/helper/Helper.php';

class Extra {

    private $dbObj;
    private $helpObj;

    public function __construct() {

        $this->dbObj = new Database();
        $this->helpObj = new Helper();
    }

    public function showGroup() { //for showing group in dropdown in addinvoice.php
        $query = 'select * from tbl_group order by groupname ASC';
        $stmt = $this->dbObj->select($query);
        $val = '<select class="form-control product_group" name="product_group">';
        if ($stmt->num_rows > 0) {
            $val .= '<option>Select</option>';
            while ($r = $stmt->fetch_assoc()) {
                $val .= '<option value="' . $r['groupid'] . '">' . $r['groupname'] . '</option>';
            }
        }
        return $val .= '</select>';
    }

    //for showing products name list according to group id in dropdown in addinvoice.php
    public function showProductNameList($group_id) {
        $group_id = $this->helpObj->validAndEscape($group_id);
        $query = "SELECT * from tbl_product WHERE product_group='$group_id' order by product_name asc";
        $stmt = $this->dbObj->select($query);
        $val = '<select class="form-control product_list" name="product_name">';
        if ($stmt) {
            $val .= '<option>Select</option>';
            while ($r = $stmt->fetch_assoc()) {
                $val .= '<option value="' . $r['product_id'] . '">' . $r['product_name'] . '</option>';
            }
            return $val .= '</select>';
        } else {
            $return = '';
            $return .= '<select  class="form-control">'
                    . '<option>Select</option>'
                    . '</select';
            return $return;
        }
    }

    //showing single product details in addinvoice form by selecting product list dropdown
    public function showSingleProDetails($pro_id) {
        $q = "select * from tbl_product,tbl_type where tbl_product.product_type = tbl_type.typeid and tbl_product.product_id ='$pro_id'";
        $st = $this->dbObj->select($q);
        if ($st) {
            return $st->fetch_assoc();
        } else {
            
        }
    }


    /**
     * @ get group list
     * @ group product
     */
    public function showgrouplist()
    {
        $q = "select * from tbl_group order by groupid asc";
        $st = $this->dbObj->select($q);
        if ($st) {
            return $st;
        } else {
            return false;
        }
    }


    /**
     * @ get type list
     * @ type product
     */
    public function showtypelist()
    {
        $q = "select * from tbl_type order by typeid asc";
        $st = $this->dbObj->select($q);
        if ($st) {
            return $st;
        } else {
            return false;
        }
    }


    /**
    @previous due of customer 
    @ in viewsales.php
    **/
    public function lastInvoicedue($cus_id)
    {


        $q = "SELECT due FROM tbl_sell WHERE customer_id = '$cus_id' ORDER BY SERIAL ASC LIMIT 2";
        $st = $this->dbObj->select($q);
        $last_due = 0;
        if($st)
        {
            $i = 0;
            while ($row  = $st->fetch_assoc()) {
                if ($i == 1) {
                    $last_due = $row['due'];
                }
                $i++;
            }
            return $last_due;
        }

    }


    /**
    @  quantiy Maintainer function
    @  this will identify wheather the quantity is grater than one or not
    */
    public function quantityMaintainer($quantity, $unit)
    {
        if ($quantity > 1) {
            return $unit."s";
        }else{
            return $unit;
        }
        
    }



    /* @send message to customer 
    * @ after completing sale at printfiles/sale/printinvoice.php
    */
    
    public function sendMessageAfterSale($customer_id,$sell_id,$amount)
    { 
        $query = "select * from tbl_customer where customer_id='$customer_id'";
        $stmt = $this->dbObj->link->query($query) or die($this->dbObj->link->error)." ".__LINE__;
        if ($stmt) {
           $data =  $stmt->fetch_assoc();
           $customer_name = $data['customer_name'];
           $customer_mobile = $data['contact_no'];
        }

        $balstmt = $this->dbObj->link->query("select * from customer_balance where customer_id='$customer_id'") or die($this->dbObj->link->error)." ".__LINE__;
        if ($balstmt) {
           $balarray = $balstmt->fetch_assoc();
           $current_balance = number_format((float)$balarray['balance'], 2, '.', '');
           
             
        }

        /*$message = 'Dear '.$customer_name.', your payment '.$amount.'tk for invoice '.$sell_id.' has successfully recieved. Your current balance is '.$current_balance.'-----------------'.Session::get('company_name'); */

        $message = 'Dear '.$customer_name.', your bill  is '.$amount.' for invoice '.$sell_id.'. Current balance is '.$current_balance;

        $token = "77f9a4d2c5ea51913e1cd7624705239c";
        $url = "http://sms.greenweb.com.bd/api.php";

        $data= array(
        'to'=> $customer_mobile,
        'message'=> $message,
        'token'=>"$token"
        ); // Add parameters in key value
        $ch = curl_init(); // Initialize cURL
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $smsresult = curl_exec($ch); //execute statement to send sms
        return $smsresult;
    }




}
