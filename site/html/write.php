<?php
    if(isValid($_SESSION['username']) && isValid($_SESSION['password'])){
        include_once("message.html");

        if(isValid($_POST['receiver']) && isValid($_POST['subject']) && isValid($_POST['message'])){
            $file_db->exec("INSERT INTO \"message\" (id_message, id_sender, id_receiver, subject, text) VALUES (NULL," . getIdByUsername($_SESSION['username']) . "," . getIdByUsername($_POST['receiver']) . ",\"" . $_POST['subject'] . "\",\"" . $_POST['message'] . "\")");
        }
    }else{
        header("Location: index.php?page=login.php");
    }
?>