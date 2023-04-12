<?php
namespace PortfolioSite\Controllers;
class portfolioController{
    public function __construct($pdo, $projectsTable, $imagesTable, array $get, array $post, $purifier){
        $this->pdo = $pdo;
        $this->projectsTable = $projectsTable;
        $this->imagesTable = $imagesTable;
        $this->get = $get;
        $this->post = $post;
        $this->purifier = $purifier;
    }

    public function projects(){
        $view = 'all';
        $projectsList = $this->projectsTable->findAll();
        if(isset($this->get['project_id'])){
            $images = $this->imagesTable->find('project_id', $this->get['project_id']);
            $project = $this->projectsTable->findTwo('id', $this->get['project_id'], 'multiple_images', 'true');
        }
        else {
            $images = false;
            $project = false;
        }
        return [
            'template' => 'portfolio/projects.html.php',
            'title' => 'Portfolio',
            'variables' => ['projectsList' => $projectsList, 'view' => $view, 'images' => $images, 'project' => $project]
        ];
    }
    public function universityProjects(){
        $view = 'university';
        $projectsList = $this->projectsTable->find('project_type', 'university');
        if(isset($this->get['project_id'])){
            $images = $this->imagesTable->find('project_id', $this->get['project_id']);
            $project = $this->projectsTable->findTwo('id', $this->get['project_id'], 'multiple_images', 'true');
        }
        else {
            $images = false;
            $project = false;
        }
        return [
            'template' => 'portfolio/projects.html.php',
            'title' => 'Portfolio',
            'variables' => ['projectsList' => $projectsList, 'view' => $view, 'images' => $images, 'project' => $project]
        ];
    }
    public function personalProjects(){
        $view = 'personal';
        $projectsList = $this->projectsTable->find('project_type', 'personal');
        if(isset($this->get['project_id'])){
            $images = $this->imagesTable->find('project_id', $this->get['project_id']);
            $project = $this->projectsTable->findTwo('id', $this->get['project_id'], 'multiple_images', 'true');
        }
        else {
            $images = false;
            $project = false;
        }
        return [
            'template' => 'portfolio/projects.html.php',
            'title' => 'Portfolio',
            'variables' => ['projectsList' => $projectsList, 'view' => $view, 'images' => $images, 'project' => $project]
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
        if(empty($project['primary_image_url'])){
            $valid = false;
            $errors[] = 'No project image provided';
        }
        if(filter_var($project['primary_image_url'], FILTER_VALIDATE_URL) == false){
            $valid = false;
            $errors[] = 'Image URL is not valid';
        }
        if(!empty($project['github_url'])){
            if(empty($project['github_url_name'])){
                $valid = false;
                $errors[] = 'No name provided for GitHub URL';
            }
            if(filter_var($project['github_url'], FILTER_VALIDATE_URL) == false){
                $valid = false;
                $errors[] = 'GitHub URL is not valid';
            }
        }
        if(!empty($project['other_url'])){
            if(empty($project['other_url_name'])){
                $valid = false;
                $errors[] = 'No name provided for "other url"';
            }
            if(filter_var($project['other_url'], FILTER_VALIDATE_URL) == false){
                $valid = false;
                $errors[] = 'Other URL is not valid';
            }
        }

        if($valid == true){
            //no errors - sanitize input
            $project['project_title'] = $this->purifier->purify($project['project_title']);
            $project['project_desc'] = $this->purifier->purify($project['project_desc']);
            $project['github_url_name'] = strip_tags($project['github_url_name']);
            $project['other_url_name'] = strip_tags($project['other_url_name']);
            $project['github_url'] = filter_var($project['github_url'], FILTER_SANITIZE_URL);
            $project['other_url'] = filter_var($project['other_url'], FILTER_SANITIZE_URL);
            if(!empty($project['extended_details'])){
                $project['extended_details'] = $this->purifier->purify($project['extended_details']);
            }
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