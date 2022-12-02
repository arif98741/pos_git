<?php

/**
 *
 */
class Session
{

    /**
     * @param $key
     * @param $val
     * @return void
     */
    public static function set($key, $val)
    {
        $_SESSION[$key] = $val;
    }

    /**
     * @return void
     */
    public static function checkSession()
    {
        self::init();
        if (self::get("login") == false) {
            self::destroy();
            header('Location: login.php');
        }
    }

    /**
     * @return void
     */
    public static function init()
    {

        session_start();

    }

    /**
     * @param $key
     * @return false|mixed
     */
    public static function get($key)
    {
        return $_SESSION[$key] ?? false;
    }

    /**
     * @return void
     */
    public static function destroy()
    {
        session_destroy();
        header('Location: login.php');
    }

    /**
     * @return void
     */
    public static function checkLogin()
    {
        self::init();
        if (self::get("login")) {
            header('Location: index.php');
        }
    }

}
