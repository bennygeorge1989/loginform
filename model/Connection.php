<?php

class Connection
{
    public function __construct() {  
      
    }

    public function connect()
    {
        require_once('./config.php');  
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABSE);
        
        if ($conn->connect_errno) {
            printf("Connect failed: %s\n", $conn->connect_error);
            exit();
        } 
        return $conn;
    }
    public function Close()
    {  
        mysql_close();  
    }  
}