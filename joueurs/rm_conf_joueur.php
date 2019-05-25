<html lang="fr">
	<title>Confirmer la suppression</title>
	<?php
		include_once 'header_bootstrap.html';
		require_once '../sgbd_login.php';
	?>
    <br>
	<div class="container border" ><br/>
		<div class="row">
			<h2 class="ml-3 mr-3 mb-3 mt-3">Confirmation de suppression</h2>
		</div>
		<?PHP
            $id_joueur = $_POST['id_joueur'];
            $req_afficher = $link->prepare("SELECT * FROM joueur WHERE id_joueur = :id_joueur");
            $req_afficher->execute(array('id_joueur' => $id_joueur));
            $data = $req_afficher->fetch();
            echo "<p class='ml-1 mr-3'>Êtes-vous sûre de vouloir supprimer le joueur ".$data['nom']." ".$data['prenom']." ?</p>";
            $req_joueur_participant = $link->prepare("SELECT * FROM participer WHERE id_joueur = :id_joueur");
            $req_joueur_participant->execute(array('id_joueur' => $id_joueur));
            if ($req_joueur_participant->rowCount() > 0 ) {
                echo "<p class='ml-1 mr-3'>Ses participations au(x) match(s) suivant(s) seront également supprimée(s):</p>";
                echo '<ol>';
                while ($data = $req_joueur_participant->fetch()) {
                    $req_match_participant = $link->prepare("SELECT * FROM matchs WHERE id_matchs = :id_matchs");
                    $req_match_participant->execute(array("id_matchs" => $data['id_matchs']));
                    while ($data_match = $req_match_participant->fetch()) {
                        echo '<li>' . $data_match['equipeAdverse'] . ' le ' . $data_match['dateHeure'] . ' à ' . $data_match['lieu'] . '</li>';
                    }
                }
                echo '</ol>';
            }
            echo '<div class="row">
                <form action="../afficher.php" method="post">
                    <input type="hidden" name="id_joueur" value='.$id_joueur.'>
                    <input type="submit" name="annuler" value="Annuler" class="form-group btn btn-secondary ml-3 mr-3 mb-3 mt-3">
                    <input type="submit" name="confirmer" value="Confirmer" class="form-group btn btn-primary ml-3 mr-3 mb-3 mt-3" formaction="rm_joueur.php" > 
                </form>
            </div>';
		?>
	</div>
</html>


