<?php
$path = realpath(dirname(__DIR__));
require $path . '/vendor/autoload.php';
/*
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

$whoops = new Run;
$whoops->pushHandler(new PrettyPageHandler);
$whoops->register();
*/

spl_autoload_register(function ($class) {
    $filepath = realpath(dirname(__DIR__));
    include_once $filepath . '/classes/' . $class . '.php';
});

Session::checkSession();
include_once 'helper/Helper.php';

$db = new Database();
$log = new Login();
$pro = new Product();
$sel = new Sell();
$sup = new Supplier();
$cus = new Customer();
$inv = new Invoice();
$sto = new Stock();
$las = new Laser();
$ext = new Extra();
$help = new Helper();

if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    session_destroy();
    echo "<script>window.location = 'login.php';</script>";
}