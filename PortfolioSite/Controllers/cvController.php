<?php
namespace PortfolioSite\Controllers;
class cvController{
    public function __construct(){

    }

    public function overview(){

        return [
            'template' => 'cv-overview.html.php',
            'title' => 'CV',
            'variables' => []
        ];
    }

    public function education(){

        return [
            'template' => 'cv-education.html.php',
            'title' => 'CV',
            'variables' => []
        ];
    }

    public function pro-exp(){

        return [
            'template' => 'cv-pro-exp.html.php',
            'title' => 'CV',
            'variables' => []
        ];
    }

    public function other-exp(){

        return [
            'template' => 'cv-other-exp.html.php',
            'title' => 'CV',
            'variables' => []
        ];
    }

    public function skills(){

        return [
            'template' => 'cv-skills.html.php',
            'title' => 'CV',
            'variables' => []
        ];
    }
}