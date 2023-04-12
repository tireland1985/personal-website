<?php
namespace PortfolioSite\Controllers;
class otherexpController {
    public function __construct($pdo, $cvOtherExpTable, array $get, array $post, $purifier){
        $this->pdo = $pdo;
        $this->cvOtherExpTable = $cvOtherExpTable;
        $this->get = $get;
        $this->post = $post;
        $this->purifier = $purifier;
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

    public function edit($errors = []){
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

    public function editSubmit(){
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

}