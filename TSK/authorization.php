<?php
include_once __DIR__ . "/functions.php";
?>

<head>
    <title>Authorization</title>
    <link rel="stylesheet" href="styles/style.css">
</head>

<form action="functions/auth.php" class="authDiv" method="POST">
	<h3>Авторизация</h3>
	<p>Логин</p>
	<input type="text" name="username" class="sendUsername"><br>
	<p>Пароль</p>
	<input type="text" name="password" class="sendPassword"><br>
	<input type="submit">
</form>