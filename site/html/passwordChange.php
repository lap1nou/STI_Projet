<?php
    include_once("passwordChange.html");
    include_once("model.php");

    if(isValid($_SESSION['username']) && isValid($_SESSION['password'])){
        if(isValid($_POST['oldPassword']) && isValid($_POST['newPassword']) && isValid($_POST['newPasswordConfirm']) && $_POST['newPasswordConfirm'] === $_POST['newPassword']){
            if(changePassword($_POST['oldPassword'], $_POST['newPassword'], $_SESSION['username'])){
                ?>
                    <div class="alert alert-success" role="alert">
                        Password has been modifed !
                    </div>
                <?php
            }else{
                ?>
                    <div class="alert alert-danger" role="alert">
                        Password change has failed !
                    </div>
                <?php
            }
        }else if($_POST['newPasswordConfirm'] != $_POST['newPassword']){
            ?>
                <div class="alert alert-danger" role="alert">
                    Both password are not similar !
                </div>
            <?php
        }
    }
?>