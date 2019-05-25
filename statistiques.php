<?php
    require 'is_connected.php';
    require_once 'sgbd_login.php';
    require_once 'class/Match.php';
    require_once 'class/Stats.php';
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Statistiques</title>
        <?php
        include 'header_bootstrap.html';
        ?>
        <script src="node_modules/chart.js/dist/Chart.js"></script>
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
                    <a class="nav-item nav-link" role="tab" href="ajouter.php" aria-selected="false">Ajouter</a>
                    <a class="nav-item nav-link active" data-toggle="tab" role="tab" href="statistiques.php"
                       aria-selected="true">Statistiques<span class="sr-only">(current)</span></a>
                </div>
            </div>
            <form method="post" id="checkout_form"></form>
            <button class="btn btn-outline-danger " name="checkout" type="submit" form="checkout_form" formaction="checkout_connexion.php">Se déconnecter</button>
        </nav>
        <div class="container border-right border-left"><br/>
            <!-- LA NAVTAB MATCH ET JOUEURS ET PARTICIPANTS -->
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="joueurs-tab" data-toggle="tab" href="#joueurs" role="tab" aria-controls="joueurs" aria-selected="true">Joueurs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="matchs-tab" data-toggle="tab" href="#matchs" role="tab" aria-controls="matchs" aria-selected="false">Matchs</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <!--TAB JOUEURS-->
                <div class="tab-pane fade show active" id="joueurs" role="tabpanel" aria-labelledby="joueurs-tab">
                    <div class="container">
                        <h1 class="mt-3">Les joueurs</h1><br/>
                        <div class="row">
                            <!-- LIST GROUP MENU -->
                            <div class="col-3">
                                <div class="list-group" id="list-tab" role="tablist">
                                    <?php
                                    $req_recuperer_joueurs = $link->prepare("SELECT * FROM joueur");
                                    $req_recuperer_joueurs->execute();
                                    $tab_id_joueur = array();
                                    $cpt = 0;
                                    while ($data = $req_recuperer_joueurs->fetch()) {
                                        $value = "joueur" . $cpt;
                                        echo "<a class=\"list-group-item list-group-item-action " . ($cpt == 0 ? "active" : "") . "\" id=\"list-$value-list\" data-toggle=\"list\" href=\"#list-$value\" role=\"tab\" aria-controls=\"home\">$data[nom] $data[prenom]</a>
                                        ";
                                        $cpt++;
                                        array_push($tab_id_joueur, $data['id_joueur']);
                                    }
                                    ?>
                                </div>
                            </div>
                            <!-- LIST GROUP CONTENU -->
                            <div class="col-9">
                                <div class="tab-content" id="nav-tabContent">
                                    <?php
                                    $cpt = 0;
                                    foreach ($tab_id_joueur as $id_joueur) {
                                        $req_recuperer_participants = $link->prepare("SELECT * FROM participer WHERE id_joueur = :id_joueur");
                                        $req_recuperer_participants->execute(array("id_joueur" => $id_joueur));
                                        $tab_participant = ["nb_titulaire" => 0, "nb_remplacant" => 0, "total_note" => 0, "nb_matchs_gagnes" => 0];
                                        $tab_notes = ["note" => array(), "dateMatch" => array()];
                                        $cpt_selection_consecutif = 0;
                                        for ($i = 0; $data = $req_recuperer_participants->fetch(); $i++) {
                                            if ($data['titulaire'] == 1) {
                                                $tab_participant['nb_titulaire']++;
                                            }
                                            $tab_participant['total_note'] += $data['note'];
                                            $tab_notes["note"][] = $data['note'];
                                            $req_recuperer_le_match = $link->prepare("SELECT * FROM matchs WHERE id_matchs = :id_matchs ORDER BY dateHeure DESC");
                                            $req_recuperer_le_match->execute(array("id_matchs" => $data['id_matchs']));
                                            $leMatch = $req_recuperer_le_match->fetch();
                                            $m = new Match($leMatch['id_matchs'], $leMatch['dateHeure'], $leMatch['equipeAdverse'], $leMatch['lieu'], $leMatch['resultat']);
                                            if ($m->compareTo() > 0) {
                                                $tab_participant['nb_matchs_gagnes']++;
                                            }
                                            $tab_notes["dateMatch"][] = $m->getDateMatch(true);
                                        }
                                        $joueur = $link->prepare("SELECT poste, statut FROM joueur WHERE id_joueur = :id_joueur");
                                        $joueur->execute(array("id_joueur" => $id_joueur));
                                        $joueur = $joueur->fetch();
                                        $tab_participant['nb_remplacant'] = $i - $tab_participant['nb_titulaire'];
                                        $value = "joueur" . $cpt;
                                        $id_canvas = "id-" . $id_joueur . "-chart" . $cpt;
                                        echo "<div class=\"tab-pane fade " . ($cpt == 0 ? "show active" : "") . "\" id=\"list-$value\" role=\"tabpanel\" aria-labelledby=\"list-$value-list\">\n";
                                        echo '<div class="row">';
                                        echo "<table class=\"table\">
                                        <tr>
                                            <th>Statut actuel</th>
                                            <th>Poste préféré</th>
                                            <th>% de matchs gagnés</th>
                                            <th>Moyenne des notes</th>
                                        </tr>
                                        <tr>
                                            <td>$joueur[statut]</td>
                                            <td>$joueur[poste]</td>
                                            <td>" . ($tab_participant['nb_matchs_gagnes'] != 0 ? Stats::pourcentage($tab_participant['nb_matchs_gagnes'], $i) : '0') . "</td>
                                            <td>" . Stats::moyenne($tab_notes['note']) . "/5</td>
                                        </tr>
                                        </table>";
                                        Stats::titulaireChart($id_canvas . "-bar", $tab_participant['nb_titulaire'], $tab_participant['nb_remplacant']);
                                        Stats::moyenneNoteChart($id_canvas . "-line", $tab_notes["note"], $tab_notes["dateMatch"]);
                                        echo '</div>';
                                        echo '</div>';
                                        $cpt++;
                                    }
                                    ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--TAB MATCHS-->
                <div class="tab-pane fade" id="matchs" role="tabpanel" aria-labelledby="matchs-tab"><br/>
                    <div class="container">
                        <div class="row">
                            <canvas id="myChart" width="400" height="200"></canvas>
                            <script>
                                <?php
                                    $req_recuperer_matchs = $link->prepare("SELECT * FROM matchs");
                                    $req_recuperer_matchs->execute();
                                    $stats = [0, 0, 0];
                                    while ($data = $req_recuperer_matchs->fetch()) {
                                        $m = new Match($data['id_matchs'], $data['dateHeure'], $data['equipeAdverse'], $data['lieu'], $data['resultat']);
                                        if ($m->compareTo() > 0) {
                                            $stats[0] += 1;
                                        } elseif ($m->compareTo() < 0) {
                                            $stats[2] += 1;
                                        } else {
                                            $stats[1] += 1;
                                        }
                                    }$tab_pourcentage = [Stats::pourcentage($stats[0], $stats), Stats::pourcentage($stats[1], $stats), Stats::pourcentage($stats[2], $stats)];


                                    ?>;
                                var nbMatchsGagnes = <?php echo $stats[0]; ?>;
                                var nbMatchsNuls = <?php echo $stats[1]; ?>;
                                var nbMatchsPerdus = <?php echo $stats[2]; ?>;
                                var tab_resultat = [nbMatchsGagnes, nbMatchsNuls, nbMatchsPerdus];
                                var tab_pourcentage = [<?php echo $tab_pourcentage[0]; ?>, <?php echo $tab_pourcentage[1]; ?>, <?php echo $tab_pourcentage[2]; ?>];
                                var ctx = document.getElementById("myChart");
                                var myChart = new Chart(ctx, {
                                    type: 'bar',
                                    data: {
                                        labels: ["Gagnés : " + tab_pourcentage[0] + "%", "Nuls " + tab_pourcentage[1] + "%", "Perdus " + tab_pourcentage[2] + "%"],
                                        datasets: [{
                                            label: "Statistiques de l'équipe",
                                            data: tab_resultat,
                                            backgroundColor: [
                                                'rgba(75, 192, 192, 0.2)',
                                                'rgba(255, 206, 86, 0.2)',
                                                'rgba(255, 99, 132, 0.2)',
                                            ],
                                            borderColor: [
                                                'rgba(75, 192, 192, 1)',
                                                'rgba(255, 206, 86, 1)',
                                                'rgba(255,99,132,1)',
                                            ],
                                            borderWidth: 1
                                        }]
                                    },
                                    options: {
                                        scales: {
                                            yAxes: [{
                                                ticks: {
                                                    beginAtZero: true,
                                                    min: 0,
                                                    max: Math.max(...tab_resultat) + 2, // plus jolie
                                                    stepSize: 1
                                                }
                                            }]
                                        }
                                    }
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>