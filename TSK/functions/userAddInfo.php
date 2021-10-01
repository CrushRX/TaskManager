<?php 
	$usernameReg = $_POST['usernameReg'];
	$passwordReg = $_POST['passwordReg'];
	$rulesReg = $_POST['rulesReg'];

	$dbname = '127.0.0.1';
    $username = 'root';
    $password = '';
    $db = 'tsk';
    $userInThisMoment = 'admin';

    $connection = mysqli_connect($dbname, $username, $password, $db);

	if ($usernameReg != null && $passwordReg != null && $rulesReg != null){
		mysqli_query($connection, "INSERT INTO `users` (`username`, `password`, `rules`) VALUES ('$usernameReg', '$passwordReg', '$rulesReg')");
	}
	header('HTTP/1.1 301 Moved Permanently');
	header('Location: http://localhost/TSK/');