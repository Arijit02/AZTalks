<?php
    require_once "users.class.php";
    
    class UsersContr extends Users{
        public function createUsers($name, $email, $phone, $password){
            $this->setUsers($name, $email, $phone, $password);
        }
        public function flipStatusToOnline($name){
            $this->changeStatusToOnline($name);
        }
        public function flipStatusToOffline($name){
            $this->changeStatusToOffline($name);
        }
        public function postMessage($sender, $receiver, $message){
            $this->sendMessage($sender, $receiver, $message);
        }
        public function setFollowers($name, $followed){
            return $this->addFollowers($name, $followed);
        }
        public function unsetFollowers($name, $followed){
            return $this->deleteFollowers($name, $followed);
        }
    }

?>