<?php
$path = realpath(dirname(__DIR__));
include_once $path.'/classes/DB.php';

class Helper {

    public $dbObj;

    function __construct() {
        $this->dbObj = new Database();
    }

    public function validation($data) {
        $c = trim($data);
        $d = htmlspecialchars($c);
        $e = stripslashes($d);
        return $e;
    }

    public function realEscape($data) {
        $data = mysqli_real_escape_string($this->dbObj->link, $data);
        return $data;
    }

    public function validAndEscape($data) {
        $d = $this->validation($data);
        $e = $this->realEscape($d);
        return $e;
    }

    public function validArrayData($data) {
        $data = $this->validation($data);
        $data = $this->realEscape($data);
        return $data;
    }

    public function formatDate($date, $format = 'd-m-Y') {
        return date($format, strtotime($date));
    }

    public function validEmail($data) {
        if (filter_var($data, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }

    public function validInt($data) {
        if (filter_var($data, FILTER_VALIDATE_INT)) {
            return true;
        } else {
            return false;
        }
    }

    public function validFloat($data) {
        if (filter_var($data, FILTER_VALIDATE_FLOAT)) {
            return true;
        } else {
            return false;
        }
    }

    public function calQuantity($data) {
        $total = 0;
        for ($i = 0; $i < count($data); $i++) {
            $total += $data;
        }
        return $total;
    }


    public function nullChecker($data)
    {
        if($data == null)
        {
            return 0;
        }else{
            return $data;
        }
    }

}

?>