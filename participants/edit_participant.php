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
	    $cpt = $_POST['cpt'];
	    for ($i =0 ; $i<$cpt ; $i++){
		    $req = $link->prepare(' UPDATE participer
	                            SET  note = :note, commentaire = :commentaire
	                            WHERE id_joueur= :id_joueur AND id_matchs = :id_matchs ');
		    $req->execute(array('id_joueur' => $_POST['id_joueur'.$i],
			    'note' => (empty($_POST['note'.$i]) ? NULL : $_POST['note'.$i]),
			    'commentaire' => $_POST['commentaire'.$i] ,
			    'id_matchs' => $id_matchs));
	    }
	    MyElement::pageConfirmation("Participant modifié avec succès","../rsc/success.png");
	    echo '<meta http-equiv="Refresh" content="3;URL=../afficher.php">';
	?>
	</body>
</html>
