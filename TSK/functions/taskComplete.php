<?php
	$dbname = '127.0.0.1';
    $username = 'root';
    $password = '';
    $db = 'tsk';
    $userInThisMoment = 'admin';

    $connection = mysqli_connect($dbname, $username, $password, $db);

    $postComplete = $_POST['sendPostComplete'];
    $usernameComplete = $_POST['sendUsernameComplete'];
    $dateComplete = $_POST['sendDateComplete'];

    echo $postComplete;
    echo $usernameComplete;

	mysqli_query($connection, "INSERT INTO `tasks` (`username`, `posts`) VALUES ('$usernameComplete', '$postComplete')");
	mysqli_query($connection, "DELETE FROM `posts` WHERE `posts`='$postComplete' AND `username` = '$usernameComplete'");

	header('HTTP/1.1 301 Moved Permanently');
	header('Location: http://localhost/TSK/');