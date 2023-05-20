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
        if(!empty($cert['vendor_url'])){
            if(!filter_var($cert['vendor_url'], FILTER_VALIDATE_URL)){
                $valid = false;
                $errors[] = 'Invalid URL';
            }
        }
        if(empty($cert['vendor_name'])){
            $valid = false;
            $errors[] = 'Vendor name required';
        }
        if(empty($cert['valid_from'])){
            $valid = false;
            $errors[] = 'Start date not provided';
        }
        if(empty($cert['valid_to'])){
            $valid = false;
            $errors[] = 'End date not provided';
        }
        if(empty($cert['cert_name'])){
            $valid = false;
            $errors[] = 'Certificate name not provided';
        }
        $validateStartDate = DateTime::createFromFormat('Y-m-d', $cert['valid_from']);
        if($validateStartDate && $validateStartDate->format('Y-m-d') != $cert['valid_from']) {
            $valid = false;
            $errors[] = 'Provided start date invalid: use YYYY-MM-DD format (ex: 2019-07-18)';
        }
        $validateEndDate = DateTime::createFromFormat('Y-m-d', $cert['valid_to']);
        if($validateEndDate && $validateEndDate->format('Y-m-d') != $cert['valid_to']) {
            $valid = false;
            $errors[] = 'Provided end date invalid: use YYYY-MM-DD format (ex: 2019-07-18)';
        }
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