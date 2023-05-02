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
        // admin function - display records
        $certsList = $this->certsTable->findAll(); 
        return [
           'template' => 'admin/certs/showCerts.html.php',
           'title' => 'Admin - Certificates',
           'variables' => ['certsList' => $certsList]
           ];
    }

    public function edit($errors = []){
        // admin function - edit records
        $certsList = $this->certsTable->findAll();

        if(isset($this->get['id'])){
            $result = $this->certsTable->find('id', $this->get['id']);
            $item = $result[0];
        }
        else {
            $item = false;
        }

        return [
            'template' => 'admin/certs/editCerts.html.php',
            'title' => 'Admin - Edit Certiificates',
            'variables' => ['item' => $item, 'certsList' => $certsList, 'errors' => $errors]
        ];
    }

    public function editSubmit(){
        $cert = $this->post['cert'];
        $errors = [];
        $valid = true;

        // validation checks

        //submission is valid
        if($valid == true){
            //Purify submission
            // ..
            // ..
            // ..
            // ..
            // ..
            //save data
            $this->certsTable->save($cert);
            header('location: /certs/show');
        }
    }

    public function deleteSubmit(){
        $this->certsTable->delete($this->post['id']);
        header('location: /certs/show');
    }
}