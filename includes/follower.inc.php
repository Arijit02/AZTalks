<?php

    require_once "autoloader.inc.php";

    if(isset($_POST['follow_submit'])){
        
        $name = $_POST['name'];
        $followed = $_POST['followed'];

        $usersContr = new UsersContr();

        if($_POST['follow_submit'] === "follow"){
            $usersContr->setFollowers($name, $followed);
        }
        if($_POST['follow_submit'] === "unfollow"){
            $usersContr->unsetFollowers($name, $followed);
        }
    }

    else{
        session_start();
        $name = $_SESSION['name'];
    
        $usersView = new UsersView();
        $results = $usersView->getFollowers($name);
    
        $count=1;
        
        echo '<div class="row"><div class="col-xs-1"></div><div class="col-xs-5">
                <table id="followers-table" class="table table-hover">
                    <thead>
                        <tr>
                            <th id="followers">Followers</th>
                        </tr>
                    </thead>';
        foreach($results['followers'] as $result){
            echo '  <tbody>
                        <tr>
                            <td headers="followers">'.$result.'</td>
                        </tr>
                    </tbody>';
        }
        echo '</table></div>';
    
        $count=1;
    
        echo '<div class="col-xs-5">
            <table id="following-table" class="table table-hover">
                <thead>
                    <tr>
                        <th id="following">Following</th>
                    </tr>
                </thead>';
        foreach($results['following'] as $result){
            echo '  <tbody>
                        <tr>
                            <td headers="following">'.$result.'</td>
                        </tr>
                    </tbody>';
        }
        echo '</table></div><div class="col-xs-1"></div></div>';
    }
?>