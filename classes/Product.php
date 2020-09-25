<?php

class Product
{

    private $dbObj;
    private $helpObj;


    /**
     * Product constructor.
     */
    public function __construct()
    {
        $this->dbObj = new Database();
        $this->helpObj = new Helper();
    }

    /**
     * @param $data
     * @return string
     */
    public function addProduct($data)
    {
        $product_name = $this->helpObj->validAndEscape($data['product_name']);
        $sku = $this->helpObj->validAndEscape($data['sku']);
        $retail_price = $this->helpObj->validAndEscape($data['retail_price']);
        $sale_price = $this->helpObj->validAndEscape($data['sale_price']);
        $whole_price = $this->helpObj->validAndEscape($data['whole_price']);
        $brand_name = $this->helpObj->validAndEscape($data['brand_name']);
        $category_name = $this->helpObj->validAndEscape($data['category_name']);
        $stock = $this->helpObj->validAndEscape($data['stock']);
        $size = $this->helpObj->validAndEscape($data['size']);
        $query = "insert into tbl_product(
                product_name,
                sku,
                retail_price,
                sale_price,
                whole_price,
                brand_name,
                category_name,
                stock,
                size) values('$product_name','$sku','$retail_price','$sale_price','$whole_price','$brand_name','$category_name','$stock','$size')";

        $status = $this->dbObj->insert($query);
        if ($status) {
            return "<p class='alert alert-success fadeout'>Product Insert Successful<p>";
        } else {
            return "<p class='alert alert-danger fadeout'>Failed To Insert Product<p>";
        }

    }

    /**
     * Upload File Using Csv File.
     * @return string
     */
    public function bulkProductUpload()
    {
        ini_set('max_execution_time', 300); // 300 (seconds) = 5 Minutes
        $name = $_FILES['file']['name'];
        $explode = explode('.', $name);
        $fileName = $_FILES["file"]["tmp_name"];
        $fileType = end($explode);
        if ($fileType != 'csv') {
            return "<p class='alert alert-danger fadeout'>File is not supported<p>";

        } else if ($_FILES["file"]["size"] > 0) {

            $file = fopen($fileName, "r");
            $i = 0;
            $flagStatus = 1;
            while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
                if ($column[0] == 'post_title') {
                    continue;
                } else {
                    $product_name = str_replace("'", "''", $column[0]);
                    $sku = $column[1];
                    $stock = $column[2];
                    $retail_price = (!is_numeric($column[3]) || empty($column[3])) ? 0 : $column[3];
                    $sale_price = (!is_numeric($column[4]) || empty($column[4])) ? 0 : $column[4];
                    if (empty($sale_price)) {
                        $sale_price = 0;
                    }
                    $whole_price = (!is_numeric($column[5]) || empty($column[5])) ? 0 : $column[5];
                    $url = $column[7];
                    $low_stock = (empty($column[8])) ? 0 : $column[8];
                    $category_name = $this->helpObj->getCategoryFromString($column[11]);
                    $brand_name = str_replace("'", "''", $column[14]);
                    $sql = "insert into tbl_product(
                        product_name,
                        sku,
                        retail_price,
                        sale_price,
                        whole_price,
                        brand_name,
                        category_name,
                        stock,
                        low_stock,
                        url) values('$product_name','$sku','$retail_price','$sale_price','$whole_price','$brand_name','$category_name','$stock','$low_stock','$url')";

                    $status = $this->dbObj->insert($sql);
                    if ($status == false) {
                        $flagStatus = 0;
                        break;
                    } else {
                        $i++;
                    }
                }
            }
            if ($flagStatus === false) {
                Session::set('error', "<p class='alert alert-danger fadeout'>File size should be greater than 1KB<p>");
            } else {
                Session::set('success', "<p class='alert alert-success fadeout'>Inserted " . $i . "products successfully<p>");
            }

            header('location: addproduct-using-file.php');
            exit;
        } else {
            return "<p class='alert alert-danger fadeout'>File size should be greater than 1KB<p>";
        }
    }

    /**
     * show product list
     * @return bool|mysqli_result
     */
    public function showAllProducts()
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

    /**
     * Show single Product Type
     * @param $typeid
     * @return array|null
     */
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


    /**
     * Show Product
     * @param string $order
     * @param string $orderBy
     * @return bool|mysqli_result
     */
    public function showProduct($order = 'ASC', $orderBy = 'serial')
    {
        $q = "SELECT * FROM tbl_product  tp ORDER BY " . $orderBy . "  " . $order;
        return $this->dbObj->select($q);
    }


    /**
     * Delete Single Product
     * @param $serial
     * @return bool
     */
    public function deleteProduct($serial)
    {
        $serial = $this->helpObj->validAndEscape($serial);
        $query = "DELETE from tbl_product where serial ='$serial'";
        if ($this->dbObj->delete($query)) {
            return "<p class='alert alert-success fadeout'>Product Insert Successful<p>";
        } else {
            return "<p class='alert alert-danger fadeout'>Failed To Insert Product<p>";
        }
    }

    public function getsingleProduct($product_id)
    {
        $product_id = $this->helpObj->validAndEscape($product_id);
        $query = "select * from tbl_product where serial='$product_id'";
        return $this->dbObj->select($query);
    }

    /**
     * Update Single Product
     * @param $data
     */
    public function updateProduct($data)
    {
        $serial = $this->helpObj->validAndEscape($data['serial']);
        $product_name = $this->helpObj->validAndEscape($data['product_name']);
        $sku = $this->helpObj->validAndEscape($data['sku']);
        $retail_price = $this->helpObj->validAndEscape($data['retail_price']);
        $sale_price = $this->helpObj->validAndEscape($data['sale_price']);
        $whole_price = $this->helpObj->validAndEscape($data['whole_price']);
        $brand_name = $this->helpObj->validAndEscape($data['brand_name']);
        $category_name = $this->helpObj->validAndEscape($data['category_name']);
        $stock = $this->helpObj->validAndEscape($data['stock']);
        $size = $this->helpObj->validAndEscape($data['size']);
        $last_update = date('current_timestamp'); //set default time at Asia/Dhaka on header.php

        $query = "UPDATE tbl_product
                            SET
                            product_name = '$product_name',    
                            sku = '$sku',
                            sale_price = '$sale_price',
                            retail_price = '$retail_price$',    
                            whole_price = '$whole_price',   
                            brand_name   ='$brand_name',
                            category_name   ='$category_name',
                            stock   ='$stock',
                            size   ='$size',
                            last_update ='$last_update'
                            where product_id='$serial' ";

        if ($this->dbObj->update($query)) {
            Session::set('success', "<p class='alert alert-success fadeout'>Product Updated Successfully<p>");
        } else {
            Session::set('error', "<p class='alert alert-danger fadeout'>Failed to update product<p>");
        }
        header('location: products.php');
        exit;
    }

    /**
     * Export All Products
     * Generate as CSV
     */
    public function allProductCSV()
    {
        $sql = 'select * from tbl_product ';
        $csvColumn = [
            'Serial',
            'Product_id',
            'Product_name',
            'Sku',
            'Retail Price',
            'Sale Price',
            'Whole Price',
            'Brand Name',
            'Category Name',
            'Stock',
            'Low Stock',
            'Size',
            'Color',
            'Url',
            'Created At',
            'Updated At',
        ];
        $this->helpObj->generateCSV($sql, 'Product-' . date('d-m-Y h-i-sa') . '.csv', $csvColumn);
    }

    /**
     * Export Stock Out Product
     * Generate as CSV
     */
    public function outOfStockProductCSV()
    {
        $sql = 'select * from tbl_product where stock=0';
        $csvColumn = [
            'Serial',
            'Product_id',
            'Product_name',
            'Sku',
            'Retail Price',
            'Sale Price',
            'Whole Price',
            'Brand Name',
            'Category Name',
            'Stock',
            'Low Stock',
            'Size',
            'Color',
            'Url',
            'Created At',
            'Updated At',
        ];
        $this->helpObj->generateCSV($sql, 'Out of Stock Product ' . date('d-m-Y h-i-sa') . '.csv', $csvColumn);
    }

    /**
     * Export Stock Out Product
     * Generate as CSV
     */
    public function lowStockProductCSV()
    {
        $sql = 'select * from tbl_product where low_stock=1';
        $csvColumn = [
            'Serial',
            'Product_id',
            'Product_name',
            'Sku',
            'Retail Price',
            'Sale Price',
            'Whole Price',
            'Brand Name',
            'Category Name',
            'Stock',
            'Low Stock',
            'Size',
            'Color',
            'Url',
            'Created At',
            'Updated At',
        ];
        $this->helpObj->generateCSV($sql, 'Low Stock Product ' . date('d-m-Y h-i-sa') . '.csv', $csvColumn);
    }
}