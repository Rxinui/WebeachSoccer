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
        //Recuperation des données
        $id = $_POST['id_joueur'];

        // requete
        //Préparation de la requête
        $req = $link->prepare(' DELETE FROM joueur 
                                        WHERE id_joueur=:id');
        ///Exécution de la requête
        $req->execute(array('id' => $id));
        header("Location: ../afficher.php");
        ?>
    </body>
</html>