<?php

    $dsn = 'mysql:dbname=my_profile;host=localhost';
    $db_user = 'root';
    $db_password='';
    $dbh = new PDO($dsn, $db_user, $db_password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbh->query('SET NAMES utf8');

?>
