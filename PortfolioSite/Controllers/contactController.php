<?php
namespace PortfolioSite\Controllers;
class contactController{
    public function __construct(){

    }

    public function home(){

        return [
            'template' => 'login.html.php',
            'title' => ' - Home',
            'variables' => NULL
        ];
    }
}