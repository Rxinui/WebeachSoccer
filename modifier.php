<?php
    require 'is_connected.php';
    require_once 'sgbd_login.php';
    require_once 'class/Joueur.php';
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Modifier un joueur</title>
        <?php
        include 'header_bootstrap.html';
        ?>
    </head>
    <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light" id="myNavBar">
        <a class="navbar-brand" href="#"><img src="rsc/beach-soccer.png" width="48" height="44" alt="icone beach soccer"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav" role="tablist">
				<a class="nav-item nav-link"  role="tab" href="afficher.php" aria-selected="false">Afficher</a>
				<a class="nav-item nav-link"  role="tab" href="ajouter.php" aria-selected="false">Ajouter</a>
				<a class="nav-item nav-link" role="tab" href="statistiques.php" aria-selected="false">Statistiques</a>
			</div>
		</div>
        <form method="post" id="checkout_form"></form>
        <button class="btn btn-outline-danger " name="checkout" type="submit" form="checkout_form" formaction="checkout_connexion.php">Se déconnecter</button>
	</nav>
	<?PHP
		// si l'utilisateur tente d'acceder via l'url a modifier.php on le redirige sur afficher.php
		if (empty($_POST['id_joueur'])){
			echo "<script type='text/javascript'>document.location.replace('afficher.php');</script>";
		}
		// on recupere l'id du joueur qu'on souhaite modifier
		$id_joueur = $_POST['id_joueur'];
		// on execute la requete 
		$req_afficher = "SELECT * FROM joueur WHERE id_joueur = ?";
		$reqVerif = $link->prepare($req_afficher);
		$reqVerif->execute(array($id_joueur)); // array est necessaire
		$data = $reqVerif->fetch();
		echo '<div class="container border-right border-left" >
			<div class="row">
			';
			$j = new Joueur($data['id_joueur'],$data['numLicence'],$data['nom'],$data['prenom'],$data['dateNaissance'],$data['taille'],$data['poids'],$data['statut'],$data['poste'],$data['photoPath']);
			$j->toCard();
			$j->form("joueurs/edit_joueur.php","Modifier les informations du joueur","Modifier");
			echo '</div>
			</div>';
	?>
    </body>
</html>
