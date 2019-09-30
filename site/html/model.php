<?php
    function DB_connect(){
        $file_db = new PDO('sqlite:/usr/share/nginx/databases/database.sqlite');
        $file_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $file_db;
    }

    function getUserById($userId){
        $file_db = DB_connect();

        return $file_db->query("SELECT * FROM user WHERE id_user = " . $userId);
    }

    function getIdByUsername($username){
        $file_db = DB_connect();

        $result = $file_db->query("SELECT id_user FROM user WHERE username = \"" . $username . "\"");

        foreach($result as $row){
            return $row[0];
        }
    }

    function getUsernameById($userId){
        $file_db = DB_connect();

        $result = $file_db->query("SELECT username FROM user WHERE id_user = \"" . $userId . "\"");
        
        foreach($result as $row){
            return $row[0];
        }
    }

    function getUsernamePassword($username){
        $file_db = DB_connect();

        $result = $file_db->query("SELECT password FROM user WHERE username = \"" . $username . "\"");
        
        foreach($result as $row){
            return $row[0];
        }
    }

    function createUser($username, $password, $role){
        $file_db = DB_connect();

        $result = $file_db->exec("INSERT INTO \"user\" VALUES (NULL, \"" . $username . "\",\"" . password_hash($password, PASSWORD_DEFAULT) . "\"," . $role . ", 1);");
    }

    function modifyUser($userId, $username, $newPassword, $role, $active){
        $file_db = DB_connect();

        if(isValid($newPassword)){
            $result = $file_db->exec("UPDATE user SET username = \"" . $username . "\", password = \"" . password_hash($newPassword, PASSWORD_DEFAULT) . "\", role = " . $role . ", enabled = " . $active . " WHERE id_user = " . $userId);
        }else{
            $result = $file_db->exec("UPDATE user SET username = \"" . $username . "\", role = " . $role . ", enabled = " . $active . " WHERE id_user = " . $userId);
        }
    }

    function deleteUser($userId){
        $file_db = DB_connect();

        $result = $file_db->exec("DELETE FROM user WHERE id_user = " . $userId);
    }

    function changePassword($oldPassword, $newPassword, $username){
        $file_db = DB_connect();

        $password = getUsernamePassword($username);

        if(password_verify($oldPassword , $password)){
            $result = $file_db->exec("UPDATE user SET password = \"" . password_hash($newPassword, PASSWORD_DEFAULT) . "\" WHERE id_user = \"" . getIdByUsername($username) . "\"");

            return true;
        }

        return false;
    }
    function sendMessage($username, $receiver, $subject, $message){
        $file_db = DB_connect();

        $file_db->exec("INSERT INTO \"message\" (id_message, id_sender, id_receiver, subject, text) VALUES (NULL," . getIdByUsername($_SESSION['username']) . "," . getIdByUsername($_POST['receiver']) . ",\"" . $_POST['subject'] . "\",\"" . $_POST['message'] . "\")");
    }

    function removeMessage($messageId){
        $file_db = DB_connect();

        $result = $file_db->exec("DELETE FROM message WHERE id_message = " . $messageId);
    }

    function isActive($userId){
        $file_db = DB_connect();

        $result = $file_db->query("SELECT enabled FROM user WHERE id_user = \"" . $userId . "\"");

        foreach($result as $row){
            if($row[0] == 1){
                return true;
            }
        }

        return false;
    }

    function isAdmin($userId){
        $file_db = DB_connect();

        $result = $file_db->query("SELECT role FROM user WHERE id_user = \"" . $userId . "\"");

        foreach($result as $row){
            if($row[0] == 1){
                return true;
            }
        }

        return false;
    }
?>