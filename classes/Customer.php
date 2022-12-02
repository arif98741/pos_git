<?php

include_once 'Session.php';
include_once 'DB.php';
include_once 'helper/Helper.php';

class Customer
{

    private $dbObj;
    private $helpObj;

    public function __construct()
    {

        $this->dbObj = new Database();
        $this->helpObj = new Helper();
    }


    /*
    !----------------------------------------------------------
    ! showing customer list in addsell.php in dropdown menu
    !---------------------------------------------------------
    */
    public function showCustomerForDropdown()
    {
        $query = 'select * from tbl_customer order by customer_name asc';
        $stmt = $this->dbObj->select($query);
        if ($stmt) {
            return $stmt;
        } else {
            return false;
        }
    }


    /*
    !----------------------------------------------------------
    !  show single customer details for dropdown in addsell.php
    !---------------------------------------------------------
    */
    public function singleCustomerDetail($customer_id)
    {
        $query = "select * from tbl_customer where customer_id='$customer_id'";
        $stmt = $this->dbObj->select($query);
        if ($stmt) {
            $val = $stmt->fetch_array();
            return json_encode($val);
        } else {
            return false;
        }
    }

    /*
    !------------------------------------------------
    !       insert Customer to customer table
    !       from addcustomer.php
    !-----------------------------------------------
    */
    public function insertCustomer($data)
    {
        date_default_timezone_set('Asia/Dhaka');

        $customer_id = $this->helpObj->validAndEscape($data['customer_id']);
        $customer_name = $this->helpObj->validAndEscape($data['customer_name']);
        $address = $this->helpObj->validAndEscape($data['address']);
        $contact_no = $this->helpObj->validAndEscape($data['contact_no']);
        //$contact_person = $this->helpObj->validAndEscape($data['contact_person']);
        $email = $this->helpObj->validAndEscape($data['email']);

        $opening_balance = $this->helpObj->validAndEscape($data['opening_balance']);
        $remark = $this->helpObj->validAndEscape($data['remark']);
        $date = date('Y-m-d H:i:s');
        $updateby = Session::get('userid');
        $query = "insert into tbl_customer(
             customer_id, customer_name, address,contact_no,email,opening_balance,remark,date,updateby)
            values('$customer_id', '$customer_name', '$address',
            '$contact_no','$email','$opening_balance','$remark','$date','$updateby')";

        $check = $this->dbObj->select("select * from tbl_customer where customer_id='$customer_id'");
        if ($check) {
            return "<script>alert('Customer Already Exist. Try with Different ID');</script>";
        } else {
            $sta = $this->dbObj->insert($query);
            if ($sta) {
                $msg = "<script>alert('Customer Added Successfully');</script>";
            } else {
                $msg = "<script>alert('Error! Customer Added failed');</script>";
            }
            return $msg;
        }
    }

    /*
    !--------------------------------------
    !       get single customer details
    !-------------------------------------
    */
    public function singleCustomer(int $customerId)
    {
        $customerId = $this->helpObj->validAndEscape($customerId);
        $query = "select * from tbl_customer where customer_id='$customerId'";
        return $this->dbObj->select($query);
    }

    /*
    !----------------------------------------------
    !    update customer from editcustomer.php
    !---------------------------------------------
    */
    public function updateCustomer(array $data)
    {
        $serial = $this->helpObj->validAndEscape($data['serial']);
        $customerid = $this->helpObj->validAndEscape($data['customer_id']);
        $customer = $this->helpObj->validAndEscape($data['customer_name']);
        $address = $this->helpObj->validAndEscape($data['address']);
        $contact_no = $this->helpObj->validAndEscape($data['contact_no']);
        $email = $this->helpObj->validAndEscape($data['email']);
        $opening_balance = $this->helpObj->validAndEscape($data['opening_balance']);
        $remark = $this->helpObj->validAndEscape($data['remark']);
        $updateby = Session::get('userid');
        $query = "UPDATE tbl_customer SET
                            customer_name = '$customer', address = '$address',
                            contact_no = '$contact_no',  email = '$email',
                            opening_balance ='$opening_balance',
                            remark = '$remark', updateby = '$updateby'
                            where serial='$serial'";

        $stmt = $this->dbObj->update($query);
        if ($stmt) {
            return true;
        } else {
            return false;
        }
    }


    /*
    !----------------------------------------------
    !    delete customer from customerlist.php
    !---------------------------------------------
    */
    public function deleteCustomer(array $data)
    {
        $serial = $this->helpObj->validAndEscape($data['serial']);
        $query = "delete from tbl_customer where serial='$serial'";
        $sta = $this->dbObj->delete($query);
        if ($sta) {
            return "<p class='alert alert-success fadeout'>Customer Deleted Successful<p>";
        } else {
            return "<p class='alert alert-danger fadeout'>Customer Deleted Failed<p>";
        }
    }


    /*
    !-----------------------------------------------------------------
    !    show customers in addsell dropdown after adding from popup
    !----------------------------------------------------------------
    */
    public function getPopCustomers()
    {
        $query = 'select * from tbl_customer order by customer_name asc';
        $stmt = $this->dbObj->select($query);
        if ($stmt) {
            $v = '<option>Select</option>';
            while ($r = $stmt->fetch_assoc()) {
                $v .= '<option value"' . $r['customer_id'] . '">' . $r['customer_name'] . '</option>';
            }
            return $v;
        } else {
            return "<option>Select</option>";
        }
    }


    /*
    !-------------------------------------
    !    send message to customer
    !    after completing payment
    !------------------------------------
    */
    public function sendMessage($customer_id, $amount, $method)
    {
        $query = "SELECT tc.customer_name,tc.customer_id,tc.contact_no,cb.balance from tbl_customer tc join customer_balance cb on tc.customer_id = cb.customer_id where tc.customer_id='$customer_id'";
        $stmt = $this->dbObj->link->query($query) or die($this->dbObj->link->error) . " " . __LINE__;
        if ($stmt) {
            $data = $stmt->fetch_assoc();
            $customer_name = $data['customer_name'];
            $customer_mobile = $data['contact_no'];
            //$balance = $data['balance']; //current balance
            $balance = number_format((float)$data['balance'], 2, '.', '');
        }

        $message = 'Dear ' . $customer_name . ', your payment ' . $amount . 'tk was successfully received by ' . $method . '. Your current balance is ' . $balance . '------------------' . Session::get('company_name');

        $token = "77f9a4d2c5ea51913XXXXXXXXXXXX";
        $url = "http://sms.greenweb.com.bd/api.php";

        $data = array(
            'to' => $customer_mobile,
            'message' => $message,
            'token' => "$token"
        ); // Add parameters in key value
        $ch = curl_init(); // Initialize cURL
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        return curl_exec($ch);
    }


}
