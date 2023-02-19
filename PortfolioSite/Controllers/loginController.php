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

        return [
            'template' => 'login.html.php',
            'title' => 'Login',
            'variables' => []
        ];
    }

    public function authSubmit(){
        require_once('../functions/rate_limiter.php');

        //Check if they have gone over the rate limit before starting, but don't add the IP to the rate limit
        if (!check_within_rate_limit('login_page', $_SERVER['REMOTE_ADDR'], 50, 3600, 0))
        {
            die("Your IP has been restricted because of too many attempts. Please try again later.\r\n");
        }

        //Login Code
        if($this->authentication->login($this->post['username'], $this->post['password'])){
            //record the login attempt
            $this->loginTable->recordLoginSuccess();

            //redirect to admin portal
            header('location: /admin/home');
        }
        else {
            //record the failed attempt
            $this->loginTable->recordLoginFailed();
            //load the login form and display error
            return [
                'template' => 'login.html.php',
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
        session_destroy();
        header('location: /');
    }
}