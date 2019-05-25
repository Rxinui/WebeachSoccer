<?php
require 'is_connected.php';
require_once 'sgbd_login.php';
require_once 'class/Joueur.php';
require_once 'class/Match.php';
require_once 'class/Participant.php';
require_once 'class/MyElement.php';
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Page d'affichage</title>
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
                    <a class="nav-item nav-link active" data-toggle="tab" role="tab" href="afficher.php" aria-selected="true">Afficher<span
                                class="sr-only">(current)</span></a>
                    <a class="nav-item nav-link" role="tab" href="ajouter.php" aria-selected="false">Ajouter</a>
                    <a class="nav-item nav-link" role="tab" href="statistiques.php" aria-selected="false">Statistiques</a>
                </div>
            </div>
            <form method="post" id="checkout_form"></form>
            <button class="btn btn-outline-danger " name="checkout" type="submit" form="checkout_form"
                    formaction="checkout_connexion.php">Se déconnecter
            </button>
        </nav>
        <div class="container border-right border-left"><br/>
            <!-- LA NAVTAB MATCH ET JOUEURS ET PARTICIPANTS -->
            <?PHP
            MyElement::tabNavs();
            ?>
            <div class="tab-content" id="myTabContent">
                <!--TAB JOUEURS-->
                <div class="tab-pane fade show active" id="joueurs" role="tabpanel" aria-labelledby="joueurs-tab">
                    <div class="container">
                        <h1 class="mt-3">Les joueurs</h1><br/>
                        <div class="row">
                            <!-- carte du joueur a generer avec php-->
                            <?PHP
                            $req_afficher = "SELECT * FROM joueur ORDER BY nom, prenom";
                            $reqVerif = $link->query($req_afficher);
                            while ($data = $reqVerif->fetch()) {
                                /* on crée des instances joueurs pour appeler la methode toCard() */
                                $j = new Joueur($data['id_joueur'], $data['numLicence'], $data['nom'], $data['prenom'], $data['dateNaissance'], $data['taille'], $data['poids'], $data['statut'], $data['poste'], $data['photoPath']);
                                $req_participant = $link->prepare("SELECT * FROM participer WHERE id_joueur = :id_joueur");
                                $req_participant->execute(array("id_joueur" => $j->getId_joueur()));
                                $j->toCard();
                            }
                            $reqVerif->closeCursor();
                            include 'footer_bootstrap.html';
                            ?>

                        </div>
                    </div>
                </div>
                <!--TAB MATCHS-->
                <div class="tab-pane fade " id="matchs" role="tabpanel" aria-labelledby="matchs-tab"><br/>
                    <div class="container">
                        <div class="row">
                            <div class="tab-content col-10 " id="nav-tabContent">

                                <?PHP
                                $tab_trie = array('dateHeure', 'equipeAdverse', 'lieu', 'resultat');
                                $cpt = 0;
                                foreach ($tab_trie as $valeur_trie) {
                                    echo "<div class=\"tab-pane fade " . ($cpt == 0 ? "show active" : "") . "\" id=\"list-$valeur_trie\" role=\"tabpanel\" aria-labelledby=\"list-$valeur_trie-list\">\n";
                                    if ($valeur_trie == $tab_trie[0] or $valeur_trie == $tab_trie[3]) {
                                        $req_afficher_par_tri = $link->query("SELECT * FROM matchs ORDER BY $valeur_trie DESC");
                                    } else {
                                        $req_afficher_par_tri = $link->query("SELECT * FROM matchs ORDER BY $valeur_trie");
                                    }
                                    $cpt_ligne = 0;
                                    echo '
                                                 <table class="table">
                                                    <thead class="thead-light">
                                                        <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Équipe</th>
                                                        <th scope="col">Résultat</th>
                                                        <th scope="col">Date et heure</th>
                                                        <th scope="col">Lieu</th>
                                                        <th scope="col" style="text-align:center">Modifier</th>
                                                        <th scope="col" style="text-align:center">Supprimer</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                ';
                                    while ($data = $req_afficher_par_tri->fetch()) {
                                        $cpt_ligne++;
                                        /* on crée des instances joueurs pour appeler la methode toCard() */
                                        $m = new Match($data['id_matchs'], $data['dateHeure'], $data['equipeAdverse'], $data['lieu'], $data['resultat']);
                                        $m->toTable($cpt_ligne);
                                    }
                                    echo '</tbody>
                                                     </table>';
                                    echo '</div>';
                                    $req_afficher_par_tri->closeCursor();
                                    $cpt++;
                                }
                                include 'footer_bootstrap.html';
                                ?>

                            </div>
                            <div class="col-2">
                                <!-- A implementer le SQL/PHP pour trier -->
                                <h4>Trier par</h4><br/>
                                <div class="list-group" id="list-tab" role="tablist">
                                    <a class="list-group-item list-group-item-action active" id="list-dateHeure-list"
                                       data-toggle="list" href="#list-dateHeure" role="tab" aria-controls="date-heure">Date et
                                        heure</a>
                                    <a class="list-group-item list-group-item-action" id="list-equipeAdverse-list"
                                       data-toggle="list" href="#list-equipeAdverse" role="tab"
                                       aria-controls="equipe">Équipe</a>
                                    <a class="list-group-item list-group-item-action" id="list-lieu-list" data-toggle="list"
                                       href="#list-lieu" role="tab" aria-controls="lieu">Lieu</a>
                                    <a class="list-group-item list-group-item-action" id="list-resultat-list" data-toggle="list"
                                       href="#list-resultat" role="tab" aria-controls="resultat">Résultat</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--TAB PARTICIPANTS-->
                <div class="tab-pane fade" id="participants" role="tabpanel" aria-labelledby="participants-tab"><br/>
                    <div class="container">
                        <!-- SELECT MATCH -->
                        <form method="POST" action="#participants">
                            <label class="ml-3" for="selectMatchs">Matchs</label>
                            <div class="form-inline mb-3">
                            <select class="form-control ml-3 mr-3 col-8" name="id_matchs" id="selectMatchs">
                            <?PHP
                            $req_match = $link->prepare("SELECT * FROM matchs ORDER BY dateHeure DESC");
                            $req_match->execute();
                            $cpt = 0;
                            while ($data = $req_match->fetch()) {
                                echo '<option value="' . $data['id_matchs'] . '" ' . ($data['id_matchs'] == $_POST['id_matchs'] ? 'selected' : '') . ' >' . $data['equipeAdverse'] . ' le ' . $data['dateHeure'] . ' à ' . $data['lieu'].'</option>';
                                $cpt++;
                            }?>
                            </select>
                                <input class="btn btn-primary mr-3 " type="submit" value="Afficher" name="afficher">
                                <input class="btn btn-success mr-3" type="submit" value="Modifier" formaction="participants/edit_participant.php" <?php echo (isset($_POST['afficher']) ? '' : 'disabled'); ?>>
                                <input class="btn btn-danger mr-3 " type="submit" value="Supprimer" formaction="participants/rm_participant.php" <?php echo (isset($_POST['afficher']) ? '' : 'disabled'); ?>>
                            </div>
                            <!-- AFFICHAGE DU NB TITULAIRE ET REMPLACANT -->
                            <?PHP
                                if (isset($_POST['id_matchs'])){
                                    $req_nb_titulaire = $link->prepare("SELECT titulaire, COUNT(*) as nb FROM `participer` WHERE id_matchs = ? GROUP BY titulaire ORDER BY 1 DESC ");
                                    $req_nb_titulaire->execute(array($_POST['id_matchs']));
                                    $nbTitulaire = $req_nb_titulaire->fetchAll();
                                    if (!empty($nbTitulaire)) {
                                        echo '<span class="form-inline">
                                                <div class="alert alert-primary col-2 ml-3 mr-3" role="alert">TITULAIRES<span class="badge badge-dark ml-1">' . $nbTitulaire[0]['nb'] . '</span></div>
                                                <div class="alert alert-warning col-2" role="alert">REMPLACANTS<span class="badge badge-dark ml-1">' . $nbTitulaire[1]['nb'] . '</span></div>
                                            </span>';
                                    }
                                }
                            ?>
                            <div class="row">
                            <!-- AFFICHAGE DES JOUEURS-->
                            <?php
                                $req_participer = $link->prepare("SELECT * FROM participer WHERE id_matchs = :id_matchs ORDER BY titulaire DESC");
                                $req_participer->execute(array("id_matchs" => (isset($_POST['id_matchs']) ? $_POST['id_matchs'] : '')));
                                for ($cpt = 0; $data = $req_participer->fetch(); $cpt++) {
                                    // MYSQL
                                    $req_recuperer_joueur = $link->prepare("SELECT * FROM joueur WHERE id_joueur = :id_joueur");
                                    $req_recuperer_joueur->execute(array("id_joueur" => $data['id_joueur']));
                                    $joueur = $req_recuperer_joueur->fetch();
                                    $req_recuperer_matchs = $link->prepare("SELECT * FROM matchs WHERE id_matchs = :id_matchs");
                                    $req_recuperer_matchs->execute(array("id_matchs" => $data['id_matchs']));
                                    $matchs = $req_recuperer_matchs->fetch();
                                    // POO
                                    echo '<input type="hidden" name="id_joueur'.$cpt.'" value="' .$joueur['id_joueur']. '">';
                                    $j = new Joueur($joueur['id_joueur'], $joueur['numLicence'], $joueur['nom'], $joueur['prenom'], $joueur['dateNaissance'], $joueur['taille'], $joueur['poids'], $joueur['statut'], $joueur['poste'], $joueur['photoPath']);
                                    $m = new Match($matchs['id_matchs'], $matchs['dateHeure'], $matchs['equipeAdverse'], $matchs['lieu'], $matchs['resultat']);
                                    $p = new Participant($j, $m, $data['titulaire'], $data['note'], $data['commentaire']);
                                    $p->toCard($cpt);
                                }
                                if ($req_participer->rowCount() == 0 and isset($_POST['afficher'])) {
                                    $req_match_selectionne = $link->prepare('SELECT equipeAdverse FROM matchs WHERE id_matchs = :id_matchs');
                                    $req_match_selectionne->execute(array('id_matchs' => $_POST['id_matchs']));
                                    $nomEquipe = $req_match_selectionne->fetch();
                                    echo '<div class="container"><h2 style="text-align:center">Aucun participant pour le match contre ' . $nomEquipe[0] . '.</div>';
                                }
                                echo '<input type="hidden" name="cpt" value="' . $cpt . '">';
                                ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>