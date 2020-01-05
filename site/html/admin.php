<?php
if(isAdmin(getIdByUsername($_SESSION['username'])) && isActive(getIdByUsername($_SESSION['username']))){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];
    $role = $_POST['role'];

    if(isValid($username) && isValid($password) && isValid($password_confirm) && verifyToken($_POST['token'])){
        // Verifying if username is valid
        if($password_confirm === $password && getIdByUsername($username) === NULL){
            createUser($username, $password, $role);
            ?>
                <br>
                <!-- Source: https://getbootstrap.com/docs/4.3/components/alerts/ -->
                <div class="alert alert-success" role="alert">
                    User has been created !
                </div>
            <?php
        }else{
            ?>
                <br>
                <!-- Source: https://getbootstrap.com/docs/4.3/components/alerts/ -->
                <div class="alert alert-danger" role="alert">
                    User has not been created !
                </div>
            <?php
        }
    }
    if(isValid($_POST['userIdRemove']) && verifyToken($_POST['token'])){
        deleteUser($_POST['userIdRemove']);
        ?>
        <br>
        <!-- Source: https://getbootstrap.com/docs/4.3/components/alerts/ -->
        <div class="alert alert-success" role="alert">
            User has been deleted !
        </div>
    <?php
    }
?>

<!DOCTYPE html>
<html>
    Create user
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
        Rôle:
        <!-- Source: https://www.w3schools.com/tags/tag_select.asp -->
        <select name="role">
            <option value="0">Collaborateur</option>
            <option value="1">Administrateur</option>
        </select>
        <br>
        <input type="submit" id="button_login" value="Create">
    </form>
    <hr>
    Manage users
    <!-- Source: https://getbootstrap.com/docs/4.3/content/tables/ -->
    <table class="table table-striped">
        <thead>
            <tr>
            <th scope="col">ID</th>
            <th scope="col">Username</th>
            <th scope="col">Role</th>
            <th scope="col">Statut</th>
            <th scope="col"></th>
            <th scope="col"></th>
            </tr>
        </thead>
        <?php 
        $allUser = $file_db->query("SELECT * FROM user");

        foreach($allUser as $user) { ?>
            <tbody>
                <tr>
                    <th scope="row"><?php echo $user[0] ?></th>
                        <td><?php echo htmlspecialchars($user[1]); ?></td>
                        <td><?php echo $user[3] ?></td>
                        <td><?php echo $user[4] ?></td>
                        <td>
                            <form action="?page=modify.php" method="POST" style="display: inline-block;">
                                <input class="btn btn-primary" type="submit" value="Modify" name="modifyUser">
                                <input type="hidden" value="<?php echo $user[0] ?>" name="userIdModify">   
                                <input type="hidden" value="<?php echo $_SESSION['token'] ?>" name="token">
                            </form>
                        </td>
                        <td>
                            <form action="?page=admin.php" method="POST" style="display: inline-block;">
                                <input class="btn btn-danger" type="submit" value="Remove" name="removeUser<?php echo $user[0] ?>">
                                <input type="hidden" value="<?php echo $user[0] ?>" name="userIdRemove">
                                <input type="hidden" value="<?php echo $_SESSION['token'] ?>" name="token">
                            </form>
                        </td>
                    </tr>
                <tr>
            </tbody>
        <?php } ?>
    </table>
</html>

<?php } else {
    header("Location: index.php?page=login.php");
} ?>