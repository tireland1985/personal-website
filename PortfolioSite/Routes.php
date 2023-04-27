<?php
namespace PortfolioSite;
class Routes implements \Classes\Routes{

    

    public function getController($name){
        require '../siteconf/database.php';
        //HTMLPurifier with xemlock's html5 extension
        require_once '../vendor/ezyang/htmlpurifier/library/HTMLPurifier.auto.php';
        $config = \HTMLPurifier_HTML5Config::createDefault();
        //$config = \HTMLPurifier_Config::createDefault();
        //Allow only basic tags
        $config->set('HTML.Allowed', 'p,b,a[href],i, ul, li');
        $purifier = new \HTMLPurifier($config);

        // using $this->categoryTable instead of $categoryTable appears necessary to pass certain variables for dynamic navbar menu generation into layout.html.php
        // have so far been unable to get menu working without this.. WIP
       // $this->categoryTable = new \Classes\DatabaseTable($pdo, 'category', 'id');
       // $menuTable = new \Classes\DatabaseTable($pdo, 'menu', 'id');
        $userTable = new \Classes\DatabaseTable($pdo, 'users', 'id');
        $cvEmpTable = new \Classes\DatabaseTable($pdo, 'cv_employment', 'id');
        $cvOtherExpTable = new \Classes\DatabaseTable($pdo, 'cv_other_exp', 'id');
        $cvSkillsTable = new \Classes\DatabaseTable($pdo, 'cv_skills', 'id');
        $cvEducationTable = new \Classes\DatabaseTable($pdo, 'cv_education', 'id');
        $quotesTable = '';
        $projectsTable = new \Classes\DatabaseTable($pdo, 'projects', 'id');
        $loginTable = new \Classes\DatabaseTable($pdo, 'login_attempts', 'id');
        $imagesTable = new \Classes\DatabaseTable($pdo, 'project_images', 'id');
        $certsTable = new \Classes\DatabaseTable($pdo, 'certifications', 'id');
        $authentication = new \Classes\Authentication($userTable, 'email', 'password');
        
       // $images = new \Classes\Image();


        $controllers = [];
        $controllers['admin'] = new \PortfolioSite\Controllers\adminController($authentication, $userTable, $loginTable);
        $controllers['contact'] = new \PortfolioSite\Controllers\contactController($_GET, $_POST);
        $controllers['cv'] = new \PortfolioSite\Controllers\cvController($pdo, $cvEmpTable, $cvOtherExpTable, $cvSkillsTable, $cvEducationTable, $certsTable, $_GET, $_POST, $purifier);
        $controllers['login'] = new \PortfolioSite\Controllers\loginController($authentication, $pdo, $loginTable, $_POST);
        $controllers['quotes'] = new \PortfolioSite\Controllers\quotesController($quotesTable);
        $controllers['user'] = new \PortfolioSite\Controllers\userController($pdo, $authentication, $userTable, $_GET, $_POST);
        $controllers['portfolio'] = new \PortfolioSite\Controllers\portfolioController($pdo, $projectsTable, $imagesTable, $_GET, $_POST, $purifier);
        $controllers['download'] = new \PortfolioSite\Controllers\downloadController($_GET);
        $controllers['education'] = new \PortfolioSite\Controllers\educationController($pdo, $cvEducationTable, $_GET, $_POST, $purifier);
        $controllers['otherexp'] = new \PortfolioSite\Controllers\otherexpController($pdo, $cvOtherExpTable, $_GET, $_POST, $purifier);
        $controllers['proexp'] = new \PortfolioSite\Controllers\proexpController($pdo, $cvEmpTable, $_GET, $_POST, $purifier);
        $controllers['skills'] = new \PortfolioSite\Controllers\skillsController($pdo, $cvSkillsTable, $_GET, $_POST, $purifier);
        $controllers['delete'] = new \PortfolioSite\Controllers\deleteController($pdo, $userTable, $cvEmpTable, $cvOtherExpTable, $cvSkillsTable, $cvEducationTable, $quotesTable, $projectsTable, $imagesTable, $_POST);
        //$controllers['editCV'] = new \PortfolioSite\controllers\editCVController($pdo, $cvEmpTable, $cvOtherExpTable, $cvSkillsTable, $cvEducationTable, $_GET, $_POST, $purifier);
        return $controllers[$name];
    }

    public function getDefaultRoute(){
        return 'quotes/home';
    }

    public function checkLogin($route){
        session_start();
        $loginRoutes = [];

        # admin routes requiring login
        $loginRoutes['admin/home'] = true;

        # user routes requiring login
        $loginRoutes['user/list'] = true;
        $loginRoutes['user/register'] = true;
		$loginRoutes['user/registerUserSubmit'] = true;
        $loginRoutes['user/edit'] = true;
        $loginRoutes['user/editSubmit'] = true;
		$loginRoutes['user/deleteSubmit'] = true;
		$loginRoutes['user/profile'] = true;
		$loginRoutes['user/profileSubmit'] = true;

		#cv routes requiring login - review for removal
		/*$loginRoutes['cv/showSkills'] = true;
        $loginRoutes['cv/showEducation'] = true;
        $loginRoutes['cv/showProfessionalExperience'] = true;
        $loginRoutes['cv/showOtherExp'] = true;

		$loginRoutes['cv/editSkills'] = true;
		$loginRoutes['cv/editEducation'] = true;
		$loginRoutes['cv/editProfessionalExperience'] = true;
        $loginRoutes['cv/editOtherExp'] = true;

        $loginRoutes['cv/editSkillsSubmit'] = true;
        $loginRoutes['cv/editEducationSubmit'] = true;
        $loginRoutes['cv/editProfessionalExperienceSubmit'] = true;
        $loginRoutes['cv/editOtherExpSubmit'] = true;
        
        $loginRoutes['cv/deleteSkillsSubmit'] = true;
        $loginRoutes['cv/deleteEducationSubmit'] = true;
        $loginRoutes['cv/deleteProfessionalExperienceSubmit'] = true;
        $loginRoutes['cv/deleteOtherExpSubmit'] = true; */
		
        $loginRoutes['education/show'] = true;
        $loginRoutes['education/edit'] = true;
        $loginRoutes['education/editSubmit'] = true;

        $loginRoutes['proexp/show'] = true;
        $loginRoutes['proexp/edit'] = true;
        $loginRoutes['proexp/editSubmit'] = true;

        $loginRoutes['otherexp/show'] = true;
        $loginRoutes['otherexp/edit'] = true;
        $loginRoutes['otherexp/editSubmit'] = true;

        $loginRoutes['skills/show'] = true;
        $loginRoutes['skills/edit'] = true;
        $loginRoutes['skills/editSubmit'] = true;

        $loginRoutes['delete/'] = true;

        $requiresLogin = $loginRoutes[$route] ?? false;
        if ($requiresLogin && !isset($_SESSION['loggedin'])){
            header('location: /login/auth');
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