<?php
include_once 'DB.php';
include_once 'helper/Helper.php';

class Manage {

    private $dbObj;
    private $helpObj;
    private $msg;

    public function __construct() {

        $this->dbObj = new Database();
        $this->helpObj = new Helper();
    }


    /*
     * showing applicant list in applicationlist.php 
     * */

    public function addRegistant($data) {
        $fullname = $this->helpObj->validAndEscape($data['fullname']);
        $dob = $this->helpObj->validAndEscape($data['dob']);
        $gender = $this->helpObj->validAndEscape($data['gender']);
        $father = $this->helpObj->validAndEscape($data['father']);
        $contact = $this->helpObj->validAndEscape($data['contact']);
        $address = $this->helpObj->validAndEscape($data['address']);
        $email = $this->helpObj->validAndEscape($data['email']);
        $batchyear = $this->helpObj->validAndEscape($data['batchyear']);
        $occupation = $this->helpObj->validAndEscape($data['occupation']);
        $fam_member_name = $this->helpObj->validAndEscape($data['fam_member_name']);
        $relation = $this->helpObj->validAndEscape($data['relation']);

        $photo  =  'photo' . date('Y-m-d-H-i-s') . '_' . uniqid() . '.jpg';
        $msg = '';

        $checkstmt = $this->dbObj->link->query("SELECT * from registration where email ='$email' or contact='$contact'");
        if ($checkstmt) {
            $row = $checkstmt->num_rows;
            if($row > 0){
                return "<col-md-12 width='100%'><span class='alert alert-warning'>You have already registered on <strong>Celebration 75 years - CGSA COLLEGE</strong>.</span></div>";
            }else{
                $query = "insert into registration(
                fullname,dob,gender,father,contact,address,email,batchyear,
                occupation,photo,fam_member_name,relation
                ) values('$fullname','$dob','$gender','$father','$contact','$address','$email','$batchyear','$occupation','$photo','$fam_member_name', '$relation')";

                $stmt = $this->dbObj->insert($query);
                if ($stmt) {
                    move_uploaded_file($_FILES["photo"]["tmp_name"], "photo/".$photo);
                    $status =  $this->confirmation($data); //save confirm code in confirmation table

                    if ($status) {
                        return "<col-md-12><span class='alert alert-success'>You have successfully registered to <strong>Celebration 75 years - CGSA COLLEGE</strong>. Please check your email for the confirmation....</span></div>";
                    }else{
                        return "<span class='alert alert-warning'>Failed! Unknown Error. Please Contact Support</span>";
                    }
                } else {
                    return false;
                }
            }
        }

        
    }


    //confirmation email
    function confirmation($data)
    {
        $email = $this->helpObj->validAndEscape($data['email']);
        $query = "select id from registration where email='$email'";
        $stmt = $this->dbObj->select($query);
        if ($stmt) {
            $registant_id = $stmt->fetch_object()->id;
            $confirm_code = $this->RandomString(32);
            $query = "insert into confirmation( registant_id,confirm_code) values('$registant_id','$confirm_code')";
            $in_stmt = $this->dbObj->insert($query);
            if ($in_stmt) {
                $status = $this->confirmMail($email,$confirm_code); //send confirmation mail to user
                if ($status) {
                    return true;
                }else{
                    false;
                }
            }
        }


    }


    //send confirmation mail to user inbox
    function confirmMail($email,$confirm_code)
    {
                // Multiple recipients
        $to = $email; // note the comma

        // Subject
        $subject = 'Registration Confirmation';
       
        $message = '
        <html>
        <head>
          <title>Registration Confirmation</title>
        </head>
        <body>'.'<a style="font-size:18px;" href="http://localhost/powrosova?status=notclicked&token='.$confirm_code.'">Click To Confirm Your Registration</a>'.
          '<p>Thanks for your registration</p>
          
        </body>
        </html>
        ';

        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=iso-8859-1';
        $headers[] = 'From: Event Registration <no-reply@example.com>';

        $status = mail($to, $subject, $message, implode("\r\n", $headers));
        if ($status) {
            return true;
        }else{
            return false;
        }
    }

    //update confirmation mail 
    function updateConfirmation($token) //update token and registration pending
    {
         $token = $this->helpObj->validAndEscape($token);
         $stmt1 = $this->dbObj->update("update confirmation set status='clicked' where confirm_code='$token'");
         $stmt2 = $this->dbObj->select("select registant_id from confirmation where confirm_code='$token'");
         if ($stmt2) {
             $registant_id = $stmt2->fetch_object()->registant_id;
             $stmt1 = $this->dbObj->update("update registration set status='pending' where id='$registant_id'");
         }
    }


    //random string
    function RandomString($length) {
        $keys = array_merge(range(0,9), range('a', 'z'));

        $key = "";
        for($i=0; $i < $length; $i++) {
            $key .= $keys[mt_rand(0, count($keys) - 1)];
        }
        return $key;
    }

    /*
    @ add payment in payment.php
    @ action index.php
    @method post
    */
    function addPayment($data)
    {
        $registant_id = $this->helpObj->validAndEscape($data['registant_id']);
        $method = $this->helpObj->validAndEscape($data['method']);
        $amount = $this->helpObj->validAndEscape($data['amount']);
        $transaction_id = $this->helpObj->validAndEscape($data['transaction_id']);

        $checkquery = "select * from ledger where method='$method' and transaction_id='$transaction_id'";
        $checkstmt = $this->dbObj->link->query($checkquery);
        if ($checkstmt) {
            if ($checkstmt->num_rows > 0) {
                 return "<col-md-12><span class='alert alert-warning'>Your given transaction id has already been used. Please try by another.....</span></div>";
            }else{
                $query = "insert into ledger(registant_id,method,transaction_id,amount) 
                values('$registant_id','$method','$transaction_id','$amount')";
                $stmt = $this->dbObj->link->query($query);
                if ($stmt) {
                    return  "<col-md-12><span class='alert alert-success'>You have successully paid for<strong>Celebration 75 years - CGSA COLLEGE</strong></span></div>";
                }else{
                   return  "<col-md-12><span class='alert alert-warning'>Failed to pay for<strong>Celebration 75 years - CGSA COLLEGE</strong></span></div>";
                }
            }
        }


        
    }


    /*
    @ show registant in pending.php
    @ table = ledger
    */
    function showPendingRegistant()
    {

        $query = "select * from registration where status='pending' order by id desc";
        $stmt = $this->dbObj->link->query($query);
        if ($stmt) {
            return $stmt;
        }else{
            return false;
        }

    }


    
    /*
    @ show registant in pending.php
    @ table = ledger
    */
    function showApprovedRegistant()
    {

        $query = "select * from registration where status='approved' order by id desc";
        $stmt = $this->dbObj->link->query($query);
        if ($stmt) {
            return $stmt;
        }else{
            return false;
        }

    }



    /*
    @ add committee  in addcommiteemeber.php
    @ table = committee
    @ action viewcommitee.php
    */
    function addCommittee($data)
    {
        $name = $this->helpObj->validAndEscape($data['name']);
        $designation = $this->helpObj->validAndEscape($data['designation']);
        $address = $this->helpObj->validAndEscape($data['address']);
        $contact = $this->helpObj->validAndEscape($data['contact']);
        $photo  =  'photo' . date('Y-m-d-H-i-s') . '_' . uniqid() . '.jpg';

        $chstmt =  $this->dbObj->link->query("select * from committee where contact ='$contact'");
        if ($chstmt) {
            if ($row = $chstmt->num_rows > 0) {
                 return "<script>alert('Member Already Exist');</script>";
            }else{
                $query = "insert into committee (name,designation,address,contact,photo) values('$name','$designation','$address','$contact','$photo')";
                $stmt = $this->dbObj->link->query($query);
                if ($stmt) {
                    
                    move_uploaded_file($_FILES["photo"]["tmp_name"], "../photo/committee/".$photo);
                    return "<script>alert('Member Added Successful');</script>";
                }else{
                     return "<script>alert('Member Added Failed');</script>";
                }
            }
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
                 return "<script>alert('Member Update Successful');</script>";
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


    /*
    @ show committee member in viewcommimtee.php
    @ table = committee
    */
    function showCommittee()
    {

        $query = "SELECT * FROM `committee` order by name asc";
        $stmt = $this->dbObj->link->query($query);
        if ($stmt) {

            return $stmt;
        }else{
            return false;
        }

    }











}
