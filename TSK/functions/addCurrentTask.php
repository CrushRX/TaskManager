<?php

	$dbname = '127.0.0.1';
    $usernames = 'root';
    $password = '';
    $db = 'tsk';
    $userInThisMoment = 'admin';

    $connection = mysqli_connect($dbname, $usernames, $password, $db);
	$postCurrentForm = $_POST['postsCurrentForm'];
	$usernameX = $_POST['usernameX'];

    mysqli_query($connection, "INSERT INTO `posts` (`posts`, `username`, `state`) VALUES ('$postCurrentForm', '$usernameX', 'in process')");
	var_dump(mysqli_query($connection, "SELECT * FROM `posts`"));


	header('HTTP/1.1 301 Moved Permanently');
	header('Location: http://localhost/TSK/currentTasks.php');
