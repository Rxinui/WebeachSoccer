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
	    include_once '../class/Participant.php';

	    /*
	     * AU BEACH SOCCER, IL EST OBLIGATOIRE D'AVOIR EXACTEMENT 1 GARDIEN TITULAIRE.
	     * CEPENDANT, LES "POSTES" INDIQUES SUR LES DONNEES DES JOUEURS SONT LEURS POSTES FAVORIS.
	     * DONC, NOUS AUTORISONS A FAIRE PARTICIPER 2 JOUEURS AYANT COMME POSTE FAVORIS "GARDIEN"
	     * SACHANT QU'UN DES 2 JOUERA UN AUTRE POSTE.
	     * DE MEME QU'UNE EQUIPE TITULAIRE PEUT ETRE COMPOSE DE JOUEUR N'AYANT PAS COMME
	     * POSTE FAVORIS "GARDIEN". CE SERA A L'ENTRAINEUR DE DESIGNER QUI OCCUPERA CE ROLE.
	     */

	    $tab_participant = array();
	    $cpt_titulaire = 0;
	    $cpt_remplacant = 0;

	    for ($i=1 ; $i<=$_POST['cpt'] ; $i++){
	        $tab_participant[$id_joueur = $_POST['id_joueur'.$i]] = array('titulaire' => $_POST['titulaire'.$i],
	                                                        'note' => $_POST['note'.$i],
	                                                        'commentaire' => $_POST['commentaire'.$i]);
	        if ($_POST['titulaire'.$i] == 1){
	            $cpt_titulaire++;
	            // on va chercher le poste du gardien en BDD
	            $req = $link->prepare('SELECT poste FROM joueur WHERE id_joueur = :id_joueur');
	            $req->execute(array('id_joueur' => $id_joueur));
	            $poste = $req->fetch();
	        }elseif ($_POST['titulaire'.$i] == 0){
	            $cpt_remplacant++;
	        }
	    }
	    // print_r($tab_participant); // structure du tableau
	    if ($cpt_titulaire == Participant::NB_TITULAIRES and $cpt_remplacant >= Participant::MIN_REMPLACANTS
	        and  $cpt_remplacant <= Participant::MAX_REMPLACANTS) {
	        $id_matchs = $_POST['id_matchs'];
	        foreach($tab_participant as $id_joueur=>$tab_joueur){
	            if (isset($tab_joueur['titulaire']) and $tab_joueur['titulaire'] != -1){
	                $req = $link->prepare('INSERT INTO participer (id_joueur,id_matchs,titulaire,note,commentaire) 
	                                        VALUES(:id_joueur, :id_matchs, :titulaire, :note, :commentaire)');
	                $req->execute(array('id_joueur' => $id_joueur,
	                                'id_matchs' => $id_matchs,
	                                'titulaire' => ($tab_joueur['titulaire']) , // car TINYINT sur MySQL
	                                'note' => $tab_joueur['note'],
	                                'commentaire' => $tab_joueur['commentaire']));
	            }
	        }MyElement::pageConfirmation("Participant ajouté avec succès","../rsc/success.png");
	    }else{
	        MyElement::pageConfirmation("Erreur d'ajout de participant","../rsc/error.png");
		}echo '<meta http-equiv="Refresh" content="3;URL=../ajouter.php">'; // pause de 3 secondes avant redirection
	?>
	</body>
</html>
