<?php
	session_start();
	unset($_SESSION['userid']);
	session_destroy();

	header('HTTP/1.1 301 Moved Permanently');
	header('Location: http://localhost/TSK/');