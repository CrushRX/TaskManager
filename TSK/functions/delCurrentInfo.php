<?php

    $dbname = '127.0.0.1';
    $username = 'root';
    $password = '';
    $db = 'tsk';
    $userInThisMoment = 'admin';

    $connection = mysqli_connect($dbname, $username, $password, $db);

	$idCurrentForm = $_POST['idForm'];


	if ($idCurrentForm != null){
		mysqli_query($connection, "DELETE FROM `posts` WHERE `id` = '$idCurrentForm'");
	}

	header('HTTP/1.1 301 Moved Permanently');
	header('Location: http://localhost/TSK/currentTasks.php');
