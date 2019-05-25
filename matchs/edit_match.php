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
	// ID connexion
    require_once '../sgbd_login.php';
    include '../class/MyElement.php';
    $id = $_POST['id_modal'];
	$equipeAdverse = $_POST['equipeAdverse'];
    $scoreEquipe = $_POST['scoreEquipe'];
    $scoreAdverse = $_POST['scoreAdverse'];
    $dateM = $_POST['dateM'];
    $heure = $_POST['heure'];
    $lieu = $_POST['lieu'];
    // harmonisation des variables 
    $dateHeure = $dateM.' '.$heure;
    $resultat = $scoreEquipe.'-'.$scoreAdverse;
	// requete
    //Préparation de la requête
    $req = $link->prepare(' UPDATE matchs
                            SET equipeAdverse=:equipeAdverse, resultat=:resultat, dateHeure=:dateHeure, lieu=:lieu
                            WHERE matchs.id_matchs=:id');
    ///Exécution de la requête
    $req->execute(array('equipeAdverse' => $equipeAdverse,
                        'resultat' => $resultat,
                        'dateHeure' => $dateHeure,
                        'lieu' => $lieu,
                        'id' => $id));
    MyElement::pageConfirmation("Match modifie avec succès","../rsc/success.png");
    echo '<meta http-equiv="Refresh" content="3;URL=../afficher.php">'; // pause de 3 secondes avant redirection
?>
    </body>
</html>