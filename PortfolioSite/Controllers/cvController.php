<?php
namespace PortfolioSite\Controllers;
class cvController{
    public function __construct($pdo, $cvEmpTable, $cvOtherExpTable, $cvSkillsTable, $cvEducationTable, $certsTable, array $get, array $post, $purifier){
        $this->cvEmpTable = $cvEmpTable;
        $this->cvOtherExpTable = $cvOtherExpTable;
        $this->cvSkillsTable = $cvSkillsTable;
        $this->cvEducationTable = $cvEducationTable;
        $this->certsTable = $certsTable;
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
        $certsList = $this->certsTable->findAllOrderByLimit('vendor_name', 'DESC', 999); // change this to order by vendor name
        return [
            'template' => 'cv/cv-overview.html.php',
            'title' => 'CV',
            'variables' => ['employmentList' => $employmentList, 'skillsList' => $skillsList, 'educationList' => $educationList, 'otherExperienceList' => $otherExperienceList, 'certsList' => $certsList]
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

    public function pro_exp(){
        $employmentList = $this->cvEmpTable->findAllOrderByLimit('start_date', 'DESC', '200');
        return [
            'template' => 'cv/cv-pro-exp.html.php',
            'title' => 'CV',
            'variables' => ['employmentList' => $employmentList]
        ];
    }

    public function other_exp(){
        $otherExperienceList = $this->cvOtherExpTable->findAll();
        return [
            'template' => 'cv/cv-other-exp.html.php',
            'title' => 'CV',
            'variables' => ['otherExperienceList' => $otherExperienceList]
        ];
    }

    public function skills(){
		$skillsList = $this->cvSkillsTable->findAll();
        return [
            'template' => 'cv/cv-skills.html.php',
            'title' => 'CV',
            'variables' => ['skillsList' => $skillsList]
        ];
    }
}