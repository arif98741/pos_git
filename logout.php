<?php
include_once 'classes/Session.php';
Session::checkSession();
if (isset($_GET['action'])) {
    Session::destroy();
    header("location: login.php");
} else {
    header("location: index.php");
}
