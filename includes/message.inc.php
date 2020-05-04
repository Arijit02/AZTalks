<?php

    require_once "autoloader.inc.php";

    session_start();
    $name = $_SESSION['name'];

    $usersView = new UsersView();
    $results = $usersView->showAllUsers();

    foreach($results as $result){
        if($result['username'] !== $name){
            echo "<tr>
                    <td class='name'>".$result['username']."</td>
                    <td><span class='status ".$result['online_status']."'>".$result['online_status']."</span></td>
                    <td><button class='btn message-btn btn-primary btn-sm'>Message</button></td>
                </tr>";
        }
    }
