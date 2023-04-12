<?php
namespace PortfolioSite\Controllers;
class educationController {
    public function __construct($pdo, $cvEducationTable, array $get, array $post, $purifier){
        $this->pdo = $pdo;
        $this->cvEducationTable = $cvEducationTable;
        $this->get = $get;
        $this->post = $post;
        $this->purifier = $purifier;
    }

    public function show(){
        // admin function - display records
        $educationList = $this->cvEducationTable->findAll();
        return [
            'template' => 'admin/cv/showEducation.html.php',
            'title' => 'Admin - Education',
            'variables' => ['educationList' => $educationList]
        ];
    }

    public function edit($errors = []){
        // admin function - edit records
        $educationList = $this->cvEducationTable->findAll();

        if(isset($this->get['id'])){
            $result = $this->cvEducationTable->find('id', $this->get['id']);
            $item = $result[0];
        }
        else {
            $item = false;
        }

        return [
            'template' => 'admin/cv/editEducation.html.php',
            'title' => 'Admin - Edit Education',
            'variables' => ['item' => $item, 'educationList' => $educationList, 'errors' => $errors]
        ];
    }

    public function editSubmit(){
        //admin function - save submitted data
        $edu = $this->post['education'];
        $errors = [];
        $valid = true;

        if(empty($edu['institute_name'])){
            $valid = false;
            $errors[] = 'Name of educational institute required';
        }
        if(empty($edu['course_names'])){
            $valid = false;
            $errors[] = 'Course name(s) must be provided';
        }
        if(empty($edu['start_year'])) {
            $valid = false;
            $errors[]= 'Start year must be provided in a 4 digit format (eg:2019)';
        }
        if(!empty($edu['start_year']) && !is_numeric($edu['start_year'])){
            $valid = false;
            $errors[]= 'Start year must be provided in a 4 digit format (eg:2019)';
        }
        $startYr_length = strlen((string)$edu['start_year']);
        if($startYr_length !== 4){
            $valid = false;
            $errors[]= 'Start year must be provided in a 4 digit format (eg:2019)';
        }

        if(!empty($edu['end_year']) && !is_numeric($edu['end_year'])){
            $valid = false;
            $errors[] = 'End year must be 4 numbers';
        }
        if(!empty($edu['end_year']) && is_numeric($edu['end_year'])){
            $endYr_length = strlen((string)$edu['end_year']);
            if($endYr_length !== 4){
                $valid = false;
                $errors[]= 'End year must be provided in a 4 digit format (eg:2019)';
            }
        }
        if($valid == true){
            // no errors, run HTMLPurifier on relevant fields and save record
            $edu['institute_name'] = $this->purifier->purify($edu['institute_name']);
            $edu['course_names'] = $this->purifier->purify($edu['course_names']);
            $this->cvEducationTable->save($edu);
            header('location: /cv/showEducation');
        }

    }

}