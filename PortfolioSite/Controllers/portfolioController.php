<?php
namespace PortfolioSite\Controllers;
class portfolioController{
    public function __construct(){

    }

    public function projects(){

        return [
            'template' => 'login.html.php',
            'title' => 'Portfolio',
            'variables' => []
        ];
    }
}