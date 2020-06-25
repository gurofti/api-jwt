<?php

class Database {

    // variable declaration
    private $hostname;
    private $dbname;
    private $username;
    private $password;

    private $conn;

    public function connect()
    {
        // vehicle initialization
        $this->hostname =   "localhost";
        $this->dbname   =   "rest_php_api";
        $this->username =   "root";
        $this->password =   "";

        $this->conn     =   mysqli_connect(
            $this->hostname,
            $this->username,
            $this->password,
            $this->dbname);

        if ($this->conn->connect_errno) {
            // true => it means that it has some error
            print_r($this->conn->connect_error);
            exit;
        } else {
            // false => it means no error in connection details
            // echo "--successful connection--";
            // print_r($this->conn);
            return $this->conn;
        }

    }
}

// $db     =   new Database();
// $db->connect();