<?php
include_once 'DB.php';
include_once 'helper/Helper.php';

class News {

    private $dbObj;
    private $helpObj;
    private $msg;

    public function __construct() {

        $this->dbObj = new Database();
        $this->helpObj = new Helper();
        date_default_timezone_set('Asia/Dhaka');
    }



    /*
    @ add news  in addnews.php
    @ table = news
    @ action newslist.php
    */
    function addNews($data)
    {
        $title = $this->helpObj->validAndEscape($data['title']);
        $description = $data['description'];
        $photo  =  'news' . date('Y-m-d-H-i-s') . '_' . uniqid() . '.jpg';
        $date = date('Y-m-d h:i:s');
       
        $query = "insert into news(title,description,photo,date) values('$title','$description','$photo','$date')";
        $stmt = $this->dbObj->link->query($query) or die($this->dbObj->link->error)." ".__LINE__;
        if ($stmt) {     
            move_uploaded_file($_FILES["photo"]["tmp_name"], "../photo/news/".$photo);
            return "<script>alert('News Added Successful');</script>";
        }else{
             return "<script>alert('News Added Failed');</script>";
        }

    }



     /*
    @ update news  in editnews.php
    @ table = news
    @ action newslist.php
    */
    function updateNews($data)
    {

        $id = $this->helpObj->validAndEscape($data['newsid']);
        $title = $this->helpObj->validAndEscape($data['title']);
        $description = $data['description'];
        $photo  =  'news' . date('Y-m-d-H-i-s') . '_' . uniqid() . '.jpg';
        

        if (strpos($_FILES["photo"]["tmp_name"],'.tmp') == "" || strpos($_FILES["photo"]["tmp_name"],'.tmp') == null) {
            
            $query = "update news set title ='$title', description = '$description' where id='$id'";
            $stmt = $this->dbObj->link->query($query) or die($this->dbObj->link->error)." ".__LINE__;
            if ($stmt) {
                 return "<script>alert('News Updated Successful');</script>";
            }else{
                return "<script>alert('News Updated Failed');</script>";
            }
        }else{
            $chstmt =  $this->dbObj->link->query("select * from news where id ='$id'") or die($this->dbObj->link->error)." ".__LINE__;
            if ($chstmt) {
                $data = $chstmt->fetch_assoc();
            }
             $query = "update news set title ='$title', description = '$description', photo = '$photo' where id='$id'";

             if (file_exists("../photo/news/".$data['photo'])) {
                 unlink("../photo/news/".$data['photo']);
             }
            $stmt = $this->dbObj->link->query($query) or die($this->dbObj->link->error)." ".__LINE__;
            if ($stmt) {
                move_uploaded_file($_FILES["photo"]["tmp_name"], "../photo/news/".$photo);
                return "<script>alert('News Updated Successful');</script>";
            }else{
                return "<script>alert('News Updated Failed');</script>";
            }
        }

    }

    /*
    @ show news in newslist.php
    @ table = news
    */
    function showNews()
    {

        $query = "SELECT * FROM `news` where status='active' order by date desc";
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
