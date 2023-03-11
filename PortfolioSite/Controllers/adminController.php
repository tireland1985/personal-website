<?php
namespace PortfolioSite\Controllers;
use Classes\Authentication;
class adminController{

    private $userTable;

    public function __construct($authentication, $userTable, $loginTable){
        $this->authentication = $authentication;
        $this->userTable = $userTable;
        $this->loginTable = $loginTable;
    }

    public function home(){
        $lastLoginSuccess = $this->loginTable->findTwoLatestOnly('email', $_SESSION['username'], 'status', 'SUCCESS', 'datetime_attempted');
        return [
            'template' => 'admin/home.html.php',
            'title' => 'Administration Area',
            'variables' => ['lastLoginSuccess' => $lastLoginSuccess]
        ];
    }
}