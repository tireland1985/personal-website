<?php
namespace PortfolioSite\Controllers;
class skillsController{
    public function __construct($pdo, $cvSkillsTable, array $get, array $post, $purifier){
        $this->pdo = $pdo;
        $this->cvSkillsTable = $cvSkillsTable;
        $this->get = $get;
        $this->post = $post;
        $this->purifier = $purifier;
    }

    public function show(){
        // admin function - display list of records
        $skillsList = $this->cvSkillsTable->findAll();
        return [
            'template' => 'admin/cv/showSkills.html.php',
            'title' => 'Admin - Skills',
            'variables' => ['skillsList' => $skillsList]
        ];
    }

    public function edit($errors = []){
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

    public function editSubmit(){
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