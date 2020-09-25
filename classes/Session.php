<?php

class Session
{

    public static function set($key, $val)
    {
        $_SESSION[$key] = $val;
    }

    public static function checkSession()
    {
        self::init();
        if (self::get("login") == false) {
            self::destroy();
            header('Location: login.php');
        }
    }

    public static function init()
    {
        session_start();
    }

    public static function get($key)
    {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        } else {
            return false;
        }
    }

    public static function destroy()
    {
        session_destroy();
        header('Location: login.php');
    }

    /**
     * Unset Session if Exist
     * @param $key
     * @return void
     */
    public static function unsetSession($key)
    {
        if (array_key_exists($key, $_SESSION)) {
            unset($_SESSION[$key]);
        }
    }

    /**
     * Check Login Status
     */
    public static function checkLogin()
    {
        self::init();
        if (self::get("login") == true) {
            header('Location: index.php');
        }
    }


    /**
     * Check Session key existance
     * @param $key
     * @return bool
     */
    public static function keyExist($key)
    {
        if (array_key_exists($key, $_SESSION)) {
            return true;
        } else {

            return false;
        }
    }


}

?>