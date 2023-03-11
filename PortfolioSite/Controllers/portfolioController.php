<?php
namespace PortfolioSite\Controllers;
class portfolioController{
    public function __construct($pdo, $projectsTable, array $get, array $post){
        $this->pdo = $pdo;
        $this->projectsTable = $projectsTable;
        $this->get = $get;
        $this->post = $post;
    }

    public function projects(){
        $projectsList = $this->projectsTable->findAll();
        return [
            'template' => 'portfolio.html.php',
            'title' => 'Portfolio',
            'variables' => ['projectsList' => $projectsList]
        ];
    }
    public function universityProjects(){
        $projectsList = $this->projectsTable->find('project_type', 'university');
        return [
            'template' => 'portfolio_university.html.php',
            'title' => 'Portfolio',
            'variables' => ['projectsList' => $projectsList]
        ];
    }
    public function personalProjects(){
        $projectsList = $this->projectsTable->find('project_type', 'personal');
        return [
            'template' => 'portfolio_personal.html.php',
            'title' => 'Portfolio',
            'variables' => ['projectsList' => $projectsList]
        ];
    }

    public function showPersonal(){
        //admin function - list only personal projects
        $projectsList = $this->projectsTable->find('project_type', 'personal');
        $view = 'personal';
        return [
            'template' => 'admin/portfolio/showProjects.html.php',
            'title' => 'Admin - Personal Projects',
            'variables' => ['projectsList' => $projectsList, 'view' => $view]
        ];
    }

    public function showUniversity(){
        //admin function - show only university related projects
        $projectsList = $this->projectsTable->find('project_type', 'university');
        $view = 'university';
        return [
            'template' => 'admin/portfolio/showProjects.html.php',
            'title' => 'Admin - University Projects',
            'variables' => [
                'projectsList' => $projectsList,
                'view' => $view
            ]
            ];
    }
    public function showProjects(){
        // admin function - display list of records
        $projectsList = $this->projectsTable->findAll();
        $view = 'all';
        return [
            'template' => 'admin/portfolio/showProjects.html.php',
            'title' => 'Admin - Projects',
            'variables' => ['projectsList' => $projectsList, 'view' => $view]
        ];
    }

    public function editProjects($errors = []){
        //admin function - edit records
        $projectsList = $this->projectsTable->findAll();

        if(isset($this->get['id'])){
            $result = $this->projectsTable->find('id', $this->get['id']);
            $item = $result[0];
        }
        else {
            $item = false;
        }

        return [
            'template' => 'admin/portfolio/editProjects.html.php',
            'title' => 'Admin - Edit Projects',
            'variables' => ['item' => $item, 'projectsList' => $projectsList, 'errors' => $errors]
        ];
    }

    public function editProjectsSubmit(){
        //admin function - save submitted data
        $project = $this->post['project'];
        $valid = true;
        $errors = [];
        if(empty($project['project_title'])){
            $valid = false;
            $errors[] = 'No title provided';
        }
        if(empty($project['project_desc'])){
            $valid = false;
            $errors[] = 'No project description provided';
        }
        if(empty($project['image_url'])){
            $valid = false;
            $errors[] = 'No project image provided';
        }
        if($valid == true){
            $this->projectsTable->save($project);
            header('location: /portfolio/showProjects');
        }
        
    }

    public function deleteProjectsSubmit(){
        // admin function - delete record
        //TODO: check permissions first
        $this->projectsTable->delete($this->post['id']);
        header('location: /portfolio/showProjects/');
    }
}