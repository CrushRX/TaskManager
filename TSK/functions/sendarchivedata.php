<?php 
	$dbname = '127.0.0.1';
    $username = 'root';
    $password = '';
    $db = 'tsk';
    $userInThisMoment = 'admin';

    $connection = mysqli_connect($dbname, $username, $password, $db);
	$dateArchive = $_POST['dateArch'];
    mysqli_query($connection, "DELETE FROM `dateInThisMoment`");
    mysqli_query($connection, "INSERT INTO `dateInThisMoment` (`date`) VALUES ('$dateArchive')");
	

	header('HTTP/1.1 301 Moved Permanently');
	header('Location: http://localhost/TSK/archive.php');
