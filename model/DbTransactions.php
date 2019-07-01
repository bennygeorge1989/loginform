<?php
include 'Connection.php';
session_start();

class DbTrans
{
    function __construct() {
        $this->conn = new Connection();
    }

}
