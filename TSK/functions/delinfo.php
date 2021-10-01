<?php

    $dbname = '127.0.0.1';
    $username = 'root';
    $password = '';
    $db = 'tsk';
    $userInThisMoment = 'admin';

    $connection = mysqli_connect($dbname, $username, $password, $db);

    $idForm = $_POST['idForm'];
    $usernameForm = $_POST['usernameX'];
    if ($idForm != null){
    	mysqli_query($connection, "DELETE FROM `tasks` WHERE `id` = '$idForm'");
    }
    header('HTTP/1.1 301 Moved Permanently');
	header('Location: http://localhost/TSK/');
