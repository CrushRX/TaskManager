<?php
	$datex = mysqli_query($connection, "SELECT `date` FROM `dateInThisMoment`");
	$row = mysqli_fetch_assoc($datex);
	$dateArchive = $row['date'];
	

	if (!isset($dateArchive)){
		echo "переменной не существует";
	} else {
		
	}
	showArchiveInfo($connection);


?>
	<div class="outputField">
	<?php
		showArchiveTasks($connection, $dateArchive);	
	?>
	</div>