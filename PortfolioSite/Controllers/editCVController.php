<?php
namespace PortfolioSite\Controllers;
class editCVController{
    public function __construct($pdo, $cvEmpTable, $cvOtherExpTable, $cvSkillsTable, $cvEducationTable, array $get, array $post, $purifier){
        $this->cvEmpTable = $cvEmpTable;
        $this->cvOtherExpTable = $cvOtherExpTable;
        $this->cvSkillsTable = $cvSkillsTable;
        $this->cvEducationTable = $cvEducationTable;
        $this->get = $get;
        $this->post = $post;
        $this->pdo = $pdo;
        $this->purifier = $purifier;
    }

    public function editEducation($errors = []){
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

    public function editEducationSubmit(){
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

    public function editProfessionalExperience($errors = []){
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

    public function editProfessionalExperienceSubmit(){
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
            header('location: /cv/showProfessionalExperience');
        }
    }

    public function editOtherExp($errors = []){
        //admin function - edit records
        $otherExperienceList = $this->cvOtherExpTable->findAll();


        if(isset($this->get['id'])){
            $result = $this->cvOtherExpTable->find('id', $this->get['id']);
            $item = $result[0];
        }
        else {
            $item = false;
        }

        return [
            'template' => 'admin/cv/editOtherExp.html.php',
            'title' => 'Admin - Edit Other Experience',
            'variables' => ['item' => $item, 'otherExperienceList' => $otherExperienceList, 'errors' => $errors]
        ];
    }

    public function editOtherExpSubmit(){
        //admin function - save submitted data
        $otherExp = $this->post['otherExperience'];
        $valid = true;
        $errors = [];
        if(empty($otherExp['title'])){
            $valid = false;
            $errors[] = 'No title provided';
        }
        if(empty($otherExp['details'])){
            $valid = false;
            $errors[] = 'No details provided';
        }

        if($valid == true){
            //no errors, run HTMLPurifier and save record
            $otherExp['title'] = $this->purifier->purify($otherExp['title']);
            $otherExp['details'] = $this->purifier->purify($otherExp['details']);
            $this->cvOtherExpTable->save($otherExp);
            header('location: /cv/showOtherExp');
        }
    }

    public function editSkills($errors = []){
        //admin function - edit records
        $skillsList = $this->cvSkillsTable->findAll();

        if(isset($this->get['id'])){
            $result = $this->cvSkillsTable->find('id', $this->get['id']);
            $item = $result[0];
        }
        else {
            $item = false;
        }

        return [
            'template' => 'admin/cv/editSkills.html.php',
            'title' => 'Admin - Edit Skills',
            'variables' => ['item' => $item, 'skillsList' => $skillsList, 'errors' => $errors]
        ];
    }

    public function editSkillsSubmit(){
        //admin function - save submitted data
        $skills = $this->post['skills'];
        $valid = true;
        $errors = [];
        if(empty($skills['skill_name'])){
            $valid = false;
            $errors[] = 'Skill name is required';
        }
        if(empty($skills['skill_desc'])){
            $valid = false;
            $errors[] = 'Skill details are required';
        }
        if(empty($skills['skill_name_long'])){
            $valid = false;
            $errors[] = 'Long name must be provided - this can be identical to the skill name field if required';
        }
        if(empty($skills['modal_name'])){
            $valid = false;
            $errors[] = 'Modal name is required';
        }

        if($valid == true){
            //no errors, run HTMLPurifier, ensure no html exists in 'modal_name' and save record
            $skills['skill_name'] = $this->purifier->purify($skills['skill_name']);
            $skills['skill_desc'] = $this->purifier->purify($skills['skil_desc']);
            $skills['skill_name_long'] = $this->purifier->purify($skills['skill_name_long']);
            $skills['modal_name'] = strip_tags($skills['modal_name']);
            
            $this->cvSkillsTable->save($skills);
            header('location: /cv/showSkills');
        }
    }

}