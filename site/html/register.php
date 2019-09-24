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

    if(isset($username) && isset($password) && isset($password_confirm) && !empty($password_confirm) && !empty($username) && !empty($password)){
        // Verifying if username is valid
        $result = $file_db->exec("INSERT INTO \"user\" VALUES (NULL, \"" . $username . "\",\"" . $password . "\", 0, 1);");
    }
?>