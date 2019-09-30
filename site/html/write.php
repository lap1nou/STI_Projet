<?php
    if(isValid($_SESSION['username']) && isValid($_SESSION['password'])){
        include_once("message.html");

        if(isValid($_POST['receiver']) && isValid($_POST['subject']) && isValid($_POST['message'])){
            sendMessage($_SESSION['username'], $_POST['receiver'], $_POST['subject'], $_POST['message']);
            ?>
                <br>
                <!-- Source: https://getbootstrap.com/docs/4.3/components/alerts/ -->
                <div class="alert alert-success" role="alert">
                    Message has been sent !
                </div>
            <?php
        } else if(isValid($_POST['answerMessage'])){
        ?>
            <script>
                document.getElementById("receiver").value = "<?php echo $_POST['receiverMessage'] ?>";
                document.getElementById("subject").value = "<?php echo $_POST['subjectMessage'] ?>";
            </script>
        <?php
        }
    }else{
        header("Location: index.php?page=login.php");
    }
?>