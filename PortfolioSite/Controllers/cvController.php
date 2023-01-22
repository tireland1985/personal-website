<?php
namespace PortfolioSite\Controllers;
class cvController{
    public function __construct(){

    }

    public function overview(){

        return [
            'template' => 'login.html.php',
            'title' => 'CV',
            'variables' => []
        ];
    }
}