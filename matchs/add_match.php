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
	include '../class/MyElement.php';
    //Recuperation des données
    $id = $_POST['id_matchs'];
	$equipeAdverse = $_POST['equipeAdverse'];
    $dateM = $_POST['dateM'];
    $heure = $_POST['heure'];
    $lieu = $_POST['lieu'];
    $scoreEquipe = $_POST['scoreEquipe'];
    $scoreAdverse = $_POST['scoreAdverse'];
    // harmonisation des variables 
    $dateHeure = $dateM.' '.$heure.':00';
    $resultat = $scoreEquipe.'-'.$scoreAdverse;
	// requete
	$req_afficher = $link->prepare('    SELECT COUNT(*) 
                                        FROM matchs  
                                        WHERE dateHeure = :dateHeure AND equipeAdverse = :equipeAdverse AND lieu = :lieu AND resultat = :resultat ');
    $req_afficher->execute(array('equipeAdverse' => $equipeAdverse,
                                'dateHeure' => $dateHeure,
                                'lieu' => $lieu,
	                            'resultat' => $resultat));
	//print_r($link->errorInfo());
	if ($req_afficher->fetchColumn() == 0){
		//Préparation de la requête
		$req = $link->prepare('INSERT INTO matchs (dateHeure, equipeAdverse, lieu, resultat) 
								VALUES(:dateHeure, :equipeAdverse, :lieu, :resultat)');
		///Exécution de la requête
		$req->execute(array('dateHeure' => $dateHeure,
							'equipeAdverse' => $equipeAdverse,
							'lieu' => $lieu,
							'resultat' => $resultat));
		MyElement::pageConfirmation("Match ajouté avec succès","../rsc/success.png");
	} else {
		MyElement::pageConfirmation("Match déjà existant","../rsc/error.png");
	} echo '<meta http-equiv="Refresh" content="3;URL=../ajouter.php">'; // pause de 3 secondes avant redirection
?>
	</body>
</html>
