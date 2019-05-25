<html> 
  <body> 
	<?php
		// on teste la déclaration de notre cookie
		if (isset($_COOKIE['pseudo'])) {
			echo 'Bonjour '.$_COOKIE['pseudo'].' !';
		}
		else {
			echo '<form action="e8_traitement.php" method="post">';
			echo 'Votre nom : <input type = "texte" name = "nom"><br />';
			echo '<input type = "submit" value = "Envoyer" name="ok">';
		}
	?>
  </body> 

</html>
