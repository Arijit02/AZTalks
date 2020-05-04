<?php

    require_once "autoloader.inc.php";

    session_start();
    $sender = $_SESSION['name'];
    $receiver = $_POST['to_name'];

    if($_POST['data'] === "get"){
        $usersView = new UsersView();
        $message = $usersView->getMessage($sender, $receiver);
        echo $message;
    }

    if($_POST['data'] === "post"){
        $usersContr = new UsersContr();
        $message = $_POST['message'];
        $usersContr->postMessage($sender, $receiver, $message);
    }