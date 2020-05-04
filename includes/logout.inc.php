<?php

    require_once "autoloader.inc.php";

    if(isset($_POST['submit'])){
        session_start();
        $name = $_SESSION['name'];
        session_unset();
        session_destroy();
        $usersContr = new UsersContr();
        $usersContr->flipStatusToOffline($name);
    }