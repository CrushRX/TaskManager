<?php

    $dbname = '127.0.0.1';
    $username = 'root';
    $password = '';
    $db = 'tsk';
    $userInThisMoment = 'admin';
    $connection = mysqli_connect($dbname, $username, $password, $db);
    $today = date("Y-m-d");


	mysqli_query($connection, "INSERT INTO `archive` SELECT * FROM `tasks` WHERE `date` = '$today'");
    mysqli_query($connection, "DELETE FROM `tasks` WHERE `date` = '$today'");

    header('HTTP/1.1 301 Moved Permanently');
    header('Location: http://localhost/TSK/');
    

