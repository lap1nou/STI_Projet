<?php
    session_start();

    include("functions.php");
    include_once("db.php");
    include("model.php");
    include("nav.html");
    include($_GET['page']);
?>