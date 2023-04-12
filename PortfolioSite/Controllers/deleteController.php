<?php
namespace PortfolioSite\Controllers;
class deleteController {
    public function __construct($pdo, $userTable, $cvEmpTable, $cvOtherExpTable, $cvSkillsTable, $cvEducationTable, $quotesTable, $projectsTable, $imagesTable, array $post){
        $this->pdo = $pdo;
        $this->userTable = $userTable;
        $this->cvEmpTable = $cvEmpTable;
        $this->cvOtherExpTable = $cvOtherExpTable;
        $this->cvSkillsTable = $cvSkillsTable;
        $this->cvEducationTable = $cvEducationTable;
        $this->quotesTable = $quotesTable;
        $this->projectsTable = $projectsTable;
        $this->imagesTable = $imagesTable;
        $this->post = $post;
    }

    public function deleteUserSubmit(){
        //delete user account
        //TODO: check privileges
        if($this->post['id'] !== 1){
            $this->userTable->delete($this->post['id']);
            header('location: /user/showUsers');
        }
        else {
            //cannot delete user id 1 - redirect to error page
        }
    }

    public function deleteProfessionalExperienceSubmit(){
        // admin function - delete employment record
        //TODO: check permissions first
        $this->cvEmpTable->delete($this->post['id']);
        header('location: /cv/showProfessionalExperience');
    }

    public function deleteOtherExpSubmit(){
        // admin function - delete "other experience" record
        //TODO: check permissions first
        $this->cvOtherExpTable->delete($this->post['id']);
        header('location: /cv/showOtherExp');
    }

    public function deleteSkillsSubmit(){
        // admin function - delete "skills" record
        //TODO: check permissions first
        $this->cvSkillsTable->delete($this->post['id']);
        header('location: /cv/showSkills');
    }

    public function deleteEducationSubmit(){
        // admin function - delete "education" record
        //TODO: check permissions first
        $this->cvEducationTable->delete($this->post['id']);
        header('location: /cv/showEducation');
    }

    public function deleteProjectsSubmit(){
        // admin function - delete "projects" record
        //TODO: check permissions first
        $this->projectsTable->delete($this->post['id']);
        header('location: /portfolio/showProjects/');
    }

    public function deleteImagesSubmit(){
        //TODO:
        //admin function - delete "images" record (and file)
    }
}
