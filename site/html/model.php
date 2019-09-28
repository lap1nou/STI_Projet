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
?>