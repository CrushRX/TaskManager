<?php

    $dbname = '127.0.0.1';
    $username = 'root';
    $password = '';
    $db = 'tsk';
    $userInThisMoment = 'admin';

    $connection = mysqli_connect($dbname, $username, $password, $db);

    $postsForm = $_POST['postsForm'];
    $usernameForm = $_POST['usernameX'];
    if ($postsForm != null){
    	mysqli_query($connection, "INSERT INTO `tasks` (`username`, `posts`) VALUES ('$usernameForm', '$postsForm')");
    }
    header('HTTP/1.1 301 Moved Permanently');
	header('Location: http://localhost/TSK/');
