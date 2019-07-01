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
        $_SESSION['error'] = 'Username and password not matching';

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
        $_SESSION['error'] = 'Error occurred Try again later';

        return false;
    }

    public function isUserExist($emailId) : array
    {
        $db = $this->conn->connect();
        $query = mysqli_query($db, "SELECT * FROM signup WHERE email = '".$emailId."'");
        $result = [];

        while ($record = mysqli_fetch_array($query)) {
            $result[] = $record;
        }

        return $result;
    }

    public function userRegister(array $data) : bool
    {
        $dataList = [
            'email' => $data['email'],
            'fname' => $data['fname'],
            'lname' => $data['lname'],
            'password' => md5($data['pwd']),
            'dob' => $data['dob']
        ];
        $db = $this->db;
        $sql = "INSERT INTO signup";
        $fields = [];
        $values = [];

        foreach( $dataList as $field => $value ) {
            $fields[] = $field;
            $values[] = "'".$value."'";
        }
        $fields = ' (' . implode(', ', $fields) . ')';
        $values = '('. implode(', ', $values) .')';
        $sql .= $fields .' VALUES '. $values;
        $db->query($sql);
        $new_user_id = mysqli_insert_id($db); 
        $db->commit();
        
        if($new_user_id) {
            $_SESSION['user_id'] = $new_user_id;
echo 'ssdddd';
			return true;
        }
        $_SESSION['error'] = 'Error occurred Try again later';
echo 'asasss';exit;
        return false;
    }
}
