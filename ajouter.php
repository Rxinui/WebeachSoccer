<?php
    require 'is_connected.php';
    require_once 'sgbd_login.php';
    require_once 'class/Joueur.php';
    require_once 'class/Match.php';
    require_once 'class/Participant.php';
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Page d'ajout</title>
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
                    <a class="nav-item nav-link" role="tab" href="afficher.php" aria-selected="false">Afficher</a>
                    <a class="nav-item nav-link active" data-toggle="tab" role="tab" href="ajouter.php"
                       aria-selected="true">Ajouter<span class="sr-only">(current)</span></a>
                    <a class="nav-item nav-link" role="tab" href="statistiques.php" aria-selected="false">Statistiques</a>
                </div>
            </div>
            <form method="post" id="checkout_form"></form>
            <button class="btn btn-outline-danger " name="checkout" type="submit" form="checkout_form" formaction="checkout_connexion.php">Se déconnecter</button>
        </nav>
        <div class="container border-right border-left"><br/>
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="joueurs-tab" data-toggle="tab" href="#joueurs" role="tab"
                       aria-controls="joueurs" aria-selected="true">Joueurs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="matchs-tab" data-toggle="tab" href="#matchs" role="tab" aria-controls="profile"
                       aria-selected="false">Matchs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="participants-tab" data-toggle="tab" href="#participants" role="tab"
                       aria-controls="profile" aria-selected="false">Participants</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <!--TAB AJOUT DE JOUEUR-->
                <div class="tab-pane fade show active" id="joueurs" role="tabpanel" aria-labelledby="joueurs-tab">
                    <div class="container">
                        <div class="row">
                            <!-- formulaire d'ajout de joueur -->
                            <?PHP
                            $j = new Joueur();
                            $j->form("joueurs/add_joueur.php", "Ajouter un joueur", "Ajouter");
                            ?>
                        </div>
                    </div>
                </div>
                <!-- TAB AJOUT DE MATCH -->
                <div class="tab-pane fade" id="matchs" role="tabpanel" aria-labelledby="matchs-tab">
                    <div class="container">
                        <div class="row">
                            <!-- formulaire d'ajout de match -->
                            <?PHP
                            $m = new Match();
                            $m->form("matchs/add_match.php", "Ajouter un match", "Ajouter");
                            ?>
                        </div>
                    </div>
                </div>
                <!--TAB AJOUT DE PARTICIPANTS-->
                <div class="tab-pane fade" id="participants" role="tabpanel" aria-labelledby="participants-tab"><br/>
                    <div class="container">
                        <form action="participants/add_participant.php" method="POST">
                            <!-- PHP MATCH -->
                            <?PHP
                            $req_match = $link->prepare("SELECT * FROM matchs m WHERE m.id_matchs NOT IN(SELECT id_matchs FROM participer) ORDER BY dateHeure DESC ");
                            $req_match->execute();
                            echo '<label class="ml-3" for="selectMatchs">Matchs</label>';
                            echo '<div class="form-inline" >
                                    <select class="form-control ml-3 mr-3 col-10" name="id_matchs" id="selectMatchs">';
                            $cpt = 0;
                            while ($data = $req_match->fetch()) {
                                echo "<option value=\"$data[id_matchs]\">$data[equipeAdverse] le $data[dateHeure] à $data[lieu] </option>";
                                $cpt++;
                            }
                            echo '</select>';
                            $req_afficher_joueur = $link->prepare("SELECT * FROM joueur WHERE statut = 'Actif' ");
                            $req_afficher_joueur->execute();
                            echo '<input class="btn btn-primary col-1" type="submit" value="Valider" ' .($req_afficher_joueur->rowCount() >= Participant::MIN_JOUEURS ? : 'disabled'). ' >'; // creer un constante JOUEUR_MIN = 5;
                            echo '</div>';
                            ?>
                            <!-- PHP JOUEUR -->
                            <?PHP
                            echo '<div class="row">';
                            $req_afficher_joueur->execute();
                            $cpt = 0;
                            while ($data = $req_afficher_joueur->fetch()) {
                                $cpt++;
                                /* on crée des instances joueurs pour appeler la methode toCardTitulaire() */
                                $j = new Joueur($data['id_joueur'], $data['numLicence'], $data['nom'], $data['prenom'], $data['dateNaissance'], $data['taille'], $data['poids'], $data['statut'], $data['poste'], $data['photoPath']);
                                $j->toCardTitulaire($cpt);
                            }
                            echo '<input class="btn btn-primary" type="hidden" name="cpt" value="' . $cpt . '">';
                            echo '</div>';
                            include 'footer_bootstrap.html';
                            ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
