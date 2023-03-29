<?php
namespace PortfolioSite\Controllers;
class cvController{
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

    public function overview(){
        $employmentList = $this->cvEmpTable->findAllOrderByLimit('start_date', 'DESC', 999);
        $skillsList = $this->cvSkillsTable->findAll();
        $educationList = $this->cvEducationTable->findAllOrderByLimit('start_year', 'DESC', 999);
        $otherExperienceList = $this->cvOtherExpTable->findAll();
        return [
            'template' => 'cv/cv-overview.html.php',
            'title' => 'CV',
            'variables' => ['employmentList' => $employmentList, 'skillsList' => $skillsList, 'educationList' => $educationList, 'otherExperienceList' => $otherExperienceList]
        ];
    }

    public function education(){
        $educationList = $this->cvEducationTable->findAllOrderByLimit('start_year', 'DESC', 999);
        return [
            'template' => 'cv/cv-education.html.php',
            'title' => 'CV',
            'variables' => ['educationList' => $educationList]
        ];
    }

    public function showEducation(){
        // admin function - display records
        $educationList = $this->cvEducationTable->findAll();
        return [
            'template' => 'admin/cv/showEducation.html.php',
            'title' => 'Admin - Education',
            'variables' => ['educationList' => $educationList]
        ];
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

    public function deleteEducationSubmit(){
        // admin function - delete record
        //TODO: check permissions first
        $this->cvEducationTable->delete($this->post['id']);
        header('location: /cv/showEducation');
    }

    public function pro_exp(){
        $employmentList = $this->cvEmpTable->findAllOrderByLimit('start_date', 'DESC', '200');
        return [
            'template' => 'cv/cv-pro-exp.html.php',
            'title' => 'CV',
            'variables' => ['employmentList' => $employmentList]
        ];
    }

    public function showProfessionalExperience(){
        // admin function - display list of records
        $employmentList = $this->cvEmpTable->findAllOrderByLimit('start_date', 'DESC', '200');
        return [
            'template' => 'admin/cv/showProfessionalExperience.html.php',
            'title' => 'Admin - Professional Experience',
            'variables' => ['employmentList' => $employmentList]
        ];
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

    public function deleteProfessionalExperienceSubmit(){
        // admin function - delete record
        //TODO: check permissions first
        $this->cvEmpTable->delete($this->post['id']);
        header('location: /cv/showProfessionalExperience');
    }

    public function other_exp(){
        $otherExperienceList = $this->cvOtherExpTable->findAll();
        return [
            'template' => 'cv/cv-other-exp.html.php',
            'title' => 'CV',
            'variables' => ['otherExperienceList' => $otherExperienceList]
        ];
    }

    
    public function showOtherExp(){
        // admin function - display list of records
        $otherExperienceList = $this->cvOtherExpTable->findAll();
        return [
            'template' => 'admin/cv/showOtherExp.html.php',
            'title' => 'Admin - Other Experience',
            'variables' => ['otherExperienceList' => $otherExperienceList]
        ];
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

    public function deleteOtherExpSubmit(){
        // admin function - delete record
        //TODO: check permissions first
        $this->cvOtherExpTable->delete($this->post['id']);
        header('location: /cv/showOtherExp');
    }

    public function skills(){
		$skillsList = $this->cvSkillsTable->findAll();
        return [
            'template' => 'cv/cv-skills.html.php',
            'title' => 'CV',
            'variables' => ['skillsList' => $skillsList]
        ];
    }
        
    public function showSkills(){
        // admin function - display list of records
        $skillsList = $this->cvSkillsTable->findAll();
        return [
            'template' => 'admin/cv/showSkills.html.php',
            'title' => 'Admin - Skills',
            'variables' => ['skillsList' => $skillsList]
        ];
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

    public function deleteSkillsSubmit(){
        // admin function - delete record
        //TODO: check permissions first
        $this->cvSkillsTable->delete($this->post['id']);
        header('location: /cv/showSkills');
    }
}