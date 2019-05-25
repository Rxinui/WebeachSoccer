<html lang="fr">
<title>Erreur lors de la suppression</title>
<?php
include_once 'header_bootstrap.html';
require_once '../sgbd_login.php';
?>
<br>
<div class="container border" ><br/>
    <div class="row">
        <h2 class="ml-3 mr-3 mb-3 mt-3">Impossible de supprimer le joueur</h2>
    </div>
    <p class='ml-1 mr-3'>Ce joueur ne peut pas être supprimé car il participe (ou a participé) au(x) match(s) suivant(s) : </p>
    <?PHP
    $id_joueur = $_POST['id_joueur'];
    $req_joueur_participant = $link->prepare("SELECT * FROM participer WHERE id_joueur = :id_joueur");
    $req_joueur_participant->execute(array('id_joueur' => $id_joueur));
    echo '<ol>';
    while ($data = $req_joueur_participant->fetch()){
        $req_match_participant = $link->prepare("SELECT * FROM matchs WHERE id_matchs = :id_matchs");
        $req_match_participant->execute(array("id_matchs" => $data['id_matchs']));
        while ($data_match = $req_match_participant->fetch() ){
            echo '<li>'.$data_match['equipeAdverse'].' le '.$data_match['dateHeure'].' à '.$data_match['lieu'].'</li>';
        }
    }
    echo '</ol>';
    ?>
    <p class='ml-1 mr-3'><i>Il est nécessaire qu'un joueur ne participe à aucun match pour le supprimer.</i><a class="ml-1 mr-3 mb-3" href="javascript:history.go(-1)">Retour</a></p>

</div>
</html>


