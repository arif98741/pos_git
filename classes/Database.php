<?php

/*
 * Copyright (c) 9/26/20, 1:55 PM. This file is created and maintained by Ariful Islam.
 * This is the private  property of mine. If you want to use this for personal use this is ok.
 * But for commercial use you must have to contact with me for further process. Here is my contact details..
 * Github: https://github.com/arif98741
 * Twitter: https://twitter.com/arif98741
 * Email: arif98741@gmail.com
 */
$path = realpath(dirname(__DIR__));
require $path . '/vendor/autoload.php';
require $path . '/config/config.php';


class Database
{

    public $link;
    private $username = USERNAME;
    private $password = PASSWORD;
    private $host = HOST;
    private $database = DATABASE;

    /*
    !-----------------------------------------------------
    !      initial load at the time of creating object
    !      no return job
    !----------------------------------------------------
    */
    public function __construct()

    {
        $this->link = $this->connection();
    }


    /*
    !-----------------------------------------------------
    !      database connection
    !      return as connection object
    !----------------------------------------------------
    */
    public function connection()
    {
        $link = new mysqli($this->host, $this->username, $this->password, $this->database);
        if (!$link) {
            return die('Connection Failed');
        } else {
            return $link;
        }
    }


    /*
    !-----------------------------------------------------
    !      select data from database
    !      return as object
    !----------------------------------------------------
    */
    public function select($query)
    {
        $stmt = $this->link->query($query) or die($this->link->error) . " error at line number " . __LINE__;

        if ($stmt) {
            if ($stmt->num_rows > 0) {
                return $stmt;
            } else {
                return false;
            }
        }

    }


    /*
    !-----------------------------------------------------
    !      select data from database
    !      return as associative array
    !----------------------------------------------------
    */
    public function selectFetchAssoc($query)
    {
        $stmt = $this->link->query($query);
        if ($stmt->num_rows > 0) {
            return $stmt->fetch_assoc();
        } else {
            return false;
        }
    }

    /*
    !-----------------------------------------------------
    !      insert data into database
    !      @param $query
    !      @ return true/false
    !----------------------------------------------------
    */
    public function insert($query)
    {
        $stmt = $this->link->query($query) or die($this->link->error) . " error at line number " . __LINE__;
        if ($stmt) {
            return $stmt;
        } else {
            return false;
        }
    }

    /*
    !-----------------------------------------------------
    !      update data in database
    !      @param $query
    !      @ return as object
    !      @ true/false
    !----------------------------------------------------
    */
    public function update($query)
    {
        $stmt = $this->link->query($query) or die($this->link->error) . " error at line number " . __LINE__;
        if ($stmt) {
            return true;
        } else {
            return false;
        }
    }


    /*
    !-----------------------------------------------------
    !      delete data from database
    !      @param $query
    !      @ return boolean
    !----------------------------------------------------
    */
    public function delete($query)
    {
        $stmt = $this->link->query($query) or die($this->link->error) . " error at line number " . __LINE__;

        if ($stmt) {
            return true;
        } else {
            return false;
        }
    }

    /*
    !-----------------------------------------------------
    !      count row of table in database
    !      return as number
    !----------------------------------------------------
    */
    public function rowCount($query)
    {
        $stmt = $this->link->query($query) or die($this->link->error) . " error at line number " . __LINE__;

        if ($stmt->num_rows > 0) {
            return $stmt->num_rows;
        } else {
            return false;
        }
    }

}
