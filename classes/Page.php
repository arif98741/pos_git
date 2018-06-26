<?php
include_once 'DB.php';
include_once 'helper/Helper.php';

class Page {

    private $dbObj;
    private $helpObj;
    private $msg;

    public function __construct() {

        $this->dbObj = new Database();
        $this->helpObj = new Helper();
        date_default_timezone_set('Asia/Dhaka');
    }



    /*
    @ add page  in addpage.php
    @ table = page
    @ action pagelist.php
    */
    function addPage($data)
    {
        $title = $this->helpObj->validAndEscape($data['title']);
        $description = $data['description'];
        $photo  =  'page' . date('Y-m-d-H-i-s') . '_' . uniqid() . '.jpg';
        $date = date('Y-m-d h:i:s');
       
        $query = "insert into page(title,description,photo,date) values('$title','$description','$photo','$date')";
        $stmt = $this->dbObj->link->query($query);
        if ($stmt) {     
            move_uploaded_file($_FILES["photo"]["tmp_name"], "../photo/page/".$photo);
            return "<script>alert('Page Added Successful');</script>";
        }else{
             return "<script>alert('Page Added Failed');</script>";
        }

    }



     /*
    @ update page  in editnpage.php
    @ table = page
    @ action pagelist.php
    */
    function updatePage($data)
    {

        $id = $this->helpObj->validAndEscape($data['pageid']);
        $title = $this->helpObj->validAndEscape($data['title']);
        $description = $data['description'];
        $photo  =  'page' . date('Y-m-d-H-i-s') . '_' . uniqid() . '.jpg';
        

        if (strpos($_FILES["photo"]["tmp_name"],'.tmp') == "" || strpos($_FILES["photo"]["tmp_name"],'.tmp') == null) {
            
            $query = "update page set title ='$title', description = '$description' where id='$id'";
            $stmt = $this->dbObj->link->query($query); 
            if ($stmt) {
                 return "<script>alert('Page Updated Successful');</script>";
            }else{
                return "<script>alert('Page Updated Failed');</script>";
            }
        }else{
            $chstmt =  $this->dbObj->link->query("select * from page where id ='$id'");
            if ($chstmt) {
                $data = $chstmt->fetch_assoc();
            }
             $query = "update page set title ='$title', description = '$description', photo = '$photo' where id='$id'";

             if (file_exists("../photo/page/".$data['photo'])) {
                 unlink("../photo/page/".$data['photo']);
             }
            $stmt = $this->dbObj->link->query($query); 
            if ($stmt) {
                move_uploaded_file($_FILES["photo"]["tmp_name"], "../photo/page/".$photo);
                return "<script>alert('Page Updated Successful');</script>";
            }else{
                return "<script>alert('Page Updated Failed');</script>";
            }
        }

    }

    /*
    @ show news in newslist.php
    @ table = news
    */
    function showPage()
    {

        $query = "SELECT * FROM `page` where status='active' order by date desc";
        $stmt = $this->dbObj->link->query($query);
        if ($stmt) {

            return $stmt;
        }else{
            return false;
        }

    }



    /*
    @ update committee  in editcommittee.php
    @ table = committee
    @ action editcommittee.php
    */
    function updateCommittee($data)
    {
        $name = $this->helpObj->validAndEscape($data['name']);
        $designation = $this->helpObj->validAndEscape($data['designation']);
        $address = $this->helpObj->validAndEscape($data['address']);
        $contact = $this->helpObj->validAndEscape($data['contact']);
        $member_id = $this->helpObj->validAndEscape($data['member_id']);
        $_FILES["photo"]["tmp_name"];
        $photo  =  'photo' . date('Y-m-d-H-i-s') . '_' . uniqid() . '.jpg';

        if (strpos($_FILES["photo"]["tmp_name"],'.tmp') == "" || strpos($_FILES["photo"]["tmp_name"],'.tmp') == null) {
            
            $query = "update committee set
             name ='$name',
             designation = '$designation',
             address = '$address',
             contact = '$contact' where id='$member_id'";
            $stmt = $this->dbObj->link->query($query); 
            if ($stmt) {
                 return "<script>alert('Member Update Succful');</script>";
            }else{
                return "<script>alert('Member Update Failed');</script>";
            }
        }else{
            $chstmt =  $this->dbObj->link->query("select * from committee where id ='$member_id'");
            if ($chstmt) {
                $data = $chstmt->fetch_assoc();
            }
             $query = "update committee set
             name ='$name',
             designation = '$designation',
             address = '$address',
             contact = '$contact', photo = '$photo' where id='$member_id'";

             if (file_exists("../photo/committee/".$data['photo'])) {
                 unlink("../photo/committee/".$data['photo']);
             }
            $stmt = $this->dbObj->link->query($query); 
            if ($stmt) {
                move_uploaded_file($_FILES["photo"]["tmp_name"], "../photo/committee/".$photo);
                return "<script>alert('Member Update Successful');</script>";
            }else{
                return "<script>alert('Member Update Failed');</script>";
            }
        }


    }


}
