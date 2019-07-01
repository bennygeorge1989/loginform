<?php
include_once('model/DbTransactions.php');
ini_set('display_errors', 1);
error_reporting(E_ALL);



class UserController
{
    public function __construct() {
        $this->dbTrans = new DbTransactions();    
    }

    public function getaction($url)
    {
        $parts = parse_url($url);
        parse_str($parts['query'], $action);
        
        if ($action['action']) {
            $this->render($action['action']);
        }
    }
     
    public function render($action)
    {
        include './view/'.$action.'.php';
    }
    
}


