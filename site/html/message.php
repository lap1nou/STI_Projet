<?php
    $username = $_POST['username'];
    $password = $_POST['password'];

    if(isValid($username) && isValid($password)){
        // Thanks to SQLite 3, the numCount() function is not supported so we have to implement it ourself
        $numRows = 0;

        $result = $file_db->query("SELECT * FROM user WHERE username = \"" . $username . "\"");

        foreach($result as $row){
                $numRows++; 
                $usernameFetched = $row[1];
                $passwordFetched = $row[2];

                // Verifying if username is valid
                if($username === $usernameFetched && password_verify($password, $passwordFetched)){
                    $_SESSION['username'] = $usernameFetched;
                    $_SESSION['password'] = $passwordFetched;
                }
        }

        if($numRows == 0){
            header("Location: index.php?page=login.php");
        }
    }

    if(isValid($_SESSION['username']) && isValid($_SESSION['password'])){
        echo "Bienvenue " . $_SESSION['username'];
        include_once("message.html");

        if(isValid($_POST['receiver']) && isValid($_POST['subject']) && isValid($_POST['message'])){
            echo "Sending";
            echo getIdByUsername($_POST['receiver']);
            echo "INSERT INTO \"message\" (id_message, id_sender, id_receiver, subject, text) VALUES (NULL," . getIdByUsername($_SESSION['username']) . "," . getIdByUsername($_POST['receiver']) . ",\"" . $_POST['subject'] . "\",\"" . $_POST['message'] . "\")";
            $file_db->exec("INSERT INTO \"message\" (id_message, id_sender, id_receiver, subject, text) VALUES (NULL," . getIdByUsername($_SESSION['username']) . "," . getIdByUsername($_POST['receiver']) . ",\"" . $_POST['subject'] . "\",\"" . $_POST['message'] . "\")");

        }
    }else{
        header("Location: index.php?page=login.php");
    }
?>