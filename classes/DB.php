<?php

class Database
{

    public $link;

    /*
    !-----------------------------------------------------
    !      initial load at the time of creating object
    !      no return job
    !----------------------------------------------------
    */
    function __construct()
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
        $this->getConfiguration();

        $link = new mysqli(DATABASE_HOST, DATABASE_USERNAME, DATABASE_PASSWORD, DATABASE_NAME);
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
        $stmt = $this->link->query($query) or die($this->link->error) . " error at line number " . __LINE__;;
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
        $stmt = $this->link->query($query) or die($this->link->error) . " error at line number " . __LINE__;;
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
        $stmt = $this->link->query($query) or die($this->link->error) . " error at line number " . __LINE__;;
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
        $stmt = $this->link->query($query) or die($this->link->error) . " error at line number " . __LINE__;;
        if ($stmt->num_rows > 0) {
            return $stmt->num_rows;
        } else {
            return false;
        }
    }

   /*
    ! -------------------------------------------------
    !Get Database Configuration file from config.php
    ! ---------------------------------------------------
    */
    private function getConfiguration()
    {
        $path = realpath(dirname(__DIR__));
        include_once $path . '/config/config.php';
    }

}
