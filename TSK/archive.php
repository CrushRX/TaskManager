<?php
include_once __DIR__ . "/functions.php";
session_start();
if (isset($_SESSION['userid'])){
        $useridx = $_SESSION['userid'];
        $chk = mysqli_query($connection, "SELECT * FROM `users` WHERE `id`='$useridx'");
        $usernameAuthX;
        while ($row = mysqli_fetch_assoc($chk))
        {
          $rulesAuthX = $row['rules'];
        }
    }
?>

<head>
    <title>TASKMANAGER</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
<div class="centerDV">
	<?php $CD = include_once __DIR__ . "/components/header.php";?>
	<div class="middle">
		<div class="usersNav">

			<?php showUsername($connection,  $rulesAuthX) ?>
		</div>

		<div class="showInfo">
			<p>Архив</p>
			<?php $SI = include_once __DIR__."/components/archivebody.php";?>
		</div>
	</div>

</div>
</body>