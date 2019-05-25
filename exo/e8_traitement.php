<?php
	if (isset($_POST['nom'])) {
		$temps = 24*3600; // 1 jour 
		setcookie ("pseudo", $_POST['nom'], time() + $temps);
	}
?>
