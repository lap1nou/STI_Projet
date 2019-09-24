<?php
    $username = $_POST['username'];
    $password = $_POST['password'];

    if(isset($username) && isset($password) && !empty($username) && !empty($password)){
        // Verifying if username is valid
        $result = $file_db->query("SELECT * FROM user WHERE username = \"" . $username . "\"");
        echo $result;
    }
?>