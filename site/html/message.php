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

        $allMessage = $file_db->query("SELECT * FROM message WHERE id_receiver = " . getIdByUsername($_SESSION['username']) . " ORDER BY date");
        
        // Source: https://getbootstrap.com/docs/4.3/components/collapse/
        /*
        echo "<br>";
        echo 
        "<table>
        <tr>
          <th>Date</th>
          <th>Sender</th>
          <th>Subject</th>
          <th>Message</th>
        </tr>";

        foreach($allMessage as $message){
            echo "<tr>
            <td>" . $message[5] . "</td>
            <td>" . getUsernameById($message[1]) . "</td>
            <td>" . $message[3] . "</td>
            <td>" . $message[4] . "</td>
            </tr>";
        }

        echo "</table>";
        */
        ?>
        <div class="accordion" id="accordionExample">

        <?php
        foreach($allMessage as $message){
        ?>
            <div class="card">
                <div class="card-header" id="heading<?php echo $message[0] ?>">
                <h2 class="mb-0">
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse<?php echo $message[0] ?>" aria-expanded="true" aria-controls="collapse<?php echo $message[0] ?>">
                    Collapsible Group Item #1
                    </button>
                </h2>
                </div>

                <div id="collapse<?php echo $message[0] ?>" class="collapse show" aria-labelledby="heading<?php echo $message[0] ?>" data-parent="#accordionExample">
                <div class="card-body">
                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                </div>
                </div>
            </div>
        <?php 
        }
        ?>
        </div>

        <?php
        echo "<br>";
        echo 
        "<table>
        <tr>
          <th>Date</th>
          <th>Sender</th>
          <th>Subject</th>
          <th>Message</th>
        </tr>";

        
            echo "<tr>
            <td>" . $message[5] . "</td>
            <td>" . getUsernameById($message[1]) . "</td>
            <td>" . $message[3] . "</td>
            <td>" . $message[4] . "</td>
            </tr>";
        

        echo "</table>";
    }else{
        header("Location: index.php?page=login.php");
    }
?>