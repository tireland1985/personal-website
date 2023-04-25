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
            'template' => 'user/user_profile.html.php',
            'title' => 'User Profile',
            'variables' => []
        ];
    }

    public function editProfile($errors = []){
        if(isset($_SESSION['user_id'])){
            $result = $this->userTable->find('id', $_SESSION['user_id']);
            $currentUser = $result[0];
            $user = [];

            return [
                'template' => 'user/editProfile.html.php',
                'title' => 'Edit Profile',
                'variables' => ['currentUser' => $currentUser, 'errors' => $errors]
            ];
        }
        else {
            //user isn't logged in
            header('location: /login/auth');
        }

    }

    public function editProfileSubmit(){
        $user = $this->post['user'];
        $currentPass = $user['password'];
        $newPass = $user['new_password'];
        $newPassConfirm = $user['confirm_new_password'];
        $userId = $user['id'];
        $result = $this->userTable->find('id', $_SESSION['user_id']);
        $userResult = $result[0];

        //password strength check - min 8 chars, min 1 uppercase char, min 1 digit, min one of the following special chars - !@#$%^&*-[]
        $pwStrength = '/^(?=.*[!@#$%^&*-])(?=.*[0-9])(?=.*[A-Z]).{8,}$/';
        
        $valid = true;
        $errors = [];

        if(!preg_match($pwStrength, $newPass)){
            $valid = false;
            $errors[] = 'Password MUST contain at minimum: at least 8 characters long, at least one uppercase character, at least one digit (number), and at least one of the following special characters: ! @ # $ % ^ & * - [ ]';
        }
        if($userId !== $_SESSION['user_id']){
            $valid = false;
            $errors[] = 'Cannot modify other users here';
        }
        if(empty($currentPass)){
            $valid = false;
            $errors[] = 'Enter your existing password';
        }
        if(empty($newPass) || empty($newPassConfirm)){
            $valid = false;
            $errors[] = 'New/ Confirm password fields are required';
        }
        if($newPass !== $newPassConfirm){
            $valid = false;
            $errors[] = 'New and Confirm Password values must match';
        }

        if($valid == true){

            //verify that the user provided the correct password
            if(password_verify($currentPass, $userResult->password)){
                $user['password'] = password_hash($newPass, PASSWORD_DEFAULT);
                unset($user['new_password']);
                unset($user['confirm_new_password']);

                $this->userTable->save($user);

                header('location: /admin/home');
            }
            else {
                $valid = false;
                $errors[] = 'Incorrect Password';
            }
            
        }
    }
    public function showUsers(){
        $userList = $this->userTable->findAll();

        return [
            'template' => 'admin/user/showUsers.html.php',
            'title' => 'Admin - Users',
            'variables' => ['userList' => $userList]
        ];
    }

    public function editUsers($errors = []){
        $userList = $this->userTable->findAll();

        if(isset($this->get['id'])){
            $result = $this->userTable->find('id', $this->get['id']);
            $item = $result[0];
        }
        else {
            $item = false;
        }
        return [
            'template' => 'admin/user/editUsers.html.php',
            'title' => 'Admin - Edit Users',
            'variables' => [
                'item' => $item,
                'userList' => $userList,
                'errors' => $errors
            ]
        ];
    }

    public function editUsersSubmit(){
        $user = $this->post['user'];

        $valid = true;
        $errors = [];

        if(empty($user['firstname'])){
            $valid = false;
            $errors[] = 'Firstname is required';
        }
        if(empty($user['lastname'])){
            $valid = false;
            $errors[] = 'Lastname is required';
        }
        if(empty($user['email'])){
            $valid = false;
            $errors[] = 'Email must be provided';
        }
        if(filter_var($user['email'], FILTER_VALIDATE_EMAIL) == false){
            $valid = false;
            $errors[] = 'Email address must be valid';
        }
        if($user['id'] == 1){
            $valid = false;
            $errors[] = 'Specified User cannot be modified';
        }
        if($valid == true){
            $this->userTable->save($user);
            header('location: /user/showUsers');
        }

    }

   /* public function deleteSubmit(){
        //TODO: check privileges
        if($this->post['id'] !== 1){
            $this->userTable->delete($this->post['id']);
            header('location: /user/showUsers');
        }
        else {
            //cannot delete user id 1 - redirect to error page
        }
    }*/
}