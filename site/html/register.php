<!DOCTYPE html>
<html>
    <form action="#" method="POST">
        Username:
        <input type="text" id="username" name="username">
        <br>
        Password:
        <input type="password" id="password" name="password">
        <br>
        Confirm password:
        <input type="password" id="password_confirm" name="password_confirm">
        <br>
        <input type="submit" id="button_login" value="Register">
    </form>
</html>

<?php
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    if(isValid($username) && isValid($password) && isValid($password_confirm)){
        // Verifying if username is valid
        $result = $file_db->exec("INSERT INTO \"user\" VALUES (NULL, \"" . $username . "\",\"" . password_hash($password, PASSWORD_DEFAULT) . "\", 0, 1);");
    }
?>