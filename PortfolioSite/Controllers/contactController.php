<?php
namespace PortfolioSite\Controllers;
class contactController{
    public function __construct(){

    }

    public function form(){

        return [
            'template' => 'login.html.php',
            'title' => 'Contact',
            'variables' => []
        ];
    }
}