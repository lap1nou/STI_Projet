<?php
    $file_db = new PDO('sqlite:/usr/share/nginx/databases/database.sqlite');
    $file_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>