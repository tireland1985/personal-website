<?php
namespace PortfolioSite\Controllers;
class cvController{
    public function __construct($pdo, $cvEmpTable, $cvOtherExpTable, $cvSkillsTable, $cvEducationTable, array $get, array $post){
        $this->cvEmpTable = $cvEmpTable;
        $this->cvOtherExpTable = $cvOtherExpTable;
        $this->cvSkillsTable = $cvSkillsTable;
        $this->cvEducationTable = $cvEducationTable;
        $this->get = $get;
        $this->post = $post;
        $this->pdo = $pdo;
    }

    public function overview(){
        $employmentList = $this->cvEmpTable->findAll();
        $skillsList = $this->cvSkillsTable->findAll();
        $educationList = $this->cvEducationTable->findAll();
        return [
            'template' => 'cv/cv-overview.html.php',
            'title' => 'CV',
            'variables' => ['employmentList' => $employmentList, 'skillsList' => $skillsList, 'educationList' => $educationList]
        ];
    }

    public function education(){
        $educationList = $this->cvEducationTable->findAll();
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
            'template' => 'admin/cv/show_education.html.php',
            'title' => 'Admin - Education',
            'variables' => ['educationList' => $educationList]
        ];
    }

    public function editEducation(){
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
            'template' => 'admin/cv/edit_education.html.php',
            'title' => 'Admin - Edit Education',
            'variables' => ['item' => $item, 'educationList' => $educationList]
        ];
    }

    public function editEducationSubmit(){
        //admin function - save submitted data
        $this->cvEducationTable->save($this->post['education']);
    }

    public function deleteEducationSubmit(){
        // admin function - delete record
        //TODO: check permissions first
        $this->cvEducationTable->delete($this->post['id']);
        header('location: /cv/showEducation');
    }

    public function pro_exp(){
        $employmentList = $this->cvEmpTable->findAll();
        return [
            'template' => 'cv/cv-pro-exp.html.php',
            'title' => 'CV',
            'variables' => ['employmentList' => $employmentList]
        ];
    }

    public function showProfessionalExperience(){
        // admin function - display list of records
        $employmentList = $this->cvEmpTable->findAll();
        return [
            'template' => 'admin/cv/showProExp.html.php',
            'title' => 'Admin - Professional Experience',
            'variables' => ['employmentList' => $employmentList]
        ];
    }

    public function editProfessionalExperience(){
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
            'template' => 'admin/cv/edit_pro_exp.html.php',
            'title' => 'Admin - Edit Professional Experience',
            'variables' => ['item' => $item, 'employmentList' => $employmentList]
        ];
    }

    public function editProfessionalExperienceSubmit(){
        //admin function - save submitted data
        $this->cvEmpTable->save($this->post['pro_experience']);
    }

    public function deleteProfessionalExperienceSubmit(){
        // admin function - delete record
        //TODO: check permissions first
        $this->cvEmpTable->delete($this->post['id']);
        header('location: /cv/showProfessionalEducation');
    }

    public function other_exp(){

        return [
            'template' => 'cv/cv-other-exp.html.php',
            'title' => 'CV',
            'variables' => []
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

    public function editOtherExp(){
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
            'template' => 'admin/cv/edit_other_exp.html.php',
            'title' => 'Admin - Edit Other Experience',
            'variables' => ['item' => $item, 'otherExperienceList' => $otherExperienceList]
        ];
    }

    public function editOtherExpSubmit(){
        //admin function - save submitted data
        $this->cvOtherExpTable->save($this->post['other_experience']);
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
            'template' => 'admin/cv/show_skills.html.php',
            'title' => 'Admin - Skills',
            'variables' => ['skillsList' => $skillsList]
        ];
    }

    public function editSkills(){
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
            'template' => 'admin/cv/edit_skills.html.php',
            'title' => 'Admin - Edit Skills',
            'variables' => ['item' => $item, 'skillsList' => $skillsList]
        ];
    }

    public function editSkillsSubmit(){
        //admin function - save submitted data
        $this->cvSkillsTable->save($this->post['skills']);
    }

    public function deleteSkillsSubmit(){
        // admin function - delete record
        //TODO: check permissions first
        $this->cvSkillsTable->delete($this->post['id']);
        header('location: /cv/showSkills');
    }
}