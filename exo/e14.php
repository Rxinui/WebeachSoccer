<?php
	include("/home/S3S4/lwr2466a/public_html/form.php");
	$formulaire = new form();
	$formulaire->setText("n1");
	$formulaire->setText("n2");
	$formulaire->setButton("+");
	echo $formulaire->getForm();
?>
