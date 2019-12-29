<?php
    function DB_connect(){
        $file_db = new PDO('sqlite:/usr/share/nginx/databases/database.sqlite');
        $file_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $file_db;
    }

    function getUserById($userId){
        $file_db = DB_connect();

        $stmt = $file_db->prepare("SELECT * FROM user WHERE id_user = :userId");
        $stmt->bindValue(":userId", $userId, SQLITE3_INTEGER);

        $stmt->execute();

        $result = $stmt->fetch();
        $stmt->closeCursor();

        return $result['id_user'];
    }

    function getIdByUsername($username){
        $file_db = DB_connect();

        $stmt = $file_db->prepare("SELECT id_user FROM user WHERE username = :username");
        $stmt->bindValue(":username", $username);
        $stmt->execute();
        $result = $stmt->fetch();

        return $result['id_user'];
    }

    function getUsernameById($userId){
        $file_db = DB_connect();

        $stmt = $file_db->prepare("SELECT username FROM user WHERE id_user = :userId");
        $stmt->bindValue(":userId", $userId);
        $stmt->execute();

        $result = $stmt->fetch();

        return $result['username'];
    }

    function getUsernamePassword($username){
        $file_db = DB_connect();

        $stmt = $file_db->prepare("SELECT password FROM user WHERE username = :username");
        $stmt->bindValue(":username", $username);
        $stmt->execute();

        $result = $stmt->fetch();
        $stmt->closeCursor();

        return $result["password"];
    }

    function createUser($username, $password, $role){
        $file_db = DB_connect();

        $stmt = $file_db->prepare("INSERT INTO user VALUES (NULL, :username, :password, :role, 1)");
        $stmt->bindValue(":username", $username);
        $stmt->bindValue(":password",  password_hash($password, PASSWORD_DEFAULT));
        $stmt->bindValue(":role", $role);
        $stmt->execute();
        $stmt->closeCursor();
    }

    function modifyUser($userId, $username, $newPassword, $role, $active){
        $file_db = DB_connect();
        var_dump($newPassword);

        if(isValid($newPassword) && $newPassword !== ''){
            $stmt = $file_db->prepare("UPDATE `user` SET username = :username, password = :password, role = :role, enabled = :active WHERE id_user = :userId");
            $stmt->bindValue(":username", $username);
            $stmt->bindValue(":password",  password_hash($newPassword, PASSWORD_DEFAULT));
            $stmt->bindValue(":role", $role);
            $stmt->bindValue(":active", $active);
            $stmt->bindValue(":userId", $userId);
            $stmt->execute();
        }else{
            $stmt = $file_db->prepare("UPDATE `user` SET username = :username, role = :role, enabled = :active WHERE id_user = :userId");
            $stmt->bindValue(":username", $username);
            $stmt->bindValue(":role", $role);
            $stmt->bindValue(":active", $active);
            $stmt->bindValue(":userId", $userId);
            $stmt->execute();
        }
    }

    function deleteUser($userId){
        $file_db = DB_connect();

        $stmt = $file_db->prepare("DELETE FROM user WHERE id_user = :userId");
        $stmt->bindValue(":userId", $userId);
        $stmt->execute();
        $stmt->closeCursor();
    }

    function changePassword($oldPassword, $newPassword, $username){
        $file_db = DB_connect();

        $password = getUsernamePassword($username);

        if(password_verify($oldPassword , $password)){
            $stmt = $file_db->prepare("UPDATE user SET password = :password WHERE id_user = :userId");
            $stmt->bindValue(":password", password_hash($newPassword, PASSWORD_DEFAULT));
            $stmt->bindValue(":userId", getIdByUsername($username));
            $stmt->execute();
            $stmt->closeCursor();

            return true;
        }

        return false;
    }
    function sendMessage($username, $receiver, $subject, $message){
        $file_db = DB_connect();

        $stmt = $file_db->prepare("INSERT INTO \"message\" (id_message, id_sender, id_receiver, subject, text) VALUES (NULL, :userId , :receiverId, :subject, :message)");
        $stmt->bindValue(":userId", getIdByUsername($username));
        $stmt->bindValue(":receiverId", getIdByUsername($receiver));
        $stmt->bindValue(":subject", $subject);
        $stmt->bindValue(":message", $message);
        $stmt->execute();
        $stmt->closeCursor();

    }

    function removeMessage($messageId){
        $file_db = DB_connect();
        $stmt = $file_db->prepare("DELETE FROM message WHERE id_message = :messageId");
        $stmt->bindValue(":messageId", $messageId);
        $stmt->execute();
        $stmt->closeCursor();

    }

    function isActive($userId){
        $file_db = DB_connect();

        $stmt = $file_db->prepare("SELECT enabled FROM user WHERE id_user = :userId");
        $stmt->bindValue(":userId", $userId);
        $stmt->execute();
        $result = $stmt->fetch();
        $stmt->closeCursor();

        if($result['enabled'] == 1) {
            return true;
        }

        return false;
    }

    function isAdmin($userId){
        $file_db = DB_connect();

        $stmt = $file_db->prepare("SELECT role FROM user WHERE id_user = :userId");
        $stmt->bindValue(":userId", $userId);
        $stmt->execute();
        $result = $stmt->fetch();
        $stmt->closeCursor();

        if($result['role'] == 1){
            return true;
        }

        return false;
    }
?>