<?php

    require_once "autoloader.inc.php";

    session_start();
    $name = $_SESSION['name'];
    $dirName = "../photos/".$name;

    if(!is_dir($dirName)){
        mkdir($dirName);
    }

    $binary_data_url = base64_decode($_POST['data_url']);
    $fileName = $dirName."/profile_picture.jpg";
    file_put_contents($fileName, $binary_data_url);
?>