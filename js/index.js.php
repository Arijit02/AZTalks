<script type="text/javascript" >

        var name = <?php if(isset($_SESSION['name'])) echo json_encode($_SESSION['name']);
            else echo json_encode(""); ?>;

        <?php date_default_timezone_set("Asia/Kolkata");?>
        $(()=>{
        $('ul.navbar-left>li').on("click", function(e){
            $(this).addClass('active').siblings().removeClass('active');
            if($('.navbar-toggle').is(":visible")){
                $("#myNavbar").hide();
            }
        }
        );

        $("ul.navbar-left>li").click(function(e){
            e.preventDefault();
            if($(this).hasClass("active")){
                var classList = $(this).attr('class').split(/\s+/);
                $(`div.index section:not(#${classList[0]})`).hide();
                $(`#${classList[0]}`).show();
            }
            if(classList[0] === 'message'){
                messagePageLoadWorker();
            }
            if(classList[0] === 'follow_list'){
                followerLoader();
            }
            if(classList[0] === 'timeline'){
                timelineLoader();
            }
        });    

        // Message

        setInterval(()=>{
            messagePageLoadWorker();
        },5000);

        var element = $("div.emojionearea-editor");
        // console.log($("div.emojionearea-editor").text());
        element.keyup(function(e){
            e.preventDefault();
            if(e.which == 13){
                messageShow();
            }
        });
        
        $(".send").click(()=>{
            messageShow();
        });

        $(".close").click(()=>{
            $(".messenger").hide();
        });   

        setInterval(()=>{
            var name = $("div.name h4").html();
            $('.chats').load("includes/message_control.inc.php",
                { data: "get", to_name: name });
        },100);

        function messagePageLoadWorker(){
            $.ajax({
                url : "includes/message.inc.php",
                contentType : "text/html",
                method : "get",
                dataType : "html",
                success: (data, status)=>{
                    if(data){
                        $('#message-table tbody').html(data);
                    }
                    //console.log(status);
                    
                    $("#message-table tbody td button").click(function(e){
                        e.preventDefault();
                        $(".messenger").show();
                        $("textarea.typing").emojioneArea({
                            pickerPosition: "top",
                            toneStyle: "bullet",
                            inline: false
                        });

                        var name = $(this).parent().siblings('.name').text();
                        $('.chats').load("includes/message_control.inc.php",
                            { data: "get", to_name: name },
                            (data, status)=>{
                                console.log("Previous messages loaded");
                                $(".chats").scrollTop($(".chats").prop("scrollHeight"));
                        });
                        $("div.name h4").html(name);
                    });
                }
            });
        }

        function messageShow(){
            var second_user = $("div.name h4").html();
            var time = <?php echo json_encode(date("h:ia")); ?>;
            var newMessage = "<p><b>" + name + ":</b>  " + $("textarea.typing").val() + "<i id='date'>&emsp;" + time + "</i></p>";
            $.post("includes/message_control.inc.php",
                { data: "post", to_name: second_user, message: newMessage},
                (data, status)=>{
                    console.log("Sending new message to database");
            });
            var message = $(".chats").html();
            message = message + newMessage;
            $('.chats').html(message);
            //$(".typing").val("");
            var element = $("textarea.typing").emojioneArea();
            element[0].emojioneArea.setText('');

            $(".chats").scrollTop($(".chats").prop("scrollHeight"));
        }

        // Follow_list

        function followerLoader(){
            $.ajax({
                url: "includes/follower.inc.php",
                data: {name : name},
                dataType: "text",
                contentType: "text/html",
                success: (data, status)=>{
                    if(data){
                        $("#follow_list div").html(data);
                    }
                }
            });
        }

        //Profile pic upload

        $("#profile li#browse a").click((e)=>{
            e.preventDefault();
            $("form#image-form input").trigger("click");
        });    

        // Via Webcam
        function setCamera(){

            Webcam.set({
                width: 540,
                height: 540,
            });

            Webcam.attach("#camera");
        }

        function takeSnapShot(){
            Webcam.snap((data_url)=>{
                Webcam.freeze();
                setTimeout(()=>{
                    Webcam.unfreeze();
                },5000);

                $("#image-tag").val(data_url);
                $("div#dp div#image").html("<img src='" + data_url + "'>");
                console.log(data_url);
                Webcam.upload( data_url, "includes/upload_pic.inc.php", (data)=>{
                    console.log(data);
                });
            });
        }

        $("#profile li#take-photo a").click((e)=>{
            e.preventDefault();
            $(".wrapper").css("opacity","0.2");
            setCamera();
            Webcam.on('live',()=>{
                $("div#snapshot").css("display","block");
            });
            $("#snapshot span img").click(()=>{
                takeSnapShot();
            });
        }); 
        $("#snapshot span.close").click(()=>{
            $("div#snapshot").css("display","none");
            Webcam.reset();
        });

        // Timeline

        function timelineLoader(){
            $.ajax({
                url: "includes/timeline.inc.php",
                success: (data, status)=>{
                    $("#timeline div.row").html(data);

                    $("div.row .col-xs-2 button").click(function(e){
                        e.preventDefault();
                        var followed = $(this).siblings("h4").html();
                        if($(this).html() === "FOLLOW"){
                            $.post("includes/follower.inc.php",{
                                name: name,
                                followed: followed,
                                follow_submit: "follow"                            
                            },()=>{
                                $(this).html("UNFOLLOW");
                            });
                        }
                        

                        if($(this).html() === "UNFOLLOW"){
                            $.post("includes/follower.inc.php",{
                                name: name,
                                followed: followed,
                                follow_submit: "unfollow"
                            },()=>{
                                $(this).html("FOLLOW");
                            });
                        }

                    });
                }
            });
        } 
    });
</script>