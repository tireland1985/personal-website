<?php
namespace PortfolioSite\Controllers;
class cvController{
    public function __construct($pdo, $cvEmpTable, $cvSkillsTable, $cvEducationTable, array $get, array $post){
        $this->cvEmpTable = $cvEmpTable;
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

    public function pro_exp(){
        $employmentList = $this->cvEmpTable->findAll();
        return [
            'template' => 'cv/cv-pro-exp.html.php',
            'title' => 'CV',
            'variables' => ['employmentList' => $employmentList]
        ];
    }

    public function other_exp(){

        return [
            'template' => 'cv/cv-other-exp.html.php',
            'title' => 'CV',
            'variables' => []
        ];
    }

    public function skills(){

        return [
            'template' => 'cv/cv-skills.html.php',
            'title' => 'CV',
            'variables' => []
        ];
    }
}