<?php
$path = realpath(dirname(__DIR__));
include_once 'DB.php';
include_once 'Session.php';
include_once $path.'/helper/Helper.php';

class Laser {

    private $loginObj;
    private $dbObj;
    private $helpObj;

    public function __construct() {
        $this->dbObj = new Database();
        $this->helpObj = new Helper();
    }

   
    /*
    @ view lasers in laserlist.php
    @ return object
    */
    public function showLaser() {

        $q = "SELECT * FROM tbl_laser tl join tbl_transactioncat ttc on tl.category = ttc.id order by serial desc";
        $stmt = $this->dbObj->select($q);
        if($stmt){

           return $stmt;
        }
    }


    /**
    @ show ledger category in addlaser.php
    */
    public function showCategory()
    {
        $q = "SELECT * FROM  tbl_transactioncat order by category_name asc";
        $stmt = $this->dbObj->select($q);
        if($stmt){
           return $stmt;
        }else{
            return false;
        }
    }



     /**
    @ show ledger category in printfiles/ledger/ledger_report.php
    */
    public function showCategoryByID($catid)
    {
        $q = "SELECT * FROM  tbl_transactioncat where id='$catid' order by category_name asc";
        $stmt = $this->dbObj->select($q);
        if($stmt){
           return $stmt->fetch_assoc()['category_name'];
        }else{
            return false;
        }
    }







    /*
    @ add laser data to tbl_laser table
    @ return boolean
    */
    public function addLaser($data) {

        $category = $this->helpObj->validAndEscape($data['category']);
        $donor = $this->helpObj->validAndEscape($data['donor']);
        $receiver = $this->helpObj->validAndEscape($data['receiver']);
        $debit = $this->helpObj->validAndEscape($data['debit']);
        $credit = $this->helpObj->validAndEscape($data['credit']);
        $description = $this->helpObj->validAndEscape($data['description']);
        $updateby = $_SESSION['userid'];
        $date = date('Y-m-d h:i:s');

        $query = "insert into tbl_laser(category,donor,receiver,debit,credit,description,updateby,date) values('$category','$donor','$receiver','$debit','$credit','$description','$updateby','$date')";
       
        $status = $this->dbObj->link->query($query);
        if ($status) {
            return true;
            
        } else {
            return false;
        }
        
    }


     /*
    @ delete laser data from tbl_laser table
    @ return boolean
    */
    public function deleteLaser($serial) {
        $serial = $this->helpObj->validAndEscape($serial);

        $query = "DELETE from tbl_laser where serial ='$serial'";
        $sta = $this->dbObj->delete($query);
        if ($sta) {
            return true;
        } else {
            return false;
        }
    }


     /*
    @ select single laser data from tbl_laser table
    @ return object
    */
    public function getSingleLaserdetails($serial) {
        $product_id = $this->helpObj->validAndEscape($serial);
        $query = "select * from tbl_laser where serial='$serial'";
        $sta = $this->dbObj->select($query);
        return $sta;
    }


     /*
    @ update laser data to tbl_laser table
    @ return boolean
    */
    public function updateLaser($data) {

        $category = $this->helpObj->validAndEscape($data['category']);
        $donor = $this->helpObj->validAndEscape($data['donor']);
        $receiver = $this->helpObj->validAndEscape($data['receiver']);
        $debit = $this->helpObj->validAndEscape($data['debit']);
        $credit = $this->helpObj->validAndEscape($data['credit']);
        $description = $this->helpObj->validAndEscape($data['description']);
        $laserid = $this->helpObj->validAndEscape($data['laserid']);
        $updateby = $_SESSION['userid'];
        $date = date('Y-m-d h:i:s');

        $query = "UPDATE tbl_laser
                            SET
                            category = '$category',    
                            donor = '$donor',    
                            receiver = '$receiver',    
                            debit = '$debit',
                            credit = '$credit',
                            description = '$description',
                            updateby ='$updateby'    
                            where serial='$laserid' ";

        $sta = $this->dbObj->update($query);
        if ($sta) {
            return true;
        } else {
            return false;
        }
    }


    
}
