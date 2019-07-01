<?php
include_once('model/DbTransactions.php');
ini_set('display_errors', 1);
error_reporting(E_ALL);



class UserController
{
    public function __construct() {
        $this->DbTransactions = new DbTransactions();    
    }

    public function getaction($url)
    {
        if(isset($_POST['email'])) {
            $this->loginUser($_POST);
        }
        $parts = parse_url($url);
        parse_str($parts['query'], $action);

        switch ($action['action']) {
            case 'login':
                $this->render($action['action']);
                break;
            case 'signup':
                $this->render($action['action']);
                break;
            case 'dashboard':
                $this->getUser();
                break;
            default:
            $this->render($action['action']);
                
        }      
    }
     
    public function render($action)
    {
        include './view/'.$action.'.php';
    }

    public function loginUser(array $post)
    { 
        if (!empty($post['email']) && !empty($post['pwd'])) {
            $login = $this->DbTransactions->loginUser($post['email'], $post['pwd']);

            if($login) {
               header('Location:index.php?action=dashboard');
            }
        }
    }

    public function getUser()
    { 
        $user = $this->DbTransactions->getUser((int) $_SESSION['user_id']);

        if($user) {
            $this->render('dashboard');
        } else {
            $this->render('login');
        }
        
    }
    
}


