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
	    $photo = 'photo/'.(empty($_POST['photoName']) ? 'nopicture.png' : $_POST['photoName'] ); // fonctionne a condition d'avoir la photo dans le serveur au prealable
		// requete
		$req_afficher = $link->prepare("SELECT COUNT(*) FROM joueur WHERE nom = :nom AND prenom = :prenom AND numLicence = :numLicence 
	                                        AND taille = :taille AND poids = :poids AND dateNaissance = :dateNaissance AND statut = :statut");
		$req_afficher->execute(array('nom' => $nom,
									'prenom' => $prenom,
									'numLicence' => $num,
									'dateNaissance' => $ddn,
									'taille' => $taille,
									'poids' => $poids,
									'statut' => $statut));
		if ($req_afficher->fetchColumn() == 0){
			$req = $link->prepare('INSERT INTO joueur (nom,prenom,numLicence,taille,poids,dateNaissance,poste,statut,photoPath) 
									VALUES(:nom, :prenom, :num, :taille, :poids, :ddn, :poste, :statut, :photo)');
			$req->execute(array('nom' => $nom,
								'prenom' => $prenom,
								'num' => $num,
								'taille' => $taille,
								'poids' => $poids,
								'ddn' => $ddn,
								'poste' => $poste,
								'statut' => $statut,
								'photo' => $photo));
			MyElement::pageConfirmation("Joueur ajouté avec succès","../rsc/success.png");
		} else {
			MyElement::pageConfirmation("Joueur déjà existant","../rsc/error.png");
		}echo '<meta http-equiv="Refresh" content="3;URL=../ajouter.php">'; // pause de 3 secondes avant redirection
		?>
	</body>
</html>
