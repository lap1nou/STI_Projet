<?php
    include_once("passwordChange.html");
    include_once("model.php");

    if(isValid($_SESSION['username']) && isValid($_SESSION['password'])){
        if(isValid($_POST['oldPassword']) && isValid($_POST['newPassword']) && isValid($_POST['newPasswordConfirm']) && $_POST['newPasswordConfirm'] === $_POST['newPassword']){
            if(changePassword($_POST['oldPassword'], $_POST['newPassword'], $_SESSION['username'])){
                echo "Password succesfully changed !";
            }else{
                echo "Password changed has fail !";
            }
        }else if($_POST['newPasswordConfirm'] != $_POST['newPassword']){
            echo "Both old password are not similar !";
        }
    }
?>