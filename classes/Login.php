<?php
include_once 'Session.php';
include_once 'helper/Helper.php';

class Login
{

    private $dbObj;
    private $helpObj;

    public function __construct()
    {

        $this->dbObj = new Database();
        $this->helpObj = new Helper();
    }


    /**
     * @ user login system
     * @
     */
    public function login($data)
    {
        $username = $data['username'];
        $password = $data['password'];
        $message = '';
        if (empty($username) || empty($password)) {
            return $message = "<p class='alert alert-danger' id='message'><i class='fa fa-times'></i>&nbsp;Username or Password Must Not be Empty</p>";
        } else {
            $username = $this->helpObj->validAndEscape($username);
            $password = md5($this->helpObj->validAndEscape($password));

            $query = "select * from tbl_user where username ='$username' and password = '$password'";
            $status = $this->dbObj->select($query);
            if ($status) {
                $data = $status->fetch_assoc();
                //Session::init();
                Session::set('login', true);
                Session::set('username', $data['username']);
                Session::set('userid', $data['userid']);
                Session::set('name', $data['name']);
                Session::set('email', $data['email']);
                Session::set('company_name', $data['company_name']);
                Session::set('logo', $data['logo']);
                Session::set('status', $data['status']);

                //echo "<script>window.location='index.php'</script>"; //redirecting to home page(index.php)
                header("Location: index.php");
            } else {
                $this->saveAttemptUser(array(
                    'username' => $username,
                    'password' => $data['password']
                ));
                return $message = "<p class='' id='message'><i class='fa fa-times'></i>&nbsp;Username or Password Not Matched</p>";
            }
        }
    }

    /**
     * save accessed missing user
     */

    public function saveAttemptUser($data)
    {
        date_default_timezone_set('Asia/Dhaka');
        $ip = $_SERVER['REMOTE_ADDR'];
        $username = $this->helpObj->validAndEscape($data['username']);
        $password = $this->helpObj->validAndEscape($data['password']);
        $date = date('Y-m-d h:i:s');
        $query = "insert into tbl_accesslog(ip,user,pass,date) values('$ip','$username','$password','$date')";
        $status = $this->dbObj->link->query($query);
        $delq = "DELETE FROM tbl_accesslog WHERE date < NOW() - INTERVAL 10 DAY";
        $status = $this->dbObj->link->query($delq);
        if ($status) {
            return true;
        }
    }

    /**
     * @ save user as stuff to database
     */

    public function addUser($data)
    {
        $name = $this->helpObj->validAndEscape($data['name']);
        $username = $this->helpObj->validAndEscape($data['username']);
        $password = $this->helpObj->validAndEscape(md5($data['password']));
        $email = $this->helpObj->validAndEscape($data['email']);
        $msg = '';

        $stmt = $this->dbObj->link->query("select * from tbl_user where username='admin'");
        if ($stmt) {
            $obj = $stmt->fetch_object();
            $company_name = $obj->company_name;
            $address = $obj->address;
            $logo = $obj->logo;

            $checkQ = $this->dbObj->link->query("select * from tbl_user where username = '$username' or email = '$email'");
            if ($checkQ) {
                if ($checkQ->num_rows > 0) {
                    $msg = "<script>alert('Stuff already Exist');</script>";
                } else {
                    $stmt1 = $this->dbObj->link->query("insert into tbl_user(name,username,password,email,company_name,address,logo) values('$name','$username','$password','$email','$company_name','$address','$logo')");
                    if ($stmt1) {
                        $msg = "<script>alert('Stuff Added Successfully');</script>";
                    }
                }
            }


        }

        return $msg;


    }

    /**
     * @ update user as stuff to database
     */

    public function updateUser($data)
    {
        $userid = $this->helpObj->validAndEscape($data['userid']);
        $name = $this->helpObj->validAndEscape($data['name']);
        //$username = $this->helpObj->validAndEscape($data['username']);
        $password = $this->helpObj->validAndEscape(md5($data['password']));
        $email = $this->helpObj->validAndEscape($data['email']);
        $msg = '';

        if ($password != '' || $password != null) {
            $stmt = $this->dbObj->update("update tbl_user set name='$name',password='$password',email='$email' where userid='$userid'");
            if ($stmt) {
                $msg = "<script>alert('Stuff Updated Successfully');</script>";
            } else {
                $msg = "<script>alert('Stuff Update Failed');</script>";
            }
        } else {
            $stmt = $this->dbObj->update("update tbl_user set name='$name',email='$email' where userid='$userid'") or die($this->dbObj->link->error) . " error at line number " . __LINE__;
            if ($stmt) {
                $msg = "<script>alert('Stuff Updated Successfully');</script>";
            } else {
                $msg = "<script>alert('Stuff Update Failed');</script>";
            }
        }

        return $msg;
    }

    /**
     * @show attemp user
     **/
    public function showAttemptUser()
    {
        $query = "select * from tbl_accesslog order by id desc";
        $status = $this->dbObj->select($query);
        if ($status) {
            return $status;
        }
    }


    /**
     * @ access log saving in database
     */

    function accessLog($ip, $needs)
    {
        $cSession = curl_init();
        curl_setopt($cSession, CURLOPT_URL, "http://ip-api.com/json/" . $ip);
        curl_setopt($cSession, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($cSession, CURLOPT_HEADER, false);

        $result = curl_exec($cSession);

        curl_close($cSession);

        $data = json_decode($result);
        //  echo $data;

        if ($needs == 'city') {
            return $data->city;
        } else if ($needs == 'country') {
            return $data->country;
        } else if ($needs == 'isp') {
            return $data->isp;
        } else if ($needs == 'zip') {
            return $data->zip;
        } else {
            return null;
        }


    }

}
