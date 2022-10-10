<?php

class DatabaseConnection
{

    // Connection details
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "test_db";
    private $connection;

    // Constructor for database object
    function __construct()
    {
        $this->connection = new mysqli($this->host, $this->username, $this->password, $this->database);
        if ($this->connection->connect_error) {
            die("Connection failed : " . $this->connection->connect_error);
        }
    }

    // Code for DQL => Data Query Language
    // This function is for 'SELECT'
    public function runDQL($query)
    {
        $result = $this->connection->query($query);
        if ($result->num_rows > 0) {
            return $result;
        } else {
            return [];
        }
    }


    // Code for DML => Data Manipulation Language
    // This function is for 'INSERT,UPDATE,DELETE'
    public function runDML($query)
    {
        $result = $this->connection->query($query);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}






//DDL statement used to create users table in the "test_db" database

// create table users(
//     id int(11) auto_increment not null ,
//     name varchar(100) not null,
//     email varchar(255) unique not null ,
//     gender enum('m','f') not null,
//     mail_status enum('true','false') default('false'),
//     primary key (id)
// );
