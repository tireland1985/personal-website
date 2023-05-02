<?php
namespace PortfolioSite\Controllers;
class proexpController {
    public function __construct($pdo, $cvEmpTable, array $get, array $post, $purifier){
        $this->pdo = $pdo;
        $this->cvEmpTable = $cvEmpTable;
        $this->get = $get;
        $this->post = $post;
        $this->purifier = $purifier;
    }

    public function show(){
        // admin function - display list of records
        $employmentList = $this->cvEmpTable->findAllOrderByLimit('start_date', 'DESC', '200');
        return [
            'template' => 'admin/cv/showProfessionalExperience.html.php',
            'title' => 'Admin - Professional Experience',
            'variables' => ['employmentList' => $employmentList]
        ];
    }

    public function edit($errors = []){
        //admin function - edit records
        $employmentList = $this->cvEmpTable->findAll();

        if(isset($this->get['id'])){
            $result = $this->cvEmpTable->find('id', $this->get['id']);
            $item = $result[0];
        }
        else {
            $item = false;
        }

        return [
            'template' => 'admin/cv/editProfessionalExperience.html.php',
            'title' => 'Admin - Edit Professional Experience',
            'variables' => ['item' => $item, 'employmentList' => $employmentList, 'errors' => $errors]
        ];
    }

    public function editSubmit(){
        //admin function - save submitted data
        $proExp = $this->post['professionalExperience'];
        $valid = true;
        $errors = [];
        if(empty($proExp['employer_name'])){
            $valid = false;
            $errors[] = 'No company name provided';
        }
        if(empty($proExp['duties'])){
            $valid = false;
            $errors[] = 'No employment duties provided';
        }
        if(empty($proExp['start_year'])){
            $valid = false;
            $errors[] = 'No start date provided';
        }
        if(!is_numeric($proExp['start_year'])){
            $valid = false;
            $errors[] = 'Start year must be 4 numbers (eg: 2019)';
        }
        if(!empty($proExp['end_year']) && !is_numeric($proExp['end_year'])){
            $valid = false;
            $errors[] = 'End year must be 4 numbers';
        }
        $startYr_length = strlen((string)$proExp['start_year']);
        if($startYr_length !== 4){
            $valid = false;
            $errors[] = 'Start Year should be 4 numbers';
        }
        if(!empty($proExp['end_year']) && is_numeric($proExp['end_year'])){
            $endYr_length = strlen((string)$proExp['end_year']);
            if($endYr_length !== 4){
                $valid = false;
                $errors[] = 'End year should be 4 numbers';
            }
        }
        if($valid == true){
            //no errors, run HTMLPurifier and save record
            $proExp['employer_name'] = $this->purifier->purify($proExp['employer_name']);
            $proExp['duties'] = $this->purifier->purify($proExp['duties']);
            $this->cvEmpTable->save($proExp);
            header('location: /proexp/show');
        }
    }

    public function deleteSubmit(){
        $this->cvEmpTable->delete($this->post['id']);
        header('location: /proexp/show');
    }

}