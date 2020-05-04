<?php

    require_once "autoloader.inc.php";

    $usersView = new UsersView();
    $results = $usersView->showAllUsers();

    $count = 0;

    echo '<div class="col-xs-1"><span class="glyphicon glyphicon-menu-left"></span></div>';

    foreach ($results as $result){
        echo '
                <div class="col-xs-2"><img src="profile-pics/default.png"/>
                <br><h4 id='.$result["username"].'>'.$result["username"].'</h4><br><button class="btn btn-primary">FOLLOW</button></div>
            ';

        $count++ ;
        if($count === 5) break;
    }

    echo '<div class="col-xs-1"><span class="glyphicon glyphicon-menu-right"></span></div>';
?>