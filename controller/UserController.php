<?php
include_once('model/DbTransactions.php');

class UserController
{
    public function __construct() {
        $this->DbTransactions = new DbTransactions();    
    }

    public function getaction($url)
    {
        $parts = parse_url($url);
        parse_str($parts['query'], $action);

        if(isset($_POST['email']) && $action['action'] == 'login') {
            $this->loginUser($_POST);
        }

        if(isset($_POST['email']) && $action['action'] == 'signup') {
            $this->registerUser($_POST);
        }

        $sessionUser =  $this->loggedUserExists((string) $action['action']);
        

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
               $this->redirectPage('action=dashboard');
            }
        }
    }

    public function getUser()
    { 
        $user = $this->DbTransactions->getUser((int) $_SESSION['user_id']);

        if($user) {
            $this->render('dashboard');
        } else {
            $this->redirectPage('action=login&error=login error');
        }
        
    }

    public function registerUser($post)
    {
        if ($post['pwd'] == $post['cpwd']) {
            $email = $this->DbTransactions->isUserExist($post['email']);

            if (!$email) {
                $register = $this->DbTransactions->userRegister($post);

                if($register) {
                    $this->redirectPage('action=dashboard');
                    exit;
                }
                $this->redirectPage('action=signup&error=signup error');
                exit;
            } 

            $_SESSION['error'] = 'Email already exists';
            $this->redirectPage('action=signup');
            exit;
        } 

        $_SESSION['error'] = 'Password not matching';
        $this->redirectPage('action=signup');
    }

    public function redirectPage($url)
    {
        header('Location:index.php?'.$url);
    }

    public function loggedUserExists($action)
    { 
        if($action != 'dashboard' && isset($_SESSION['user_id'])) {
            $this->redirectPage('action=dashboard');
            exit;
        }
    }

    
}


