<?php
namespace PortfolioSite\Controllers;
class loginController{
    public function __construct(){

    }

    public function home(){

        return [
            'template' => 'login.html.php',
            'title' => 'Login',
            'variables' => []
        ];
    }
}