<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
</head>
<body>
    <?php require "header.php"; ?>
    <div class="wrapper">
        <div id="signup-form">
            <h3>Sign Up</h3><br>
            <div id="form-signup"></div><br>
            <section class="signup">
                <form action="includes/signup.inc.php" method="post">
                    <h6 id="user-info"></h6>
                    <input type="text" id="name" placeholder="Username"><br><br>
                    <input type="email" id="email" placeholder="Email"><br><br>
                    <input type="tel" id="phone" placeholder="Phone"><br><br>
                    <input type="password" id="passwd" placeholder="Password"><br><br>
                    <input type="password" id="re-pwd" placeholder="Repeat-Password"><br><br>
                    <button type="submit" id="signup-submit">Sign Up</button><br><br>
                </form>
            </section>
        </div>
    </div>
    <script>
        $(function(){

            $("input#name").keyup((e)=>{
                var name = $("#name").val();
                $("#user-info").load("includes/signup.inc.php",{
                    name: name
                },(data, status)=>{
                    console.log(status);
                });
            });

            $("#signup-submit").click(function(event){
                event.preventDefault();
                var uname = $("#name").val();
                var email = $("#email").val();
                var phone = $("#phone").val();
                var pwd = $("#passwd").val();
                var re_pwd = $("#re-pwd").val();
                var submit = $("#signup-submit").val();

                $.post("includes/signup.inc.php",{
                    uname: uname,
                    email: email,
                    phone: phone,
                    pwd: pwd,
                    re_pwd: re_pwd,
                    submit: submit
                },function(data, status){
                    data = JSON.parse(data);
                    console.log(data);
                    if(data.redirect){
                        window.location.href = data.redirect;
                    }
                    if(data.message){
                        $("#form-signup").text(data.message);
                        $("input[type=password]").val("");
                    }
                });
            });
        });
    </script>
</body>
</html>