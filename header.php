<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require "links.html"; ?>
    <title></title>
</head>
<body id="header">
    <?php require "includes/autoloader.inc.php"; ?>
    <div class="wrapper">
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="./index.php">
                        <h1><strong>AZTalks</strong></h1><img src="../images/aztalks.png">
                    </a>
                    <div class="collapse navbar-collapse" id="myNavbar">
                        <ul class="nav navbar-nav navbar-left">
                            <li class="home active"><a href="../index.php" >HOME</a></li>
                            <li class="about"><a href="#">ABOUT</a></li>
                            <li class="contact"><a href="#" >CONTACT</a></li>
                            <li class="timeline session_reqd"><a href="#" >TIMELINE</a></li>
                            <li class="follow_list session_reqd"><a href="#" >FOLLOW LIST</a></li>
                            <li class="profile session_reqd"><a href="#" >YOUR PROFILE</a></li>
                            <li class="message session_reqd"><a href="#" >MESSAGE</a></li>
                        </ul>
                    </div>
                    <ul class="nav navbar-nav navbar-right form">
                        <div id="login">
                            <form action="./includes/login.inc.php" class="navbar-form" method="post">
                                <h6 id="user"></h6>
                                <input type="text" id="uname" name="uname" placeholder="Username">
                                <input type="password" id="pwd" name="pwd" placeholder="Password">
                                <button id="login" type="submit">Log In</button>
                                <button id="signup">Sign Up</button>
                                <button id="logout" type="submit">Log Out</button><br><br>
                                <a class="small" href="#">Forgot Password ?</a>
                                <p class="message-login"></p>
                            </form>
                        </div>
                    </ul>
                    <div id="mobile-login">
                        <h6 id="user-mobile"></h6>
                        <button id="login-mobile" name="login-mobile">Log In</button>
                        <button id="signup-mobile" name="signup-mobile">Sign Up</button>
                        <button id="logout-mobile" name="logout-mobile">Log Out</button>
                    </div>
                    <ul class="nav navbar-nav navbar-right icons">
                        <div id="icons">
                            <span id="search" class="glyphicon glyphicon-search"></span>
                            <form action="#" method="post">
                                <input type="text" name="search" placeholder="Search">
                                <button type="submit" name="search-submit">Search</button>&nbsp;
                            </form>
                        </div>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <div class="container-fluid mob-login">
        <article class="mobile-form">
            <span class="close">&times;</span><br>
            <div class="title">
                <strong>Login</strong>
            </div><br>
            <p class="message-login"></p>
            <div class="form-group">
                <label for="username">Username</label>
                <input class="form-control" type="text" id="uname-mob" name="username">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input class="form-control" type="password" id="pwd-mob" name="password">
            </div>
            <a class="small" href="#">Forgot Password ?</a><br><br>
            <button type="submit" id="login-mob" class="btn btn-primary">Log In</button>
        </article>
    </div>
</body>
<?php require "js/header.js.php";?>
</html>