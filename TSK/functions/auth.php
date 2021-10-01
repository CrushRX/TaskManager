<?php
	session_start();
	$dbname = '127.0.0.1';
    $username = 'root';
    $password = '';
    $db = 'tsk';


    $connection = mysqli_connect($dbname, $username, $password, $db);
	$usernameAuth = $_POST['username'];
	$passwordAuth = $_POST['password'];
	
	echo $usernameAuth;
	echo $passwordAuth;
	$userinfo = mysqli_query($connection, "SELECT * FROM `users` WHERE `username`= '$usernameAuth' AND `password`='$passwordAuth'");
	if ($userinfo){
		
	}
	while ($row = mysqli_fetch_assoc($userinfo))
    {
        $idAuth = $row['id'];
    }
    $_SESSION['userid'] = $idAuth;
    
	header('HTTP/1.1 301 Moved Permanently');
	header('Location: http://localhost/TSK/');