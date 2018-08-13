<?php

class Session {

    /*
    !---------------------------
    !   Initialize Session 
    !---------------------------
    */
    public static function init() {
        
        session_start();

    }


    /*
    !---------------------------
    !   Set Session Value
    !---------------------------
    */
    public static function set($key, $val) {
        $_SESSION[$key] = $val;
    }


    /*
    !---------------------------
    !  Get Session Value
    !  @param key
    !---------------------------
    */
    public static function get($key) {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        } else {
            return false;
        }
    }


    /*
    !---------------------------
    !   Check User Login Status
    !  @return bool
    !---------------------------
    */
    public static function checkSession() {
        self::init();
        if (self::get("login") == false) {
            self::destroy();
            header('Location: login.php');
        }
    }


    /*
    !--------------------------------------
    !   Check user login 
    !   if true> redirect to homepage
    !--------------------------------------
    */
    public static function checkLogin() {
        self::init();
        if (self::get("login") == true) {
            header('Location: index.php');
        }
    }

    /*
    !---------------------------
    !   Destroy Session Date
    !---------------------------
    */
    public static function destroy() {
        session_destroy();
        header('Location: login.php');
    }

}

?>