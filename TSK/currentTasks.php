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
          $usernameAuthC = $row['username'];
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

			<?php showUsername($connection, $rulesAuthX) ?>
		</div>
		<div class="showInfo">
			<p>Текущие задачи</p>
			<?php
			if (isset($rulesAuthX)&&$rulesAuthX === 'admin'){
				addNewTask($connection);
				deleteCurrentInfo($connection);
				showCurrentTasks($connection);
				}
			if (isset($rulesAuthX)&&$rulesAuthX === 'user'){
				showMyCurrentTasks($connection, $usernameAuthC);
				} 
			?>
		</div>
	</div>

</div>
</body>