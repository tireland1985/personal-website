<?php
namespace PortfolioSite\Controllers;
class loginController{
    public function __construct(\Classes\Authentication $authentication, $pdo, $loginTable, array $post){
        $this->authentication = $authentication;
        $this->pdo = $pdo;
        $this->loginTable = $loginTable;
        $this->post = $post;
    }

    public function auth(){

        $_SESSION['login_token'] = bin2hex(random_bytes(35));
        return [
            'template' => 'admin/login.html.php',
            'title' => 'Login',
            'variables' => []
        ];
    }

    public function authSubmit(){
        // first do a basic anti-CSRF check
        $login_token = filter_input(INPUT_POST, 'login_token', FILTER_SANITIZE_STRING);
        if(!$login_token || $login_token !== $_SESSION['login_token']){
            //tokens do not match - display error
            die('A fatal error occurred: token mismatch.');
            header($_SERVER['SERVER_PROTOCOL'] . ' 405 Method Not Allowed');
            exit;
        }
        // if CSRF check is ok, load the rate limiter
        //print_r($_POST);
        require_once('../functions/rate_limiter.php');

        //Check if they have gone over the rate limit before starting, but don't add the IP to the rate limit
        if (!check_within_rate_limit('login_page', $_SERVER['REMOTE_ADDR'], 50, 3600, 0))
        {
            die("Your IP has been restricted because of too many attempts. Please try again later.\r\n");
        }

        //Pass supplied details to the Authentication class for verification
        if($this->authentication->login($this->post['username'], $this->post['password'])){
            //record the login attempt
            //TODO: combine recordLoginSuccess & recordLoginFailure into a single function that takes one arguement - eg $status = 'SUCCESS' or 'FAILED'
            $status = 'SUCCESS';
            $this->loginTable->recordLoginAttempt($status); 

            unset($_SESSION['login_token']); // remove token after successful login

            //redirect to admin portal
            header('location: /admin/home');
        }
        else {
            //record the failed attempt if the entered username exists - this is checked by the below function
            $status = 'FAILED';
            $this->loginTable->recordLoginAttempt($status);
            //load the login form and display error
            return [
                'template' => 'admin/login.html.php',
                'title' => 'Log In',
                'variables' => ['error' => 'Invalid username or password']
            ];
        }
        //Add to rate limit after a login attempt (failed or successful) to make it harder to brute force passwords
        if (!check_within_rate_limit('login_page', $_SERVER['REMOTE_ADDR'], 50, 3600, 1))
        {
            die("Your IP has been restricted because of too many attempts. Please try again later.\r\n");
        }
        
    }

    public function logout(){
        session_regenerate_id(); // probably not needed but cant hurt..
        session_destroy();
        header('location: /');
    }
}