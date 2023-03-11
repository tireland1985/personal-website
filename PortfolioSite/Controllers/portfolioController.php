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
        return [
            'template' => 'admin/portfolio/showPersonal.html.php',
            'title' => 'Admin - Personal Projects',
            'variables' => ['projectsList' => $projectsList]
        ];
    }

    public function showUniversity(){
        //admin function - show only university related projects
        $projectsList = $this->projectsTable->find('project_type', 'university');
        return [
            'template' => 'admin/projects/showUniversity.html.php',
            'title' => 'Admin - University Projects',
            'variables' => [
                'projectsList' => $projectsList
            ]
            ];
    }
    public function showProjects(){
        // admin function - display list of records
        $projectsList = $this->projectsTable->findAll();
        return [
            'template' => 'admin/portfolio/showProjects.html.php',
            'title' => 'Admin - Projects',
            'variables' => ['projectsList' => $projectsList]
        ];
    }

    public function editProjects(){
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
            'template' => 'admin/projects/editProjects.html.php',
            'title' => 'Admin - Edit Projects',
            'variables' => ['item' => $item, 'projectsList' => $projectsList]
        ];
    }

    public function editProjectsSubmit(){
        //admin function - save submitted data
        $this->projectsTable->save($this->post['projects']);
    }

    public function deleteProjectsSubmit(){
        // admin function - delete record
        //TODO: check permissions first
        $this->projectsTable->delete($this->post['id']);
        header('location: /portfolio/showProjects/');
    }
}