<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Confirmation</title>
		<?php
		include 'header_bootstrap.html';
		?>
	</head>
	<body>
	<?PHP
		require_once '../sgbd_login.php';
		require_once '../class/MyElement.php';
	    //Recuperation des données
	    $id_matchs = $_POST['id_matchs'];
		// requete
	    //Préparation de la requête
	    $req = $link->prepare(' DELETE FROM participer 
	                            WHERE id_matchs= :id_matchs');
	    ///Exécution de la requête
	    $req->execute(array('id_matchs' => $id_matchs));
	    MyElement::pageConfirmation("Participants supprimés avec succès","../rsc/success.png");
	    echo '<meta http-equiv="Refresh" content="3;URL=../afficher.php">'; // pause de 3 secondes avant redirection
	?>
	</body>
</html>
