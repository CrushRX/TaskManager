<?php

	if (isset($_SESSION['userid'])){
        $useridx = $_SESSION['userid'];
        $chk = mysqli_query($connection, "SELECT * FROM `users` WHERE `id`='$useridx'");
        $usernameAuthX;

        while ($row = mysqli_fetch_assoc($chk))
        {
          $usernameAuthX = $row['rules'];
          $usernameAuthXC = $row['username'];
        }
    }
    if (isset($usernameAuthX)&&$usernameAuthX != 'guest'){
		addInfo($connection, $usernameAuthXC);
		if (isset($usernameAuthX)&&$usernameAuthX === 'admin'){
			deleteInfo($connection);
			insertInfo($connection);
		}
	}
	caseUser($connection);
	
	?>
	<div class="outputField">
	<?php
		showTasks($connection);
	?>
	</div>
