<?php
$path = realpath(dirname(__DIR__));
include_once 'DB.php';
include_once 'Session.php';
include_once $path.'/helper/Helper.php';

class Product {

    private $dbObj;
    private $helpObj;
    private $userid; //for filtering data by Session User

    /*
    !-----------------------------------------------------
    !     Constructor Load During Creation of Object
    !-----------------------------------------------------
    */
    public function __construct() {
        $this->dbObj   = new Database();
        $this->helpObj = new Helper();
        $this->userid  = Session::get('userid');
    }

    /*
    !-----------------------------------------------------
    !     Show All Products
    !-----------------------------------------------------
    */
    public function showallproducts()
    {
        $query = "select * from tbl_product where updateby='$this->userid' order by serial ASC";
        $stmt  = $this->dbObj->select($query);
        return $stmt;
    }

    /*
    !-----------------------------------------------------
    !     Show All Type/Unit
    !-----------------------------------------------------
    */
    public function showType() { //for showing type in dropdown in addproduct.php
        $query = "select * from tbl_type where updateby='$this->userid' order by typename ASC";
        $stmt  = $this->dbObj->select($query);
        return $stmt;
    }

    /*
    !-----------------------------------------------------
    !     Show Single Type by ID
    !-----------------------------------------------------
    */
    public function showSingleType($typeid) {
        $tstmt  = $this->dbObj->select("select * from tbl_type where typeid='$typeid' and updateby='$this->userid'");
        $trdata = $tstmt->fetch_assoc();
        return $trdata;
    }


    /*
    !-----------------------------------------------------
    !     Show All Group
    !-----------------------------------------------------
    */
    public function showGroup() { //for showing group in dropdown in addproduct.php
        $query = "select * from tbl_group where updateby='$this->userid' order by groupname ASC";
        $stmt  = $this->dbObj->select($query);
        return $stmt;
    }

    /*
    !-----------------------------------------------------
    !     Show Group By ID
    !-----------------------------------------------------
    */
    public function showGroupById($groupid) { //for showing group in dropdown in addproduct.php
        $groupid = $this->helpObj->validAndEscape($groupid);
        $query   = "select * from tbl_group where groupid ='$groupid' and updateby='$this->userid'";
        $stmt    = $this->dbObj->select($query);
        if($stmt){
            return $stmt->fetch_assoc();
        }
    }


    /*
    !-----------------------------------------------------
    !     Show All Brand
    !-----------------------------------------------------
    */
    public function showBrand() { //for showing brand in dropdown in addproduct.php
        $query = "select * from tbl_brand where updateby='$this->userid' order by brandname ASC";
        $stmt  = $this->dbObj->select($query);
        return $stmt;
    }


    /*
    !-----------------------------------------------------
    !     Show Brand By ID
    !-----------------------------------------------------
    */
    public function showBrandById($supplier_id) { //for showing group in dropdown in addproduct.php
        $supplier_id = $this->helpObj->validAndEscape($supplier_id);
        $query = "select * from tbl_supplier where supplier_id ='$supplier_id' and updateby='$this->userid'";
        $stmt  = $this->dbObj->select($query);
        if($stmt){
            return $stmt->fetch_assoc();
        }
        
    }

    
    /*
    !-----------------------------------------------------
    !     Show All Color
    !-----------------------------------------------------
    */
    public function showColor() { //for showing color in dropdown in addproduct.php
        $query = "select * from tbl_color where updateby='$this->userid' order by colorname ASC";
        $stmt  = $this->dbObj->select($query);
        return $stmt;
    }


    /*
    !-----------------------------------------------------
    !     Show Single Group By ID
    !-----------------------------------------------------
    */
    public function showSingleGroup($groupid) {
        $grstmt = $this->dbObj->select("select * from tbl_group where groupid='$groupid' and updateby='$this->userid'");
        $grdata = $grstmt->fetch_assoc();
        return $grdata;
    }


    /*
    !-----------------------------------------------------
    !     Show Product In Products.php
    !-----------------------------------------------------
    */
    public function showProduct() {
        //brand is granted as supplier

        $q = "SELECT tp.product_id,tg.groupname,tp.product_name,ts.supplier_name,tt.typename,tp.purchase_price,tp.last_update,tp.serial FROM tbl_product tp
            JOIN tbl_supplier ts ON
                tp.product_brand = ts.supplier_id
            JOIN tbl_group tg ON
                tp.product_group = tg.groupid
            JOIN tbl_type tt ON
                tp.product_type = tt.typeid
            where tp.updateby='$this->userid'    
            ORDER BY
                tp.product_id
            DESC";
        $stmt = $this->dbObj->select($q);
        return $stmt;
    }


    /*
    !-----------------------------------------------------
    !     Addproduct 
    !     @param array
    !     @table= tbl_product
    !-----------------------------------------------------
    */
    public function addProduct($data) {

        $product_id        = $this->helpObj->validAndEscape($data['product_id']);
        $product_type      = $this->helpObj->validAndEscape($data['product_type']);
        $product_group     = $this->helpObj->validAndEscape($data['product_group']);
        $product_name      = $this->helpObj->validAndEscape($data['product_name']);
        $product_brand     = $this->helpObj->validAndEscape($data['product_brand']);
        $sale_price        = $this->helpObj->validAndEscape($data['sale_price']);
        $purchase_price    = $this->helpObj->validAndEscape($data['purchase_price']);
        $wholesale_price   = $this->helpObj->validAndEscape($data['wholesale_price']);
        $piece_in_a_carton = $this->helpObj->validAndEscape($data['piece_in_a_carton']);
        $stock_limit       = $this->helpObj->validAndEscape($data['stock_limit']);
        $u_id              = $this->userid;
        $query = "insert into tbl_product
                (product_id,product_type,product_group,product_name,product_brand,sale_price,purchase_price,wholesale_price,piece_in_a_carton,stock_limit,updateby)
   
          values('$product_id','$product_type','$product_group','$product_name','$product_brand','$sale_price','$purchase_price','$wholesale_price','$piece_in_a_carton','$stock_limit','$u_id')";

        $check = $this->dbObj->select("select * from tbl_product where product_id='$product_id' and updateby='$this->userid'");

        if ($check) {
            return "<p class='alert alert-danger fadeout'>Product Already Exist<p>";
        } else {
            $status = $this->dbObj->insert($query);
            if ($status) {
                return true;
                ;
            } else {
                return false;
            }
        }
    }


    /*
    !-----------------------------------------------------
    !    Update Product
    !    @param array
    !    @return bool
    !-----------------------------------------------------
    */
    public function updateProduct($data) {

        $id = $this->helpObj->validAndEscape($data['id']);
        $product_id      = $this->helpObj->validAndEscape($data['product_id']);
        $product_type    = $this->helpObj->validAndEscape($data['product_type']);
        $product_group   = $this->helpObj->validAndEscape($data['product_group']);
        $product_name    = $this->helpObj->validAndEscape($data['product_name']);
        $product_brand   = $this->helpObj->validAndEscape($data['product_brand']);
        $sale_price      = $this->helpObj->validAndEscape($data['sale_price']);
        $purchase_price  = $this->helpObj->validAndEscape($data['purchase_price']);
        $wholesale_price = $this->helpObj->validAndEscape($data['wholesale_price']);
        $piece_in_a_carton = $this->helpObj->validAndEscape($data['piece_in_a_carton']);
        $stock_limit     = $this->helpObj->validAndEscape($data['stock_limit']);
        $u_id = $_SESSION['userid'];
        $last_update     = date('current_timestamp'); //set default time at Asia/Dhaka on header.php

        $query = "UPDATE tbl_product
                            SET
                            product_id = '$product_id',    
                            product_type = '$product_type',    
                            product_group = '$product_group',    
                            product_name = '$product_name',    
                            product_brand = '$product_brand',
                            sale_price = '$sale_price',
                            purchase_price = '$purchase_price',    
                            wholesale_price = '$wholesale_price',    
                            piece_in_a_carton = '$piece_in_a_carton',   
                            stock_limit = '$stock_limit',   
                            last_update   ='$last_update',
                            updateby ='$u_id'    
                            where serial='$id' and updateby='$this->userid'";

        $sta = $this->dbObj->update($query);
        if ($sta) {
            return true;
        } else {
            return false;
        }
    }


    /*
    !-----------------------------------------------------
    !     Delete Product
    !     @param product serial (key)
    !     @return bool
    !-----------------------------------------------------
    */
    public function deleteProduct($id) {
        $id = $this->helpObj->validAndEscape($id);

        $query = "DELETE from tbl_product where serial ='$id' and updateby='$this->userid'";
        $sta   = $this->dbObj->delete($query);
        if ($sta) {
            return true;
        } else {
            return false;
        }
    }

    /*
    !-----------------------------------------------------
    !    Get Single Product Details
    !    @return object
    !-----------------------------------------------------
    */
    public function getsingleProduct($id) {
        $id    = $this->helpObj->validAndEscape($id);
        $query = "select * from tbl_product where serial='$id' and updateby='$this->userid'";
        $sta   = $this->dbObj->select($query);
        return $sta;
    }
    
}
