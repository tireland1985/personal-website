<?php
namespace PortfolioSite\Controllers;
class quotesController{
    public function __construct(){

    }

    public function home(){

        return [
            'template' => 'home.html.php',
            'title' => 'Home',
            'variables' => []
        ];
    }
}