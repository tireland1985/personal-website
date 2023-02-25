<?php
namespace PortfolioSite\Controllers;
class userController{
    public function __construct($pdo, $authentication, $userTable, array $get, array $post){
        $this->pdo = $pdo;
        $this->authentication = $authentication;
        $this->userTable = $userTable;
        $this->get = $get;
        $this->post = $post;
    }

    public function profile(){

        return [
            'template' => 'user_profile.html.php',
            'title' => '',
            'variables' => []
        ];
    }
}