<?php
namespace Classes;

class Authentication{
    private $users;
    private $usernameField;
    private $passwordField;

    public function __construct($users, $usernameField, $passwordField){
        $this->users = $users;
        $this->usernameField = $usernameField;
        $this->passwordField = $passwordField;
    }

    public function login($username, $password) {
		$user = $this->users->find($this->usernameField, strtolower($username));

		if (!empty($user) && password_verify($password, $user[0]->{$this->passwordField})) {
			session_regenerate_id();
			$_SESSION['username'] = $username;
			$_SESSION['user_id'] = $user[0]->id;
			$_SESSION['privilege_level'] = $user[0]->privilege_level;
			$_SESSION['loggedin'] = true;
			$_SESSION['firstname'] = $user[0]->firstname;
			$_SESSION['lastname'] = $user[0]->lastname;
			return true;
		}
		else {
			return false;
		}
	}

	/*public function isLoggedIn() {
		if (empty($_SESSION['username'])) {
			return false;
		}
		
		$user = $this->users->find($this->usernameField, strtolower($_SESSION['username']));

		if (!empty($user) && $user[0]->{$this->id} === $_SESSION['user_id']) {
			return true;
		}
		else {
			return false;
		}
	}
	
	public function getUser() {
		if ($this->isLoggedIn()) {
			return $this->users->find($this->usernameField, strtolower($_SESSION['username']))[0];
		}
		else {
			return false;
		}
	}*/
}