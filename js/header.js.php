<script type="text/javascript" >
    $(()=>{

        session_var = <?php if(isset($_SESSION['name'])) echo json_encode($_SESSION['name']);
            else echo json_encode(""); ?>;

        if(session_var !== ""){
            $("button#logout").show();
            $(".navbar-form #user").html(session_var);
            $('li.session_reqd').show();
            var string = window.location.href;
            if((string).includes("/signup.php")){
                window.location.href = "./index.php";
            }
        }else{
            $(".navbar-form input, .navbar-form button, .navbar-form p, .navbar-form a").show();
            $("button#logout").hide();
            $('li.session_reqd').hide();
        }
        $("#signup-mobile").click(()=>{
            window.location.href = "signup.php";
        });
        $("#signup").click((e)=>{
            e.preventDefault();
            window.location.href = "signup.php";
        });
        $("#login-mobile").click(()=>{
            $("div.mob-login").show();
            $(".wrapper").css("opacity","0.2");
            $("p.message-login").html("");
            $("button:not(#login-mob)").prop("disabled", true);
        });
        $("span.close").click(()=>{  
            $("div.mob-login").hide();
            $(".wrapper").css("opacity","1");
            $("div.mob-login input").val("");
            $("p.message-login").html("");
            $("button:not(#login-mob)").prop("disabled", false);
        });
        function login(e){
            e.preventDefault();
            var name = $("#uname").val() || $("#uname-mob").val();
            var password = $("#pwd").val() || $("#pwd-mob").val();
            var submit = $("button#login").val() || $("button#login-mob").val();
            $.ajax({
                url: "./includes/login.inc.php",
                data: { name: name, password: password, submit: submit },
                method: "post",
                dataType: "text",
                success: (data, status)=>{
                    data = JSON.parse(data);
                    if(data.redirect){
                        window.location.href = data.redirect;
                    }
                    if(data.message){
                        $("p.message-login").text(data.message);
                        $("input[type=password]").val("");
                    }
                    console.log(status);
                }

            });
        }

        $("button#login, button#login-mob").click((e)=>{
            login(e);
        });

        $(".mobile-form input").keyup((e)=>{
            if(e.which == 13){
                login(e);
            }
        });

        $("button#logout, button#logout-mobile").click((e)=>{
            e.preventDefault();
            var submit = $("button#logout").val() || $("button#logout-mobile").val();
            $.ajax({
                url: "./includes/logout.inc.php",
                data: { submit: submit },
                method: "post",
                dataType: "text",
                success: ()=>{
                    window.location.href = "./index.php";
                }

            });
        });

        $(window).click((e)=>{
            e.preventDefault();
            //console.log("hello");
            if($('#myNavbar').is(":visible")){
                $("#myNavbar").hide();      
            }  
        });  
        $('#myNavbar, .navbar-toggle').click(function(event){
            event.stopPropagation();
        });
        $('.navbar-toggle').click(()=>{
            $('#myNavbar').toggle();
            console.log("Hi");
        }); 

        setInterval(()=>{

            if($('.navbar-toggle').is(":hidden")){
                $('#myNavbar li').css("background-color","#f2f2f2");
                $('#myNavbar li.home').css("margin-top", "1px");
                $(".navbar-form").show();
                $("ul.icons").css({
                    "top": "90px",
                    "right":"15px",
                    "background-color": "#f2f2f2"
                });
                $("ul .glyphicon").css({
                    "color": "black"
                });
                $("div#mobile-login").hide();
                $("ul.icons form input").css({
                    "width": "180px",
                    "height": "40px"
                });
                $("ul.icons form button").css({
                    "width": "70px",
                    "height": "40px",
                    "font-size": "initial"
                });
            }
            if($('.navbar-toggle').is(":visible")){
                $(".navbar-form").hide();
                $('#myNavbar li').css("background-color","#c3c3c3");
                $('#myNavbar li.home').css("margin-top", "-1px");
                $("ul.icons").css({
                    "top":"40px",
                    "right":"40px",
                    "background-color":"black"
                });
                $("ul .glyphicon").css({
                    "color": "white"
                });
                $("ul.icons form input").css({
                    "width": "120px",
                    "height": "25px"
                });
                $("ul.icons form button").css({
                    "width": "50px",
                    "height": "25px",
                    "font-size": "10px"
                });
                $("div#mobile-login").show();
                $(".navbar-form input").val("");
                session_var = <?php if(isset($_SESSION['name'])) echo json_encode($_SESSION['name']);
                else echo json_encode(""); ?>;
                if(session_var !== ""){
                    $("#login-mobile, #signup-mobile").hide();
                    $("#mobile-login #user-mobile").html(session_var);
                }else{
                    $("#logout-mobile").hide();
                }
            }
        },10);

        $("#search").click(()=>{
            $("#icons form").toggle();
            $("#icons span").toggleClass("glyphicon-search");
            $("#icons span").toggleClass("glyphicon-remove");
        });
    });
</script>