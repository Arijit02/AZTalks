<?php
    require_once "dbh.class.php";
    date_default_timezone_set("Asia/Kolkata");
    
    class Users extends Dbh{
        protected function getUsers($name, $password){
            $sql = "SELECT * FROM users WHERE username=?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$name, $password]);
    
            $results = $stmt->fetchAll();

    
            return $results;
        }

        protected function getAllUsers(){
            $sql = "SELECT * FROM users ORDER BY username ASC";
            $stmt = $this->connect()->query($sql);
    
            $results = $stmt->fetchAll();
            return $results;
        }

        protected function changeStatusToOnline($name){
            $sql = "UPDATE users SET online_status='online' WHERE username=?";
            $stmt = $this->connect()->prepare($sql);    
            $stmt->execute([$name]);
        }
        
        protected function changeStatusToOffline($name){
            $sql = "UPDATE users SET online_status='offline' WHERE username=?";
            $stmt = $this->connect()->prepare($sql);    
            $stmt->execute([$name]);   
        }

        protected function authenticateUsers($name, $password){
            $sql = "SELECT * FROM users WHERE username=?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$name]);
    
            $results = $stmt->fetchAll();

            if ($results){
                $pwdCheck = password_verify($password, $results[0]['pass_word']);
                if($pwdCheck == false){
                    return "Invalid password";
                }else if($pwdCheck == true){
                    session_start();
                    $name = $_SESSION['name'] = $results[0]['username'];
                    $_SESSION['email'] = $results[0]['email'];
                    $_SESSION['mobile'] = $results[0]['mobile'];
                    return "Success";
                }
            }else{
                return "No user";
            }
    
        }

        protected function userExists($name){
            $sql = "SELECT * FROM users WHERE username=?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$name]);
    
            $results = $stmt->fetchAll();
            
            if($results){
                return 1;
            }else{
                return 0;
            }
        }
    
        protected function setUsers($name, $email, $phone, $password){
            $date = date("y-m-d h:i:s");
            $sql = "INSERT INTO users(username, email, mobile, pass_word, created) VALUES (?,?,?,?,?)";
            if($stmt = $this->connect()->prepare($sql)){
                $hashedpwd = password_hash($password, PASSWORD_DEFAULT);
                if($stmt->execute([$name, $email, $phone, $hashedpwd, $date])){
                    session_start();
                    $_SESSION['name'] = $name;
                    $_SESSION['email'] = $email;
                    $_SESSION['mobile'] = $phone;
                    return;
                }else{
                    echo "Some unwanted error occurred!";
                }
            }else{
                echo "Some unwanted error occurred!";
            }
        }


        protected function showMessage($sender, $receiver){
            $sql = "SELECT * FROM messages WHERE (sender_username=? OR sender_username=?) AND 
            (receiver_username=? OR receiver_username=?) ORDER BY conversation_id ASC";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$sender, $receiver, $sender, $receiver]);

            $results = $stmt->fetchAll();
            $message = "";
            if($results){
                foreach ($results as $result){
                    $message = $message.$result['message_content'];
                }
                return $message;
            }else{
                return $message;
            }
        }

        protected function showMessageDetails($sender, $receiver){
            $sql = "SELECT * FROM messages WHERE (sender_username=? OR sender_username=?) AND 
            (receiver_username=? OR receiver_username=?) ORDER BY conversation_id ASC";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$sender, $receiver, $sender, $receiver]);

            $results = $stmt->fetchAll();
            return $results;
        }

        protected function sendMessage($sender, $receiver, $message){
            $updateDate = date("y-m-d h:i:s");
            $results = $this->showMessage($sender, $receiver);
            if($results === ""){
                $createDate = $updateDate;
                $sql = "INSERT INTO messages(sender_username, receiver_username, message_content, created, updated) 
                VALUES(?,?,?,?,?)";
                $stmt = $this->connect()->prepare($sql);
                $stmt->execute([$sender, $receiver, $message, $createDate, $updateDate]);
            }else{
                $results = $this->showMessageDetails($sender, $receiver);
                $createDate = end($results)['created'];
                $conversationId = end($results)['conversation_id'];
                $conversationId  = $conversationId + 1;
                $sql = "INSERT INTO messages(sender_username, receiver_username, conversation_id,
                 message_content, created, updated) VALUES(?,?,?,?,?,?)";
                $stmt = $this->connect()->prepare($sql);
                $stmt->execute([$sender, $receiver, $conversationId, $message, $createDate, $updateDate]);
            }
        }

        protected function showFollowers($name){
            $sql = "SELECT * FROM follow_list WHERE username=? OR follower_username=?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$name, $name]);
            $results = $stmt->fetchAll();
            
            $follow_arr = array("followers"=>array(), "following"=>array());
            foreach($results as $result){
                if($result['username'] === $name){
                    array_push($follow_arr['followers'], $result['follower_username']);
                }else{
                    array_push($follow_arr['following'], $result['username']);
                }
            }

            return $follow_arr; 
        }

        protected function addFollowers($name, $followed){
            $date = date("Y-m-d h:i:s");
            $sql = "INSERT INTO follow_list(username, follower_username, followed_at) VALUES(?,?,?)";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$followed, $name, $date]);
        }

        protected function deleteFollowers($name, $followed){
            $sql = "DELETE FROM follow_list WHERE username=? AND follower_username=?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$followed, $name]);
        }
    }

?>