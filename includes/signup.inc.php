<?php 
    require "autoloader.inc.php";
    
    if(isset($_POST['submit'])){
        $uname = $_POST['uname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $pwd = $_POST['pwd'];
        $re_pwd = $_POST['re_pwd'];

        if(empty($uname)||empty($email)||empty($phone)||empty($pwd)||empty($re_pwd)){
            echo json_encode(array("message"=>"Empty Fields!"));
            exit();
        }
        else if(!preg_match("/^[a-zA-Z 0-9_]*$/", $uname)){
            echo json_encode(array("message"=>"Invalid Username!"));
            exit();
        }
        else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            echo json_encode(array("message"=>"Invalid Email!"));
            exit();
        }
        else if($pwd !== $re_pwd){
            echo json_encode(array("message"=>"Password not same")); 
            exit();
        }else{
            $usersContr = new UsersContr();
            $usersContr->createUsers($uname, $email, $phone, $pwd);
            echo json_encode(array("redirect"=>"index.php")); 
            exit();
        }
    }else if(isset($_POST['name'])){
        $name = $_POST['name'];

        $usersView = new UsersView();
        if($usersView->userPresent($name)){
            echo "Username already exists";
        }else{
            // echo "Username available";
        }
        exit();        
    }