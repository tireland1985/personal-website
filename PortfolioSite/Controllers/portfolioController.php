<?php
namespace PortfolioSite\Controllers;
class portfolioController{
    public function __construct($pdo, $projectsTable, array $get, array $post){
        $this->pdo = $pdo;
        $this->projectsTable = $projectsTable;
        $this->get = $get;
        $this->post = $post;
    }

    public function projects(){
        $projectsList = $this->projectsTable->findAll();
        return [
            'template' => 'portfolio.html.php',
            'title' => 'Portfolio',
            'variables' => ['projectsList' => $projectsList]
        ];
    }
}