<?php
namespace PortfolioSite\Controllers;
class userController{
    public function __construct(){

    }

    public function home(){

        return [
            'template' => 'login.html.php',
            'title' => '',
            'variables' => []
        ];
    }
}