<?php
    include_once("model.php");

    $username = $_POST['username'];
    $password = $_POST['password'];

    if(isValid($username) && isValid($password) && isActive(getIdByUsername($username))){
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
                header("Location: index.php?page=message.php");
            }
        }

        if($numRows == 0){
            header("Location: index.php?page=login.php");
        }
    }

    if(isValid($_SESSION['username']) && isValid($_SESSION['password'])){
        header("Location: index.php?page=message.php");
    }
?>

<!DOCTYPE html>
<html>
    <form action="?page=login.php" method="POST">
        Username:
        <input type="text" id="username" name="username">
        <br>
        Password:
        <input type="password" id="password" name="password">
        <br>
        <input type="submit" id="button_login" value="Login">
    </form>
</html>