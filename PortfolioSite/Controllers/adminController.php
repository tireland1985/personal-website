<?php
namespace PortfolioSite\Controllers;
use Classes\Authentication;
class adminController{

    private $userTable;

    public function __construct($authentication, $userTable){
        $this->authentication = $authentication;
        $this->userTable = $userTable;
    }

    public function home(){

        return [
            'template' => 'admin/home.html.php',
            'title' => 'Administration Area',
            'variables' => []
        ];
    }
}