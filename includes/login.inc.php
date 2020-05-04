<?php

    require_once "autoloader.inc.php";

    if(isset($_POST['submit'])){
        $name = $_POST['name'];
        $password = $_POST['password'];
        
        if(empty($name)||empty($password)){
            echo json_encode(array("message"=>"Empty Fields!"));
            exit();
        }else if(!preg_match("/^[a-zA-Z 0-9_]*$/", $name)){
            echo json_encode(array("message"=>"Invalid Username!"));
            exit();
        }else{
            $usersView = new UsersView();
            $message = $usersView->loginUsers($name, $password);
            unset($usersView);
            if($message === 'Success'){
                echo json_encode(array("redirect"=>"index.php"));
                $name = $_SESSION['name'];
                $usersContr = new UsersContr();
                $usersContr->flipStatusToOnline($name);
                exit();
            }else if($message === 'Invalid password'){
                echo json_encode(array("redirect"=>"index.php"));
                exit();
            }else if($message === 'No user'){
                echo json_encode(array(["redirect"=>"index.php"]));                
                exit();
            }
        }
    }