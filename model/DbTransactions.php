<?php
include 'Connection.php';
session_start();

class DbTransactions
{
    function __construct() {
        $this->conn = new Connection();
        $this->db = $this->conn->connect();
    }

    public function loginUser($emailId, $password) : bool
    {
        $pwd = md5($password);
        $result = mysqli_query($this->db, "SELECT * FROM signup WHERE email = '".$emailId."' AND password = '".$pwd."'");
        $user_exists = mysqli_num_rows($result);	

        if($user_exists>=1) {
            $user = mysqli_fetch_array($result,MYSQLI_ASSOC);
            $_SESSION['user_id'] = $user["id"];

			return true;
        }

        return false;
    }

    public function getUser(int $id) : bool
    {
        $result = mysqli_query($this->db, "SELECT * FROM signup WHERE id = '".$id."'");
        $user_exists = mysqli_num_rows($result);	

        if($user_exists>=1) {
            $user = mysqli_fetch_array($result,MYSQLI_ASSOC);
            $_SESSION['first_name'] = $user["fname"];
            $_SESSION['last_name'] = $user["lname"];

            return true;
        }

        return false;
    }
}
