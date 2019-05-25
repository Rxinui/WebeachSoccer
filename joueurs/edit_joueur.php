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
		    $id = $_POST['id_joueur'];
			$nom = $_POST['nom'];
			$prenom = $_POST['prenom'];
		    $num = $_POST['num'];
		    $ddn = $_POST['ddn'];
		    // attributs pouvant etre NULL dans la BDD
			$taille = empty($_POST['taille']) ? NULL : $_POST['taille'];
			$poids = empty($_POST['poids']) ? NULL : $_POST['poids'];
			$poste = empty($_POST['poste']) ? NULL : $_POST['poste'];
			$statut = empty($_POST['statut']) ? NULL : $_POST['statut'];
			$req_photo = $link->prepare('SELECT photoPath FROM joueur
			                            WHERE id_joueur=:id');
			$req_photo->execute(array('id' => $id));
		    $photo = empty($_POST['photoName']) ? $req_photo->fetch()[0] : 'photo/'.$_POST['photoName'];
			// requete
		    //Préparation de la requête
		    $req = $link->prepare(' UPDATE joueur 
		                            SET nom=:nom, prenom=:prenom, numLicence=:num, taille=:taille, poids=:poids, dateNaissance=:ddn, poste=:poste, statut=:statut, photoPath=:photo
		                            WHERE joueur.id_joueur=:id');
		    ///Exécution de la requête
		    $req->execute(array('nom' => $nom,
		                        'prenom' => $prenom,
		                        'num' => $num,
		                        'taille' => $taille,
		                        'poids' => $poids,
		                        'ddn' => $ddn,
		                        'poste' => $poste,
		                        'statut' => $statut,
		                        'id' => $id,
		                        'photo' => $photo));
		    MyElement::pageConfirmation("Joueur modifié avec succès","../rsc/success.png");
		    echo '<meta http-equiv="Refresh" content="3;URL=../afficher.php">';
		    ?>
	</body>
</html>
