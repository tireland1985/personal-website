<?php
namespace PortfolioSite\Controllers;
class adminController{
    public function __construct(){

    }

    public function home(){

        return [
            'template' => 'login.html.php',
            'title' => 'Admin',
            'variables' => []
        ];
    }
}