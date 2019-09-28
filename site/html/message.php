<?php

    if(isValid($_SESSION['username']) && isValid($_SESSION['password'])){
        if(isValid($_POST['removeMessage'])){
            removeMessage($_POST['messageId']);
        }

        echo "Bienvenue " . $_SESSION['username'];

        $allMessage = $file_db->query("SELECT * FROM message WHERE id_receiver = " . getIdByUsername($_SESSION['username']) . " ORDER BY date");
        
        // Source: https://getbootstrap.com/docs/4.3/components/collapse/
        ?>
        <div class="accordion" id="accordionExample">

        <?php
        foreach($allMessage as $message){
        ?>
            <div class="card">
                <div class="card-header" id="heading<?php echo $message[0] ?>">
                    <form action="?page=write.php" method="POST" style="display: inline-block;">
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse<?php echo $message[0] ?>" aria-expanded="true" aria-controls="collapse<?php echo $message[0] ?>">
                            <?php echo $message[3] . " - by " . getUsernameById($message[1]) ?>
                        </button>
                        <input class="btn btn-success" type="submit" value="Answer" name="answerMessage">
                        <input type="hidden" value="<?php echo getUsernameById($message[1]) ?>" name="receiverMessage">
                        <input type="hidden" value="Re: <?php echo $message[3] ?>" name="subjectMessage">    
                    </form>

                    <form action="?page=message.php" method="POST" style="display: inline-block;">
                        <input class="btn btn-danger" type="submit" value="Remove" name="removeMessage">
                        <input type="hidden" value="<?php echo $message[0] ?>" name="messageId">   
                    </form>

                    <!-- Source: https://stackoverflow.com/questions/46171138/bootstrap-card-header-pull-right -->
                    <div class="float-sm-right">
                        <?php echo $message[5] ?>
                    </div>
                </div>

                <div id="collapse<?php echo $message[0] ?>" class="collapse" aria-labelledby="heading<?php echo $message[0] ?>" data-parent="#accordionExample">
                    <div class="card-body">
                        <?php echo $message[4] ?>
                    </div>
                </div>
            </div>
        <?php 
        }
        ?>
        </div>

<?php
    }else{
        header("Location: index.php?page=login.php");
    }
?>