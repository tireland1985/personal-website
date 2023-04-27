<?php
namespace PortfolioSite\Controllers;

class certsController{
    public function __construct($pdo, $certsTable, array $get, array $post, $purifier){
        $this->pdo = $pdo;
        $this->certsTable = $certsTable;
        $this->get = $get;
        $this->post = $post;
        $this->purifier = $purifier;
    }

    public function show(){

    }

    public function edit($errors = []){

    }

    public function editSubmit(){
        
    }
}