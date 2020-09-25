<?php
require 'classes/Database.php';
require 'helper/Helper.php';
require 'classes/Product.php';
$pro = new Product();
$pro->outOfStockProductCSV();

?>
