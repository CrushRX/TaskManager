<?php 
	if (isset($_SESSION['userid'])){
		$useridx = $_SESSION['userid'];
		$chk = mysqli_query($connection, "SELECT * FROM `users` WHERE `id`='$useridx'");
		$usernameAuthX;
		while($row = mysqli_fetch_assoc($chk))
    	{
      	  $usernameAuthX = $row['username'];
   		}
	}
?>
<header>
	<h1>TASKMGR</h1>
	<div class="authPanel">
		<?php 
			if (isset($_SESSION['userid']))    {
    			print $usernameAuthX;
    			?>
    			<form action="functions/exit.php">
    				<input type="submit" class="exitBtn" value="Выход">
    			</form>
    			<?php
			} else {
				?>
				<a href="authorization.php" class="authA">
					Авторизация
				</a>
				<?php
			}
		 ?>		
		
	</div>
</header>