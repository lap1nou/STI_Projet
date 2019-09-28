<?php
    function DB_connect(){
        $file_db = new PDO('sqlite:/usr/share/nginx/databases/database.sqlite');
        $file_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $file_db;
    }

    function getIdByUsername($username){
        $file_db = DB_connect();

        $result = $file_db->query("SELECT id_user FROM user WHERE username = \"" . $username . "\"");

        foreach($result as $row){
            return $row[0];
        }
    }

    function getUsernameById($id){
        $file_db = DB_connect();

        $result = $file_db->query("SELECT username FROM user WHERE id_user = \"" . $id . "\"");
        
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

    function changePassword($oldPassword, $newPassword, $username){
        $file_db = DB_connect();

        $password = getUsernamePassword($username);

        if(password_verify($oldPassword , $password)){
            $result = $file_db->exec("UPDATE user SET password = \"" . password_hash($newPassword, PASSWORD_DEFAULT) . "\" WHERE id_user = \"" . getIdByUsername($username) . "\"");

            return true;
        }

        return false;
    }
?>