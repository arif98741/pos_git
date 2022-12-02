<?php
$path = realpath(dirname(__DIR__));
include_once 'DB.php';
include_once 'Session.php';
include_once $path . '/helper/Helper.php';

class Product
{

    private $dbObj;
    private $helpObj;

    public function __construct()
    {
        $this->dbObj = new Database();
        $this->helpObj = new Helper();
    }

    public function showallproducts()
    {
        $query = 'select * from tbl_product order by serial ASC';
        $stmt = $this->dbObj->select($query);
        return $stmt;
    }

    public function showType()
    { //for showing type in dropdown in addproduct.php
        $query = 'select * from tbl_type order by typename ASC';
        $stmt = $this->dbObj->select($query);
        return $stmt;
    }

    public function showSingleType($typeid)
    {
        $tstmt = $this->dbObj->select("select * from tbl_type where typeid='$typeid'");
        $trdata = $tstmt->fetch_assoc();
        return $trdata;
    }

    public function showGroup()
    { //for showing group in dropdown in addproduct.php
        $query = 'select * from tbl_group order by groupname ASC';
        $stmt = $this->dbObj->select($query);
        return $stmt;
    }


    public function showGroupById($groupid)
    { //for showing group in dropdown in addproduct.php
        $groupid = $this->helpObj->validAndEscape($groupid);
        $query = "select * from tbl_group where groupid ='$groupid'";
        $stmt = $this->dbObj->select($query);
        if ($stmt) {
            return $stmt->fetch_assoc();
        }

    }


    public function showBrandById($supplier_id)
    { //for showing group in dropdown in addproduct.php
        $supplier_id = $this->helpObj->validAndEscape($supplier_id);
        $query = "select * from tbl_supplier where supplier_id ='$supplier_id'";
        $stmt = $this->dbObj->select($query);
        if ($stmt) {
            return $stmt->fetch_assoc();
        }

    }


    public function showBrand()
    { //for showing brand in dropdown in addproduct.php
        $query = 'select * from tbl_brand order by brandname ASC';
        $stmt = $this->dbObj->select($query);
        return $stmt;
    }

    public function showColor()
    { //for showing color in dropdown in addproduct.php
        $query = 'select * from tbl_color order by colorname ASC';
        $stmt = $this->dbObj->select($query);
        return $stmt;
    }


    public function showSingleGroup($grid)
    {
        $grstmt = $this->dbObj->select("select * from tbl_group where groupid='$grid'");
        $grdata = $grstmt->fetch_assoc();
        return $grdata;
    }


    public function showProduct()
    {
        //brand is granted as supplier

        $q = "SELECT * FROM tbl_product tp
            JOIN tbl_supplier ts ON
                tp.product_brand = ts.supplier_id
            JOIN tbl_group tg ON
                tp.product_group = tg.groupid
            JOIN tbl_type tt ON
                tp.product_type = tt.typeid
            ORDER BY
                tp.serial
            DESC";
        $stmt = $this->dbObj->select($q);
        return $stmt;
    }


    public function addProduct($data)
    {

        $product_id = $this->helpObj->validAndEscape($data['product_id']);
        $product_type = $this->helpObj->validAndEscape($data['product_type']);
        $product_group = $this->helpObj->validAndEscape($data['product_group']);
        $product_name = $this->helpObj->validAndEscape($data['product_name']);
        $product_brand = $this->helpObj->validAndEscape($data['product_brand']);
        $sale_price = $this->helpObj->validAndEscape($data['sale_price']);
        $purchase_price = $this->helpObj->validAndEscape($data['purchase_price']);
        $piece_in_a_carton = $this->helpObj->validAndEscape($data['piece_in_a_carton']);
        $u_id = $_SESSION['userid'];
        $query = "insert into tbl_product
                (product_id,product_type,product_group,product_name,product_brand,sale_price,purchase_price,piece_in_a_carton,updateby)
   
          values('$product_id','$product_type','$product_group','$product_name','$product_brand','$sale_price','$purchase_price','$piece_in_a_carton','$u_id')";

        $check = $this->dbObj->select("select * from tbl_product where product_id='$product_id'");
        if ($check) {
            return "<p class='alert alert-danger fadeout'>Product Already Exist<p>";
        } else {
            $status = $this->dbObj->insert($query);
            if ($status) {
                return "<p class='alert alert-success fadeout'>Product Insert Successful<p>";
            } else {
                return "<p class='alert alert-danger fadeout'>Failed To Insert Product<p>";
            }
        }
    }

    public function deleteProduct($product_id)
    {
        $serial = $this->helpObj->validAndEscape($product_id);

        $query = "DELETE from tbl_product where product_id ='$product_id'";
        $sta = $this->dbObj->delete($query);
        if ($sta) {
            return true;
        } else {
            return false;
        }
    }

    public function getsingleProduct($product_id)
    {
        $product_id = $this->helpObj->validAndEscape($product_id);
        $query = "select * from tbl_product where product_id='$product_id'";
        $sta = $this->dbObj->select($query);
        return $sta;
    }

    public function updateProduct($data)
    {

        $product_id = $this->helpObj->validAndEscape($data['product_id']);
        $product_type = $this->helpObj->validAndEscape($data['product_type']);
        $product_group = $this->helpObj->validAndEscape($data['product_group']);
        $product_name = $this->helpObj->validAndEscape($data['product_name']);
        $product_brand = $this->helpObj->validAndEscape($data['product_brand']);
        $sale_price = $this->helpObj->validAndEscape($data['sale_price']);
        $purchase_price = $this->helpObj->validAndEscape($data['purchase_price']);
        $piece_in_a_carton = $this->helpObj->validAndEscape($data['piece_in_a_carton']);
        $u_id = $_SESSION['userid'];
        $last_update = date('current_timestamp'); //set default time at Asia/Dhaka on header.php

        $query = "UPDATE tbl_product
                            SET
                            product_type = '$product_type',    
                            product_group = '$product_group',    
                            product_name = '$product_name',    
                            product_brand = '$product_brand',
                            sale_price = '$sale_price',
                            purchase_price = '$purchase_price',    
                            piece_in_a_carton = '$piece_in_a_carton',   
                            last_update   ='$last_update',
                            updateby ='$u_id'    
                            where product_id='$product_id' ";

        $sta = $this->dbObj->update($query);
        if ($sta) {
            return true;
        } else {
            return false;
        }
    }


}
