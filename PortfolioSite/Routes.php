<?php
namespace PortfolioSite;
class Routes implements \Classes\Routes{

    

    public function getController($name){
        require '../siteconf/database.php';

        // using $this->categoryTable instead of $categoryTable appears necessary to pass certain variables for dynamic navbar menu generation into layout.html.php
        // have so far been unable to get menu working without this.. WIP
       // $this->categoryTable = new \Classes\DatabaseTable($pdo, 'category', 'id');
       // $menuTable = new \Classes\DatabaseTable($pdo, 'menu', 'id');
        $userTable = new \Classes\DatabaseTable($pdo, 'users', 'id');
        $cvEmpTable = new \Classes\DatabaseTable($pdo, 'cv_employment', 'id');
        $cvSkillsTable = new \Classes\DatabaseTable($pdo, 'cv_skills', 'id');
        $cvEducationTable = new \Classes\DatabaseTable($pdo, 'cv_education', 'id');
        $quotesTable = '';

        $authentication = new \Classes\Authentication($userTable, 'username', 'password');
       // $images = new \Classes\Image();


        $controllers = [];
        $controllers['admin'] = new \PortfolioSite\Controllers\adminController($authentication, $userTable);
        $controllers['contact'] = new \PortfolioSite\Controllers\contactController($_GET, $_POST);
        $controllers['cv'] = new \PortfolioSite\Controllers\cvController($cvEmpTable, $cvSkillsTable, $cvEducationTable, $_GET, $_POST);
        $controllers['login'] = new \PortfolioSite\Controllers\loginController($authentication, $_POST);
        $controllers['quotes'] = new \PortfolioSite\Controllers\quotesController($quotesTable);
        $controllers['user'] = new \PortfolioSite\Controllers\userController($authentication, $userTable, $_GET, $_POST);
        $controllers['portfolio'] = new \PortfolioSite\Controllers\portfolioController();
        return $controllers[$name];
    }

    public function getDefaultRoute(){
        return 'quotes/home';
    }

    public function checkLogin($route){
        session_start();
        $loginRoutes = [];

        $loginRoutes['admin/home'] = true;

        $loginRoutes['user/list'] = true;
        $loginRoutes['user/register'] = true;
		$loginRoutes['user/registerUserSubmit'] = true;
        $loginRoutes['user/edit'] = true;
        $loginRoutes['user/editSubmit'] = true;
		$loginRoutes['user/deleteSubmit'] = true;
		$loginRoutes['user/profile'] = true;
		$loginRoutes['user/profileSubmit'] = true;
		
		$loginRoutes['cv/listSkills'] = true;
        $loginRoutes['cv/listEducation'] = true;
        $loginRoutes['cv/listEmployment'] = true;
        $loginRoutes['cv/list'] = true;
		$loginRoutes['cv/edit'] = true;
		$loginRoutes['cv/editSubmit'] = true;
		$loginRoutes['cv/deleteSubmit'] = true;
		

        $requiresLogin = $loginRoutes[$route] ?? false;
        if ($requiresLogin && !isset($_SESSION['loggedin'])){
            header('location: /admin/login');
            exit();
        }
    }
/*
    public function checkAdminLogin($route){
        //based on checkLogin above, further restrict access on some pages to the administrator privilege level ONLY.
        //for now these are user account management, as well as all delete functions.
        $adminRoutes = [];

        $adminRoutes['user/list'] = true;
        $adminRoutes['user/register'] = true;
		$adminRoutes['user/registerSubmit'] = true;
        $adminRoutes['user/edit'] = true;
        $adminRoutes['user/editSubmit'] = true;
		$adminRoutes['user/deleteSubmit'] = true;

        $adminRoutes['booking/deleteSubmit'] = true;

        $adminRoutes['faq/deleteSubmit'] = true;

        $adminRoutes['menu/deletedishSubmit'] = true;
        $adminRoutes['menu/deletecategorySubmit'] = true;
        
        $adminRoutes['news/deleteSubmit'] = true;

        $adminRoutes['reviews/deleteSubmit'] = true;

        $requiresAdmin = $adminRoutes[$route] ?? false;
        if ($requiresAdmin && $_SESSION['privilege_level'] !== 'admin'){
            header('location: /admin/prohibited');
            exit();
        }


    }    */

    public function getLayoutVariables($output, $title){
        //function to pass relevant variables directly to layout.html.php template file, used for dynamic menu generation from database records
        return [
           // 'navMenu' => $this->categoryTable->findAll(),
            'output' => $output,
            'title' => $title
        ];
    }
}