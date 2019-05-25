<html lang="fr">
<title>Erreur lors de la suppression</title>
<?php
include_once 'header_bootstrap.html';
require_once '../sgbd_login.php';
?>
<br>
<div class="container border" ><br/>
    <div class="row">
        <h2 class="ml-3 mr-3 mb-3 mt-3">Attention à la suppression de ce match</h2>
    </div>
    <p class='ml-1 mr-3'>Vous avez proposé la composition suivante pour ce match :</p>
    <?PHP
    $id_matchs = $_POST['id_modal'];
    $req_match_participant = $link->prepare("SELECT * FROM participer WHERE id_matchs = :id_matchs");
    $req_match_participant->execute(array('id_matchs' => $id_matchs));
    echo '<ol>';
    while ($data = $req_match_participant->fetch()){
        $req_joueur_participant = $link->prepare("SELECT * FROM joueur WHERE id_joueur = :id_joueur");
        $req_joueur_participant->execute(array("id_joueur" => $data['id_joueur']));
        while ($data_joueur = $req_joueur_participant->fetch() ){
            echo '<li>'.$data_joueur['Nom'].' '.$data_joueur['Prenom'].'</li>';
        }
    }
    echo '</ol>';
    ?>
    <p class='ml-1 mr-3'><i>Il est nécessaire qu'un joueur ne participe à aucun match pour le supprimer.</i><a class="ml-1 mr-3 mb-3" href="javascript:history.go(-1)">Retour</a></p>
    
</div>
</html>


