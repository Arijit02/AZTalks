<?php
    require_once "users.class.php";

    class UsersView extends Users{
        public function showUsers($name, $password){
            return $this->getUsers($name, $password);
        }
        public function showAllUsers(){
            return $this->getAllUsers();
        }
        public function loginUsers($name, $password){
            return $this->authenticateUsers($name, $password);
        }
        public function userPresent($name){
            return $this->userExists($name);
        }
        public function getMessage($sender, $receiver){
            return $this->showMessage($sender, $receiver);
        }
        public function getFollowers($name){
            return $this->showFollowers($name);
        }
    }
    
?>