<?php

include_once 'Session.php';
include_once 'DB.php';
include_once 'helper/Helper.php';

class Supplier {

    private $dbObj;
    private $helpObj;

    public function __construct() {

        $this->dbObj = new Database();
        $this->helpObj = new Helper();
    }

    public function showSupplier() {
        $query = 'select * from tbl_supplier order by serial desc';
        $stmt = $this->dbObj->select($query);
        if ($stmt) {
            return $stmt;
        } else {
            return false;
        }
    }

    public function showSupplierForDropdown() {
        $query = 'select * from tbl_supplier order by supplier_name asc';
        $stmt = $this->dbObj->select($query);
        return $stmt;
    }

    public function showSingleSupplier($id) {
        $supplier_id = $this->helpObj->validAndEscape($id);
        $query = "select * from tbl_supplier where supplier_id='$supplier_id'";
        $stmt = $this->dbObj->select($query);
        return $stmt;
    }


    /*
     * Add New Supplier to Database
     * From addsupplier.php
     * */
    public function addSupplier($data) {
        $supplier_id = $this->helpObj->validAndEscape($data['supplier_id']);
        $supplier_name = $this->helpObj->validAndEscape($data['supplier_name']);
        $address = $this->helpObj->validAndEscape($data['address']);
        $contact_no = $this->helpObj->validAndEscape($data['contact_no']);
        $contact_person = $this->helpObj->validAndEscape($data['contact_person']);
        $email = $this->helpObj->validAndEscape($data['email']);
        $remark = $this->helpObj->validAndEscape($data['remark']);
        $updateby = Session::get('userid');
        $query = "insert into tbl_supplier(
            supplier_id, supplier_name, address,
            contact_no, contact_person, email,remark,updateby) 
            values('$supplier_id', '$supplier_name', '$address',
            '$contact_no', '$contact_person', '$email',
            '$remark','$updateby')";

        $check = $this->dbObj->select("select * from tbl_supplier where supplier_id='$supplier_id'");

        if($check)
        {
            $this->msg = "<script>alert('Supplier Already Exist. Try with Different ID');</script>";
            return $this->msg;
        }else{
            $sta = $this->dbObj->insert($query);
            if ($sta) {
                $this->msg = "<script>alert('Supplier Added Successfully');</script>";
                return $this->msg;
            } else {
                $this->msg = "<script>alert('Error! Supplier Added failed');</script>";
                return $this->msg;
            }
        }
    }

    /*
     * showing single supplier data to editsupplier.php
     * */
    public function singleSupplier($supplier_id) {
        $supplier_id = $this->helpObj->validAndEscape($supplier_id);
        $query = "select * from tbl_supplier where supplier_id='$supplier_id'";
        $sta = $this->dbObj->select($query);
        return $sta;
    }

    /*
     * update supplier from editsupplier.php
     * update execution at supplierlist.php
     * */
    public function updatesupplier($data) {
        $serial = $this->helpObj->validAndEscape($data['serial']);
        $supplier_id = $this->helpObj->validAndEscape($data['supplier_id']);
        $supplier_name = $this->helpObj->validAndEscape($data['supplier_name']);
        $address = $this->helpObj->validAndEscape($data['address']);
        $contact_no = $this->helpObj->validAndEscape($data['contact_no']);
        $contact_person = $this->helpObj->validAndEscape($data['contact_person']);
        $email = $this->helpObj->validAndEscape($data['email']);
        $updateby = Session::get('userid');
        $query = "UPDATE tbl_supplier SET
                            supplier_id = '$supplier_id',supplier_name = '$supplier_name', address = '$address',    
                            contact_no = '$contact_no', contact_person = '$contact_person',
                            email = '$email', updateby = '$updateby'    
                            where serial='$serial' ";
        $stmt = $this->dbObj->update($query);
        if ($stmt) {
            return true;
        } else {
            return false;
        }
    }


    /*
     * delete single supplier from database
     *
     * */
    public function deleteSupplier($data) {
        $serial = $this->helpObj->validAndEscape($data['serial']);
        //$supplier_id = $this->helpObj->validAndEscape($data['supplier_id']);
        $query = "delete from tbl_supplier where serial='$serial'";
        $sta = $this->dbObj->delete($query);
        if ($sta) {
            return true;
        } else {
            return false;
        }
    }

}
