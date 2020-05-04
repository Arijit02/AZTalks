<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AZTalks</title>
    <style>
        
    </style>
</head>
<body>
    <?php  
        require "header.php"; 
    ?>
    <div class="wrapper index">
        <section id="home">
            <article class="index-intro">
                <div class="container">
                    <div class="jumbotron">
                        <div class="col">
                            <div class="row-sm-6"><h1 id="welcome-msg">Connect to people all around the world and a lot more....</h1>
                            <h2><a href="../signup.php">Join AZTalks Now!</a></h2></div>
                            <div class="row-sm-6"></div>
                        </div>
                    </div>
                </div>
            </article>
            <div class="row">
                <div class="col-sm-3"><img class="image-responsive" src="./images/laptop.jpeg"></div>
                <div class="col-sm-3"><img class="image-responsive" src="./images/cellphone.jpeg"></div>
                <div class="col-sm-3"><img class="image-responsive" src="./images/mobile.jpeg"></div>
                <div class="col-sm-3"><img class="image-responsive" src="./images/headphone.jpeg"></div>
            </div>
        </section>

        <section id="about">
            <div>
                About
            </div>
        </section>

        <section id="contact">
            <div>
                Contact
            </div>
        </section>

        <section id="timeline">
            <div class="caption">
                People You May Know
            </div>
            <div class="row"></div>

        </section>

        <section id="follow_list">
            <div class="table-responsive"></div>
        </section>

        <section id="profile">
            <div class="display">
                <div id="cp">
                    <div id="dp">
                        <div id="image"><img src="photos/default.png"/></div>
                        <div class="dropdown">
                            <span class="glyphicon glyphicon-camera data-toggle" data-toggle="dropdown"></span>
                            <ul class="dropdown-menu">
                                <li id="take-photo"><a href="#">Take Photo</a></li>
                                <li id="browse"><a href="#">Browse</a></li>
                                <form id="image-form">
                                    <input type="file" name="profile-pic" id="profile-pic">
                                </form>
                                <li id="delete-photo"><a href="#">Delete Photo</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="action-bar btn-group">
                    <button class="About">ABOUT</button>
                    <button class="Photos">PHOTOS</button>
                    <button class="Timeline">TIMELINE</button>
                    <button class="Message">MESSAGE</button>
                    <button class="Followers">FOLLOWERS</button>
                    <button class="Following">FOLLOWING</button>
                </div>
            </div>
        </section>

        <section id="message">
            <div class="table-responsive">
                <table id="message-table" class="table table-striped table-bordered table-hover table-condensed">
                    <thead>
                        <tr>
                            <th id="username">USERNAME</th>
                            <th id="status">STATUS</th>
                            <th id="action">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </section>

        <div class="wrapper-message">
            <div class="messenger">
                <div class="show-text">
                    <span class="close">&times;</span>
                    <div class="name">
                        <strong><h4></h4>
                    </strong></div>
                    <div class="chats"></div>
                </div>
                <div class="type-text">
                    <textarea id="type-message" rows="1" class="typing" placeholder="Type message..."></textarea>
                    <button class="btn btn-primary send">Send</button>
                </div>
            </div>
        </div>

    </div>
    <div id="snapshot">
        <div id="camera"></div>
        <span class="snapshot"><img src="images/snapshot.png"></span>
        <span class="close"><strong>&times;</strong></span>
    </div>

    <?php require "js/index.js.php";?>
</body>
</html>


