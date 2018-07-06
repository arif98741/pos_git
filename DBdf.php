<?php

class Database {
    //this is file is no longer maintained

    public $link;
    private $username = 'aladinpos';
    private $password = 'explore+88';
    private $host = 'localhost';
    private $database = 'aladinpo_pos';

    function __construct() {
        $this->link = $this->connection();
    }

    public function connection() {
        $link = new mysqli($this->host, $this->username, $this->password, $this->database);
        if (!$link) {
            return die('Connection Failed');
        } else {
            return $link;
        }
    }

    public function select($query) {
        $stmt = $this->link->query($query);
        if ($stmt->num_rows > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    
    public function selectFetchAssoc($query) {
        $stmt = $this->link->query($query);
        if ($stmt->num_rows > 0) {
            return $stmt->fetch_assoc();
        } else {
            return false;
        }
    }

    public function insert($query) {
        $stmt = $this->link->query($query);
        if ($stmt) {
            return $stmt;
        } else {
            return false;
        }
    }

    public function update($query) {
        $stmt = $this->link->query($query);
        if ($stmt) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($query) {
        $stmt = $this->link->query($query);
        if ($stmt) {
            return true;
        } else {
            return false;
        }
    }

    public function rowCount($query) {
        $stmt = $this->link->query($query);
        if ($stmt->num_rows > 0) {
            return $stmt->num_rows;
        } else {
            return false;
        }
    }

}
