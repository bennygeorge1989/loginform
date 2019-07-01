<?php
include_once('model/DbTransactions.php');

class UserController
{
    public function __construct() {
        $this->DbTransactions = new DbTransactions();    
    }

    /**
     * load the required page based on the url
     * @param string $url
     */
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
     
    /**
     * load the required view for action
     * @param string $action
     */
    public function render($action)
    {
        include './view/'.$action.'.php';
    }

    /**
     * login for user
     * @param array $post
     */
    public function loginUser(array $post)
    { 
        if (!empty($post['email']) && !empty($post['pwd'])) {
            $login = $this->DbTransactions->loginUser($post['email'], $post['pwd']);

            if($login) {
               $this->redirectPage('action=dashboard');
            }
        }
    }

    /**
     * get user details of logged in user
     * @param array $post
     */
    public function getUser()
    { 
        $user = $this->DbTransactions->getUser((int) $_SESSION['user_id']);

        if($user) {
            $this->render('dashboard');
        } else {
            $this->redirectPage('action=login&error=login error');
        }
        
    }

     /**
     * user registration
     * @param array $post
     */
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

    /**
     * navigation function to a given page
     * @param string $url
     */
    public function redirectPage($url)
    {
        header('Location:index.php?'.$url);
    }

    /**
     * check user is logged in or not
     * @param string $action
     */
    public function loggedUserExists($action)
    { 
        if($action != 'dashboard' && isset($_SESSION['user_id'])) {
            $this->redirectPage('action=dashboard');
            exit;
        }
    }

    
}


